<?php

namespace App\Http\Controllers;

use App\Http\Catalogs\RolesCatalog;
use App\Models\User;
use App\Rules\UniqueIfEmailHasChange;
use App\Http\Catalogs\UsersCatalog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function showUsersView()
    {
        return view('users.main',['users'=>User::all()]);
    }

    public function validateData(array $data)
    {
        $rules =  [
          'name' => ['required', 'string', 'max:255','regex:/^[a-zA-Z ]*$/'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];     
        $validator = Validator::make($data,$rules);
        return $validator->validate();        
    }

    public function addUser(Request $request)
    {
        try
        {
            $this->validateData($request->all());
            UsersCatalog::addUser($request->all());         
            return redirect('/users')->with('msg','add-user-success');
        }
        catch(ValidationException $e)
        {
            Log::error('Validate rol exception',['line'=> $e->getTraceAsString()]);  
            return back()->withInput()->withErrors($e->errors());
        }
        catch(QueryException $e)
        {
            Log::error('Add Rol exception',['line'=> $e->getTraceAsString()]); 
            return back()->withInput()->with('msg','add-user-error');
        }
        catch(\Exception $e)
        {
            Log::error('Add Rol exception',['line'=> $e->getTraceAsString()]); 
            return back()->withInput()->with('msg','add-user-error');
        }
    }

    public function showEditUserView(int $id)
    {
        try
        {
            $user = UsersCatalog::searchUser($id);           
            return view('users.edit',['user'=>$user]);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('User not found',['line'=>$e->getTraceAsString()]);
            return back()->with('msg','user-not-found-error');
        }
        catch(\Exception $e)
        {
           Log::error('Show edit user view exception',['line'=>$e->getTraceAsString()]); 
           return back()->with('msg','show-edit-user-exception'); 
        }
    }

    public function validateFormData(array $data)
    {
        $rules =  [
          'name' => ['required', 'string', 'max:255','regex:/^[a-zA-Z ]*$/'],
          'email' => ['required', 'string', 'email', 'max:255',new UniqueIfEmailHasChange($data) ],
          'password' => ['nullable','string', 'min:8', 'confirmed'],
        ];     
        $validator = Validator::make($data,$rules);
        return $validator->validate();    
    }

    public function updateUser(Request $request)
    {
        try
        {
            $this->validateFormData($request->all());
            $user = UsersCatalog::searchUser($request->input('id'));
            $userToUpdate = new User($request->all());
            UsersCatalog::updateUser($user,$userToUpdate);
            return redirect('/users')->with('msg','update-user-success');
        }
        catch(ValidationException $e)
        {
            Log::error('Form data is invalid',['line'=>$e->getTraceAsString()]);
            return back()->withInput()->withErrors($e->errors());
        }
        catch(QueryException $e)
        {
            Log::error('Update user sql exception',['line'=> $e->getTraceAsString()]);
            return back()->with('msg','update-user-error');
        }
        catch(\Exception $e)
        {
            Log::error('Update user exception',['line'=>$e->getTraceAsString()]);
            return back()->with('msg','update-user-error');
        }
    }

    public function deleteUser( int $id)
    {
        try
        {
            $user = UsersCatalog::searchUser($id);
            UsersCatalog::deleteUser($user);
            return redirect('/users')->with('msg','delete-user-success');
        }
        catch(ModelNotFoundException $e)
        {
           Log::error('User not found',['line'=>$e->getTraceAsString()]);
           return back()->with('msg','user-not-found-error');
        }
        catch(\Exception $e)
        {
           Log::error('Delete user exception',['line'=>$e->getTraceAsString()]);
           return back()->with('msg','user-not-found-error');
        }
    }

    public function showUserRolesView(int $id)
    {
        try
        {
            $user = UsersCatalog::searchUser($id);
            $roles = RolesCatalog::getRolesNotApplied($user);
            return view('users.roles',['user'=>$user,'roles'=>$roles ?? []]);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('User not found exception',['line'=> $e->getTraceAsString()]); 
            return back()->with('msg','user-roles-error');
        }
        catch(QueryException $e)
        {
            Log::error('Retrieve roles exception',['line'=> $e->getTraceAsString()]);  
            return back()->with('msg','user-roles-error');
        }
        catch(\Exception $e)
        {
            Log::error('Retrive user and roles exception',['line'=> $e->getTraceAsString()]); 
            return back()->with('msg','user-roles-error');
        }
    }

    public function assignRol(Request $request)
    {
        try
        { 
            $user = UsersCatalog::searchUser($request->input('user_id'));
            $rol = RolesCatalog::seachRol($request->input('rol_id'));
            UsersCatalog::assignRol($user,$rol);
            return redirect('/user-roles/'.$user->id)->with('msg','add-rol-user-success');
        }
        catch(QueryException $e)
        {
            Log::error('Assign rol sql exception',['line'=> $e->getTraceAsString()]);
            return back()->with('msg','add-rol-user-error');
        }
        catch(\Exception $e)
        {
           Log::error('Assign rol exception',['line'=> $e->getTraceAsString()]);
           return back()->with('msg','add-rol-user-error');
        } 
    }
    
    public function unassignRol(Request $request)
    {
        try
        { 
            $user = UsersCatalog::searchUser($request->input('user_id'));
            $rol = RolesCatalog::seachRol($request->input('rol_id'));
            UsersCatalog::unassignRol($user,$rol);
            return redirect('/user-roles/'.$user->id)->with('msg','unassign-rol-user-success');
        }
        catch(QueryException $e)
        {
            Log::error('Unassign rol sql exception',['line'=> $e->getTraceAsString()]);
            return back()->with('msg','unassign-rol-user-error');
        }
        catch(\Exception $e)
        {
           Log::error('Unassign rol exception',['line'=> $e->getTraceAsString()]);
           return back()->with('msg','unassign-rol-user-error');
        } 
    }
}
