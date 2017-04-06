<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Rekening;
use Session;

class RekeningController extends Controller
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

            $rekening = Rekening::all();

            return Datatables::of($rekening)->addColumn('action', function($rekening){
                    return view('rekening._action', [
                    'model'=> $rekening,
                    'hapus_url'=> route('rekening.destroy', $rekening->id),
                    'edit_url'=> route('rekening.edit', $rekening->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $rekening->title . '?'
                    ]);
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'nama_bank', 'name'=>'nama_bank', 'title'=>'Nama Bank'])
            ->addColumn(['data' => 'nama_rekening_tabungan', 'name'=>'nama_rekening_tabungan', 'title'=>'Nama Rekening Tabungan'])
            ->addColumn(['data' => 'nomor_rekening_tabungan', 'name'=>'nomor_rekening_tabungan', 'title'=>'Nomor Rekening Tabungan'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('rekening.index')->with(compact('html'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rekening.create');
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
            'nama_bank'   => 'required',
            'nama_rekening_tabungan'   => 'required',
            'nomor_rekening_tabungan'   => 'required|unique:rekening,nomor_rekening_tabungan'
            ]);

         $rekening = Rekening::create([
            'nama_bank' => $request->nama_bank,
            'nama_rekening_tabungan' => $request->nama_rekening_tabungan,
            'nomor_rekening_tabungan' => $request->nomor_rekening_tabungan]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Data Rekening $rekening->nama_bank"
            ]);
        return redirect()->route('rekening.index');
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
