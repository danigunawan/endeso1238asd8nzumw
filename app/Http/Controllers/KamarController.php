<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kamar;
use Yajra\Datatables\Html\Builder; 
use Yajra\Datatables\Datatables;

class KamarController extends Controller
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
        $kamar = Kamar::with(['destinasi','rumah']);
        return Datatables::of($kamar)->make(true);
      }

        $html = $htmlBuilder
            ->addColumn(['data' => 'rumah.nama_pemilik', 'name'=>'rumah.nama_pemilik', 'title'=>'Nama Pemilik Rumah'])
            ->addColumn(['data' => 'destinasi.nama_destinasi', 'name'=>'destinasi.nama_destinasi', 'title'=>'Nama Destinasi'])
            ->addColumn(['data' => 'kapasitas', 'name'=>'kapasitas', 'title'=>'Kapasitas'])
            ->addColumn(['data' => 'harga_endeso', 'name'=>'harga_endeso', 'title'=>'Harga Endeso'])
            ->addColumn(['data' => 'harga_pemilik', 'name'=>'harga_pemilik', 'title'=>'Harga Pemilik']);
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
