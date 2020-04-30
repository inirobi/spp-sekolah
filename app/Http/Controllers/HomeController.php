<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class HomeController extends Controller
{
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
}
