<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Destinasi;
use Session;

class DestinasiController extends Controller
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

            $destinasi = Destinasi::all();

            return Datatables::of($destinasi)->addColumn('action', function($destinasi){
                    return view('destinasi._action', [
                    'model'=> $destinasi,
                    'hapus_url'=> route('destinasi.destroy', $destinasi->id),
                    'edit_url'=> route('destinasi.edit', $destinasi->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $destinasi->title . '?'
                    ]);
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'nama_destinasi', 'name'=>'nama_destinasi', 'title'=>'Destinasi'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('destinasi.index')->with(compact('html'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('destinasi.create');
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
                'nama_destinasi' => 'required|unique:destinasi,nama_destinasi',
                'foto_destinasi' => 'image|max:2048'
                ]);

        $destinasi = Destinasi::create($request->except('foto_destinasi'));

        // isi field foto_destinasi jika ada foto_destinasi yang diupload
        if ($request->hasFile('foto_destinasi')) {
        // Mengambil file yang diupload
        $uploaded_foto_destinasi = $request->file('foto_destinasi');
        // mengambil extension file
        $extension = $uploaded_foto_destinasi->getClientOriginalExtension();
        // membuat nama file random berikut extension
        $filename = md5(time()) . '.' . $extension;
        // menyimpan foto_destinasi ke folder public/img
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $uploaded_foto_destinasi->move($destinationPath, $filename);
        // mengisi field foto_destinasi di destinasi dengan filename yang baru dibuat
        $destinasi->foto_destinasi = $filename;
        $destinasi->save();
        }
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $destinasi->title"
        ]);

        return redirect()->route('destinasi.index');

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
