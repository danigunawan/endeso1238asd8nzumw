<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kamar;
use Yajra\Datatables\Html\Builder; 
use Yajra\Datatables\Datatables;
use Session;

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
        return Datatables::of($kamar)->addColumn('action', function(Kamar $kamar){
            return view('kamar._action', [
            'model'=> $kamar,
            'hapus_url'=> route('kamar.destroy', $kamar->id_kamar),
            'edit_url'=> route('kamar.edit', $kamar->id_kamar),
            'confirm_message' => 'Yakin mau menghapus ' . $kamar->title . '?'
             ]);

         })->make(true);
      }

        $html = $htmlBuilder
            ->addColumn(['data' => 'rumah.nama_pemilik', 'name'=>'rumah.nama_pemilik', 'title'=>'Nama Pemilik Rumah'])
            ->addColumn(['data' => 'destinasi.nama_destinasi', 'name'=>'destinasi.nama_destinasi', 'title'=>'Nama Destinasi'])
            ->addColumn(['data' => 'kapasitas', 'name'=>'kapasitas', 'title'=>'Kapasitas'])
            ->addColumn(['data' => 'harga_endeso', 'name'=>'harga_endeso', 'title'=>'Harga Endeso'])
            ->addColumn(['data' => 'harga_pemilik', 'name'=>'harga_pemilik', 'title'=>'Harga Pemilik'])
            ->addColumn(['data' => 'harga_makan', 'name'=>'harga_makan', 'title'=>'Harga Makan'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
            return view('kamar.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kamar.create');
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
             'id_rumah' => 'required|exists:rumah,id',
            'id_destinasi' => 'required|exists:destinasi,id',
            'foto_kamar.*' => 'image|max:2048',
            'deskripsi' => 'required',
            'harga_endeso' => 'required',
            'harga_pemilik' => 'required',
            'harga_makan' => 'required'


            ]); 

        $kamar = Kamar::create([
            'deskripsi' => $request->deskripsi,
            'id_rumah' => $request->id_rumah,
            'id_destinasi' => $request->id_destinasi,
            'kapasitas' => $request->kapasitas,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'judul_peta' => $request->judul_peta,
           'harga_endeso' => $request->harga_endeso,
           'harga_pemilik' => $request->harga_pemilik,
           'harga_makan' => $request->harga_makan,
           'info_makanan' => $request->info_makanan

           ]);

        // isi field foto_kamar jika ada FOTO KAMAR 1 yang diupload
        if ($request->hasFile('foto_kamar')) {
           
            $foto_kamar = $request->file('foto_kamar');
             if (is_array($foto_kamar) || is_object($foto_kamar))
            {
            $urutan = 0;

            foreach ($foto_kamar as $foto_kamars){
                # code...
                // mengambil urutan untuk foto 1 - 5 
                $urutan++;

                // Mengambil file yang diupload
                $uploaded_foto_kamar_1 = $foto_kamars;
                // mengambil extension file
                $extension = $uploaded_foto_kamar_1->getClientOriginalExtension();
                // membuat nama file random berikut extension
                $filename = str_random(40) . '.' . $extension;
                // menyimpan foto_kamar ke folder public/img
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                $uploaded_foto_kamar_1->move($destinationPath, $filename);
                // mengisi field foto_kamar di database kamar dengan filename yang baru dibuat
                if ($urutan == 1){
                $kamar->foto1 = $filename; 
                }  
                if ($urutan == 2){
                $kamar->foto2 = $filename; 
                }  
                if ($urutan == 3){
                $kamar->foto3 = $filename; 
                }  
                if ($urutan == 4){
                $kamar->foto4 = $filename; 
                }  
                if ($urutan == 5){
                $kamar->foto5 = $filename; 
                } 
            }

            // menyimpan field foto_kamar di database kamar dengan filename yang baru dibuat
                   $kamar->save();
            }

        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan Data Kamar"
        ]);

        return redirect()->route('kamar.index');
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
        $kamar = Kamar::find($id);
         return view('kamar.edit')->with(compact('kamar'));
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
             'id_rumah' => 'required|exists:rumah,id',
            'id_destinasi' => 'required|exists:destinasi,id',
            'foto_kamar.*' => 'image|max:2048',
            'deskripsi' => 'required',
            'harga_endeso' => 'required',
            'harga_pemilik' => 'required',
            'harga_makan' => 'required'            
            ]); 

        $kamar = Kamar::find($id);
        $kamar->update([
            'deskripsi' => $request->deskripsi,
            'id_rumah' => $request->id_rumah,
            'id_destinasi' => $request->id_destinasi,
            'kapasitas' => $request->kapasitas,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'judul_peta' => $request->judul_peta,
           'harga_endeso' => $request->harga_endeso,
           'harga_pemilik' => $request->harga_pemilik,
           'harga_makan' => $request->harga_makan,
           'info_makanan' => $request->info_makanan

        ]);

        if ($request->hasFile('foto_kamar')) {

        $foto_kamar = $request->file('foto_kamar');

            $urutan = 0;

            foreach ($foto_kamar as $foto_kamars){
                # code...
                // mengambil urutan untuk foto 1 - 5 
                $urutan++;

                   // menambil foto_kategori yang diupload berikut ekstensinya

                    $filename = null;
                    $uploaded_foto_kamar = $foto_kamars;
                    $extension = $uploaded_foto_kamar->getClientOriginalExtension();
                    // membuat nama file random dengan extension
                    $filename = str_random(40) . '.' . $extension;
                    $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                    // memindahkan file ke folder public/img
                    $uploaded_foto_kamar->move($destinationPath, $filename);
                    // hapus foto_kamar lama, jika ada
                    if ($kamar->foto_kamar) {
                    $old_foto_kamar = $kamar->foto_kamar;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                    . DIRECTORY_SEPARATOR . $kamar->foto_kamar;
                    try {
                    File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                    }

                 }
                // ganti field foto_kamar dengan cover yang baru
                 if ($urutan == 1){
                $kamar->foto1 = $filename; 
                }  
                if ($urutan == 2){
                $kamar->foto2 = $filename; 
                }  
                if ($urutan == 3){
                $kamar->foto3 = $filename; 
                }  
                if ($urutan == 4){
                $kamar->foto4 = $filename; 
                }  
                if ($urutan == 5){
                $kamar->foto5 = $filename; 
                } 
            }
            // menyimpan field foto_kamar di database kamar dengan filename yang baru dibuat
                   $kamar->save();

         }

          Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil Menyimpan Data Kamar"
        ]);

        return redirect()->route('kamar.index');


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

        $kamar = Kamar::find($id);

        // hapus foto lama, jika ada

        if ($kamar->foto_kamar) {

        $old_foto_kategori = $kamar->foto_kamar;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $kamar->foto_kamar;
        
            try {
            File::delete($filepath);
            } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
            }

        }
        $kamar->delete();

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Kategori Berhasil Dihapus"
        ]);
        return redirect()->route('kamar.index');

    }
}
