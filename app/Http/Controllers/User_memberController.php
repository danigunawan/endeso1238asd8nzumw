<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Role_user;
use App\User;
use Session;

class User_memberController extends Controller
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

            $user_member = Role_user::with(['user','role'])->where('role_id', 2);
            $user = User::find(['id','name']);

            return Datatables::of($user_member)->addColumn('action', function($user_member){
                    return view('rekening._action', [
                    'model'=> $user_member,
                    'hapus_url'=> route('user_member.destroy', $user_member->user),
                    'edit_url'=> route('user_member.edit', $user_member->user),
                    'confirm_message' => 'Yakin mau menghapus ' . $user_member->user->name . '?'
                    ]);
                })->make(true);
            }
            $html = $htmlBuilder 
            ->addColumn(['data' => 'user_id', 'name'=>'user_id', 'title'=>'Id'])  
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Username']) 
            ->addColumn(['data' => 'user.email', 'name'=>'user.email', 'title'=>'Email']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

            return view('user_member.index')->with(compact('html'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user_member.create');
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

            $member = new User();
            $member->name = $request->name;
            $member->email = $request->email;
            $member->password = bcrypt($request->password);
            $member->save();
            $member->attachRole(2);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah User Member $request->name"
            ]);
        return redirect()->route('user_member.index');
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
        return view('user_member.edit')->with(compact('user'));
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

        $user_member = User::find($id);
        $user_member->update($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Data User Member $user_member->name"
            ]);

        return redirect()->route('user_member.index');
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
            "message"=>"Data User Member Berhasil Di Hapus"
            ]);
        return redirect()->route('user_member.index');
        }
    }
}
