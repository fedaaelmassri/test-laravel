<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="javascript:;">
            <img src="{{asset('assets/images/icon.svg')}}" alt="" class="img-fluid logo"><span>Oculux</span>
        </a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">

                <img src="{{ Auth::user()->avater?asset('storage/'. Auth::user()->avater):asset('assets/images/user-small.png') }}" class="user-photo" alt="صورة المستخدم">
            </div>
            <div class="dropdown">
                <span>{{trans('lang.welcome')}}،</span>
                <a href="{{route('profile',['id'=>auth()->user()->id])}}" class="user-name">
                    <strong>{{auth()->user()->name}}</strong>
                </a>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="divider"></li>
                <li class="@yield('profile')">
                    <a href="{{route('profile',['id'=>auth()->user()->id])}}"><i class="icon-user"></i><span>{{trans('lang.profile')}} </span></a>
                </li>

                <li class="@yield('all_requests')">
                    <a href="{{route('admin.requests')}}"><i class="icon-layers"></i><span> {{trans('lang.requests')}} </span></a>
                </li>
                <li class="@yield('file_upload')">
                    <a href="{{route('admin.uploadfile')}}">
                        <i class="icon-cloud-upload"></i><span>  {{trans('lang.uploadfile')}} </span></a>
                </li>

                <li><a href="{{route('admin.logout')}}"><i class="icon-power"></i>{{trans('lang.Logout')}}</a></li>
            </ul>
        </nav>
    </div>
