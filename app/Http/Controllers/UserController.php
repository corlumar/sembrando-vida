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
        $regiones = DB::table('regiones')->orderBy('name')->get();
        $estados = DB::table('estados')->orderBy('name')->get();
        $municipios = DB::table('municipios')->orderBy('name')->get();
        $territorios = DB::table('territorios')->orderBy('name')->get();

        return view('usuarios.create', compact('roles', 'regiones', 'estados', 'municipios', 'territorios'));
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
}
