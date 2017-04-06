<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Role_user;
use Session;

class UserController extends Controller
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

            $user_admin = Role_user::with(['user','role'])->where('role_id', 1);

            return Datatables::of($user_admin)->addColumn('action', function($user_admin){
                    return view('rekening._action', [
                    'model'=> $user_admin,
                    'hapus_url'=> route('user_admin.destroy', $user_admin->id),
                    'edit_url'=> route('user_admin.edit', $user_admin->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $user_admin->title . '?'
                    ]);
                })->make(true);
            }
            $html = $htmlBuilder 
            ->addColumn(['data' => 'user_id', 'name'=>'user_id', 'title'=>'Id']) 
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Username']) 
            ->addColumn(['data' => 'user.email', 'name'=>'user.email', 'title'=>'Email']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('user.index')->with(compact('html'));

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
