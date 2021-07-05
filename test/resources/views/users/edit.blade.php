@extends('layouts.app')

@section('content')
<div class="uk-child-width-expand" uk-grid>
    <div class="uk-container uk-width-1-6">
    </div>
    <div class="uk-container uk-width-4-6 uk-margin-small-left">
        @if(session('msg'))
        <div class="@if(stristr(session('msg'),'success')) uk-alert-success @else uk-alert-danger @endif uk-width-large uk-align-center uk-margin-top" uk-alert>
             <a class="uk-alert-close" uk-close></a> 
             <p>{{__('msgs'.'.'.session('msg'))}}</p>
        </div>
        @endif    
        <div class="uk-card uk-card-default uk-width-large uk-margin-top uk-align-center animate__animated animate__slideInLeft delay-12s">
            <div class="uk-card-header uk-section-primary uk-background-primary uk-padding-remove-left ">
                <h6 class="uk-margin-left">{{__('messages.User')}}</h6>
            </div>
            <div class="uk-card-body uk-child-width-expand" uk-grid>
                <form method="post" action="{{route('user.update')}}"
                 class="uk-margin-left uk-margin-top uk-margin-bottom uk-margin-right" 
                 >
                 @csrf
                    <input type="hidden" value="{{$user->id}}" name="id">
                     <fieldset class="uk-fieldset"> 
                        <div class="uk-child-width-expand" uk-grid>
                              <div class="uk-form-controls uk-child-width-expand">
                                    <sup class="uk-form-label">{{__('messages.Name')}}</sup>
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon:user"></span>
                                        <input type="text" 
                                        class="uk-input @error('name') uk-form-danger @enderror"
                                        value="{{ $user->name ?? old('name') }}"
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
                                value="{{ $user->email ?? old('email') }}"
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
                       uk-align-right">
                            {{ __('messages.Save') }}                                                         
                       </button>  
                        <a href="{{route('users.show')}}" 
                       class="uk-align-left uk-button uk-button-primary uk-with-small uk-margin-top uk-margin-remove-bottom
                        ">
                            {{ __('messages.Cancel') }}                                                         
                       </a>                 
                     </fieldset>
                </form>
            </div>        
        </div>
    </div>
    <div class="uk-container uk-width-1-6">
    </div>
</div>

@endsection