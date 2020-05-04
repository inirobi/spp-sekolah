<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Pencatatan;
use PDF;
use DB;
class RekapController extends Controller
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
        $no = 1;
        $kategori = "SPP";
        $datas=DB::table('students')
                        ->selectRaw('students.*,getNominalTerbayarBulanan(payments.id) AS terbayar, getCountBulananTidakTerbayar(payments.id) AS bulan_tidak_bayar, getCountNunggak(payments.id) as cekNunggak, getCountWaiting(payments.id) AS cekWaiting, majors.nama AS jurusan, getAkumulasiPerBulan(payments.id) AS akumulasi, financing_categories.`nama` AS financing_nama, financing_categories.id AS financing_id, payments.`id` AS payment_id, payments.`jenis_pembayaran`')
                        ->leftJoin('majors','majors.id','=','students.major_id')
                        ->leftJoin('payments','payments.student_id','=','students.id')
                        ->leftJoin('financing_categories','financing_categories.id','=','payments.financing_category_id')
                        ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
                        ->where('financing_categories.id','1')->get();
        $title="Rekapitulasi Pembiayaan {$kategori}";
        $pdf = PDF::loadView('export.coba',compact('no','title','datas'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
        // return view('export.index');
    }

    public function FunctionName(Type $var = null)
    {
        # code...
    }

    public function print($id) 
    {
        $t = now();

        $t = explode(" ", $t);
        $t = explode("-", $t[0]);
        $tanggal = "{$t[2]} {$t[1]} {$t[0]}";
        $no=1;

        $user= Session::get('nama');

        if($id=="pemasukan"){ 
            $rincian = "Pemasukan";
            
            $datas = Pencatatan::where('debit','<>','0')->get();
            
            $pdf = PDF::loadView('export.pemasukan',compact('tanggal','user','rincian','datas','no'));
            return $pdf->stream();
        }elseif($id=="pengeluaran"){
            $rincian = "Pengeluaran";
            
            $datas = Pencatatan::where('kredit','<>','0')->get();
            
            $pdf = PDF::loadView('export.pengeluaran',compact('tanggal','user','rincian','datas','no'));
            return $pdf->stream();
        }
    }

    public function kwitansi()
    {
        $pdf = PDF::loadView('export.siswa');
        return $pdf->stream();
    }

    public function listdata()
    {
        $pdf = PDF::loadView('export.kwitansi');
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function rekapBulanan($kategori, $id)
    {
        $no = 1;
        $datas=DB::table('students')
                        ->selectRaw('students.*,getNominalTerbayarBulanan(payments.id) AS terbayar, getCountBulananTidakTerbayar(payments.id) AS bulan_tidak_bayar, getCountNunggak(payments.id) as cekNunggak, getCountWaiting(payments.id) AS cekWaiting, majors.nama AS jurusan, getAkumulasiPerBulan(payments.id) AS akumulasi, financing_categories.`nama` AS financing_nama, financing_categories.id AS financing_id, payments.`id` AS payment_id, payments.`jenis_pembayaran`')
                        ->leftJoin('majors','majors.id','=','students.major_id')
                        ->leftJoin('payments','payments.student_id','=','students.id')
                        ->leftJoin('financing_categories','financing_categories.id','=','payments.financing_category_id')
                        ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
                        ->where('financing_categories.id',$id)->get();
        $title="Rekapitulasi Pembiayaan {$kategori}";
        $pdf = PDF::loadView('export.coba',compact('no','title','datas'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
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
