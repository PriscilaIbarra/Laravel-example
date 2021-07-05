<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class RolesSeeder extends Seeder
{
    private function initialize()
    {   try
        {
            $roles = [
                'SuperAdmin',
                'Admin'
            ];

            foreach($roles as $rolDescription)
            {
                try
                {
                    $rol = new Rol();
                    $rol->description = $rolDescription;
                    $rol->save();
                }
                catch(QueryException $e)
                {
                    Log::error('Insert rol'.$rolDescription.' exception',['line'=>$e->getTraceAsString()]);
                }
            }
        }
        catch(\Exception $e)
        {
            Log::error('Insert roles list exception', ['line'=>$e->getTraceAsString()]);
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
