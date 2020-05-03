<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'incomes';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "title",
        "description",
        "sumber",
        "foto",
        "nominal",
    ];
}
