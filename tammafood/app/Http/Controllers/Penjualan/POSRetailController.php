<?php

namespace App\Http\Controllers\Penjualan;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;

// use App\mmember

class POSRetailController extends Controller
{
  public function retail(){	
	  $year = carbon::now()->format('y');
    $month = carbon::now()->format('m');
    $date = carbon::now()->format('d');
    //select max dari um_id dari table d_uangmuka
    $maxid = DB::Table('m_customer')->select('c_id')->max('c_id');
    $idfatkur = DB::Table('d_sales')->select('s_id')->max('s_id');
    $idreq = DB::table('d_transferitem')->select('ti_id')->max('ti_id');
    //untuk +1 nilai yang ada,, jika kosong maka maxid = 1 , 
    if ($maxid <= 0 || $maxid <= '') {
      $maxid  = 1;
    }else{
      $maxid += 1;
    }
    if ($idfatkur <= 0 || $idfatkur <= '') {
      $idfatkur  = 1;
    }else{
      $idfatkur += 1;
    }
    if ($idreq <= 0 || $idreq <= '') {
      $idreq  = 1;
    }else{
      $idreq += 1;
    }
    //jika kurang dari 100 maka maxid mimiliki 00 didepannya
    if ($maxid < 100) {
      $maxid = '00'.$maxid;
    }
      $id_cust = 'CUS' . $month . $year . '/' . 'C001' . '/' .  $maxid; 
      $fatkur = 'XX'  . $year . $month . $date . $idfatkur;
      $idreq = 'REQ'  . $year . $month . $date . $idreq;

      $stock  = DB::table('d_stock')->where('s_comp','3')->where('s_position','3')
        ->join('m_item', 'm_item.i_id', '=', 'd_stock.s_item')
        ->get();

      $dataPayment = DB::table('m_paymentmethod')->get();

      $ket = 'create';

      return view('/penjualan/POSretail/index',compact('id_cust','fatkur', 'idreq','stock','dataPayment', 'ket'));
    }

  public function edit_sales($id){
    $year = carbon::now()->format('y');
    $month = carbon::now()->format('m');
    $date = carbon::now()->format('d');

    //select max dari um_id dari table d_uangmuka
    $maxid = DB::Table('m_customer')->select('c_id')->max('c_id');
    $idfatkur = DB::Table('d_sales')->select('s_id')->max('s_id');
    $idreq = DB::table('d_transferitem')->select('ti_id')->max('ti_id');
    //untuk +1 nilai yang ada,, jika kosong maka maxid = 1 , 

    if ($maxid <= 0 || $maxid <= '') {
      $maxid  = 1;
    }else{
      $maxid += 1;
    }

    if ($idfatkur <= 0 || $idfatkur <= '') {
      $idfatkur  = 1;
    }else{
      $idfatkur += 1;
    }

    if ($idreq <= 0 || $idreq <= '') {
      $idreq  = 1;
    }else{
      $idreq += 1;
    }
    //jika kurang dari 100 maka maxid mimiliki 00 didepannya
    if ($maxid < 100) {
      $maxid = '00'.$maxid;
    }
      $id_cust = 'CUS' . $month . $year . '/' . 'C001' . '/' .  $maxid; 
      $fatkur = 'XX'  . $year . $month . $date . $idfatkur;
      $idreq = 'REQ'  . $year . $month . $date . $idreq;

      $edit = DB::table('d_sales')
      ->select('c_id','c_code','c_name','c_hp','c_address','c_type','c_insert','c_update',
                'd_sales.s_id as sd_id','s_channel','s_date','s_note','s_staff','s_customer','s_gross',
                's_disc_percent','s_disc_value','s_tax','s_net','s_status','d_sales.s_insert as sd_insert',
                'd_sales.s_update as sd_update','sd_sales','sd_detailid','sd_item','sd_qty','sd_price','sd_disc_percent',
                'sd_disc_value','sd_total','i_id','i_code','i_type','i_group','i_name','i_unit',
                'i_price','i_price','i_insert','i_update','d_stock.s_id as d_id','s_comp',
                's_position','s_item','s_qty','d_stock.s_insert as d_insert','d_stock.s_update as d_update')
      ->join('m_customer', 'm_customer.c_id', '=' , 'd_sales.s_customer')
      ->join('d_sales_dt','d_sales_dt.sd_sales','=','d_sales.s_id')
      ->join('m_item','m_item.i_id','=','d_sales_dt.sd_item')
      ->join('d_stock','d_stock.s_item','=','d_sales_dt.sd_item')
      ->where('s_comp','9')
      ->where('s_position','9')
      ->where('s_status','DR')
      ->where('d_sales.s_id',$id)
      ->get();

      $dataPayment = DB::table('m_paymentmethod')->get();

      $ket = 'edit';

    return view('/penjualan/POSretail/index',compact('id_cust','fatkur','idreq', 'stock','edit','dataPayment', 'ket'));
  }

  public function detail(Request $request){
    $detaliss = DB::table('d_sales_dt')
                  ->select('*')
      ->join('d_sales', 'd_sales_dt.sd_sales', '=', 'd_sales.s_id' )
      ->join('m_item', 'm_item.i_id', '=' , 'd_sales_dt.sd_item')
      ->where('sd_sales','=',$request->x)->get();

   return view('/penjualan/POSretail/NotaPenjualan.detail',compact('detaliss'));
  }

  public function autocomplete(Request $request){
    $term = $request->term;

    $results = array();
    
    $queries = DB::table('m_customer')
      ->where('m_customer.c_name', 'LIKE', '%'.$term.'%')
      ->take(50)->get();
    
    if ($queries == null) {
      $results[] = [ 'id' => null, 'label' =>'tidak di temukan data terkait'];
    } else {
      foreach ($queries as $query) 
      {
        $results[] = [ 'id' => $query->c_id, 'label' => $query->c_name .'  '.$query->c_address, 'alamat' => $query->c_address.' '.$query->c_hp ];
      }
    }

    return Response::json($results);
    }

  public function autocompleteitem(Request $request){
      $term = $request->term;

      $results = array();
    
      $queries = DB::table('m_item')

        ->leftJoin('d_stock','m_item.i_id','=', 'd_stock.s_item')

        ->orWhere(function ($b) use ($term) {
                  $b->where('s_comp','9')
                    ->where('s_position','9');
              })
        ->where(function ($d) use ($term) {
                  $d->orWhere('m_item.i_type', 'LIKE', '%'.$term.'%')
                    ->orWhere('m_item.i_code', 'LIKE', '%'.$term.'%')
                    ->orWhere('m_item.i_name', 'LIKE', '%'.$term.'%');
              })
        ->take(50)->get();

        

      if ($queries == null) {
        $results[] = [ 'i_id' => null, 'label' =>'tidak di temukan data terkait'];
      } else {
        foreach ($queries as $query) 
        {
          $results[] = [ 'id' => $query->i_id, 
                         'label' => $query->i_code .' - '. $query->i_name,
                         'harga' => $query->i_price, 
                         'kode' => $query->i_id, 
                         'nama' => $query->i_name, 
                         'satuan' => $query->i_unit, 
                         's_qty'=>$query->s_qty 
                       ];
        }
      }
 
      return Response::json($results); 
      }

  public function autocompletereq(Request $request){
      $term = $request->term;

      $results = array();
      
      $queries = DB::table('m_item')

        ->leftJoin('d_stock','m_item.i_id','=', 'd_stock.s_item')

        ->where(function ($b) use ($term) {
                  $b->where('s_comp','9')
                    ->where('s_position','9');
              })
        ->where(function ($d) use ($term) {
                  $d->orWhere('m_item.i_type', 'LIKE', '%'.$term.'%')
                    ->orWhere('m_item.i_name', 'LIKE', '%'.$term.'%');
              })
        ->take(50)->get();
      if ($queries == null) {
        $results[] = [ 'i_id' => null, 'label' =>'tidak di temukan data terkait'];
      } else {
        foreach ($queries as $query) 
        {
          $results[] = [ 'id' => $query->i_id, 'label' => $query->i_code .' - '. $query->i_name,
                         'harga' => $query->i_price, 'kode' => $query->i_id, 'nama' => $query->i_name, 'satuan' => $query->i_unit, 'stok' => $query->s_qty ];
        }
      }
   
    return Response::json($results); 
    }

  public function store(Request $request){
    return DB::transaction(function () use ($request) {
    $maxid = DB::Table('m_customer')->select('c_id')->max('c_id');
     if ($maxid <= 0 || $maxid <= '') {
        $maxid  = 1;
      }else{
        $maxid += 1;
      }
   
    $customer = DB::table('m_customer')
          ->insert([
        'c_id' => $maxid,
        'c_code' => $request->id_cus_ut,
        'c_name' => $request->nama_cus,
        'c_birthday' => $request->tgl_lahir,
        'c_email' => $request->email,
        'c_hp' => $request->no_hp,
        'c_address' => $request->alamat,
        'c_type' =>'RT',
        'c_insert' => Carbon::now(),
        'c_update' => $request->c_update
      ]);
    });
  }  

  public function sal_save_final(Request $request){ 
    //dd($request->all());
    return DB::transaction(function () use ($request) {
    $customer = DB::table('d_sales')
        ->insert([
          's_id' => $request->s_id,
          's_channel' => 'RT',
          's_date' => date('Y-m-d',strtotime($request->s_date)),
          's_note' => $request->s_nota,
          's_staff' => $request->s_staff,
          's_customer' => $request->id_cus,
          's_gross' => ($this->konvertRp($request->s_gross)),
          's_disc_percent' => ($this->konvertRp($request->s_disc_percent)),
          's_disc_value' => ($this->konvertRp($request->s_disc_value)),
          's_tax' => $request->s_pajak,
          's_net' => ($this->konvertRp($request->s_net)),
          's_status' => 'FN',
          's_insert' => Carbon::now(),
          's_update' => $request->s_update
        ]);

        $s_id = DB::table('d_sales')->max('s_id');

        for ($i=0; $i < count($request->kode_item); $i++) {

        $stokRetail = DB::table('d_stock')
        ->where('s_comp','9')
        ->where('s_position','9')
        ->where('s_item',$request->kode_item[$i])->first(); 

        $d_sales_dt = DB::table('d_sales_dt')
            ->insert([
              'sd_sales' => $s_id,
              'sd_detailid' => $i+1,
              'sd_item' => $request->kode_item[$i],
              'sd_qty' => $request->sd_qty[$i],
              'sd_price' => ($this->konvertRp($request->harga_item[$i])),
              'sd_disc_percent' => $request->sd_disc_percent[$i],
              'sd_disc_value' => $request->sd_disc_value[$i],
              'sd_total' => ($this->konvertRp($request->hasil[$i]))
          ]);

        $stokBaru = $stokRetail->s_qty - $request->sd_qty[$i];

        DB::table("d_stock")
        ->where('s_comp','9')
        ->where('s_position','9')
        ->where("s_id", $stokRetail->s_id)
        ->update(['s_qty' => $stokBaru]);
        }

      for ($i=0; $i < count($request->sp_method); $i++) {

      $d_sales_payment = DB::table('d_sales_payment')
          ->insert([
              'sp_sales' => $s_id,
              'sp_paymentid' => $i+1,
              'sp_method' => $request->sp_method[$i],
              'sp_nominal' => ($this->konvertRp($request->sp_nominal[$i]))
          ]);
        } 
      });
    }

  public function sal_save_draft(Request $request){
    //dd($request->all());
    return DB::transaction(function () use ($request) {
        $customer = DB::table('d_sales')
            ->insert([
              's_id' =>$request->s_id,
              's_channel' =>'RT',
              's_date' =>date('Y-m-d',strtotime($request->s_date)),
              's_note' =>$request->s_nota,
              's_staff' =>$request->s_staff,
              's_customer' => $request->id_cus,
              's_disc_percent' => $request->s_disc_percent,
              's_disc_value' => ($this->konvertRp($request->totalDiscount)),
              's_gross' => ($this->konvertRp($request->s_gross)),
              's_tax' => $request->s_pajak,
              's_net' => ($this->konvertRp($request->s_gross)),
              's_status' => 'DR',
              's_insert' => Carbon::now(),
              's_update' => $request->s_update
              
            ]);

            $s_id= DB::table('d_sales')->max('s_id');

            for ($i=0; $i < count($request->kode_item); $i++) { 

            $d_sales_dt = DB::table('d_sales_dt')
                ->insert([
                  'sd_sales' => $s_id,
                  'sd_detailid' => $i+1,
                  'sd_item' => $request->kode_item[$i],
                  'sd_qty' => $request->sd_qty[$i],
                  'sd_price' => ($this->konvertRp($request->harga_item[$i])),
                  'sd_disc_percent' => $request->sd_disc_percent[$i],
                  'sd_disc_value' => ($this->konvertRp($request->sd_disc_value[$i])),
                  'sd_total' => ($this->konvertRp($request->hasil[$i]))
              ]);
              
            }
        });
    }

   public function sal_save_finalUpdate(Request $request){
      return DB::transaction(function () use ($request) {

       $s_id=$request->sd_id;
        
       $m = DB::table('d_sales')->where('s_id',$request->sd_id)->first();

       if ($m->s_status =='DR') {

          DB::table('d_sales')->where('s_id',$request->sd_id)
            ->update([
              's_channel' => 'RT',
              's_date' => date('Y-m-d',strtotime($request->s_date)),
              's_note' => $request->s_nota,
              's_staff' => $request->s_staff,
              's_customer' => $request->id_cus,
              's_disc_percent' => $request->s_disc_percent,
              's_disc_value' => $request->s_disc_value,
              's_gross' => ($this->konvertRp($request->s_gross)),
              's_tax' => $request->s_pajak,
              's_net' => ($this->konvertRp($request->s_gross)),
              's_status' => 'FN',
              's_insert' => Carbon::now(),
              's_update' => $request->s_update
            ]);

              for ($i=0; $i < count($request->kode_item); $i++) {

              $stokRetail = DB::table('d_stock')
                ->where('s_comp','9')
                ->where('s_position','9')
                ->where('s_item',$request->kode_item[$i])->first(); 

            
            if ($request->sd_sales[$i] == null ){ 
              $sd_detailid=DB::table('d_sales_dt')->where('sd_sales',$s_id)->max('sd_detailid');
              $d_sales_dt = DB::table('d_sales_dt')
                ->where('sd_sales',$s_id)
                  ->insert([
                    'sd_sales' =>$s_id,
                    'sd_detailid'=>$sd_detailid+1,
                    'sd_qty'=>$request->sd_qty[$i],
                    'sd_price'=>($this->konvertRp($request->harga_item[$i])),
                    'sd_item'=>$request->kode_item[$i],
                    'sd_disc_percent'=>$request->sd_disc_percent[$i],
                    'sd_disc_value'=>$request->sd_disc_value[$i],
                    'sd_total'=>($this->konvertRp($request->hasil[$i]))

            ]);
                       
            }else{
             $d_sales_dt = DB::table('d_sales_dt')
                ->where('sd_sales',$s_id)
                ->where('sd_detailid',$request->sd_detailid[$i])
                  ->update([                        
                    'sd_item'=>$request->kode_item[$i],
                    'sd_qty'=>$request->sd_qty[$i],
                    'sd_price'=>($this->konvertRp($request->harga_item[$i])),
                    'sd_disc_percent'=>$request->sd_disc_percent[$i],
                    'sd_disc_value'=>$request->sd_disc_value[$i],
                    'sd_total'=>($this->konvertRp($request->hasil[$i]))
            ]);

            $stokBaru = $stokRetail->s_qty - $request->sd_qty[$i];

            DB::table("d_stock")
            ->where('s_comp','9')
            ->where('s_position','9')
            ->where("s_id", $stokRetail->s_id)
            ->update(['s_qty' => $stokBaru]);
            }

            for ($i=0; $i < count($request->sp_method); $i++) {

            $d_sales_payment = DB::table('d_sales_payment')
                ->insert([
                    'sp_sales' => $s_id,
                    'sp_paymentid' => $i+1,
                    'sp_method' => $request->sp_method[$i],
                    'sp_nominal' => ($this->konvertRp($request->sp_nominal[$i]))
                ]);
              }
          }
       }
    });
  }

  public function distroy($id){
    DB::table('d_sales')
      ->where('s_id',$id)
      ->where('s_status','DR')
      ->delete();

   return redirect('/penjualan/POSretail/index');
  }
  
  public function konvertRp($value){

    $value = str_replace(['Rp', '\\', '.', ' '], '', $value);
    return str_replace(',', '.', $value);

    }

  public function getTanggal($tgl1,$tgl2){

    $y = substr($tgl1, -4);
    $m = substr($tgl1, -7,-5);
    $d = substr($tgl1,0,2);
     $tgll = $y.'-'.$m.'-'.$d;

    $y2 = substr($tgl2, -4);
    $m2 = substr($tgl2, -7,-5);
    $d2 = substr($tgl2,0,2);
      $tgl2 = $y2.'-'.$m2.'-'.$d2;

    $detalis = DB::table('d_sales')
      ->join('m_customer','m_customer.c_id','=','d_sales.s_customer')
      ->where('s_channel','RT')
      ->where('s_date','>=',$tgll)
      ->where('s_date','<=',$tgl2)
      ->get();

    return view('/penjualan/POSretail/NotaPenjualan.dt_notaJual',compact('detalis'));
  }

  function getTanggalJual($tgl1,$tgl2){

    $y = substr($tgl1, -4);
    $m = substr($tgl1, -7,-5);
    $d = substr($tgl1,0,2);
     $tgll = $y.'-'.$m.'-'.$d;

    $y2 = substr($tgl2, -4);
    $m2 = substr($tgl2, -7,-5);
    $d2 = substr($tgl2,0,2);
      $tgl2 = $y2.'-'.$m2.'-'.$d2;

    $leagues = DB::table('d_sales_dt')
      ->select('sd_item','s_date','i_name','i_type','i_group', DB::raw("sum(sd_qty) as jumlah"))
      ->join('m_item', 'm_item.i_id', '=' , 'd_sales_dt.sd_item')
      ->join('d_sales', 'd_sales.s_id', '=' , 'd_sales_dt.sd_sales')
      ->where('s_channel','RT')
      ->where('s_status','FN')
      ->where('s_date','>=',$tgll)
      ->where('s_date','<=',$tgl2)
      ->groupBy('sd_item','i_name')
      ->get();

      return view('/penjualan/POSretail/ItemPenjualan.Data_JualRetail',compact('leagues'));
      }
      
  public function PayMethode(Request $request){
    $paymethode=DB::table('m_paymentmethod')
      ->select('pm_id','pm_name')
      //->where('pm_id','!=',$request->data0)
      ->get();
    $data = array();
    foreach ($paymethode as $value) {
      $data[] = (array) $value;
    }
    for ($j=0; $j<count($data); $j++) {
      for($i=0; $i<$request->length; $i++){
        if($data[$j]['pm_id'] == $request->{'data'.$i})
          $data[$j]['pm_id']=0;
      }
    }
    $idx=0;
    foreach ($data as $key) {
      if($key['pm_id'] == 0){
        unset($data[$idx]);
      }
      $idx++;
    } 

    $data2 = array();
    foreach ($data as $key => $value) {
      $data2[] = (array) $value;
    }
    echo json_encode($data2);
  }

  public function setBarcode(Request $request){
    $data = DB::table('m_item')
        ->select('i_id','i_code','i_name','i_price','i_unit','s_qty')
        ->join('d_stock','d_stock.s_item','=','m_item.i_id')
        ->where('s_comp','9')
        ->where('s_position','9')
        ->where('i_code', 'like', '%'.$request->code.'%')
        ->get();

     return Response::json($data); 
  }
}


