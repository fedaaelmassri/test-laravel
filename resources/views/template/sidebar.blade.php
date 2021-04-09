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

                <img src="{{ asset('assets/images/user-small.png') }}" class="user-photo" alt="صورة المستخدم">
            </div>
            <div class="dropdown">
                <span>Welcome،</span>
                <a href="{{route('profile',['id'=>auth()->user()->id])}}" class="user-name">
                    <strong>{{auth()->user()->name}}</strong>
                </a>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="divider"></li>
                <li class="@yield('profile')">
                    <a href="{{route('profile',['id'=>auth()->user()->id])}}"><i class="icon-user"></i><span>Profile</span></a>
                </li>  
                 <li class="divider"></li>
                <li class="@yield('products')">
                    <a href="{{route('products')}}"><i class="icon-present"></i><span>Products</span></a>
                </li>

              

                <li><a href="{{route('admin.logout')}}"><i class="icon-power"></i>Logout</a></li>
            </ul>
        </nav>
    </div>
