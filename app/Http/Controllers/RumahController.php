<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rumah;
use Yajra\Datatables\Html\Builder; 
use Yajra\Datatables\Datatables;
use Session;

class RumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        // cara menampilkan datatable
      if ($request->ajax()) {
        $rumah = Rumah::select(['id', 'nama_pemilik','no_telp','alamat']);
        return Datatables::of($rumah)->addColumn('action', function($rumah){
            return view('rumah._action', [
            'model'=> $rumah,
            'hapus_url'=> route('rumah.destroy', $rumah->id),
            'edit_url'=> route('rumah.edit', $rumah->id),
            'confirm_message' => 'Yakin mau menghapus ' . $rumah->title . '?'
            ]);
         })->make(true);
      }

      $html = $htmlBuilder
        ->addColumn(['data' => 'nama_pemilik', 'name'=>'nama_pemilik', 'title'=>'Nama Pemilik'])
        ->addColumn(['data' => 'no_telp', 'name'=>'no_telp', 'title'=>'No Telp'])
        ->addColumn(['data' => 'alamat', 'name'=>'alamat', 'title'=>'Alamat'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('rumah.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //arahkan ke view create
        return view('rumah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'nama_pemilik'   => 'required|unique:rumah,nama_pemilik',
            'no_telp'   => 'required',
            'alamat'   => 'required'
            ]);
//memasukan data dengan model rumah
         $rumah = Rumah::create([
            'nama_pemilik' => $request->nama_pemilik,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat]);
//memasukan data dengan model rumah

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Data Rumah $rumah->nama_pemilik"
            ]);
        return redirect()->route('rumah.index');
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
         $rumah = Rumah::find($id);
         return view('rumah.edit')->with(compact('rumah'));
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
            'nama_pemilik'   => 'required|unique:rumah,nama_pemilik',
            'no_telp'   => 'required',
            'alamat'   => 'required'
            ]);
//memasukan data dengan model rumah
         $rumah = Rumah::find($id);
         $rumah->update([
            'nama_pemilik' => $request->nama_pemilik,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat]);
//memasukan data dengan model rumah

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Data Rumah $rumah->nama_pemilik"
            ]);
        return redirect()->route('rumah.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data dengan pengecekan alert /peringatan
        if(!Rumah::destroy($id)) 
        {
            return redirect()->back();
        }
        else{
        Session:: flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Rumah Berhasil Di Hapus"
            ]);
        return redirect()->route('rumah.index');
        }
    }
}
