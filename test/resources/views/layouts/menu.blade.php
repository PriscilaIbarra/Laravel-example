<nav class="uk-background-primary" uk-navbar="boundary-align: true; align: center;"  id="menu" > 
                <div class="uk-navbar-left ">
                   <ul class="uk-navbar-nav">
                       @guest
                            @if (Route::has('login'))
                            <li>    
                                <a href="{{url('/')}}" uk-tooltip="title: Home; pos: bottom"> 
                                    <span uk-icon="home"> 
                                    </span>
                                </a>
                            </li>
                           @endif 
                      @else  
                             <li>
                                <a href="#offcanvas-usage" uk-toggle uk-tooltip="title: Menu; pos: bottom">
                                    <span uk-icon="menu"> 
                                    </span>
                                </a>
                            </li>
                      @endguest    
                   </ul>    
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav"> 
                        @guest
                            @if (Route::has('register'))
                                <li> 
                                    <a href="{{ route('register') }}">
                                            {{ __('messages.Register') }} 
                                    </a>     
                               </li> 
                            @endif
                            @if (Route::has('login'))
                                <li> 
                                    <a href="{{ route('login') }}">
                                            {{ __('messages.Login') }} 
                                    </a>     
                               </li> 
                            @endif   
                        @else                            
                            <li>
                                <a href="#offcanvas-usage" uk-toggle >                                 
                                    @if(isset(Auth::user()->image))
                                    <img src="{{asset('images/users/'.Auth::user()->image->image_path)}}" class="uk-border-circle" style="height:35px;width:35px;">   
                                    @else
                                    <span uk-icon="user" class="uk-icon-button">                                         
                                    </span>
                                    @endif        
                                    <span uk-icon  class="uk-margin-small-left uk-margin-small-right" style="color:white">
                                        {{  Auth::user()->name }}
                                    </span>
                                </a>
                            </li>
                            <li>    
                                    <a class="dropdown-item" href="{{ route('logout') }}" uk-toggle uk-tooltip="title: {{ __('messages.Logout') }}; pos: bottom"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <span uk-icon="sign-out"> 
                                       </span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
                    <ul>    
                </div>             
</nav>
<div id="offcanvas-usage" uk-offcanvas>
    <div class="uk-offcanvas-bar uk-background-primary" >
        <button class="uk-offcanvas-close" type="button" uk-close></button>
        <div class="uk-align-center uk-text-center  uk-margin-small-top">
                <span class="uk-icon-button" uk-icon="icon: user; ratio: 2" style="height:80px;width:80px;" >
                </span>
                <h5 class="uk-text-center uk-margin-small-top">                   
                    @auth 
                         {{ Auth::user()->name }}
                    @endauth
                </h5>
                <hr>
        </div>
        <h3 class="uk-text-center">{{__('messages.Menu')}}</h3>
        <ul class="uk-list" uk-accordion="multiple: true">                 
                     <li> 
                    <a class="uk-accordion-title" style="font-size:17px">               
                        <span class="uk-icon-button"  uk-icon="server"> 
                        </span> 
                  
                    </a>   
                    <div class="uk-accordion-content uk-margin-left">
                        <ul class="uk-list">                                         
                            <ul uk-accordion>
                                <li>
                                    <a style="font-size:14px" class="uk-accordion-title"> 
                                        <span class="uk-icon-button" uk-icon="video-camera"></span>
                                         
                                    </a>
                                    <div class="uk-accordion-content uk-margin-left" >
                                        <ul class="uk-list">
                                            <li>
                                                <a style="font-size:14px" > 
                                                    <span class="uk-icon-button"  uk-icon="check"></span>
                                                    
                                                </a>
                                            </li> 
                                            <li>
                                                <a style="font-size:14px" > 
                                                    <span class="uk-icon-button"  uk-icon="check"></span>
                                                a
                                                </a>
                                            </li>
                                        </ul>
                                    </div>       
                                </li> 
                            </ul>
                            <ul uk-accordion>
                                <li>
                                    <a style="font-size:14px" class="uk-accordion-title"> 
                                        <span class="uk-icon-button"  uk-icon="image"></span>
                                      
                                    </a>
                                    <div class="uk-accordion-content uk-margin-left" >
                                        <ul class="uk-list">
                                            <li>
                                                <a style="font-size:14px"  > 
                                                    <span class="uk-icon-button"  uk-icon="check"></span>
                                                a
                                                </a>
                                            </li> 
                                            <li>
                                                <a style="font-size:14px" > 
                                                    <span class="uk-icon-button"  uk-icon="check"></span>
                                                a
                                                </a>
                                            </li>
                                        </ul>
                                    </div>       
                                </li> 
                            </ul>
                        </ul>
                    </div>
                   </li> 
        
           <li>      
                <a href="{{ route('logout') }}"
                   uk-toggle uk-tooltip="title: {{ __('messages.Logout') }}; pos: bottom"  
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"
                >
                        <span class="uk-icon-button" uk-icon="sign-out"> 
                        </span>   
                         {{__('messages.Logout')}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                        </form>
                </a> 
            </li>             
        </ul>        
    </div>
</div>