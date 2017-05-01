<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\KomentarKamar;
use Session;

class KomentarKamarController extends Controller
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

            $komentar_kamar = KomentarKamar::with(['kamar','rumah','user']);

            return Datatables::of($komentar_kamar)->addColumn('action', function($komentar_kamar){
                    return view('komentar_kamar._action', [
                    'model'=> $komentar_kamar,
                    'konfirmasi_url' => route('komentar_kamar.konfirmasi', $komentar_kamar->id),
                    'no_konfirmasi_url' => route('komentar_kamar.no_konfirmasi', $komentar_kamar->id),
                    'hapus_url'=> route('komentar_kamar.destroy', $komentar_kamar->id),
                    'edit_url'=> route('komentar_kamar.edit', $komentar_kamar->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $komentar_kamar->title . '?'
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
            ->addColumn(['data' => 'rumah.nama_pemilik', 'name'=>'rumah.nama_pemilik', 'title'=>'Pemilik Rumah'])  
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Pengomentar'])  
            ->addColumn(['data' => 'isi_komentar', 'name'=>'isi_komentar', 'title'=>'Isi Komentar'])  
            ->addColumn(['data' => 'status', 'name'=>'status', 'title'=>'Status' , 'searchable'=>false])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>' ', 'orderable'=>false, 'searchable'=>false]); 

            return view('komentar_kamar.index')->with(compact('html'));

    }

    public function konfirmasi($id){ 

            $komentar = KomentarKamar::find($id);   
            $komentar->status = 1;
            $komentar->save();  

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"komentar Berhasil Di konfirmasi"
        ]);
 
        return redirect()->route('komentar_kamar.index');
    } 


    public function no_konfirmasi($id){ 

            $komentar = KomentarKamar::find($id);   
            $komentar->status = 2;
            $komentar->save();  

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"komentar Tidak Di konfirmasi"
        ]);

        return redirect()->route('komentar_kamar.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    }
}
