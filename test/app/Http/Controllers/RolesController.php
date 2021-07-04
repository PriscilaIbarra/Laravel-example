<?php

namespace App\Http\Controllers;

use App\Http\Catalogs\UsersCatalog;
use App\Http\Catalogs\RolesCatalog;
use App\Models\Rol;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    public function showRolesView()
    {
       /// $roles = RolesCatalog::getRolesDistinctOf(Auth::user()->roles());
       return view('roles.main',['roles'=>Rol::all()]);
    }

    public function validateFormData(array $data)
    {
        $rules = ['description'=>['string','required','max:256','unique:roles,description']];
        $attributes = ['description'=>$data["description"]];
        $validator = Validator::make($attributes,$rules);
        return $validator->validate();
    }

    public function addRol(Request $request)
    {
        try
        {
            $this->validateFormData($request->all());
            $rol = new Rol(['description'=>$request->input('description')]);
            $rol->save();
            return redirect('/roles')->with('msg','add-rol-success');
        }
        catch(ValidationException $e)
        {
            Log::error('Validate rol exception',['line'=> $e->getTraceAsString()]);  
            return back()->withInput()->withErrors($e->errors());
        }
        catch(\Exception $e)
        {
            Log::error('Add Rol exception',['line'=> $e->getTraceAsString()]); 
            return back()->withInput()->with('msg','add-rol-error');
        }   
    }

    public function showEditRolView(int $rolId)
    {
        try
        {
           $rol = RolesCatalog::seachRol($rolId);
           return view('roles.edit',['rol'=>$rol]);    
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Rol not found',['line'=> $e->getTraceAsString()]);  
            return back()->with('msg','rol-not-found-error');
        }
        catch(\Exception $e)
        {
            Log::error('Edit rol exception',['line'=> $e->getTraceAsString()]);  
            return back()->with('msg','edit-rol-error'); 
        }
    }

    public function updateRol(Request $request)
    {
        try
        {
             $this->validateFormData($request->all());
             $rol = new Rol($request->all());
             RolesCatalog::updateRol($rol);
             return redirect('/roles')->with('msg','update-rol-success');
        }
        catch(ValidationException $e)
        {
            Log::error('Validate rol exception',['line'=> $e->getTraceAsString()]);  
            return back()->withInput()->withErrors($e->errors());
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Rol not found exception',['line'=> $e->getTraceAsString()]);  
            return redirect('/roles')->with('msg','update-rol-error');
        }
        catch(QueryException $e)
        {
            Log::error('Update rol exception',['line'=> $e->getTraceAsString()]); 
            return redirect('/roles')->with('msg','update-rol-error');
        }
        catch(\Exception $e)
        {
            Log::error('Update rol exception',['line'=> $e->getTraceAsString()]);  
            return back()->with('msg','update-rol-error'); 
        }
    }

    public function deleteRol(int $id)
    {
        try
        {
            RolesCatalog::deleteRol(new Rol(['id'=>$id]));
            return redirect('/roles')->with('msg','delete-rol-success');
        }        
        catch(ModelNotFoundException $e)
        {
            Log::error('Rol not found exception',['line'=> $e->getTraceAsString()]);  
            return back()->with('msg','delete-rol-error');
        }
        catch(QueryException $e)
        {
            Log::error('Delete rol sql exception',['line'=> $e->getTraceAsString()]); 
            return back()->with('msg','delete-rol-error');
        }
        catch(\Exception $e)
        {
            Log::error('Delete rol exception',['line'=> $e->getTraceAsString()]);  
            return back()->with('msg','delete-rol-error'); 
        }
    }
}
