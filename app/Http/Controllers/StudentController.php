<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use App\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
        $no=1;
        $major = Major::count();
        return view('master.student.index', compact('student','no','major'));
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
        ]);

        try {
            $req = $request->all();
            Student::create([
                'id' => null,
                'nama' => $req['nama'],
              ]);
          return redirect()
              ->route('student.index')
              ->with('success', 'Data siswa berhasil disimpan!');

        }catch(Exception $e){
          return redirect()
              ->route('student.create')
              ->with('success', 'Data siswa gagal disimpan!');
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
          $student = Student::findOrFail($id);
          $student->nama = $req['nama'];
          $student->save();

          return redirect()
              ->route('students.index')
              ->with('success', 'Data siswa berhasil diubah!');

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
          return redirect()
              ->route('students.index')
              ->with('error', 'Data siswa gagal diubah!');
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
            $Student = Student::findOrFail($id)->delete();
  
            return redirect()
                ->route('students.index')
                ->with('success', 'Data siswa berhasil dihapus!');
  
          } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return redirect()
                ->route('Students.index')
                ->with('error', 'Data siswa gagal diubah!');
          }
    }
}
