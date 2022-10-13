<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    const ROLE_ADMIN   = 'Admin';
    const ROLE_EDITOR  = 'Editor';
    const ROLE_USER    = 'User';
}
