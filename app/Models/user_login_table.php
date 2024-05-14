<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_login_table extends Model
{
    use HasFactory;

    protected $table = 'user_login_table'; // Explicitly specify the table name

    protected $fillable = ['exhibitor_id', 'login_email', 'password'];

    public function exhibitor()
    {
        return $this->belongsTo(exhibitor_reg_table::class, 'exhibitor_id', 'exhibitor_id');
    }
}
