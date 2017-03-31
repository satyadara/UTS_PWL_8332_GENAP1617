<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $table = 'tbl_topik';
    protected $fillable = ['id_kategori', 'judul_topik', 'isi_topik', 'id_penulis', 'banyak_komentar', 'kehadiran', 'waktu_mulai', 'waktu_selesai'];
    protected $primaryKey = 'id_topik';
}
