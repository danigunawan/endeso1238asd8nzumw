<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\KomentarKategori;
use Session;

class KomentarKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        //

        if ($request->ajax()) {

            $komentar_kategori = KomentarKategori::with(['kategori','user']);

            return Datatables::of($komentar_kategori)->addColumn('action', function($komentar_kategori){
                    return view('komentar_kategori._action', [
                    'model'=> $komentar_kategori,
                    'konfirmasi_url' => route('komentar_kategori.konfirmasi', $komentar_kategori->id),
                    'no_konfirmasi_url' => route('komentar_kategori.no_konfirmasi', $komentar_kategori->id),
                    'hapus_url'=> route('komentar_kategori.destroy', $komentar_kategori->id),
                    'edit_url'=> route('komentar_kategori.edit', $komentar_kategori->id),
                    'confirm_message' => 'Yakin mau menghapus Komentar ?'
                    ]);})
            ->addColumn('status',function($tugas){
                $status = "status";
                if ($tugas->status == 0 ) {
                    # code...
                    $status = "Konfirmasi Komentar";
                }
                elseif ($tugas->status == 1) {
                    # code...
                     $status = "Komentar Sudah Di Konfirmasi";
                }
                elseif ($tugas->status == 2) {
                    # code...
                     $status = "Komentar Tidak Di Konfirmasi";
                } 
                return $status;
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'iD'])  
            ->addColumn(['data' => 'kategori.nama_aktivitas', 'name'=>'kategori.nama_aktivitas', 'title'=>'Nama Kategori'])  
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Pengomentar'])  
            ->addColumn(['data' => 'isi_komentar', 'name'=>'isi_komentar', 'title'=>'Isi Komentar'])  
            ->addColumn(['data' => 'status', 'name'=>'status', 'title'=>'Status' , 'searchable'=>false])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>' ', 'orderable'=>false, 'searchable'=>false]);

            return view('komentar_kategori.index')->with(compact('html'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function konfirmasi($id){ 

            $komentar = KomentarKategori::find($id);   
            $komentar->status = 1;
            $komentar->save();  

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"komentar Berhasil Di konfirmasi"
        ]);
 
        return redirect()->route('komentar_kategori.index');
    } 


    public function no_konfirmasi($id){ 

            $komentar = KomentarKategori::find($id);   
            $komentar->status = 2;
            $komentar->save();  

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"komentar Tidak Di konfirmasi"
        ]);
 
        return redirect()->route('komentar_kategori.index');
    } 


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!KomentarKategori::destroy($id)) 
        {
            return redirect()->back();
        }
        else{
        Session:: flash("flash_notification", [
            "level"=>"success",
            "message"=>"Komentar Kategori Berhasil Di Hapus"
            ]);
        return redirect()->route('komentar_kategori.index');
        }
    }
}
