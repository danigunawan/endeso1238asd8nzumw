<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\SettingHalamanCulture;
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
}
