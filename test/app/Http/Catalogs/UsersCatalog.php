<?php
namespace App\Http\Catalogs;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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