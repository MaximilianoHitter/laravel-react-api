<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index($url){
        /* $user = Auth::user();
        $perms = $user->obtener_permisos();
        return response()->json(['perms' => $perms]); */
        return response()->json(['perms' => $url]);
    }
}
