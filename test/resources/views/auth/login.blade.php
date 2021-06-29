@extends('layouts.app')

@section('content')
<div class="uk-child-witdh-expand" uk-grid>
    <div class="uk-width-1-3@m">        
    </div>
    <div class="uk-width-1-3@m">       
        <div class="uk-card uk-margin-medium-top uk-box-shadow-xlarge animate__animated animate__slideInLeft delay-12s uk-margin-remove-bottom">
          <div class="uk-card-header background-gradient uk-button-primary">
             <h4 class="uk-margin-left" style="color:white">{{__('messages.Login')}}</h4>
          </div>
          <div class="uk-card-body uk-background-muted">
            <form method="POST" action="{{route('login')}}" class="uk-margin-remove-top">
                @csrf
                 <fieldset class="uk-fieldset"> 
                    <div class="uk-form-controls uk-child-width-expand uk-margin-left uk-margin-right uk-margin-remove-top">  
                       <sup class="uk-form-label">{{__('messages.E-Mail')}}</sup>
                       <div class="uk-inline">
                          <span class="uk-form-icon" uk-icon="icon:user"></span>
                          <input
                          type="email" 
                          class="uk-input @error('email') uk-form-danger @enderror"
                          value="{{ old('email') }}"
                          id="email"
                          name="email" 
                          required 
                          autocomplete="email"
                          autofocus
                           />
                        </div>
                        @error('email')
                        <span class="uk-form-danger" role="alert">
                               {{$message}}
                        </span>  
                        @enderror          
                    </div>
                    <div class="uk-form-controls uk-child-width-expand uk-margin-left uk-margin-right uk-margin-top">
                            <sup class="uk-form-label">{{__('messages.Password')}}</sup>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon:lock"></span>
                                <input 
                                type="password" 
                                class="uk-input @error('password') uk-form-danger @enderror"
                                value="{{ old('password') }}"
                                id="password"
                                name="password" 
                                required 
                                autocomplete="password"
                                autofocus
                                />
                            </div>
                             @error('password')
                                <span class="uk-form-danger" role="alert">
                                    {{$message}}
                                </span>  
                            @enderror
                     </div>
                      <div class="uk-form-controls uk-margin uk-margin-left"> 
                         <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                           <label class="form-check-label" for="remember">
                                {{ __('messages.Remember Me') }}
                           </label>
                      </div>                        
                      <button type="submit" class="uk-button background-gradient uk-button-primary uk-margin-left">
                         {{ __('messages.Login') }}                                                         
                      </button>
                        <div class="uk-margin uk-margin-left">                               
                            <div class="uk-form-controls"> 
                                  @if (Route::has('password.request'))
                                 <sub>
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                         {{ __('messages.Forgot Your Password?') }}
                                     </a>
                                </sub>   
                                 @endif
                            </div>
                        </div>  
                 </fieldset>
            </form>
          </div>
        </div>
    </div>
    <div class="uk-width-1-3@m">
    </div>
</div>
@endsection
