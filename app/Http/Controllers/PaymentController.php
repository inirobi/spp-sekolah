<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;
use App\FinancingCategory;
use App\Payment;
use App\Student;
use App\PaymentPeriodeDetail;
use App\PaymentPeriode;
use App\PaymentDetail;
use App\PaymentView;
use App\Major;
use App\Pencatatan;
use DB;

class PaymentController extends Controller
{
    public function __construct(Request $request, Redirector $redirect)
    {
        
        // if(!Session::get('login')){
        //     $redirect->to('login')->with('danger','Kamu tidak punya akses')->send();
        // }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $datas = FinancingCategory::all();
        $no = 1;
        return view('pembayaran.index', compact('datas', 'no'));
    }

    public function indexKategori($id)
    {
        $students = Student::all();
        $no=1;
        $jml = Major::count();
        $majors = Major::all();
        return view('pembayaran.siswa', compact('students','no','jml','majors'));

        $siswa = $id;
        $datas = FinancingCategory::all();
        $no = 1;
        return view('pembayaran.index', compact('datas', 'no','siswa'));
    }

    public function indexKategori2($siswa)
    {
        $category = Student::all();
        echo '<pre>';
        var_dump($category[0]->major);die;
        $siswa = Student::where('id', $siswa)->get();
        $siswa = $siswa[0];
        DB::statement(DB::raw('set @row:=0'));
        $periodes = PaymentPeriode::select(DB::raw('@row:=@row+1 as rowNumber'),'payment_periodes.*')
                                    ->where('financing_category_id','2')
                                    ->get();
        
        return view('pembayaran.kategori',compact('periodes','category','siswa'));
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
            'besaran' => 'required',
        ]);

        try {
            $req = $request->all();
            FinancingCategory::create([
                'id' => null,
                'nama' => $req['nama'],
                'besaran' => $req['besaran'],
            ]);
            $id = DB::getPdo()->lastInsertId();
            //untuk history perubahan harga
            FinancingCategoryReset::create([
                'id' => null,
                'financing_category_id' => $id,
                'besaran' => $req['besaran'],
            ]);

        return redirect()
            ->route('financing.index')
            ->with('success', 'Data jurursan berhasil disimpan!');

        }catch(Exception $e){
        return redirect()
            ->route('financing.create')
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
        //numbering
        $no = 1;
        //data siswa
        //cek jenis kategori
        $cek = FinancingCategory::findOrFail($id);    
        if($cek->jenis=="Bayar per Bulan")
        {
            $datas=Student::selectRaw('students.*, payments.id AS payment_id,payments.jenis_pembayaran, getNominalPembayaranBulanan(payments.financing_category_id) AS akumulasi,getNominalTerbayarBulanan(payments.id) AS terbayar, getBulanTidakTerbayar(payments.id) AS bulan_tidak_terbayar, getCountWaiting(payments.id) as cekWaiting, getCountDetailBulanan(payments.id) as cekCountDetail, payment_periode_details.status')
            ->leftJoin('payments','payments.student_id','=','students.id')
            ->leftJoin('payment_periode_details','payment_periode_details.payment_id','=','payments.id')
            ->where('payments.financing_category_id',$id)
            ->groupBy('students.id')
            ->get();
            $financing = $cek;
            
            $periode = PaymentPeriode::where('financing_category_id',$id)->count(); 
            
            $payments = Payment::where('financing_category_id', $id)->get();
            
            return view('pembayaran.show', compact('datas','financing','periode','no'));
        }else{
            $datas=Student::selectRaw('students.*, payments.id AS payment_id,payments.jenis_pembayaran, `getBesaranBiayaKategoriPembiayaan`(payments.financing_category_id) AS akumulasi,getNominalTerbayarBulanan(payments.id) AS terbayar, getBulanTidakTerbayar(payments.id) AS bulan_tidak_terbayar, getCountWaiting(payments.id) as cekWaiting, getCountDetailBulanan(payments.id) as cekCountDetail, payment_periode_details.status')
            ->leftJoin('payments','payments.student_id','=','students.id')
            ->leftJoin('payment_periode_details','payment_periode_details.payment_id','=','payments.id')
            ->where('payments.financing_category_id',$id)
            ->groupBy('students.id')
            ->get();
            $financing = $cek;
            // echo '<pre>';
            // var_dump($datas);die;
            
            $periode = PaymentPeriode::where('financing_category_id',$id)->count(); 
            
            $payments = Payment::where('financing_category_id', $id)->get();
            
            return view('pembayaran.show_sekali_bayar', compact('datas','financing','periode','no'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
            'besaran' => 'required',
        ]);

        try {
          $req = $request->all();
          $data = FinancingCategory::findOrFail($id);
          $data->nama = $req['nama'];
          $data->besaran = $req['besaran'];
          $data->save();
          FinancingCategoryReset::create([
            'id' => null,
            'financing_category_id' => $id,
            'besaran' => $req['besaran'],
            ]);

          return redirect()
              ->route('financing.index')
              ->with('success', 'Data telah diubah!');

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
          return redirect()
              ->route('financing.index')
              ->with('error', 'Data gagal diubah!');
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
            $cek = FinancingCategory::findOrFail($id);
            FinancingCategory::destroy($id);
            FinancingCategoryReset::where('financing_category_id', $id)->delete();
            $payments = Payment::where('financing_category_id', $id)->get();
            if($cek->jenis=="Bayar per Bulan"){
                PaymentPeriode::where('financing_category_id', $id)->delete();
                for ($i=0; $i < $payments->count(); $i++) { 
                    PaymentPeriodeDetail::where('payment_id', $payments[$i]->id)->delete();
                }
            }else{
                for ($i=0; $i < $payments->count(); $i++) { 
                    PaymentDetail::where('payment_id', $payments[$i]->id)->delete();
                }
            }
            Payment::where('financing_category_id', $id)->delete();
            return redirect()
            ->route('financing.index')
            ->with('success', 'Berhasil dihapus!');

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return redirect()
                ->route('financing.index')
                ->with('error', 'Gagal dihapus!');
      }
        
    } 

    public function history($id)
    {
        DB::statement(DB::raw('set @row:=0'));
        return FinancingCategoryReset::select(DB::raw('@row:=@row+1 as rowNumber, format(besaran,0) as besaran'),'created_at')
                                    ->where('financing_category_id',$id)
                                    ->get();;
    }
    
    /**
     * @description Mencari nilai besaran pada kategori pembiayaan tertentu
     * 
     * @param id FinancingCategory kategori pembiayaan sebagai kata kunci
     * @return {int} mengembalikan nilai besaran
     */
    public function getBesaranBiayaKategoriPembiayaan($id)
    {
        $data = FinancingCategory::select('besaran')
                                ->where('id',$id)
                                ->get();
        return $data[0]->besaran;
    }

    /**
     * @description Mencari nilai besaran biaya telah terbayar
     * 
     * @param id Student
     * @param id Category dari FinancingCategory
     * @return {int} nominal biaya telah dibayar
     */
    public function getBesaranBiayaTerbayar($id_student, $id_category)
    {
        $data = PaymentDetail::selectRaw('sum(nominal) as nominal')
                            ->join('payments','payment_details.payment_id','=','payments.id')
                            ->join('students','payments.student_id','=','students.id')
                            ->where([
                                ['students.id','=',$id_student],
                                ['payments.financing_category_id','=',$id_category]
                            ])
                            ->get();
        return intval($data[0]->nominal);
    }

    public function storeMetodePembayaran(Request $request)
    {
        $req = $request->all();
        $req['date'] = date('Y-m-d', time());
        $req['user_id'] = Session::get('id');
        $req['siswa'] = Student::where('id',$req['student_id'])->first();
        $req['description'] = "Pembayaran ".$req['financing_category']." dari ".$req['student_name']." kelas ".$req['siswa']->kelas." ( ".$req['siswa']->major->nama." )"." diterima oleh ".$req['penerima'];
        if($req['metode_pembayaran']=='Tunai')
        {
            $payment = Payment::findOrFail($req['payment_id']);
            $payment->jenis_pembayaran="Tunai";
            $payment->save();
            PaymentDetail::create([
                'id' => null,
                'payment_id' => $payment->id,
                'tgl_dibayar' => $req['date'],
                'nominal' => $req['nominal'],
                'user_id' => $req['user_id'],
                'status' => 'Lunas',
                ]);
            return redirect()
            ->route('payment.show', $req['financing_category_id'])
            ->with('success', 'Lunas!');
        }else
        {
            $cek = Payment::where('id',$req['payment_id'])->first();
            // echo '<pre>';
            // var_dump($cek->jenis_pembayaran);die;
            if($cek->jenis_pembayaran=="Waiting"){
                $cek->jenis_pembayaran="Cicilan";
                $cek->save();
                return redirect()
                    ->route('payment.details.cicilan', [$req['financing_category_id'], $req['student_id'], $cek->id])
                    ->with('success', 'Metode Pembayaran disimpan!');
            }
            return redirect()
                ->route('payment.show', $req['financing_category_id'])
                ->with('error', 'Metode Pembayaran telah di isi');
        }
    }

    /**
     * @description me
     */
    public function details($id, $id_siswa, $id_payment)
    {
        //numbering
        $no = 1;
        //data siswa
        $datas=Student::selectRaw('students.*, payments.jenis_pembayaran,`getBesaranBiayaTerbayar`(students.id, '.$id.') AS terbayar')
                ->leftJoin('payments','payments.student_id','=','students.id')
                ->leftJoin('financing_categories', 'financing_categories.id', '=', 'payments.financing_category_id')
                ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
                ->groupBy('students.id')
                ->where('students.id', $id_siswa)
                ->get();
        //data master show data untuk header
        $financing = FinancingCategory::findOrFail($id)
                    ->selectRaw('*, getBesaranBiayaKategoriPembiayaan(financing_categories.id) as besaran')
                    ->where('id',$id)
                    ->get();
        $financing = $financing[0];
        //data Pembiayaan
        $payments = Payment::where('id',$id_payment)->first();
        $payment_details = PaymentDetail::where('payment_id',$id_payment)->get();
        //Untuk penghitung banyak periode pembayaran
        $periode = PaymentPeriode::where('financing_category_id',$id)->count(); 
        
        if ($periode==0 && $financing->nama=="Bayar per Bulan") {
            return redirect()
                ->route('payment.index')
                ->with('error', 'Periode pembiayaan kosong. Untuk Pembiayaan dengan jenis per Bulan, periode harus dicantumkan!');
        }

        $date = $this->getTanggalHariIni();
        
        return view('pembayaran.cicilan', compact('datas','financing','payments', 'payment_details','periode','no','date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cicilanStore(Request $request)
    {

        $request = $request->all();
        
        $total = FinancingCategory::select('besaran')->where('id', $request['financing_category_id'])->first();
        $sudah_dibayar = PaymentDetail::selectRaw('sum(nominal) as nominal')->where('payment_id',$request['payment_id'])->first();
        $total =$total->besaran;
        $sudah_dibayar = intval($sudah_dibayar->nominal);
        $selisih = $total - ($sudah_dibayar + intval($request['nominal']));
        $sisa = intval($request['nominal'])+intval($selisih);
        $nominal = $request['nominal'];
        $status = 'Nunggak';
        if($selisih<0){
            $nominal = $sisa;
            $status = 'Lunas';
        }elseif($selisih==0){
            $status='Lunas';
        }
        $date = $this->convertToCorrectDateValue($request['calendar']);
        PaymentDetail::create([
            'id' => null,
            'payment_id' => $request['payment_id'],
            'tgl_dibayar' => $date,
            'nominal' => $nominal,
            'user_id' => Session::get('id'),
            'status' => $status,
        ]);
        return redirect()
                ->route('payment.details.cicilan', [$request['financing_category_id'], $request['student_id'], $request['payment_id']])
                ->with('success', 'Pembayaran disimpan!');
    }


    

    // ================================== Method Pembayaran Per Bulan ===================================== //
    /**
     * menampilkan data siswa dalam kategori pembayaran bulanan
     * 
     * @param int id kategori pembayaran
     * 
     */
    public function showBulanan($id)
    {
        //numbering
        $no = 1;
        //data siswa
        $datas=Student::selectRaw('students.*, payments.jenis_pembayaran,`getBesaranBiayaTerbayar`(students.id, '.$id.') AS terbayar')
                ->leftJoin('payments','payments.student_id','=','students.id')
                ->leftJoin('financing_categories', 'financing_categories.id', '=', 'payments.financing_category_id')
                ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
                ->groupBy('students.id')
                ->get();

        //data master show data untuk header
        $financing = FinancingCategory::findOrFail($id)
                    ->selectRaw('*, getBesaranBiayaKategoriPembiayaan(financing_categories.id) as besaran')
                    ->where('id',$id)
                    ->get();
        $financing = $financing[0];
        //Untuk penghitung banyak periode pembayaran
        $periode = PaymentPeriode::where('financing_category_id',$id)->count(); 
        // $students = Student::all();
        if ($periode==0 && $financing->nama=="Bayar per Bulan") {
            return redirect()
                ->route('payment.index')
                ->with('error', 'Periode pembiayaan kosong. Untuk Pembiayaan dengan jenis per Bulan, periode harus dicantumkan!');
        }
        // echo "<pre>";
        // var_dump($datas);
        return view('pembayaran.perbulan', compact('datas','financing','periode','no'));
    }

    public function showBulananDetail($id, $id_student, $category)
    {
        //numbering
        $no = 1;
        //data siswa
        $bigDatas = PaymentPeriodeDetail::selectRaw('payment_periode_details.id, payments.financing_category_id, payment_periode_details.status, students.id as siswa_id, students.nis, students.nama, students.kelas, payment_periodes.bulan,payment_periodes.tahun, payment_periode_details.updated_at, payment_periodes.nominal')
                    ->join('payments','payments.id','=','payment_periode_details.payment_id')
                    ->join('students','students.id','=','payments.student_id')
                    ->join('payment_periodes','payment_periodes.id','=','payment_periode_details.payment_periode_id')
                    ->where('payment_id',$id)->get();
        //
        $datas=Student::selectRaw('students.*, payments.jenis_pembayaran,`getBesaranBiayaTerbayar`(students.id, '.$category.') AS terbayar')
                ->leftJoin('payments','payments.student_id','=','students.id')
                ->leftJoin('financing_categories', 'financing_categories.id', '=', 'payments.financing_category_id')
                ->leftJoin('payment_details','payment_details.payment_id','=','payments.id')
                ->groupBy('students.id')
                ->where('students.id', $id_student)
                ->get();
        //data master show data untuk header
        $financing = FinancingCategory::selectRaw('*, getBesaranBiayaKategoriPembiayaan(financing_categories.id) as besaran')
                    ->where('id',$category)
                    ->get();
        $financing = $financing[0];
        //data Pembiayaan
        $payments = Payment::where('id',$id)->first();
        $payment_details = PaymentDetail::where('payment_id',$id)->get();
        //Untuk penghitung banyak periode pembayaran
        $periode = PaymentPeriode::where('financing_category_id',$category)->count(); 
        
        if ($periode==0 && $financing->nama=="Bayar per Bulan") {
            return redirect()
                ->route('payment.index')
                ->with('error', 'Periode pembiayaan kosong. Untuk Pembiayaan dengan jenis per Bulan, periode harus dicantumkan!');
        }

        $date = $this->getTanggalHariIni();
        
        return view('pembayaran.perbulan_detail', compact('datas','financing','payments', 'payment_details','periode','no','date', 'bigDatas'));
    }

    public function bulananStore(Request $request)
    {
        $this->validate($request,[
            'status' => 'required',
            'payment_id' => 'required',
        ]);
        $req = $request->all();
        try {
            $siswa = Student::findOrFail($req['siswa']);
            $bulan = $this->convertToBulan($req['bulan']);
            $desc = "Penerimaan pembayaran {$req['pembayaran']} untuk bulan {$bulan} {$req['tahun']} dari {$siswa->nama} kelas {$siswa->kelas} {$siswa->major->nama} diterima oleh {$req['penerima']}";
            //Update data Pembayaran
            $pembayaran = PaymentPeriodeDetail::findOrFail($req['payment_id']);
            $pembayaran->status = $req['status'];
            $pembayaran->save();
            if($req['status']=="Lunas"){
                //Pencatatan Pemasukan
                Pencatatan::create([
                    'id' => null,
                    'nominal' => $req['nominal'],
                    'description' => $desc,
                    ]);
            }
            return redirect()
                ->route('payment.monthly.show.detail',[$pembayaran->payment_id,$req['siswa']])
                ->with('success', 'Status disimpan!');
        }catch(Exception $e){
        return redirect()
            ->route('payment.monthly.show.detail',[$pembayaran->payment_id,$req['siswa']])
            ->with('error', 'Pembayaran gagal!');
        }
    }

    public function convertToBulan($id=1)
    {
        $bulan = ['',"Januari", "Februari", "Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return $bulan[$id];
    }
    /**
     * 
     * @return string tanggal dalam format dd/mm/yyyy
     */
    public function getTanggalHariIni()
    {
        $date = now();
        $date = explode(" ", $date);
        $date = $date[0];
        $date = explode("-", $date);
        $date = $date[2]."/".$date[1]."/".$date[0];
        return $date;
    }
    /**
     * 
     * @param string invalid format
     * @return string tanggal dalam format dd/mm/yyyy
     */
    public function convertToCorrectDateValue($date)
    {
        $date = explode("/", $date);
        $date = $date[2]."/".$date[1]."/".$date[0];
        return $date;
    }
}
