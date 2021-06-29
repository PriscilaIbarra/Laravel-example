@extends('layouts.app')

@section('content')
<div class="uk-child-width-expand" uk-grid>
    <div class="uk-container uk-width-1-3@m">
    </div>
    <div class="uk-container uk-width-1-3@m">
        <div class="uk-card uk-align-center uk-margin-top uk-box-shadow-bottom uk-box-shadow-xlarge animate__animated animate__slideInLeft delay-12s">   
            <div class="uk-card-header background-gradient uk-button-primary ">{{__('messages.Register')}}</div> 
            <div class="uk-card-body uk-background-muted"> 
                  <form method="POST" action="{{ route('register') }}">
                  @csrf
                     <fieldset class="uk-fieldset"> 
                        <div class="uk-child-width-expand" uk-grid>
                              <div class="uk-form-controls uk-child-width-expand">
                                    <sup class="uk-form-label">{{__('messages.Name')}}</sup>
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon:user"></span>
                                        <input type="text" 
                                        class="uk-input @error('name') uk-form-danger @enderror"
                                        value="{{ old('name') }}"
                                        id="name"
                                        name="name" 
                                        required 
                                        autocomplete="name"
                                        autofocus
                                        />
                                        @error('name')
                                            <span class="uk-form-danger" role="alert">
                                                {{$message}}
                                            </span>  
                                        @enderror
                                     </div>   
                                </div>         
                        </div>                     
                        <div class="uk-form-controls uk-child-width-expand uk-margin-top">
                             <sup class="uk-form-label">{{__('messages.E-Mail')}}</sup>
                             <div class="uk-inline">
                               <span class="uk-form-icon" uk-icon="icon:mail"></span>
                               <input type="email"
                                class="uk-input @error('email') uk-form-danger @enderror" 
                                value="{{ old('email') }}"
                                id="email"
                                name="email"
                                required 
                                autocomplete="email" 
                                />
                             </div>
                              @error('email')
                              <span class="uk-form-danger" role="alert">
                                   {{$message}}
                              </span>  
                              @enderror
                        </div>
                        <div class="uk-form-controls uk-child-width-expand uk-margin-top">
                             <sup class="uk-form-label">{{__('messages.Password')}}</sup>
                             <div class="uk-inline">
                               <span class="uk-form-icon" uk-icon="icon: lock"></span>
                               <input type="password" 
                               class="uk-input @error('password') uk-form-danger @enderror" 
                               value="{{ old('password') }}" 
                               name="password"
                               id="password" 
                               required 
                               autocomplete="new-password" 
                               />
                             </div>
                             @error('password')
                                 <span class="uk-form-danger" role="alert">
                                    {{$message}}
                                 </span>  
                             @enderror
                        </div>
                        <div class="uk-form-controls uk-child-width-expand uk-margin-top">
                             <sup class="uk-form-label">{{__('messages.Confirm-Password')}}</sup>
                              <div class="uk-inline">
                                 <span class="uk-form-icon" uk-icon="icon:lock"></span>
                                 <input type="password"
                                  class="uk-input @error('password') uk-form-danger @enderror"
                                  id="password-confirm" 
                                  name="password_confirmation"
                                  required
                                  autocomplete="new-password"
                                 />
                              </div>
                              @error('password_confirmation')
                                 <span class="uk-form-danger" role="alert">
                                       {{$message}}
                                 </span>  
                              @enderror  
                        </div>
                       <button type="submit" 
                       class="uk-button uk-button-primary uk-margin-top uk-margin-remove-bottom
                       background-gradient uk-align-right">
                            {{ __('messages.Register') }}                                                         
                       </button>                   
                     </fieldset>
                  </form>
            </div>
        </div>      
        @if (session('msgName'))        
          <div class=" @if(stristr(session('msgName'),'success'))  uk-alert-success @else uk-alert-danger @endif" uk-alert>
                <a class="uk-alert-close" onclick="event.preventDefault();document.getElementById('login-url').submit();" href="{{route('login')}}" uk-close></a> 
                <p> {{ __('appmoviemsgs'.'.'.session('msgName')) }}</p>
          </div>  
          <form id="login-url" action="{{ route('login') }}" method="GET" class="d-none"></form>
        @endif
    </div>
    <div class="uk-container uk-width-1-3@m">
    </div>
</div>
@endsection
