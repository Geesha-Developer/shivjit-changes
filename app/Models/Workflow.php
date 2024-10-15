<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    protected $table = 'workflow'; // Define the table name explicitly

    protected $fillable = [
        'auth_id',
        'guard_name',
        'action',
        'model_data',
        'model_type',
        'model_id',
    ];
}
