<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'cargo', 'telefone'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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


    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'barbeiro_id');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function isAdministrador(): bool
    {
        return $this->cargo === 'administrador';
    }


    public function isBarbeiro(): bool
    {
        return $this->cargo === 'barbeiro';
    }

    public function isCliente(): bool
    {
        return $this->cargo === 'cliente';
    }
}
