<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSql2 extends Model
{
    protected $connection = 'mysql2'; // nama koneksi dari config
    protected $table = 'users';
}
