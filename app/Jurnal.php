<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'jurnals';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "expense_id",
        "payment_id",
        "description",
        "debit",
        "kredit",
    ];
}
