<?php
namespace App\Http\Catalogs;

use App\Models\Rol;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class RolesCatalog
{
    public static function seachRol(int $id)
    {
       return Rol::findOrFail($id);
    }

    public static function getRolesDistinctOf(array $roles)
    {
        
    }

    public static function updateRol(Rol $rol)
    {
        try
        {
            $rolToUpdate = RolesCatalog::seachRol($rol->id);
            $rolToUpdate->description = $rol->description;
            $rolToUpdate->update();
            return true;
        }
        catch(ModelNotFoundException $e)
        {
             Log::error('Rol not found exception',['line'=> $e->getTraceAsString()]);  
             return throw $e;
        }
        catch(QueryException $e)
        {
             Log::error('Update rol sql exception',['line'=> $e->getTraceAsString()]);  
             return throw $e;
        }
        catch(\Exception $e)
        {
            Log::error('Update rol exception',['line'=> $e->getTraceAsString()]);  
            return throw $e;
        }
    }

    public static function deleteRol(Rol $rol)
    {
        try
        {
            $rolToDelete = RolesCatalog::seachRol($rol->id);
            $rolToDelete->users()->detach();         
            $rolToDelete->delete();
            return true;
        }
        catch(ModelNotFoundException $e)
        {
             Log::error('Rol not found exception',['line'=> $e->getTraceAsString()]);  
             return throw $e;
        }
        catch(QueryException $e)
        {
             Log::error('Delete rol sql exception',['line'=> $e->getTraceAsString()]);  
             return throw $e;
        }
        catch(\Exception $e)
        {
            Log::error('Delete rol exception',['line'=> $e->getTraceAsString()]);  
            return throw $e;
        }
    }
}