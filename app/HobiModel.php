<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HobiModel extends Model
{	// nama table
    protected $table = 'hobi';

    // untuk mengatasi masalah mass_assignment
    protected $fillable = ['hobi'];
    // confirm selain create_at dan update_at
}
