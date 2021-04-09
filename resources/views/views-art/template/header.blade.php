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
                            
                         <a>
                                 <div  class="text-left helper-text" >
                            
                            
                            
                            <div class="  dropdown show ">
                <?php
                $lang = '';
                if(App::getLocale() == 'en'){
                    $lang =  trans('lang.english') ;
                }elseif (App::getLocale() == 'ar')
                    $lang =  trans('lang.arabic');
                ?>
                                        @if(App::getLocale() == 'en')

                <a class="icone_cuscolor dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <img class="img-responsive" src="{{asset('/public/assets/images/en.jpg')}}">&nbsp;  {{$lang}} 
                              
                         
                 </a>
                 @endif
                 @if(App::getLocale() == 'ar')

                    <a class="icone_cuscolor dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <img class="img-responsive" src="{{asset('/public/assets/images/ar.jpg')}}">&nbsp;  {{$lang}} 
                                  
                           
                    </a>
                    
                    @endif


                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                            <a class="dropdown-item" href="{{ url('change/en') }}"  >  <img class="img-responsive" src="{{asset('/public/assets/images/en.jpg')}}">&nbsp;&nbsp;{{trans('lang.english')}}
                            </a>
                           <a class="dropdown-item" href="{{ url('change/ar') }}"  >  <img class="img-responsive" src="{{asset('/public/assets/images/ar.jpg')}}">&nbsp;&nbsp;{{trans('lang.arabic')}}
                           </a>
                </div>
             </div>
                            
                        </div>
                             
                             
                             
                         </a>   
                        </li>
                    <li>
                        <a href="{{route('admin.logout')}}" class="icon-menu" title="{{trans('lang.Logout')}}">
                           <span class="icon-power "></span>
                          {{trans('lang.Logout')}}
                        </a>
                        </li>
                        


                    <li><a href="# class=" icon-menu"><i class="icon-power"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</nav>
