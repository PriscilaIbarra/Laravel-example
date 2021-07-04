<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    private function initialize()
    {
        try
        {   
            DB::beginTransaction(); 
            $user = new User();
            $user->name = 'web';
            $user->email =  'web@gmail.com';
            $user->password = Hash::make('12345678');
            $user->save();
            $rol = Rol::where('description','=','SuperAdmin')->firstOrFail();
            $user->roles()->attach($rol->id);     
            DB::commit();                   
        }
        catch(ModelNotFoundException $e)
        {   
            DB::rollBack(); 
            Log::error('Rol not found',['line'=> $e->getTraceAsString()]);          
        }
        catch(QueryException $e)
        {   
            DB::rollBack(); 
            Log::error('Insert user sql exception',['line'=> $e->getTraceAsString()]);          
        }
        catch(\Exception $e)
        {
           DB::rollBack(); 
           Log::error('Insert user exception',['line'=> $e->getTraceAsString()]);         
        }
    }
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->initialize();
    }
}
