<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'tbl_komentar';
    protected $fillable = ['id-topik', 'isi_komentar', 'id_penulis'];
    protected $primaryKey = 'id_komentar';
}
