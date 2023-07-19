<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index()
    {
        return "salam";
        $regions=Region::orderBy('id','DESC')->get();
        return view('admin.pages.region.index',compact('regions'));
    }

    public function create()
    {
        return view('admin.pages.region.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regions=new region;
        $data = $request->all();
        $validator = Validator::make($data, [
            'link'   => 'required',
            'img'   => 'required|mimes:png,jpg,svg,webp',
        ],
        [
            'link.required'=>'Zəhmət olmasa linki daxil edin',
            'img.required'=>'Zəhmət olmasa şəkili daxil edin',
            'img.mimes'=>'Şəkil png , jpg ,svg , webp formatında olmalıdır',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if($request->has('img'))
        {
            $ext=$request->img->extension();
            $fileName=rand(1,100).time().'.'.$ext;
            $fileNameWithUpload='image/region/'.$fileName;
            $request->img->move('image/region/',$fileName);
            $data['img']=$fileNameWithUpload;
        }
        region::create($data);

        toastr()->success('Slayder məlumatarınız əlavə olundu');
        return redirect()->route('admin.region.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region=region::findOrFail($id);

        return view('admin.pages.region.edit',compact('region'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $region=region::findOrFail($id);
        $data = $request->all();
        $validator = Validator::make($data, [
            'link'    => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if($request->has('img'))
        {
            if(File::exists($region->img))
            {
                File::delete($region->img);
            }
            $ext=$request->img->extension();
            $fileName=rand(1,100).time().'.'.$ext;
            $fileNameWithUpload='image/region/'.$fileName;
            $request->img->move('image/region/',$fileName);
            $data['img']=$fileNameWithUpload;
        }
        $region->update($data);

        toastr()->success('Slayder məlumatlarınız uğurla güncəlləndi');
        return redirect()->route('admin.region.index');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $region=region::findOrFail($id);
            if(File::exists($region->img))
            {
                File::delete($region->img);
            }
        $region->delete();
        return response()->json([
            'message' => 'Slayderiniz uğurla silindi',
            'code' => 204,
        ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong',
                'code' => 500,
            ]);}
}
}
