<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null; // must be authenticated; route middleware also restricts
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'apellido_paterno' => ['required', 'string', 'max:150'],
            'apellido_materno' => ['required', 'string', 'max:150'],
            'curp' => ['required', 'string', 'max:18', 'unique:users,curp'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'celular' => ['nullable', 'string', 'max:20', 'unique:users,celular'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],
            'estado_id' => ['nullable', 'integer', Rule::exists('estados', 'id')],
            'municipio_id' => ['nullable', 'integer', Rule::exists('municipios', 'id')],
            'region_id' => ['nullable', 'integer', Rule::exists('regiones', 'id')],
            'territorio_id' => ['nullable', 'integer', Rule::exists('territorios', 'id')],
            'ruta' => ['nullable', 'string', 'max:255'],
        ];
    }
}
