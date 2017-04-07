<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Role_user;
use App\User;
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
                    'hapus_url'=> route('user_admin.destroy', $user_admin->user),
                    'edit_url'=> route('user_admin.edit', $user_admin->user),
                    'confirm_message' => 'Yakin mau menghapus ' . $user_admin->title . '?'
                    ]);
                })->make(true);
            }
            $html = $htmlBuilder 
            ->addColumn(['data' => 'user_id', 'name'=>'user_id', 'title'=>'Id'])  
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Username']) 
            ->addColumn(['data' => 'user.email', 'name'=>'user.email', 'title'=>'Email']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('user_admin.index')->with(compact('html'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user_admin.create');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
            ]);

            $admin = new User();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->save();
            $admin->attachRole(1);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah User Admin $request->name"
            ]);
        return redirect()->route('user_admin.index');
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
        $user = User::find($id);
        return view('user_admin.edit')->with(compact('user'));
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'required|min:6|confirmed'
        ]); 

        $user_admin = User::find($id);
        $user_admin->update($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Data User Admin $user_admin->name"
            ]);

        return redirect()->route('user_admin.index');
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
        if(!User::destroy($id) && !Role_user::destroy($id)) 
        {
            return redirect()->back();
        }
        else{
        Session:: flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data User Admin Berhasil Di Hapus"
            ]);
        return redirect()->route('user_admin.index');
        }
    }
}