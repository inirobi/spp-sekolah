<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = ['title' => 'asdf'];

        $pdf = PDF::loadView('export.pengeluaran',$data);
        return $pdf->stream();
    }
}
