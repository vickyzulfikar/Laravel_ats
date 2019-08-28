<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiodataLaravel extends Model
{	// nama table
    protected $table = 'biodata_laravel';

    // untuk mengatasi masalah mass_assignment
    protected $fillable = ['nama_lengkap','tanggal_lahir','jenis_kelamin','hobi'];
    // confirm selain create_at dan update_at
}
