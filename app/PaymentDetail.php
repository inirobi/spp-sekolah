<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'payment_details';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "payment_id",
        "tgl_pembayaran", 
        "nominal",
        "user_id",
    ];
}
