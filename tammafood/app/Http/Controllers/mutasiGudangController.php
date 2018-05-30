<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class mutasiGudangController extends Controller
{
      public function mutasi()
    {      
      return view('/penjualan/mutasistok/mutasi');

    }
}
