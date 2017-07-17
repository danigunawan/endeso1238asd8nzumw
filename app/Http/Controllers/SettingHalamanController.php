<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\SettingHalaman;
use Session;


class SettingHalamanController extends Controller
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

            $setting_halaman = SettingHalaman::all();

            return Datatables::of($setting_halaman)->addColumn('action', function($setting_halaman){
                    return view('setting-halaman._action', [
                    'model'=> $setting_halaman,
                    'hapus_url'=> route('setting-halaman.destroy', $setting_halaman->id),
                    'edit_url'=> route('setting-halaman.edit', $setting_halaman->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $setting_halaman->title . '?'
                    ]);
                })->editColumn('jenis_halaman', function($setting_halaman){
                        if ($setting_halaman->jenis_halaman == 1) {
                            # code...
                            return 'Tentang Homestay';
                        }
                        elseif ($setting_halaman->jenis_halaman == 2) {
                            # code...
                            return 'Cara Pesan Homestay';
                        } 
                        elseif ($setting_halaman->jenis_halaman == 4) {
                            # code...
                            return 'Tentang Culture Experience';
                        } 
                        elseif ($setting_halaman->jenis_halaman == 5) {
                            # code...
                            return 'Cara Pesan Culture Experience';
                        }

                           elseif ($setting_halaman->jenis_halaman == 3) {
                            # code...
                            return 'Kontak';
                        }

                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'judul', 'name'=>'judul', 'title'=>'Judul'])
            ->addColumn(['data' => 'jenis_halaman', 'name'=>'jenis_halaman', 'title'=>'Jenis Halaman'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('setting-halaman.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('setting-halaman.create');

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
                'judul' => 'required',
                'isi_halaman' => 'required',
                'jenis_halaman' => 'required|unique:setting_halamen,jenis_halaman'
                ]);

        $setting_halaman = SettingHalaman::create(['judul' =>$request->judul,'isi_halaman' => $request->isi_halaman,'jenis_halaman' => $request->jenis_halaman]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $setting_halaman->judul"
        ]);

        return redirect()->route('setting-halaman.index');


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

        $setting_halaman = SettingHalaman::find($id);

        return view('setting-halaman.edit',['setting_halaman' => $setting_halaman]);
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
        'judul' => 'required', 
        'isi_halaman' => 'required',
        'jenis_halaman' => 'required|unique:setting_halamen,jenis_halaman,'.$id
        ]);

        $setting_halaman = SettingHalaman::find($id);
        $setting_halaman->update($request->all());

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $setting_halaman->judul"
        ]);

        return redirect()->route('setting-halaman.index');



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

      SettingHalaman::destroy($id);


        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Setting Halaman berhasil dihapus"
        ]);
        return redirect()->route('setting-halaman.index');
    }
}
