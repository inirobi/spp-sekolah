<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

use App\FinancingCategory;
use App\Payment;
use App\PaymentPeriodeDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dashboard= DB::table('dashboard_view')->first();
        return view('dashboard.index',compact('dashboard'));
    }

    public function logout(){
        Session::flush();
        return redirect('login')
                    ->with('success', 'Terima kasih atas kerja keras anda!');
    }

    public function change(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required|max:16',
            'pass' => 'required',
            'confirm' => 'required'
        ]);

        try {
            $req = $request->all();
            if ($req['pass'] != $req['confirm'] ) {
                return redirect('/home')->with('error','Password tidak sama');
            }
            if ($request->file('photo')!='') {
                $file = $request->file('photo');
                $nama_file = time()."_".$file->getClientOriginalName();
                $tujuan_upload = 'foto-admin';
                $file->move($tujuan_upload,$nama_file);
                
                DB::table('tb_admin')
                ->update([
                    'nama' => $req['name'],
                    'username' => $req['username'],
                    'password' => $req['pass'],
                    'photo' => $nama_file
                ]);
            }else{
                DB::table('tb_admin')
                ->update([
                    'nama' => $req['name'],
                    'username' => $req['username'],
                    'password' => $req['pass']
                ]);
            }
                return redirect('/')->with('success','Username dan Password berhasi diubah');

        }catch(Exception $e){
          return redirect('/home')
              ->with('error', $e->toString());
        }
    }

    public function edit()
    {
        return view('user.index');
    }
    
    public function update(Request $request)
    {
        $req=$request->all();
        // echo '<pre>';
        // var_dump(Auth::user()->id);die;
        try {
            $user = User::findOrFail( Auth::user()->id );
            if(Hash::check($req['old_password'], $user->password)){
                $user->password = bcrypt($req['password']);
                $user->save();
                return redirect()
                ->route('home')
                ->with('success', 'Password telah diubah');
            }
        }catch (ModelNotFoundException $e) {
            return redirect()
                ->route('password.edit')
                ->with('error', 'Password lama salah');
        }
        return redirect()
            ->route('password.edit')
            ->with('error', 'Password lama salah');
    }

}