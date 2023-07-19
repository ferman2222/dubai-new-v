<nav class="sidebar dark_sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
    <a href="{{ route('admin.slider.index') }}"><img src="{{asset('front')}}/img/jedlogo.svg" alt=""></a>
    <div class="sidebar_close_icon d-lg-none">
    <i class="ti-close"></i>
    </div>
    </div>
    <ul id="sidebar_menu">
    <li >
        <a  href="{{ route('admin.index') }}" aria-expanded="false">
            <div class="icon_menu">
                <i class="ti-layers-alt"></i>
            </div>
            <span>Əsas səhifə kə</span>
        </a>
    </li>

    <li>
        <a  href="{{ route('admin.categories.index') }}" aria-expanded="false">
            <div class="icon_menu">
                <i class="ti-layers-alt"></i>
            </div>
            <span>Kateqoriyalar</span>
        </a>
    </li>

    <li >
        <a  href="{{ route('admin.slider.index') }}" aria-expanded="false">
            <div class="icon_menu">
                <i class="ti-layers-alt"></i>
            </div>
            <span>Slayder</span>
        </a>
    </li>


    <li >
        <a  href="{{ route('admin.galery.index') }}" aria-expanded="false">
        <div class="icon_menu">
            <i class="ti-gallery"></i>
        </div>
        <span>Qalereya</span>
        </a>
    </li>

    <li >
        <a  href="{{ route('admin.region.index') }}" aria-expanded="false">
        <div class="icon_menu">
            <i class="ti-gallery"></i>
        </div>
        <span>Regionlar</span>
        </a>
    </li>


    <li>
        <a  href="{{ route('admin.setting.index') }}" aria-expanded="false">
        <div class="icon_menu">
            <i class="ti-settings"></i>
        </div>
        <span>Ayarlardi bu ozum olum </span>
     
        </a>
    
    </li>


    </ul>
    </nav>
</ul>