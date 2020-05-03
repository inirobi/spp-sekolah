<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FinancingCategory;
use App\FinancingCategoryReset;
use App\Payment;
use App\PaymentDetail;
use App\PaymentPeriode;
use App\PaymentPeriodeDetail;
use App\Student;
use Illuminate\Support\Facades\Session;

use DB;

class FinancingCategoryController extends Controller
{
    public function __construct()
    {
        if(!Session::get('login'))
        {
            return view('auth.login');
        }
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
        return view('master.financingcategory.index', compact('datas', 'no'));
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
            'jenis' => 'required'
        ]);

        try {
            $req = $request->all();
            $create = FinancingCategory::create([
                'id' => null,
                'nama' => $req['nama'],
                'besaran' => $req['besaran'],
                'jenis' => $req['jenis'],
            ]);
            $id = DB::getPdo()->lastInsertId();
            $students = Student::all();
            for ($i=0; $i < $students->count(); $i++) { 
                Payment::create([
                    'financing_category_id' => $id,
                    'student_id' => $students[$i]->id,
                    'jenis_pembayaran' => "Waiting",
                    ]);
            }
            //untuk history perubahan harga
            FinancingCategoryReset::create([
                'id' => null,
                'financing_category_id' => $id,
                'besaran' => $req['besaran'],
                'jenis' => $req['jenis'],
                ]);
            $date = $this->convertToDateArrayFromDateTime($create->created_at);
            if($req['jenis']=="Bayar per Bulan"){
                $periode = PaymentPeriode::create([
                    "financing_category_id" => $id,
                    "bulan" => $date[1], 
                    "tahun" => $date[0], 
                    "nominal" => $create->besaran,
                ]);
                $payments = Payment::where('financing_category_id', $id)->get();
                $status = "Waiting";
                for ($i=0; $i < $payments->count() ; $i++) { 
                    PaymentPeriodeDetail::create([
                        'payment_periode_id' => $periode->id,
                        'payment_id' => $payments[$i]->id,
                        'user_id' => 0,
                        'status' => $status,
                    ]);
                }
            }
            return redirect()
                ->route('financing.index')
                ->with('success', 'Data jurusan berhasil disimpan!');

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
            'jenis' => 'required'
        ]);

        try {
          $req = $request->all();
          $data = FinancingCategory::findOrFail($id);
          $data->nama = $req['nama'];
          $data->besaran = $req['besaran'];
          $data->jenis = $req['jenis'];
          $data->save();
          FinancingCategoryReset::create([
            'id' => null,
            'financing_category_id' => $id,
            'besaran' => $req['besaran'],
            'jenis' => $req['jenis'],
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
        $cek = FinancingCategory::where('id', $id)->first();
        try {
            FinancingCategoryReset::where('financing_category_id', $id)->delete();
            PaymentPeriode::where('financing_category_id', $id)->delete();
            FinancingCategory::destroy($id);
            $p = Payment::where('financing_category_id', $id)->get();
            Payment::where('financing_category_id', $id)->delete();
            if($cek['jenis']=="Bayar per Bulan"){
                // Hapus PaymentPeriodeDetail aka Bayaran bayar per bulan
                for ($i=0; $i < $p->count(); $i++) { 
                    PaymentPeriodeDetail::where('payment_id',$p[$i]->id)->delete();
                }
            }else{
                //Hapus PaymentDetail aka Bayaran sekali bayar yang dicicil
                for ($i=0; $i < $p->count(); $i++) { 
                    PaymentDetail::where('payment_id',$p[$i]->id)->delete();
                }
            }
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
        return FinancingCategoryReset::select(DB::raw('@row:=@row+1 as rowNumber, format(besaran,0) as besaran'), 'jenis','created_at')
                                    ->where('financing_category_id',$id)
                                    ->get();;
    }

    public function periode_ajax($id = null)
    {
        return PaymentPeriode::all();
    }
    
    public function periode($id)
    {
        $prev = Session::all();
        $prev = $prev['_previous']['url'];

        $category = FinancingCategory::where('id',$id)->get();
        
        DB::statement(DB::raw('set @row:=0'));
        $periodes = PaymentPeriode::select(DB::raw('@row:=@row+1 as rowNumber'),'payment_periodes.*')
                                    ->where('financing_category_id',$id)
                                    ->get();
        return view('master.financingcategory.periode',compact('periodes','category','prev'));
    }

    /**
     * store
     */
    public function periode_store(Request $req)
    {
        $bulan = ["Desember","Januari", "Februari", "Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November"];
        $d =$req->all();
        try {
            $temp = $this->convertToArrayDateValue($d['calendar']);
            $fixBulan = $bulan[(intval($temp[0])%12)];
            $cek = PaymentPeriode::where([
                ['bulan','=', $temp[0]],
                ['tahun','=',$temp[2]],
                ['financing_category_id','=',$d['id']],
            ])->get()->count();
            if($cek==0){
                PaymentPeriode::create([
                    'id' => null,
                    'financing_category_id' => $d['id'], 
                    'bulan' => $temp[0],
                    'tahun' => $temp[2],
                    'nominal' => $d['nominal'],
                ]);
                $id = DB::getPdo()->lastInsertId();
                $payment = Payment::where('financing_category_id',$d['id'])->get();
                $status = "Waiting";
                for ($i=0; $i < $payment->count(); $i++) { 
                    PaymentPeriodeDetail::create([
                        'payment_periode_id' => $id,
                        'payment_id' => $payment[$i]->id,
                        'user_id' => 0,
                        'status' => $status,
                    ]);
                }
                return redirect()
                        ->route('financing.periode',$d['id'])
                        ->with('success','Berhasil ditambahkan!');
            }
            return redirect()
                    ->route('financing.periode',$d['id'])
                    ->with('error','Periode pembayaran sudah ada!');
        } catch (Throwable $th) {
            return redirect()
                    ->route('financing.periode',$d['id'])
                    ->with('error','Gagal ditambahkan!');
        }
    }

    /**
     * update periode
     */
    public function periode_update(Request $req)
    {
        $bulan = ["Desember","Januari", "Februari", "Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November"];
        $d =$req->all();
        try {
            $temp = $this->convertToArrayDateValue($d['calendar']);
            $fixBulan = $bulan[(intval($temp[0])%12)];
            $cek = PaymentPeriode::findOrFail($d['id_data']);
            $cek->bulan = $fixBulan;
            $cek->tahun = $temp[2];
            $cek->nominal = $d['nominal'];
            $cek->save();
            $fin = FinancingCategory::findOrFail($d['id']);
            $fin->besaran=$d['nominal'];
            $fin->save;
            FinancingCategoryReset::create([
                'id'=>null,
                'financing_category_id' => $d['id'],
                'besaran' => $d['nominal'],
                'jenis' => $fin->jenis,
            ]);
            return redirect()
                    ->route('financing.periode',$d['id'])
                    ->with('success','Berhasil diubah!');
        } catch (Throwable $th) {
            return redirect()
                    ->route('financing.periode',$d['id'])
                    ->with('error','Gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function periode_destroy($id,$kategori)
    {
        try {
            PaymentPeriodeDetail::where('payment_periode_id',$id)->delete();
            PaymentPeriode::destroy($id);
            return redirect()
                    ->route('financing.periode',$kategori)
                    ->with('success','Periode Pembayaran telah dihapus!');
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return redirect()
                    ->route('financing.periode',$kategori)
                    ->with('success','Periode Pembayaran gagal dihapus!');
      }
        
    } 

    /**
     * 
     * @param string invalid format
     * @return string tanggal dalam format dd/mm/yyyy
     */
    public function convertToCorrectDateValue($date)
    {
        $date = explode("/", $date);
        $date = $date[2]."-".$date[1]."-".$date[0];
        return $date;
    }
    
    /**
     * 
     * @param string invalid format for mysql
     * @return array tanggal
     */
    public function convertToArrayDateValue($date)
    {
        return explode("/", $date);
    }

    /**
     * Date time to Date array
     * 
     * @param string datetime
     * @return array tanggal
     */
    public function convertToDateArrayFromDateTime($datetime)
    {
        $data = explode(" ", $datetime);
        return explode("-",$data[0]);
    }
    
}
