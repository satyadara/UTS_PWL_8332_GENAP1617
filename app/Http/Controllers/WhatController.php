<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Kategori;
use App\Topik;
use App\Komentar;
use App\User;
use App\Kehadiran;

class WhatController extends Controller
{
    public function index() { //Menampilkan homepage
        $kategori = Kategori::paginate(5);

        // return Auth::user()->id_role;

        return view('layoutsforum.forum', compact('kategori'));
    }

    
    public function pencarian(Request $r){
        $cari = Topik::where('judul_topik', 'LIKE', '%'.$r->kunci.'%')->orWhere('isi_topik', 'LIKE', '%'.$r->kunci.'%')->get();
        $kunci = $r->kunci;

        // echo $cari;

        return view('layoutsforum.pencarian', compact('cari', 'kunci'));
    }
     /********************************************GOTO PAGE********************************************/
    /*************************************************************************************************/
    public function tambahkategori(){
        return view('layoutsforum.tambahkategori');
    }

    public function kategori(Request $r)  { //Menampilkan halaman kategori
        $kategori = Kategori::where('id_kategori', $r->id_kategori)->first();
        $topik = Topik::where('id_kategori', $r->id_kategori)->latest()->paginate(10);

        
        return view('layoutsforum.kategori', compact('kategori', 'topik'));
    }
    public function tambahtopik(Request $r){ //Manempilkan halaman tambah topik
        $kategori = Kategori::where('id_kategori', $r->id_kategori)->first();

        
        return view('layoutsforum.tambahtopik', compact('kategori'));
    }

    public function tampilTopik(Request $r){ //Menampilkan halaman topik & komentar topik
        $topik = Topik::where('id_topik', $r->id_topik)->first();
        $komentar = Komentar::where('id_topik', $r->id_topik)->paginate(10);
        
        return view('layoutsforum.topik', compact('topik', 'komentar'));
    }

    public function komentar(Request $r){
        $komentar = Komentar::where('id_komentar', $r->id_komentar)->first();
        $topik = Topik::where('id_topik', $r->id_topik)->first();

        return view('layoutsforum.perbaruikomentar', compact('komentar', 'topik'));
    }

    public function topik(Request $r){
        $topik = Topik::where('id_topik', $r->id_topik)->first();

        return view('layoutsforum.perbaruitopik', compact('topik'));
    }

    public function perbaruikategori(Request $r){
        $kategori = Kategori::where('id_kategori', $r->id_kategori)->first();

        return view('layoutsforum.perbaruikategori', compact('kategori'));
    }
}
