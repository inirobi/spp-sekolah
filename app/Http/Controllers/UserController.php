<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $no=1;
        return view('master.user.index', compact('users','no'));
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
        $this->validate($request,[
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            ]);
            
        try {
            $req = $request->all();
            User::create([
                'id' => null,
                'name' => $req['nama'],
                'username' => $req['username'],
                'email' => $req['email'],
                'password' => Hash::make($req['password']),
              ]);
          return redirect()
              ->route('user.index')
              ->with('success', 'User baru telah ditambahkan!');

        }catch(Exception $e){
          return redirect()
              ->route('user.create')
              ->with('error', 'Gagal menambah user!');
        }
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
        $this->validate($request,[
            'nama' => 'required',
        ]);

        try {
          $req = $request->all();
          $major = User::findOrFail($id);
          $major->nama = $req['nama'];
          $major->save();

          return redirect()
              ->route('user.index')
              ->with('success', 'Data user berhasil diubah!');

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
          return redirect()
              ->route('user.index')
              ->with('error', 'Data user gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id)->delete();
  
            return redirect()
                ->route('user.index')
                ->with('success', 'Data user berhasil dihapus!');
  
          } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return redirect()
                ->route('user.index')
                ->with('error', 'Data jurusan gagal diubah!');
          }
    }
}
