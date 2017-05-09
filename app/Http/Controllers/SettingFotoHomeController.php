<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\SettingFotoHome;
use Session;

class SettingFotoHomeController extends Controller
{
    //
    public function index(Request $request, Builder $htmlBuilder)
    {
        //
         if ($request->ajax()) {

            $setting_foto_home = SettingFotoHome::all();

            return Datatables::of($setting_foto_home)->addColumn('action', function($setting_foto_home){
                    return view('setting-foto-home._action', [ 
                    'edit_url'=> route('setting-foto-home.edit', $setting_foto_home->id) 
                    ]);
                })->addColumn('foto_1',function($foto_1){
                return view('setting-foto-home.foto_1', [
                        'foto_1'=> $foto_1
                         ]);
                })->addColumn('foto_2',function($foto_2){
                return view('setting-foto-home.foto_2', [
                        'foto_2'=> $foto_2
                         ]);
                })->rawColumns(['foto_1','foto_2','action'])->make(true);
            }

            $html = $htmlBuilder
            ->addColumn(['data' => 'foto_1', 'name'=>'foto_1', 'title'=>'Foto Pertama'])
            ->addColumn(['data' => 'foto_2', 'name'=>'foto_2', 'title'=>'Foto Kedua'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('setting-foto-home.index')->with(compact('html'));
    }

    public function edit($id)
    {
        //
        $setting_foto_home = SettingFotoHome::find($id);
         return view('setting-foto-home.edit')->with(compact('setting_foto_home'));
    }

    public function update(Request $request, $id)
    {
        //
       $this->validate($request, [ 
            'foto_home.*' => 'image|max:2048'           
            ]); 

        $setting_foto_home = SettingFotoHome::find($id);
        $setting_foto_home->update();

        if ($request->hasFile('foto_home')) {

        $foto_home = $request->file('foto_home');

            $urutan = 0;

            foreach ($foto_home as $foto_homes){
                # code...
                // mengambil urutan untuk foto 1 - 5 
                $urutan++;

                   // menambil foto_kategori yang diupload berikut ekstensinya

                    $filename = null;
                    $uploaded_foto_home = $foto_homes;
                    $extension = $uploaded_foto_home->getClientOriginalExtension();
                    // membuat nama file random dengan extension
                    $filename = str_random(40) . '.' . $extension;
                    $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                    // memindahkan file ke folder public/img
                    $uploaded_foto_home->move($destinationPath, $filename);
                    // hapus foto_home lama, jika ada
                    if ($setting_foto_home->foto_home) {
                    $old_foto_home = $setting_foto_home->foto_home;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                    . DIRECTORY_SEPARATOR . $setting_foto_home->foto_home;
                    try {
                    File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                    }

                 }
                // ganti field foto_home dengan cover yang baru
                 if ($urutan == 1){
                $setting_foto_home->foto_1 = $filename; 
                }  
                if ($urutan == 2){
                $setting_foto_home->foto_2 = $filename; 
                }               }
            // menyimpan field foto_home di database setting_foto_home dengan filename yang baru dibuat
                   $setting_foto_home->save();

         }

          Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil Menyimpan Setting Foto Home"
        ]);

        return redirect()->route('setting-foto-home.index');


    }

}
