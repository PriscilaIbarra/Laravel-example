<?php
namespace App\Http\Catalogs;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UsersCatalog
{
    public static function addUser(User $user, Rol $rol)
    {
        try
        {
            DB::beginTransaction(); 
            $user->save();
            $user->roles()->attach($rol->id);
            DB::commit();
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
}