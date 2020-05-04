<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranSPP extends Model
{
    /**
     * Nama table yang digunakan
     */
    protected $table = 'pembayaran_spp';

    /**
     * Kolom yang dapat di isi
     */
    protected $fillable = [
        "student_id",
        "bulan",
        "tahun_ajaran",
        "status",
        "nominal",
        "user_id",
    ];

}
