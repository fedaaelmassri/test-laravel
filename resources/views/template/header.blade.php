<nav class="navbar top-navbar">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <a href="javascript:;">
                    <img src="{{asset('assets/images/logo.png')}}" alt="Oculux" class="img-fluid logo"></a>
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>
        </div>

        <div class="navbar-right">
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                   <li>
                        <a href="{{route('admin.logout')}}" class="icon-menu" title="Logout">
                           <span class="icon-power "></span>
                           Logout
                        </a>
                        </li>
                    <li> 
                </ul>
            </div>
        </div>
    </div>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</nav>
