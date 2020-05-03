<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use App\Income;
use App\Pencatatan;
use Illuminate\Support\Facades\Session;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Income::all();
        $no=1;
        return view('pemasukan.index', compact('datas','no'));
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
            $uuid = Uuid::uuid1();
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('foto');
            
            $nama_file = time()."_".$file->getClientOriginalName();
    
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'nota';
            $file->move($tujuan_upload,$uuid.$nama_file);
            
            Income::create([
                'id' => null,
                'title' => $req['title'],
                'description' => $req['description'],
                'sumber' => $req['sumber' ],
                'nominal' => $req['nominal'],
                'foto' => $uuid.$nama_file,
            ]);
            $desc = "Pemasukan {$req['title']} dari {$req['sumber']}";
            $id = DB::getPdo()->lastInsertId();
            Pencatatan::create([
                'id' => null,
                'income_id' =>$id,
                'payment_id' => 0,
                'debit' => $req['nominal'],
                'description' => $desc,
                'kredit' => 0,
            ]);
          return redirect()
              ->route('income.index')
              ->with('success', 'Data pengeluaran berhasil disimpan!');

        }catch(Exception $e){
          return redirect()
              ->route('income.create')
              ->with('success', 'Data pengeluaran gagal disimpan!');
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
            $data = Income::findOrFail($id);
            if ($request->file('foto')!='') {
                $file = $request->file('foto');
                $nama_file = time()."_".$file->getClientOriginalName();
                $tujuan_upload = 'nota';
                $file->move($tujuan_upload,$nama_file);
                $data->foto = $nama_file;
                
              }
            $data->title = $req['title'];
            $data->description = $req['description'];
            $data->sumber = $req['sumber'];
            $data->nominal = $req['nominal'];
            $data->sumber = $req['sumber'];
            
            $data->save();

            $jur = DB::table('Pencatatans')
            ->where('Income_id', $id)
            ->update(['kredit' => $req['nominal'] ]);

          return redirect()
              ->route('income.index')
              ->with('success', 'Data pengeluaran berhasil diubah!');

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
          return redirect()
              ->route('income.index')
              ->with('error', 'Data pengeluaran gagal diubah!');
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
            Income::findOrFail($id)->delete();
            DB::table('Pencatatans')
            ->where('Income_id', $id)
            ->delete();
            return redirect()
                ->route('income.index')
                ->with('success', 'Data pengeluaran berhasil dihapus!');
  
          } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return redirect()
                ->route('income.index')
                ->with('error', 'Data pengeluaran gagal diubah!');
          }
    }
}
