<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pencatatan extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'pencatatans';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "description",
        "nominal",
    ];
}
