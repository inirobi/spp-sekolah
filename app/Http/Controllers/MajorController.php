<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use Illuminate\Support\Facades\Session;

class MajorController extends Controller
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
        $majors = Major::all();
        $no=1;
        return view('master.major.index', compact('majors','no'));
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
            'jurusan' => 'required',
        ]);

        try {
            $req = $request->all();
            Major::create([
                'id' => null,
                'nama' => $req['jurusan'],
              ]);
          return redirect()
              ->route('majors.index')
              ->with('success', 'Data jurursan berhasil disimpan!');

        }catch(Exception $e){
          return redirect()
              ->route('majors.create')
              ->with('error', 'Data jurursan gagal disimpan!');
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
          $major = Major::findOrFail($id);
          $major->nama = $req['nama'];
          $major->save();

          return redirect()
              ->route('majors.index')
              ->with('success', 'Data jurusan berhasil diubah!');

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
          return redirect()
              ->route('majors.index')
              ->with('error', 'Data jurusan gagal diubah!');
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
            $major = Major::findOrFail($id)->delete();
  
            return redirect()
                ->route('majors.index')
                ->with('success', 'Data jurusan berhasil dihapus!');
  
          } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return redirect()
                ->route('majors.index')
                ->with('error', 'Data jurusan gagal dihapus!');
          }
    }
}
