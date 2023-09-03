<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleCollection;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StatusController extends Controller
{
    public function status(){
        return response()->json(['status'=>'on']);
    }

    public function roles(){
        return Role::all();
    }

    public function roles_publicos(){
        return new RoleCollection(Role::whereIn('id',[2, 4, 5])->get());
    }
}
