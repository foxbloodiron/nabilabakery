<?php
  
namespace App\Http\Controllers\Produksi;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Auth;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;

class ManOutputProduksiController extends Controller
{
  public function OutputProduksi(){

    
    return view('produksi.o_produksi.index');//,compact('result'));
  }

  public function setCreateProduct($tgl1){
    $y = substr($tgl1, -4);
    $m = substr($tgl1, -7,-5);
    $d = substr($tgl1,0,2);
    $tgll = $y.'-'.$m.'-'.$d;

    $dataSpk= DB::table('d_spk')
      ->join('m_item', 'm_item.i_id', '=', 'd_spk.spk_item')
      ->where('spk_date','=',$tgll)
      ->get();

      return view('produksi.o_produksi.create',compact('dataSpk'));
  }

  public function detail(Request $request){
    $detalis = DB::table('d_productresult')
      ->join('d_productresult_dt', 'd_productresult.pr_id', '=', 'd_productresult_dt.prdt_productresult' )
      ->join('m_item', 'm_item.i_id', '=' , 'd_productresult.pr_item')
      ->where('pr_id','=', $request->x)
      ->get();

   return view('produksi.o_produksi.detail',compact('detalis'));
   }

  
  public function tabel(){
    $result = DB::table('d_productresult_dt')
      ->select('pr_date','spk_code','i_name','prdt_time','prdt_qty')
      ->join('d_productresult','prdt_productresult','=','pr_id')
      ->join('m_item','i_id','=','prdt_item')
      ->join('d_spk','pr_spk','=','spk_id')
      ->get();
    $dat = array();
    foreach ($result as $r) {
      $dat[] = (array) $r;
    }
    $i=0;
    $data = array();
    foreach ($dat as $key) {
        $data[$i]['pr_date'] = $key['pr_date'];
        $data[$i]['spk_code'] = $key['spk_code'];
        $data[$i]['i_name'] = $key['i_name'];
        $data[$i]['prdt_time'] = $key['prdt_time'];
        $data[$i]['prdt_qty'] = $key['prdt_qty'];
        $data[$i]['aksi'] = "aksi";
        $i++;
    }
    $datax = array('data' => $data);
    echo json_encode($datax);    

  }

  public function store(Request $request){
    $cek = DB::table('d_productresult')
      ->where('pr_spk',$request->spk_id)
      ->get();

    $maxid1 = DB::Table('d_productresult_dt')->select('prdt_detail')->max('prdt_detail');
    if ($maxid1 <= 0 || $maxid1 == '') {
      $maxid1  = 1;
    }else{
      $maxid1 += 1;
    }

    if (count($cek) == 0) {
      $maxid = DB::Table('d_productresult')->select('pr_id')->max('pr_id');
      if ($maxid <= 0 || $maxid == '') {
        $maxid  = 1;
      }else{
        $maxid += 1;
      }
//       $date = Carbon::createFromFormat('Y-m-d', '2016-01-23');

// // From a time string
// $time = Carbon::createFromFormat('H:i:s', '11:53:20');
     

      $pr = DB::Table('d_productresult')
        ->insert([
          'pr_id' => $maxid,
          'pr_spk' => $request->spk_id,
          'pr_date' => Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d'),
          'pr_item' => $request->spk_item
        ]);
      $prdt = DB::Table('d_productresult_dt')  
        ->insert([
          'prdt_productresult' => $maxid,
          'prdt_detail' => $maxid1,
          'prdt_item' => $request->spk_item,
          'prdt_qty' => $request->spk_qty,
          'prdt_date' => Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d'),
          'prdt_time' => $request->time,
        ]);
    }else{
      $pr = DB::Table('d_productresult')
        ->where('pr_spk',$request->spk_id)
        ->get();
      $prdt = DB::Table('d_productresult_dt')
        ->insert([
          'prdt_productresult' => $pr[0]->pr_id,
          'prdt_detail' => $maxid1,
          'prdt_item' => $request->spk_item,
          'prdt_qty' => $request->spk_qty,
          'prdt_date' => Carbon::createFromFormat('d-m-Y', $request->tgl)->format('Y-m-d'),
          'prdt_time' => $request->time,
        ]);
    }

  }

  
}