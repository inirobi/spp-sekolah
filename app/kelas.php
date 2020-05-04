<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        "id",
        "kelas",
        "major_id",
        "nominal"
    ];

    public function major()
    {
        return $this->belongsTo('App\Major');
    }
}
