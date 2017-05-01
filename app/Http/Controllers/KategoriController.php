<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Kategori;
use Session;
use Illuminate\Support\Facades\File;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $kategori = Kategori::with('destinasi');
            return Datatables::of($kategori)->addColumn('action',
                function($kategori){
                    return view('kategori._action', [
                        'model' => $kategori,
                        'hapus_url' => route('kategori.destroy', $kategori->id),
                        'edit_url' => route('kategori.edit', $kategori->id),
                        'confirm_message' => 'Apakah Anda Yakin Menghapus' . $kategori->title . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
        -> addColumn(['data' => 'nama_aktivitas', 'name' => 'nama_aktivitas', 'title' => 'Aktivitas'])
        -> addColumn(['data' => 'destinasi.nama_destinasi', 'name' => 'destinasi.nama_destinasi', 'title' => 'Destinasi'])
        -> addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false]);

        return view('kategori.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kategori.create');
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
            'nama_aktivitas' => 'required|unique:kategori,nama_aktivitas',
            'destinasi_kategori' => 'required|exists:destinasi,id',
            'durasi' => 'required',
            'foto_kategori.*' => 'image|max:2048'
        ]);

        $kategori = Kategori::create([

           'nama_aktivitas' => $request->nama_aktivitas,
           'deskripsi_kategori' => $request->deskripsi_kategori,
           'destinasi_kategori' => $request->destinasi_kategori,
           'durasi' => $request->durasi
           
        ]);


        // isi field foto_kategori jika ada FOTO kategori 1 yang diupload
        if ($request->hasFile('foto_kategori')) {
            $foto_kategori = $request->file('foto_kategori');

            $urutan = 0;

            foreach ($foto_kategori as $foto_kategoris){

                // mengambil urutan untuk foto 1 - 5 
                $urutan++;

                // Mengambil file yang diupload
                $uploaded_foto_kategori = $foto_kategoris;
                // mengambil extension file
                $extension = $uploaded_foto_kategori->getClientOriginalExtension();
                // membuat nama file random berikut extension
                $filename = str_random(40) . '.' . $extension;
                // menyimpan foto_kategori ke folder public/img
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                $uploaded_foto_kategori->move($destinationPath, $filename);
                // mengisi field foto_kategori di database kategori dengan filename yang baru dibuat
                if ($urutan == 1){
                $kategori->foto_kategori = $filename; 
                }  
                if ($urutan == 2){
                $kategori->foto_kategori2 = $filename; 
                }  
                if ($urutan == 3){
                $kategori->foto_kategori3 = $filename; 
                }  
                if ($urutan == 4){
                $kategori->foto_kategori4 = $filename; 
                }  
                if ($urutan == 5){
                $kategori->foto_kategori5 = $filename; 
                } 
            }
            // menyimpan field foto_kategori di database kategori dengan filename yang baru dibuat
                   $kategori->save();

        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan $kategori->nama_aktivitas"
        ]);

        return redirect()->route('kategori.index');
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
        $kategori = Kategori::find($id);

        return view('kategori.edit')->with(compact('kategori'));
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
            'nama_aktivitas' => 'required|unique:kategori,nama_aktivitas,' . $id,
            'destinasi_kategori' => 'required|exists:destinasi,id',
            'durasi' => 'required',
            'foto_kategori.*' => 'image|max:2048'
        ]);

        $kategori = Kategori::find($id);
        $kategori->update([

           'nama_aktivitas' => $request->nama_aktivitas,
           'deskripsi_kategori' => $request->deskripsi_kategori,
           'destinasi_kategori' => $request->destinasi_kategori,
           'durasi' => $request->durasi
           
        ]);

        if ($request->hasFile('foto_kategori')) {
            $foto_kategori = $request->file('foto_kategori');

            $urutan = 0;

            foreach ($foto_kategori as $foto_kategoris){
                # code...
                // mengambil urutan untuk foto 1 - 5 
                $urutan++;

                   // menambil foto_kategori yang diupload berikut ekstensinya

                    $filename = null;
                    $uploaded_foto_kategori = $foto_kategoris;
                    $extension = $uploaded_foto_kategori->getClientOriginalExtension();
                    // membuat nama file random dengan extension
                    $filename = str_random(40) . '.' . $extension;
                    $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                    // memindahkan file ke folder public/img
                    $uploaded_foto_kategori->move($destinationPath, $filename);
                    // hapus foto_kategori lama, jika ada
                    if ($kategori->foto_kategori) {
                    $old_foto_kategori = $kategori->foto_kategori;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                    . DIRECTORY_SEPARATOR . $kategori->foto_kategori;
                    try {
                    File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                    }

                 }
                // ganti field foto_kategori dengan cover yang baru
                 if ($urutan == 1){
                $kategori->foto_kategori = $filename; 
                }  
                if ($urutan == 2){
                $kategori->foto_kategori2 = $filename; 
                }  
                if ($urutan == 3){
                $kategori->foto_kategori3 = $filename; 
                }  
                if ($urutan == 4){
                $kategori->foto_kategori4 = $filename; 
                }  
                if ($urutan == 5){
                $kategori->foto_kategori5 = $filename; 
                } 
            }
            // menyimpan field foto_kategori di database kategori dengan filename yang baru dibuat
                   $kategori->save();

         }

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil Menyimpan $kategori->nama_aktivitas"
        ]);

        return redirect()->route('kategori.index');


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
        $kategori = Kategori::find($id);

        // hapus foto lama, jika ada

        if ($kategori->foto_kategori) {

        $old_foto_kategori = $kategori->foto_kategori;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $kategori->foto_kategori;
        
            try {
            File::delete($filepath);
            } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
            }

        }
        $kategori->delete();

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Kategori Berhasil Dihapus"
        ]);
        return redirect()->route('kategori.index');
    }


    public function list_cultural(){

        $list_cultural = Kategori::limit(8)->get();
        //Mereturn (menampilkan) halaman yang ada difolder cultural -> list. (Passing $lis_cultural ke view atau tampilan cultural.list)
        return view('cultural.list', ['list_cultural' => $list_cultural]);
    }
}
