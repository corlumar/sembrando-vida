<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        $roles = DB::table('roles')->orderBy('name')->get();
        $regiones = DB::table('regiones')->orderBy('nombre')->get();
        $estados = DB::table('estados')->orderBy('nombre')->get();
        $municipios = DB::table('municipios')->orderBy('nombre')->get();
        $territorios = DB::table('territorios')->orderBy('nombre')->get();

        return view('usuarios.create', compact('roles', 'regiones', 'estados', 'municipios', 'territorios'));
    }

    public function index()
    {
        $users = User::with('role')->orderBy('name')->paginate(25);

        return view('usuarios.index', compact('users'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        // Ensure columns match DB (we use Eloquent)
        $user = User::create($data);

        return redirect()->route('usuarios.create')->with('success', 'Usuario creado correctamente.');
    }
}

