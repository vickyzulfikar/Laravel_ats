<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenderModel extends Model
{	// nama table
    protected $table = 'gender';

    // untuk mengatasi masalah mass_assignment
    protected $fillable = ['gender'];
    // confirm selain create_at dan update_at
}
