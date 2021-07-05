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
                <form method="post" action="{{route('user.add')}}" class="uk-margin-left uk-margin-top uk-margin-bottom uk-margin-right" enctype="multipart/form-data">
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
                        <div uk-grid>
                            <div class="uk-width-1-2@s">
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
                            </div>
                            <div class="uk-width-1-2@s">
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
                            </div>
                        </div>
                       <button type="submit" 
                       class="uk-button uk-button-primary uk-margin-top uk-margin-remove-bottom
                       background-gradient uk-align-right">
                            {{ __('messages.Add') }}                                                         
                       </button>                   
                     </fieldset>
                </form>
            </div>        
        </div>
    </div>   
</div>
<div class="uk-child-width-expand" uk-grid>
    <div class="uk-container uk-width-1-6">
    </div>
    <div class="uk-container uk-width-4-6 uk-margin-small-left">
        <div class="uk-card uk-card-default uk-width-large uk-margin-top uk-align-center animate__animated animate__slideInLeft delay-12s">
            <div class="uk-card-header uk-section-primary uk-background-primary">
                <h6 class="uk-margin-remove-bottom">{{__('messages.Users')}}</h6>
            </div>
            <div class="uk-card-body uk-padding-remove">            
                    <table class="uk-table uk-table-striped uk-margin-remove-left uk-margin-remove-top uk-table-small">
                        <thead>
                            <tr>
                                <th class="uk-preserve-width uk-text-capitalize uk-text-secondary">{{__('messages.Name')}}</th>
                                <th class="uk-preserve-width uk-text-capitalize uk-text-secondary">{{__('messages.E-Mail')}}</th>   
                                <th class="uk-preserve-width uk-text-capitalize uk-text-secondary"></th>                           
                            </tr>
                        </thead>
                        <tbody>
                           @foreach(Auth::user()->users as $user)
                            <tr>
                                <td class="uk-preserve-width">
                                  {{$user->name}}
                                </td>
                                <td class="uk-preserve-width">
                                  {{$user->email}}  
                                </td>
                                <td class="uk-align-right uk-preserve-width">
                                    <a
                                    href="{{route('user.roles',$user->id)}}"
                                    uk-toggle
                                    uk-tooltip="title: {{__('messages.Assign Roles')}}; pos: bottom"
                                    >
                                      <span 
                                      uk-icon="icon:users" 
                                      class="uk-text-primary"> 
                                      </span>
                                    </a>   
                                    <a
                                    href="{{route('user.edit',$user->id)}}"
                                    uk-toggle
                                    uk-tooltip="title: {{__('messages.Edit')}}; pos: bottom"
                                    >
                                      <span 
                                      uk-icon="icon:pencil" 
                                      class="uk-text-warning"> 
                                      </span>
                                    </a>
                                    <button class="uk-icon-button  uk-text-danger"  
                                    uk-icon="icon:trash" type="button"
                                    uk-toggle="target: {{'#delete-user-'.$user->id}}"
                                    uk-icon="icon:plus" uk-tooltip="title: {{__('messages.Delete')}}; pos: bottom"
                                    />
                                </td>
                            </tr>
                           @endforeach                         
                        </tbody>
                    </table>               
            </div>
        </div>
    </div>
    <div class="uk-container uk-width-1-6">
        @foreach($users as $user)      
        <div id="{{'delete-user-'.$user->id}}" uk-modal>
            <div class="uk-modal-dialog">
                <div class="uk-card">
                    <div class="uk-card-header uk-section-primary">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                    </div>
                    <div class="uk-card-body  uk-margin-remove">
                        <form method="get" action="{{route('user.delete',$user->id)}}" >
                            @csrf
                               <div class="uk-child-width-expand uk-align-center uk-margin-remove" uk-grid>
                                    <div class="uk-width-1-1">
                                        <div class="uk-form-contusers uk-child-width-expand">  
                                            {{__('msgs.delete-user-part-1')}} <strong class="uk-text-emphasis">{{$user->name}}</strong>{{__('msgs.delete-user-part-2')}}
                                        </div>
                                    </div>
                               </div>
                               <div class="uk-child-width-expand uk-align-center uk-margin-remove" uk-grid>     
                                    <div class="uk-width-1-2 uk-margin-small-top">
                                        <div class="uk-form-contusers uk-child-width-expand uk-align-center"> 
                                              <button type="submit" class="uk-button uk-section-primary uk-width-small">{{__('messages.Confirm')}}</button>
                                        </div>                         
                                    </div>
                               </div>
                        </form>
                    </div>
                   </div> 
                <div>
              </div>  
            </div>
        </div>
          @endforeach
    </div>
  
</div>
@endsection