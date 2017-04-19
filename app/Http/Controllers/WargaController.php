<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Warga;
use Session;
use Illuminate\Support\Facades\File;

class WargaController extends Controller
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

            $warga = Warga::with('kategori');

            return Datatables::of($warga)->addColumn('action', function($warga){
                    return view('warga._action', [
                    'model'=> $warga,
                    'hapus_url'=> route('warga.destroy', $warga->id),
                    'edit_url'=> route('warga.edit', $warga->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $warga->nama_warga . '?'
                    ]);
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'nama_warga', 'name'=>'nama_warga', 'title'=>'Nama Warga']) 
            ->addColumn(['data' => 'kategori.nama_aktivitas', 'name'=>'kategori.nama_aktivitas', 'title'=>'Kategori Culture']) 
            ->addColumn(['data' => 'jadwal_1', 'name'=>'jadwal_1', 'title'=>'Jadwal 1']) 
            ->addColumn(['data' => 'jadwal_2', 'name'=>'jadwal_2', 'title'=>'Jadwal 2']) 
            ->addColumn(['data' => 'jadwal_3', 'name'=>'jadwal_3', 'title'=>'Jadwal 3']) 
            ->addColumn(['data' => 'jadwal_4', 'name'=>'jadwal_4', 'title'=>'Jadwal 4']) 
            ->addColumn(['data' => 'jadwal_5', 'name'=>'jadwal_5', 'title'=>'Jadwal 5']) 
            ->addColumn(['data' => 'harga_endeso', 'name'=>'harga_endeso', 'title'=>'Harga Endeso']) 
            ->addColumn(['data' => 'harga_pemilik', 'name'=>'harga_pemilik', 'title'=>'Harga Pemilik']) 
            ->addColumn(['data' => 'kapasitas', 'name'=>'kapasitas', 'title'=>'Kapasitas']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('warga.index')->with(compact('html'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('warga.create');
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
        $this->validate($request, [
            'nama_warga' => 'required|unique:warga,nama_warga',
            'id_kategori_culture' => 'required|exists:kategori,id',
            'jadwal_1' => 'required',
            'jadwal_2' => 'max:191',
            'jadwal_3' => 'max:191',
            'jadwal_4' => 'max:191',
            'jadwal_5' => 'max:191',
            'durasi' => 'required',
            'harga_endeso' => 'required',
            'harga_pemilik' => 'required',
            'latitude' => 'max:191',
            'longitude' => 'max:191',
            'alamat_warga' => 'max:191',
            'kapasitas' => 'required',
            'foto_profil' => 'image|max:2048'
        ]);

        $warga = Warga::create($request->except('foto_profil'));

        // isi field foto_profil jika ada foto_profil yang diupload
        if ($request->hasFile('foto_profil')) {
        // Mengambil file yang diupload
        $uploaded_foto_profil = $request->file('foto_profil');
        // mengambil extension file
        $extension = $uploaded_foto_profil->getClientOriginalExtension();
        // membuat nama file random berikut extension
        $filename = md5(time()) . '.' . $extension;
        // menyimpan foto_profil ke folder public/img
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $uploaded_foto_profil->move($destinationPath, $filename);
        // mengisi field foto_profil di destinasi dengan filename yang baru dibuat
        $warga->foto_profil = $filename;
        $warga->save();
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan Data Warga $warga->nama_warga"
        ]);

        return redirect()->route('warga.index');
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
        $warga = Warga::find($id);

        return view('warga.edit')->with(compact('warga'));
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
        $this->validate($request, [
            'nama_warga' => 'required|unique:warga,nama_warga,' . $id,
            'id_kategori_culture' => 'required|exists:kategori,id',
            'jadwal_1' => 'required',
            'jadwal_2' => 'max:191',
            'jadwal_3' => 'max:191',
            'jadwal_4' => 'max:191',
            'jadwal_5' => 'max:191',
            'durasi' => 'required',
            'harga_endeso' => 'required',
            'harga_pemilik' => 'required',
            'latitude' => 'max:191',
            'longitude' => 'max:191',
            'alamat_warga' => 'max:191',
            'kapasitas' => 'required',
            'foto_profil' => 'image|max:2048'
        ]);

        $warga = Warga::find($id);
        $warga->update($request->all());

        if ($request->hasFile('foto_profil')) {

        // menambil foto_profil yang diupload berikut ekstensinya

        $filename = null;
        $uploaded_foto_profil = $request->file('foto_profil');
        $extension = $uploaded_foto_profil->getClientOriginalExtension();
        // membuat nama file random dengan extension
        $filename = md5(time()) . '.' . $extension;
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        // memindahkan file ke folder public/img
        $uploaded_foto_profil->move($destinationPath, $filename);
        // hapus foto_profil lama, jika ada
        if ($warga->foto_profil) {
        $old_foto_profil = $warga->foto_profil;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $warga->foto_profil;
        try {
        File::delete($filepath);
        } catch (FileNotFoundException $e) {
        // File sudah dihapus/tidak ada
        }

        }
        // ganti field foto_profil dengan cover yang baru

        $warga->foto_profil = $filename;
        $warga->save();
        }

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil Menyimpan Data Warga $warga->nama_warga"
        ]);

        return redirect()->route('warga.index');
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
        $warga = Warga::find($id);

        // hapus foto lama, jika ada

        if ($warga->foto_profil) {

        $old_foto_profil = $warga->foto_profil;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $warga->foto_profil;
        
            try {
            File::delete($filepath);
            } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
            }

        }
        $warga->delete();

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Warga Berhasil Di hapus"
        ]);
        return redirect()->route('warga.index');
    } 
}
