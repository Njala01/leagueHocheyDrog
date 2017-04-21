<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

$roles = array(1 => 'Admin', 2 => 'Team_Admin', 3 => 'Registered');

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

    public function equipes()
    {
        return $this->hasMany(Equipe::class);
    }

    public function SaveTeam(Equipe $equipe)
    {
        $this->equipes()->save($equipe);
    }

        public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

// Fonctions pour les rôles
    public function hasAdminRole()
    {
        return $this->roles()->pluck('name')->contains("Admin");

    }

    public function hasTeam_AdminRole()
    {
        return $this->roles()->pluck('name')->contains("Team_Admin");

    }

    public function hasRegisteredRole()
    {
        return $this->roles()->pluck('name')->contains("Registered");

    }
