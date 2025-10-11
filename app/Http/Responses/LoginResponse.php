<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // Redirección según rol
        switch ($user->role->name) {
            case 'Administrativo':
                $redirect = '/admin/dashboard';
                break;

            case 'Coordinador Territorial':
                $redirect = '/coordinador/dashboard';
                break;

            case 'Enlace Comercial':
                $redirect = '/enlace/dashboard';
                break;

            case 'Técnico':
                $redirect = '/tecnico/dashboard';
                break;

            case 'Sembrador':
                $redirect = '/sembrador/dashboard';
                break;

            default:
                $redirect = '/dashboard'; // fallback
                break;
        }

        return redirect()->intended($redirect);
    }
}
