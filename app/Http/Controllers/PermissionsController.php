<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        /* $user = Auth::user();
        $perms = $user->obtener_permisos();
        return response()->json(['perms' => $perms]); */
        $url_recortada = str_replace('/', '',$request->url);
        $user = User::find(2);
        $permisos = $user->obtener_permisos();
        $permitido = false;
        //return response()->json(['data'=> $permisos]);
        foreach ($permisos as $key => $value) {
            if($value->name == $url_recortada){
                $permitido = true;
            }
        }
        return response()->json(['data' => $permitido]);
    }
    
}
