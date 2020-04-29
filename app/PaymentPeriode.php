<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPeriode extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'payment_periodes';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "financing_category_id",
        "bulan", 
        "tahun",
    ];

    public function financingCategory()
    {
        return $this->belongsTo('App\FinancingCategory', "financing_category_id");
    }
}
