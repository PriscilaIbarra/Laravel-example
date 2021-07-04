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
                <h6 class="uk-margin-left">{{__('messages.Rol')}}</h6>
            </div>
            <div class="uk-card-body uk-child-width-expand" uk-grid>
                <form method="post" action="{{route('rol.update')}}" class="uk-margin-left uk-margin-top uk-margin-bottom uk-margin-right" enctype="multipart/form-data">
                 @csrf
                   <input type="hidden" value="{{$rol->id}}" name="id">
                   <div  class="uk-grid-row uk-margin-top">
                      <div class="uk-form-controls uk-child-width-expand">
                        <sup class="uk-form-label" for="name">{{ __('messages.Description') }}</sup><br>  
                        <div class="uk-inline">  
                            <input id="description" 
                            type="text" class="uk-child-width-expand uk-input @error('description') uk-form-danger @enderror " 
                            name="description" value="{{ $rol->description ?? old('description') }}" required autocomplete="description" autofocus>                           
                        </div> 
                      </div>
                        @error('description')
                          <span class="uk-form-danger" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>               
                      <a
                       href="{{route('roles.show')}}"
                       uk-toggle
                       uk-tooltip="title: {{__('messages.Back')}}; pos: bottom"
                       class="uk-align-left uk-button uk-margin-top uk-button-primary"
                       >
                         {{__('messages.Cancel')}}
                        </a>    
                    <div class="uk-grid-row uk-align-right">                   
                      <button type="submit" class="uk-button uk-margin-top uk-button-primary"                            
                       uk-tooltip="title: {{__('messages.Save')}}; pos: bottom">
                        {{__('messages.Save')}}
                      </button>   
                    </div>                 
                   </div>
                </form>
            </div>        
        </div>
    </div>
    <div class="uk-container uk-width-1-6">
    </div>
</div>

@endsection