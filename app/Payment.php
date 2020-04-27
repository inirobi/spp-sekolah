<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'payments';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "student_id",
        "financing_category_id", 
        "terakhir_dibayar",
    ];

    /**
     * Relasi One to Many
     */
    public function paymentDetail()
    {
        return $this->hasMany('App\PaymentDetail', 'payment_id');
    }

    /**
     * Relasi Many to Many
     */
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
