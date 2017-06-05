<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\SettingHalamanCulture;
use Illuminate\Support\Facades\File;
use App\Kategori;
use Session;

class SettingHalamanCultureController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
        //
         if ($request->ajax()) {

            $setting_halaman_culture = SettingHalamanCulture::all();

            return Datatables::of($setting_halaman_culture)->addColumn('action', function($action){
                    return view('setting-halaman-culture._action', [ 
                    'edit_url'=> route('setting-halaman-culture.edit', $action->id) 
                    ]);
                })->editColumn('kategori_1',function($setting_halaman_culture){
                    $kategori = Kategori::find($setting_halaman_culture->kategori_1);
                    return $kategori->nama_aktivitas;
                })->editColumn('kategori_2',function($setting_halaman_culture){
                    $kategori = Kategori::find($setting_halaman_culture->kategori_2);
                    return $kategori->nama_aktivitas;
                })->editColumn('kategori_3',function($setting_halaman_culture){
                    $kategori = Kategori::find($setting_halaman_culture->kategori_3);
                    return $kategori->nama_aktivitas;
                })->editColumn('kategori_4',function($setting_halaman_culture){
                    $kategori = Kategori::find($setting_halaman_culture->kategori_4);
                    return $kategori->nama_aktivitas;
                })->make(true);
            }
            $html = $htmlBuilder

            ->addColumn(['data' => 'kategori_1', 'name'=>'kategori_1', 'title'=>'Kategori 1'])
            ->addColumn(['data' => 'kategori_2', 'name'=>'kategori_2', 'title'=>'Kategori 2'])
            ->addColumn(['data' => 'kategori_3', 'name'=>'kategori_3', 'title'=>'Kategori 3'])
            ->addColumn(['data' => 'kategori_4', 'name'=>'kategori_4', 'title'=>'Kategori 4'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'']);
            return view('setting-halaman-culture.index')->with(compact('html'));
    }

    public function edit($id)
    {
        $setting_halaman_culture = SettingHalamanCulture::find($id);

        return view('setting-halaman-culture.edit',['setting_halaman_culture' => $setting_halaman_culture]);
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'kategori_1' => 'required',
            'kategori_2' => 'required',
            'kategori_3' => 'required',
            'kategori_4' => 'required',
            'foto.*' => 'image|max:2048'
        ]);

        $setting_halaman_culture = SettingHalamanCulture::find($id);
        $setting_halaman_culture->update([

           'kategori_1' => $request->kategori_1,
           'kategori_2' => $request->kategori_2,
           'kategori_3' => $request->kategori_3,
           'kategori_4' => $request->kategori_4
           
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $urutan = 0;

            foreach ($foto as $fotos){
                # code...
                // mengambil urutan untuk foto 1 - 5 
                $urutan++;

                   // menambil foto yang diupload berikut ekstensinya

                    $filename = null;
                    $uploaded_foto = $fotos;
                    $extension = $uploaded_foto->getClientOriginalExtension();
                    // membuat nama file random dengan extension
                    $filename = str_random(40) . '.' . $extension;
                    $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                    // memindahkan file ke folder public/img
                    $uploaded_foto->move($destinationPath, $filename);
                    // hapus foto lama, jika ada
                    
                // ganti field foto dengan cover yang baru
                if ($urutan == 1){

                    if ($setting_halaman_culture->foto_1) {
                        $old_foto_1 = $setting_halaman_culture->foto_1;
                        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                        . DIRECTORY_SEPARATOR . $setting_halaman_culture->foto_1;
                        try {
                        File::delete($filepath);
                        } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                        }

                     }

                $setting_halaman_culture->foto_1 = $filename; 
                }  
                if ($urutan == 2){

                    if ($setting_halaman_culture->foto_2) {
                        $old_foto_2 = $setting_halaman_culture->foto_2;
                        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                        . DIRECTORY_SEPARATOR . $setting_halaman_culture->foto_2;
                        try {
                        File::delete($filepath);
                        } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                        }

                     }

                $setting_halaman_culture->foto_2 = $filename; 
                }  
                if ($urutan == 3){

                    if ($setting_halaman_culture->foto_3) {
                        $old_foto_3 = $setting_halaman_culture->foto_3;
                        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                        . DIRECTORY_SEPARATOR . $setting_halaman_culture->foto_3;
                        try {
                        File::delete($filepath);
                        } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                        }

                     }

                $setting_halaman_culture->foto_3 = $filename; 
                }  
                if ($urutan == 4){


                    if ($setting_halaman_culture->foto_4) {
                        $old_foto_4 = $setting_halaman_culture->foto_4;
                        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                        . DIRECTORY_SEPARATOR . $setting_halaman_culture->foto_4;
                        try {
                        File::delete($filepath);
                        } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                        }

                     }
                $setting_halaman_culture->foto_4 = $filename; 
                }  
            }
            // menyimpan field foto_1 di database kategori dengan filename yang baru dibuat
            $setting_halaman_culture->save();

         }

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil Menyimpan Setting Halaman Culture"
        ]);

        return redirect()->route('setting-halaman-culture.index');


    }
}
