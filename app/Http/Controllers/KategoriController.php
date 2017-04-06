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
            'foto_kategori' => 'image|max:2048'
        ]);

        $kategori = Kategori::create($request->except('foto_kategori'));

        // isi field foto_kategori jika ada foto_kategori yang diupload
        if ($request->hasFile('foto_kategori')) {
        // Mengambil file yang diupload
        $uploaded_foto_kategori = $request->file('foto_kategori');
        // mengambil extension file
        $extension = $uploaded_foto_kategori->getClientOriginalExtension();
        // membuat nama file random berikut extension
        $filename = md5(time()) . '.' . $extension;
        // menyimpan foto_kategori ke folder public/img
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $uploaded_foto_kategori->move($destinationPath, $filename);
        // mengisi field foto_kategori di destinasi dengan filename yang baru dibuat
        $kategori->foto_kategori = $filename;
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
            'foto_kategori' => 'image|max:2048'
        ]);

        $kategori = Kategori::find($id);
        $kategori->update($request->all());

        if ($request->hasFile('foto_kategori')) {

        // menambil foto_kategori yang diupload berikut ekstensinya

        $filename = null;
        $uploaded_foto_kategori = $request->file('foto_kategori');
        $extension = $uploaded_foto_kategori->getClientOriginalExtension();
        // membuat nama file random dengan extension
        $filename = md5(time()) . '.' . $extension;
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

        $kategori->foto_kategori = $filename;
        $kategori->save();
        }

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil Menyimpan $kategori->title"
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
}
