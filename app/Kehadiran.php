<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'tbl_kehadiran';
    protected $fillable = ['id_penulis','id_topik'];
    protected $primaryKey = 'id_kehadiran';
}
