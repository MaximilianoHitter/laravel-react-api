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
        $user_id = Auth::id();
        if ($user_id == null) {
            return response()->json(['data' => false]);
        }
        /* $perms = $user->obtener_permisos();
        return response()->json(['perms' => $perms]); */
        if ($request->url == '/') {
            return response()->json(['data' => true]);
        }
        $url_recortada = str_replace('/', '', $request->url);
        $user = User::find($user_id);
        $permisos = $user->obtener_permisos();
        $permitido = false;

        foreach ($permisos as $value) {
            if ($value->name == $url_recortada) {
                $permitido = true;
            }
        }
        return response()->json(['data' => $permitido]);
    }

    public function user_rol() {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $rol = $user->getRoleNames();
        return response()->json(['data' => $rol]);
    }
}
