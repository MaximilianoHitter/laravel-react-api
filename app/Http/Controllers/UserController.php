<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Models\Specialist;
use App\Models\Student;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /**
   * Actualiza los datos de perfil del usuario autenticado.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function set_perfil_data(Request $request)
  {
    $user_id = Auth::id();
    $user = null;

    if (Student::where('id_user', $user_id)->first()) {
      $user = Student::where('id_user', $user_id)->first();
    } elseif (Trainer::where('id_user', $user_id)->first()) {
      $user = Trainer::where('id_user', $user_id)->first();
    } elseif (Specialist::where('id_user', $user_id)->first()) {
      $user = Specialist::where('id_user', $user_id)->first();
    }

    if ($user === null) {
      return response()->json(['error' => 'User not found'], 404);
    }

    $user->name = $request->name;
    $user->last_name = $request->last_name;
    $user->description = $request->description;
    $user->save();

    return response()->json(['data' => 'success'], 200);
  }

  public function set_socials_data(Request $request)
  {
    $user_id = Auth::id();
    $user = null;

    if (Student::where('id_user', $user_id)->first()) {
      $user = Student::where('id_user', $user_id)->first();
    } elseif (Trainer::where('id_user', $user_id)->first()) {
      $user = Trainer::where('id_user', $user_id)->first();
    } elseif (Specialist::where('id_user', $user_id)->first()) {
      $user = Specialist::where('id_user', $user_id)->first();
    }

    if ($user === null) {
      return response()->json(['error' => 'User not found'], 404);
    }

    $social = Social::where('id_user', $user_id)->first();
    if ($social != null) {
      $social->facebook = $request->facebook;
      $social->instagram = $request->instagram;
      $social->twitter = $request->twitter;
      $social->linkedin = $request->linkedin;
      $social->whatsapp = $request->whatsapp;
      $social->telephone = $request->telephone;
      $social->save();
    } else {
      $social = new Social();
      $social->id_user = $user_id;
      $social->facebook = $request->facebook;
      $social->instagram = $request->instagram;
      $social->twitter = $request->twitter;
      $social->linkedin = $request->linkedin;
      $social->whatsapp = $request->whatsapp;
      $social->telephone = $request->telephone;
      $social->save();
    }
    return response()->json(['data' => 'success'], 200);
  }

  public function get_extra_data(Request $request)
  {
    $user_id = Auth::id();
    $user = null;
    $role = $request->role;

    if ($role === 'Alumno') {
      $user = Student::where('id_user', $user_id)->first();
    } elseif ($role === 'Trainer') {
      $user = Trainer::where('id_user', $user_id)->first();
    } elseif ($role === 'Especialista') {
      $user = Specialist::where('id_user', $user_id)->first();
    }

    if ($user === null) {
      return response()->json(['error' => 'User not found'], 404);
    }

    $social = Social::where('id_user', $user_id)->first();
    if ($social != null) {
      $user->facebook = $social->facebook;
      $user->instagram = $social->instagram;
      $user->twitter = $social->twitter;
      $user->linkedin = $social->linkedin;
      $user->whatsapp = $social->whatsapp;
      $user->telephone = $social->telephone;
    }
    return response()->json(['data' => $user], 200);
  }
}
