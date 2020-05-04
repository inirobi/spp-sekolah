<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use App\kelas;
use Illuminate\Support\Facades\Session;
use DB;
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
        // echo '<pre>';
        // var_dump($majors[0]->kelas[1]->nominal);die;
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
        try {
            $req = $request->all();
            if($req['id_jur'] == '' || $req['x'] == '' || $req['xi'] == '' || $req['xii'] == ''){
                return redirect()
                    ->route('majors.index')
                    ->with('error', '{Inputan tidak valid}!');
            }
            Major::create([
                'id' => null,
                'nama' => $req['id_jur'],
              ]);

              $id = DB::getPdo()->lastInsertId();
            
            kelas::create([
                'id' => null,
                'kelas' => 'X',
                'major_id' => $id,
                'nominal' => $req['x'],
              ]);

            kelas::create([
                'id' => null,
                'kelas' => 'XI',
                'major_id' => $id,
                'nominal' => $req['xi'],
              ]);

            kelas::create([
                'id' => null,
                'kelas' => 'XII',
                'major_id' => $id,
                'nominal' => $req['xii'],
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

        try {
            $req = $request->all();
            if($req['id_jur'] == ''){
                return redirect()
                    ->route('majors.index')
                    ->with('error', '{Inputan tidak valid}!');
            }
          $major = Major::findOrFail($id);
          $major->nama = $req['id_jur'];
          $major->save();

            DB::table('kelas')
                ->where('major_id', $id)
                ->where('kelas', 'X')
                ->update(['nominal' => $req['x'] ]);
            DB::table('kelas')
                ->where('major_id', $id)
                ->where('kelas', 'XI')
                ->update(['nominal' => $req['xi'] ]);
            DB::table('kelas')
                ->where('major_id', $id)
                ->where('kelas', 'XII')
                ->update(['nominal' => $req['xii'] ]);

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
            Major::findOrFail($id)->delete();
            DB::table('kelas')->where('major_id', '=', $id)->delete();
  
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
