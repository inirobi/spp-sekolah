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
        "tgl_dibayar", 
        "nominal",
        "user_id",
        "status",
    ];

    public function user()
    {
        return $this->belongsTo('App\User', "user_id");
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment','payment_id');
    }

}
