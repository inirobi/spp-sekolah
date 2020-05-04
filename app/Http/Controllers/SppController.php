<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\FinancingCategory;
use App\PaymentPeriode;
use App\Payment;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //numbering
        $no = 1;
        $id= 1;
        //data siswa
        //cek jenis kategori
        $cek = FinancingCategory::findOrFail($id);    
        if($cek->jenis=="Bayar per Bulan")
        {
            $datas=DB::table('students')
                        ->selectRaw('students.*,getNominalTerbayarBulanan(payments.id) AS terbayar, getCountBulananTidakTerbayar(payments.id) AS bulan_tidak_bayar, getCountNunggak(payments.id) as cekNunggak, getCountWaiting(payments.id) AS cekWaiting, majors.nama AS jurusan, getAkumulasiPerBulan(payments.id) AS akumulasi, financing_categories.`nama` AS financing_nama, financing_categories.id AS financing_id, payments.`id` AS payment_id, payments.`jenis_pembayaran`')
                        ->leftJoin('majors','majors.id','=','students.major_id')
                        ->leftJoin('payments','payments.student_id','=','students.id')
                        ->leftJoin('financing_categories','financing_categories.id','=','payments.financing_category_id')
                        ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
                        ->where('financing_categories.id',$cek->id)->get();

            $financing = $cek;
            
            $periode = PaymentPeriode::where('financing_category_id',$id)->count(); 
            
            $payments = Payment::where('financing_category_id', $id)->get();
            
            return view('pembayaran.show', compact('datas','financing','periode','no'));
        }else{
            $datas=DB::table('students')
                        ->selectRaw('students.*, majors.nama as jurusan, financing_categories.`besaran` AS akumulasi, financing_categories.`nama` AS financing_nama, paid_once(payments.id) AS terbayar, financing_categories.id AS financing_id, payments.`id` AS payment_id, payments.`jenis_pembayaran`')
                        ->leftJoin('majors','majors.id','=','students.major_id')
                        ->leftJoin('payments','payments.student_id','=','students.id')
                        ->leftJoin('financing_categories','financing_categories.id','=','payments.financing_category_id')
                        ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
                        ->groupBy('students.id')
                        ->where('financing_categories.id',$cek->id)->get();
            $financing = $cek;
            
            $periode = PaymentPeriode::where('financing_category_id',$id)->count(); 
            
            $payments = Payment::where('financing_category_id', $id)->get();
            
            return view('pembayaran.spp.index', compact('datas','financing','periode','no'));
        }
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
