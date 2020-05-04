<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'students';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "nis",
        "nama",
        "jenis_kelamin",
        "kelas",
        "kelas_id",
        "major_id",
        "phone",
        "alamat",
        "email",
        "tgl_masuk",
    ];

    /**
     * Relasi Many to One
     */
    public function major()
    {
        return $this->belongsTo('App\Major');
    }

    /**
     * Relasi Many to Many
     */
    public function payments()
    {
        return $this->belongsToMany('App\FinancingCategory');
    }

    public function periode()
    {
        return $this->hasMany('App\PaymentPeriodeStudent');
    }

    public function pembayaran()
    {
        return $this->hasMany('App\Payment');
    }
}
