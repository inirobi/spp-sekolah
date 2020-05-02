<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPeriodeDetail extends Model
{
     /**
     * Nama table yang digunakan
     */
    protected $table = 'payment_periode_details';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "payment_periode_id",
        "payment_id",
        "user_id",
        "status",
    ];

    public function periode()
    {
        return $this->belongsTo('App\PaymentPeriode', "payment_periode_id");
    }
}
