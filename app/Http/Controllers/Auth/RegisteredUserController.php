<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;


class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol_id' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'last_name' => '',
            'json_socials' => '{}',
            'json_certificates' => '{}',
            'json_speciality' => '{}',
            'status' => 'Activo',
        ]);

        $rol = Role::find($request->rol_id);
        $user->assignRole($rol);
        

        event(new Registered($user));

        Auth::login($user);

        switch ($request->rol_id) {
            case '2':
                # Trainer
                Trainer::create([
                    'id_user' => Auth::id(),
                    'name' => $request->name,
                    'last_name' => '',
                    'profile_picture_url' => '',
                    'day_of_birth' => '2000-01-01',
                    'weight' => 40,
                    'height' => 150,
                    'description' => ''
                ]);
                break;

            case '4':
                # Especialista
                Specialist::create([
                    'id_user' => Auth::id(),
                    'name' => $request->name,
                    'last_name' => '',
                    'profile_picture_url' => '',
                    'day_of_birth' => '2000-01-01',
                    'weight' => 40,
                    'height' => 150,
                    'description' => ''
                ]);
                break;

            case '5':
                # Alumno
                Student::create([
                    'id_user' => Auth::id(),
                    'name' => $request->name,
                    'last_name' => '',
                    'profile_picture_url' => '',
                    'day_of_birth' => '2000-01-01',
                    'weight' => 40,
                    'height' => 150,
                    'description' => ''
                ]);
                break;

            default:
                # code...
                break;
        }


        

        return response()->noContent();
    }
}
