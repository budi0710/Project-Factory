<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSqlServer extends Model
{
    protected $connection = 'sqlsrv'; // nama koneksi dari config
    protected $table = 'users';
}
