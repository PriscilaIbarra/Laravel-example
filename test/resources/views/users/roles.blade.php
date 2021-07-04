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
          <div class="uk-container uk-width-4-6 uk-margin-small-left">
            <div class="uk-card uk-card-default uk-width-large uk-margin-top uk-align-center animate__animated animate__slideInLeft delay-12s">   
                <div class="uk-card-header uk-section-primary uk-background-primary">
                    <h6 class="uk-margin-remove-bottom">{{__('messages.User')}}:{{ ucfirst($user->name)}}</h6>                   
                </div>
                <div class="uk-card-body uk-padding-remove">     
                        <div class="uk-container uk-margin-small-bottom">
                            <form method="POST" action="{{route('rol.assign')}}">
                               @csrf
                               <input type="hidden" name="user_id" value="{{$user->id}}">
                               <div class="uk-child-width-expand" uk-grid>
                                    <div class="uk-forms-control uk-width-2-3@m">                                      
                                       <select name="rol_id" class="uk-input uk-margin-top uk-margin-small-left">
                                         @foreach($roles as $rol)
                                          <option value="{{$rol->id}}">{{$rol->description}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="uk-width-1-3@m">
                                       <button 
                                        type="submit" 
                                        class="uk-icon-button uk-align-right uk-margin-top uk-margin-right"
                                         uk-icon="icon:plus"
                                         uk-tooltip="title: {{__('messages.Assign')}}; pos: bottom"
                                         ></button>
                                     </div>
                              </div>
                            </form> 
                        </div>  
                        <div class="uk-card-header uk-section-primary uk-background-primary uk-margin-small-top" >
                             <h6  align="center" class="uk-margin-remove-bottom">{{__('messages.Roles Assign')}}</h6>
                        </div>     
                        <table class="uk-table uk-table-striped uk-margin-remove-left uk-margin-remove-top uk-table-small">
                            <thead>                              
                                <tr>
                                    <th class="uk-preserve-width uk-text-capitalize uk-text-secondary">Id</th>
                                    <th class="uk-preserve-width uk-text-capitalize uk-text-secondary">{{__('messages.Description')}}</th>   
                                    <th class="uk-preserve-width uk-text-capitalize uk-text-secondary"></th>                           
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($user->roles as $rol)
                                <tr>
                                    <td class="uk-preserve-width">
                                      {{$rol->id}}
                                    </td>
                                    <td class="uk-preserve-width">
                                      {{$rol->description}}  
                                    </td>
                                    <td class="uk-align-right uk-preserve-width">                                        
                                         <form id="unassign" action="{{ route('rol.unassign') }}" method="POST" class="d-none">
                                         @csrf
                                           <input type="hidden" name="user_id" value="{{$user->id}}">
                                           <input type="hidden" name="rol_id" value="{{$rol->id}}">
                                           <button
                                            uk-tooltip="title: {{__('messages.Unassign Rol')}}; pos: bottom"
                                            type="submit" class="uk-icon-button uk-text-primary" uk-icon="icon:trash"></button>
                                         </form>
                                    </td>
                                </tr>
                            @endforeach                         
                            </tbody>
                        </table>               
                </div>
            </div>
    </div>
    <div class="uk-container uk-width-1-6">
    </div>
</div>

@endsection