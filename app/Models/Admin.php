<?php
// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\Authenticatable;

// class Admin extends Model implements Authenticatable
// {
//     // Fillable fields and other model code...

//     // Implement methods from Authenticatable contract

//     public function getAuthIdentifierName()
//     {
//         return 'id'; // or the name of the primary key in your database table
//     }

//     public function getAuthIdentifier()
//     {
//         return $this->getKey();
//     }

//     public function getAuthPassword()
//     {
//         return $this->password;
//     }

//     // Methods related to "remember me" functionality

//     public function getRememberToken()
//     {
//         return $this->remember_token;
//     }

//     public function setRememberToken($value)
//     {
//         $this->remember_token = $value;
//     }

//     public function getRememberTokenName()
//     {
//         return 'remember_token';
//     }

//     // Other methods you might need to implement...

//     // For example:
//     // public function getRememberToken()
//     // {
//     //     return $this->remember_token;
//     // }

//     // public function setRememberToken($value)
//     // {
//     //     $this->remember_token = $value;
//     // }

//     // public function getRememberTokenName()
//     // {
//     //     return 'remember_token';
//     // }
// }

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins'; // or the name of your table

    protected $fillable = ['name', 'email', 'password'];

    // The default implementation of remember_token is provided by Authenticatable
}
