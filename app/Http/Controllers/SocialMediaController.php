<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\SocialMedia;
use Session;

class SocialMediaController extends Controller
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

            $social_media = SocialMedia::all();

            return Datatables::of($social_media)->addColumn('action', function($social_media){
                    return view('social_media._action', [
                    'model'=> $social_media,
                    'edit_url'=> route('social_media.edit', $social_media->id)
                    ]);
                })->make(true);
            }
            $html = $htmlBuilder
            ->addColumn(['data' => 'nama_facebook', 'name'=>'nama_facebook', 'title'=>'Nama Facebook']) 
            ->addColumn(['data' => 'link_facebook', 'name'=>'link_facebook', 'title'=>'Link Facebook']) 
            ->addColumn(['data' => 'nama_twitter', 'name'=>'nama_twitter', 'title'=>'Nama Twitter']) 
            ->addColumn(['data' => 'link_twitter', 'name'=>'link_twitter', 'title'=>'Link Twitter']) 
            ->addColumn(['data' => 'nama_instagram', 'name'=>'nama_instagram', 'title'=>'Nama Instagram']) 
            ->addColumn(['data' => 'link_instagram', 'name'=>'link_instagram', 'title'=>'Link Instagram']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('social_media.index')->with(compact('html'));

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
        $social_media = SocialMedia::find($id);

        return view('social_media.edit')->with(compact('social_media'));
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
            'nama_facebook'   => 'required',
            'link_facebook'   => 'required',
            'nama_twitter'   => 'required',
            'link_twitter'   => 'required',
            'nama_instagram'   => 'required',
            'link_instagram'   => 'required'
        ]); 

        $social_media = SocialMedia::find($id);
        $social_media->update($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Data Social Media"
            ]);

        return redirect()->route('social_media.index');

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
