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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
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

    /*********************************************PROFILE*********************************************/
    /*************************************************************************************************/
    public function getProfil(){
        return view('profil.tampil');
    }

    public function updateProfil(Request $r){
        if(Hash::check($r->password, Auth::user()->password)){
            $profil = Auth::user();
            $profil->name = $r->name;
            $profil->password = Hash::make($r->newpassword);
            $profil->save();

            return redirect('profil');
        }else{
            return redirect('profil')->withErrors('Password salah !');
        }
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
    /********************************************STORE************************************************/
    /*************************************************************************************************/
    public function storeKategori(Request $r){ //Menambahkan Kategori ke database
        
        Kategori::insert([
            'nama_kategori' => $r->nama_kategori, 
            'keterangan' => $r->keterangan,
            'jumlah_topik' => 0,
            ]);

        return redirect('/home');
    }

    public function storeTopik(Request $r){ //Menambahkan Topik ke database
        $id_kategori = Kategori::select('id_kategori')->where('nama_kategori', $r->nama_kategori)->first()->id_kategori;

        $this->validate($r, [
            'judul_topik' => 'required|max:255',
            'body' => 'required'
        ]);

        Topik::insert([
            'id_kategori' => $id_kategori,
            'judul_topik' => $r->judul_topik, 
            'isi_topik' => $r->body, 
            'id_penulis' => Auth::user()->id, 
            'banyak_komentar' => 0, 
            'kehadiran' => 0, 
            'waktu_mulai' => $r->waktu_mulai, 
            'waktu_selesai' => $r->waktu_selesai,
        ]);

        return redirect('Kategori/'.$id_kategori);
    }

    public function storeKomentar(Request $r){ //Menambah Komentar ke database
        $topik = Topik::where('id_topik', $r->id_topik)->first();

        $this->validate($r, [
            'isi_komentar' => 'required'
        ]);

        Komentar::insert([
            'id_topik' =>  $topik->id_topik, 
            'isi_komentar' => $r->isi_komentar,
            'id_penulis' => Auth::user()->id,
        ]);

        $topik->banyak_komentar += 1;
        $topik->save();
        return redirect('Topik/'.$r->id_topik);
    }

    public function storeKehadiran(Request $r){ //Menambahkan Kehadiran pada database

        if(Kehadiran::where([ ['id_penulis', '=', Auth::user()->id] ,['id_topik', '=', $r->id_topik] ])->count() > 0)
            return back();
        Kehadiran::insert([
            'id_penulis' => Auth::user()->id,
            'id_topik' => $r->id_topik,
        ]);

        $topik = Topik::where('id_topik', $r->id_topik)->first();
        $topik->kehadiran += 1;
        $topik->save();

        //echo 'suskes';
        return redirect('Topik/'.$r->id_topik);
    }
    /********************************************UPDATE***********************************************/
    /*************************************************************************************************/

    public function updatekomentar(Request $r) {
        $komentar = Komentar::where('id_komentar', $r->id_komentar)->first();

        $this->validate($r, [
            'isi_komentar' => 'required'
        ]);

        $komentar->isi_komentar = $r->isi_komentar;
        $komentar->save();

        return redirect('Topik/'.$r->id_topik);
    }

    public function updatetopik(Request $r){
        $topik = Topik::where('id_topik', $r->id_topik)->first();

        $topik->judul_topik = $r->judul_topik;
        $topik->isi_topik = $r->isi_topik;
        $topik->save();

        return redirect('Topik/'.$r->id_topik);
    }

    public function updatekategori(Request $r){
        $kategori = Kategori::where('id_kategori', $r->id_kategori)->first();

        $kategori->nama_kategori = $r->nama_kategori;
        $kategori->keterangan = $r->keterangan;
        $kategori->save();

        return redirect('/home');
    }
    /********************************************DELETE***********************************************/
    /*************************************************************************************************/
    public function deletekomentar(Request $r){
        Komentar::destroy($r->id_komentar);
        $topik = Topik::where('id_topik', $r->id_topik)->first();

        $topik->banyak_komentar -= 1;
        $topik->save();

        return back();
    }

    public function deletetopik(Request $r){
        $topik = Topik::where('id_topik', $r->id_topik)->first();

        $id_kategori = $topik->id_kategori;

        Topik::destroy($r->id_topik);
        return redirect('/Kategori/'.$id_kategori);
    }

    public function deletekategori(Request $r){
        Kategori::destroy($r->id_kategori);

        return redirect('/home');
    }
}
