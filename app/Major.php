<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'majors';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "nama",
    ];
    
    /**
     * Relasi One to Many
     */
    public function students()
    {
        return $this->hasMany('App\Student', 'major_id');
    }
}
