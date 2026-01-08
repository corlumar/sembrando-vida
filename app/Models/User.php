<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre(s)',
        'apellido_paterno',
        'apellido_materno',
        'curp',
        'email',
        'celular',
        'password',
        'role_id',
        'estado_id',
        'municipio_id',
        'region_id',
        'territorio_id',
        'ruta',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // Map virtual attribute `name` to the physical column `nombre(s)`.
    public function getNameAttribute(): ?string
    {
        return $this->attributes['nombre(s)'] ?? null;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['nombre(s)'] = $value;
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

}
