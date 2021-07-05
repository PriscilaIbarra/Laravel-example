<?php
namespace App\Http\Catalogs;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UsersCatalog
{
    
    public static function searchUser(int $id)
    {
        return User::findOrFail($id);
    }
    
    public static function addUser( array $data)
    {
        try
        {
            $data['created_by'] = Auth::user()->id;
            User::create($data);
        }
        catch(QueryException $e)
        {
            Log::error('Insert user sql exception',['line'=> $e->getTraceAsString()]);
            return throw $e;
        }
        catch(\Exception $e)
        {
           Log::error('Insert user exception',['line'=> $e->getTraceAsString()]);
           return  throw $e;  
        } 
        
    }

    public static function updateUser(User $user ,User $userToUpdate)
    {
        try
        {
            $user->name = $userToUpdate->name;
            $user->email = $userToUpdate->email;
            $user->password = isset($userToUpdate->password)? Hash::make($userToUpdate->password) : $user->password;
            $user->update();
        }
        catch(QueryException $e)
        {
            Log::error('Update user sql exception',['line'=> $e->getTraceAsString()]);
            return throw $e;
        }
        catch(\Exception $e)
        {

           Log::error('Update user exception',['line'=> $e->getTraceAsString()]);
           return  throw $e;  
        }
    }

    public static function deleteUser(User $user)
    {
        try
        {
            $user->roles()->detach();
            $user->delete();
        }
        catch(QueryException $e)
        {
            Log::error('Delete user sql exception',['line'=> $e->getTraceAsString()]);
            return throw $e;
        }
        catch(\Exception $e)
        {

           Log::error('Delete user exception',['line'=> $e->getTraceAsString()]);
           return  throw $e;  
        }
       
    }

    public static function assignRol(User $user, Rol $rol )
    {
        try
        {
           $user->roles()->attach($rol->id);
        }
        catch(QueryException $e)
        {
            Log::error('Assign rol sql exception',['line'=> $e->getTraceAsString()]);
            return throw $e;
        }
        catch(\Exception $e)
        {
           Log::error('Assign rol exception',['line'=> $e->getTraceAsString()]);
           return  throw $e;  
        }         
    }

    public static function unassignRol(User $user, Rol $rol )
    {
        try
        {
           $user->roles()->detach($rol->id);
        }
        catch(QueryException $e)
        {
            Log::error('Unassign rol sql exception',['line'=> $e->getTraceAsString()]);
            return throw $e;
        }
        catch(\Exception $e)
        {
           Log::error('Unassign rol exception',['line'=> $e->getTraceAsString()]);
           return  throw $e;  
        }         
    }

}