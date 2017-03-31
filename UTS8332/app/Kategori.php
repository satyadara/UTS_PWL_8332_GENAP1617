<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tbl_kategori';
    protected $fillable = ['nama_kategori', 'keterangan' ,'jumlah_topik'];
    protected $primaryKey = 'id_kategori';
}
