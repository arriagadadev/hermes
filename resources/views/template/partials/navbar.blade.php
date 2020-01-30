<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
            <li class="search-box"><a class="search-toggle no-pdd-right" href="javascript:void(0);"><i class="search-icon ti-search pdd-right-10"></i> <i class="search-icon-close ti-close pdd-right-10"></i></a></li>
            <li class="search-input">
                <input class="form-control" type="text" placeholder="Search...">
            </li>
        </ul>
        <ul class="nav-right">
            <li>
                <router-link to="/my-account" class="peers fxw-nw ai-c lh-1">
                    <div class="peer mR-5"><i class="material-icons nav-icon">account_circle</i></div>
                    <div class="peer"><span class="fsz-sm c-grey-900">{{ Auth::user()->name }}</span></div>
                </router-link>
            </li>
            <li>
                <a href="#" class="peers fxw-nw ai-c lh-1" 
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <div class="peer mR-5">
                        <i class="material-icons nav-icon">power_settings_new</i>
                    </div>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>