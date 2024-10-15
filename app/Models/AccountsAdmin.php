<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class AccountsAdmin extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'accountslogin';

    protected $fillable = ['name', 'email', 'password', 'manager', 'team_lead', 'role'];

}
