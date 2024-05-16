<?php
// app/Models/Country.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'dial_code', 'short_code'];
}
