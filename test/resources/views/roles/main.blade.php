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
                <form method="post" action="{{route('rol.add')}}" class="uk-margin-left uk-margin-top uk-margin-bottom uk-margin-right" enctype="multipart/form-data">
                 @csrf
                   <div  class="uk-grid-row uk-margin-top">
                      <div class="uk-form-controls uk-child-width-expand">
                        <sup class="uk-form-label" for="name">{{ __('messages.Description') }}</sup><br>  
                        <div class="uk-inline">  
                            <input id="description" 
                            type="text" class="uk-child-width-expand uk-input @error('description') uk-form-danger @enderror " 
                            name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>                           
                        </div> 
                      </div>
                        @error('description')
                          <span class="uk-form-danger" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>               
                    <div class="uk-grid-row uk-align-right">
                      <button type="submit" class="uk-icon-button uk-margin-top uk-background-muted"   style="background-color:#d5d3d3"                            
                              uk-icon="icon:plus" uk-tooltip="title: {{__('messages.Add')}}; pos: bottom">
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
<div class="uk-child-width-expand" uk-grid>
    <div class="uk-container uk-width-1-6">
    </div>
    <div class="uk-container uk-width-4-6 uk-margin-small-left">
        <div class="uk-card uk-card-default uk-width-large uk-margin-top uk-align-center animate__animated animate__slideInLeft delay-12s">
            <div class="uk-card-header uk-section-primary uk-background-primary">
                <h6 class="uk-margin-remove-bottom"></h6>
            </div>
            <div class="uk-card-body uk-padding-remove">            
                    <table class="uk-table uk-table-striped uk-margin-remove-left uk-margin-remove-top uk-table-small">
                        <thead>
                            <tr>
                                <th class="uk-preserve-width uk-text-capitalize uk-text-secondary">{{__('messages.Description')}}</th>
                                <th class="uk-preserve-width uk-text-capitalize uk-text-secondary"></th>                           
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($roles as $rol)
                            <tr>
                                <td class="uk-preserve-width">
                                <div class="uk-container uk-grid">
                                    <div class="uk-width-1-2">
                                      {{$rol->id}}
                                    </div>        
                                    <div class="uk-width-1-2">
                                      {{$rol->description}}
                                    </div>                          
                                </div>
                                </td>
                                <td class="uk-align-right uk-preserve-width">
                                    <a
                                    href="{{route('rol.edit',$rol->id)}}"
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
                                    uk-toggle="target: {{'#delete-rol-'.$rol->id}}"
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
        @foreach($roles as $rol)      
        <div id="{{'delete-rol-'.$rol->id}}" uk-modal>
            <div class="uk-modal-dialog">
                <div class="uk-card">
                    <div class="uk-card-header uk-section-primary">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                    </div>
                    <div class="uk-card-body  uk-margin-remove">
                        <form method="get" action="{{route('rol.delete',$rol->id)}}" >
                            @csrf
                               <div class="uk-child-width-expand uk-align-center uk-margin-remove" uk-grid>
                                    <div class="uk-width-1-1">
                                        <div class="uk-form-controls uk-child-width-expand">  
                                            {{__('msgs.delete-rol-part-1')}} <strong class="uk-text-emphasis">{{$rol->description}}</strong>{{__('msgs.delete-rol-part-2')}}
                                        </div>
                                    </div>
                               </div>
                               <div class="uk-child-width-expand uk-align-center uk-margin-remove" uk-grid>     
                                    <div class="uk-width-1-2 uk-margin-small-top">
                                        <div class="uk-form-controls uk-child-width-expand uk-align-center"> 
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