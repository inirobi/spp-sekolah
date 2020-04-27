<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancingCategoryReset extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'financing_category_resets';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "financing_category_id", 
        "besaran",
    ];

    public function financingCategory()
    {
        return $this->belongsTo('App\FinancingCategory');
    }
}
