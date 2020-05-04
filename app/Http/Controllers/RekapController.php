<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Pencatatan;
use App\Student;
use App\PaymentPeriodeDetail;
use App\FinancingCategory;
use App\PaymentPeriode;
use App\Payment;

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
        $user= Auth::user()->name;
        $siswa = Student::where('id','1')->first();
        $datas = PaymentPeriodeDetail::where('payment_id','1')->first();

        echo '<pre>';
        foreach ($datas as $data) {
            # code...
        }
        var_dump($data);die;

        $data['tanggal'] = $this->getTanggalHariIni();
        $data['waktu'] = $this->getWaktuHariIni();
        
        $bulan=$this->convertToBulan($data['periode']->bulan);
        
        $d = "Pembayaran {$data['periode']->financingCategory->nama} untuk periode bulan {$bulan} tahun {$data['periode']->tahun} dari {$data['payment']->student[0]->nama} kelas {$data['payment']->student[0]->kelas} - {$data['payment']->student[0]->major->nama}";
        $data['desc'] = $d;

        // $pdf = PDF::loadView('export.coba',compact('no','title','datas'));
        $pdf = PDF::loadView('export.kwitansi',compact('user','siswa','data','no'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
        // return view('export.index');
    }


    // public function getTerbilang($nominal)
    // {
    //     echo strlen($nominal);
    // }

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

        $user= Auth::user()->nama;

        if($id=="pemasukan"){ 
            $rincian = "Pemasukan";
            
            $datas = Pencatatan::where('debit','<>','0')->get();
            $title = "Laporan Pemasukan";
            $pdf = PDF::loadView('export.pemasukan',compact('tanggal','user','rincian','datas','no','title'));
            return $pdf->stream();
        }elseif($id=="pengeluaran"){
            $rincian = "Pengeluaran";
            $title = "Laporan Pengeluaran";
            $datas = Pencatatan::where('kredit','<>','0')->get();
            
            $pdf = PDF::loadView('export.pengeluaran',compact('tanggal','user','rincian','datas','no','title'));
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

    public function rekapBulanan($kategori, $id, $filter = null)
    {
        $no = 1;
        if(!$filter){
        $datas=DB::table('students')
            ->selectRaw('students.*,getNominalTerbayarBulanan(payments.id) AS terbayar, getCountBulananTidakTerbayar(payments.id) AS bulan_tidak_bayar, getCountNunggak(payments.id) as cekNunggak, getCountWaiting(payments.id) AS cekWaiting, majors.nama AS jurusan, getAkumulasiPerBulan(payments.id) AS akumulasi, financing_categories.`nama` AS financing_nama, financing_categories.id AS financing_id, payments.`id` AS payment_id, payments.`jenis_pembayaran`')
            ->leftJoin('majors','majors.id','=','students.major_id')
            ->leftJoin('payments','payments.student_id','=','students.id')
            ->leftJoin('financing_categories','financing_categories.id','=','payments.financing_category_id')
            ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
            ->where('financing_categories.id',$id)->get();
        }else{
        $datas=DB::table('students')
            ->selectRaw('students.*,getNominalTerbayarBulanan(payments.id) AS terbayar, getCountBulananTidakTerbayar(payments.id) AS bulan_tidak_bayar, getCountNunggak(payments.id) as cekNunggak, getCountWaiting(payments.id) AS cekWaiting, majors.nama AS jurusan, getAkumulasiPerBulan(payments.id) AS akumulasi, financing_categories.`nama` AS financing_nama, financing_categories.id AS financing_id, payments.`id` AS payment_id, payments.`jenis_pembayaran`')
            ->leftJoin('majors','majors.id','=','students.major_id')
            ->leftJoin('payments','payments.student_id','=','students.id')
            ->leftJoin('financing_categories','financing_categories.id','=','payments.financing_category_id')
            ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
            ->where([
                ['financing_categories.id','=',$id],
                ['majors.id','=',$filter],
            ])->get();
        }
        $title="Rekapitulasi Pembiayaan {$kategori}";
        $pdf = PDF::loadView('export.rekap_bulanan',compact('no','title','datas'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function kwitansiBulananSatuan($siswa, $detail)
    {
        $no = 1;
        $user= Auth::user()->name;
        $siswa = Student::where('id',$siswa)->first();
        $data = PaymentPeriodeDetail::where('id',$detail)->first();
        
        $d = "Pembayaran {$data['periode']->financingCategory->nama} untuk periode bulan {$bulan} tahun {$data['periode']->tahun}";
        
        $data['tanggal'] = $this->getTanggalHariIni();
        $data['waktu'] = $this->getWaktuHariIni();
        $data['desc'] = $d;

        $bulan=$this->convertToBulan($data['periode']->bulan);
        
        
        $pdf = PDF::loadView('export.kwitansi_bulanan_satuan',compact('user','siswa','data','no'));
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

    public function getTanggalHariIni()
    {
        $t = now();
        $t = explode(" ",$t);
        $t = explode("-", $t[0]);
        $d = intval($t[2]);
        return $d." ".$this->convertToBulan($t[1])." ".$t[0];
    }

    public function getWaktuHariIni()
    {
        $t = now();
        $t = explode(" ",$t);
        return $t[1];
    }

    public function convertSqlDateToIdDate($sql)
    {
        $t = explode(" ",$sql);
        $t = explode("-", $t[0]);
        $d = intval($t[2]);
        return $d." ".$this->convertToBulan($t[1])." ".$t[0];
    }

    public function convertSqlDateToHour($sql)
    {
        $t = explode(" ",$sql);
        return $t[1];
    }

    public function convertToBulan($id=1)
    {
        $id=intval($id);
        $bulan = ['',"Januari", "Februari", "Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return $bulan[$id];
    }
}
