<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use App\Student;
use App\FinancingCategory;
use App\Payment;
use App\kelas;
use App\PaymentPeriodeDetail;
use Illuminate\Support\Facades\Session;

use DB;

class StudentController extends Controller
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
        $students = Student::all();
        $no=1;
        $fil = '';
        $kls = '';
        $jml = Major::count();
        $majors = Major::all();
        return view('master.student.index', compact('students','no','jml','majors','fil','kls'));
    }

    public function filter(Request $request)
    {
        if($request->kelas=='' && $request->jurusan!=''){
            $students = Student::where('major_id',$request->jurusan)->get();
        }elseif ($request->jurusan=='' && $request->kelas!='') {
            $students = Student::where('kelas',$request->kelas)->get();
        }elseif ($request->jurusan=='' && $request->kelas=='') {
            $students = Student::all();
        }else{
            $students = Student::where('kelas',$request->kelas)
                ->where('major_id',$request->jurusan)
                ->get();
        }
        $no=1;
        $kls=$request->kelas;
        $fil= $request->jurusan;
        $jml = Major::count();
        $majors = Major::all();
        return view('master.student.index', compact('students','no','jml','majors','fil','kls'));
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
            
            // echo '<pre>';
            $n = explode(" ",now());
            $n = strtotime($n[0]);

            $l = strtotime($this->convertDateToSQLDate($req['tgl_masuk']));
        
            if (strlen($req['phone'])>14) {
                return redirect()
                ->route('students.index')
                ->with('error', 'Inputan tidak valid!');
            }
            $date = explode("/",$req['tgl_masuk']);
            $date = $date[2].'-'.$date[0].'-'.$date[1];
            $kelas = kelas::where('major_id',$req['major_id'])
                ->where('kelas',$req['kelas'])
                ->first();
            Student::create([
                'id' => null,
                'nis' => $req['nis'],
                'nama' => $req['nama'],
                'kelas' => $req['kelas'],
                'kelas_id' => $kelas->id,
                'jenis_kelamin' => $req['jenis_kelamin'],
                'major_id' => $req['major_id'],
                'phone' => $req['phone'],
                'email' => $req['email'],
                'alamat' => $req['alamat'],
                'tgl_masuk' => $date,
                ]);
            $categories = FinancingCategory::all();
            $id = DB::getPdo()->lastInsertId();
            for ($i=0; $i < $categories->count(); $i++) 
            { 
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
            $kelas = kelas::where('major_id',$req['major_id'])
                ->where('kelas',$req['kelas'])
                ->first();
            $student = Student::findOrFail($id);
            $student->nama = $req['nama'];
            $student->nis = $req['nis'];
            $student->jenis_kelamin = $req['jenis_kelamin'];
            $student->major_id = $req['major_id'];
            $student->kelas = $req['kelas'];
            $student->kelas_id = $kelas->id;
            $student->phone = $req['phone'];
            $student->email = $req['email'];
            $student->alamat = $req['alamat'];
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

    public function convertDateToSQLDate($date)
    {
        $temp = explode("/",$date);
        return $temp[2]."-".$temp[0]."-".$temp[1];
    }
}
