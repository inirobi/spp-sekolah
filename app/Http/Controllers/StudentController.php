<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use App\Student;
use App\FinancingCategory;
use App\Payment;

use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $no=1;
        $jml = Major::count();
        $majors = Major::all();
        return view('master.student.index', compact('students','no','jml','majors'));
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
        try {
            $req = $request->all();
            if (strlen($req['phone'])>14) {
                return redirect()
                    ->route('students.index')
                    ->with('error', 'Inputan tidak valid!');
            }
            $date = explode("/",$req['tgl_masuk']);
            $date = $date[2].'-'.$date[0].'-'.$date[1];
            Student::create([
                'id' => null,
                'nis' => $req['nis'],
                'nama' => $req['nama'],
                'jenis_kelamin' => $req['jenis_kelamin'],
                'major_id' => $req['major_id'],
                'phone' => $req['phone'],
                'email' => $req['email'],
                'tgl_masuk' => $date,
              ]);
            $id = DB::getPdo()->lastInsertId();
            $categories = FinancingCategory::all();
            for ($i=0; $i < $categories->count(); $i++) { 
                Payment::create([
                    'financing_category_id' => $categories[$i]->id,
                    'student_id' => $id,
                    'jenis_pembayaran' => "Waiting",
                ]);
            }
          return redirect()
              ->route('students.index')
              ->with('success', 'Data siswa berhasil disimpan!');

        }catch(Exception $e){
          return redirect()
              ->route('students.create')
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
        
        try {
            $req = $request->all();
            if (strlen($req['phone'])>14) {
                return redirect()
                    ->route('students.index')
                    ->with('success', 'Data siswa berhasil disimpan!');
            }
            $student = Student::findOrFail($id);
            $student->nama = $req['nama'];
            $student->nis = $req['nis'];
            $student->jenis_kelamin = $req['jenis_kelamin'];
            $student->major_id = $req['major_id'];
            $student->kelas = $req['kelas'];
            $student->phone = $req['phone'];
            $student->email = $req['email'];
            $student->tgl_masuk = $req['tgl_masuk'];
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
