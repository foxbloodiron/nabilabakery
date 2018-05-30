<?php 

namespace App\Http\Controllers\Penjualan;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Auth;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\m_item;
use App\mMember;

class stockController extends Controller
{
  public function tableStock(Request $request){
    if($request->numberload=='')
        $request->numberload=10;
      $stock=m_item::leftjoin('d_stock',function($join){
          $join->on('i_id', '=', 's_item');        
          $join->on('s_comp', '=', 's_position');                
          $join->on('s_comp', '=',DB::raw("'9'"));           
      })    
      ->where('i_type', '=',DB::raw("'BJ'"))
      ->orWhere('i_type', '=',DB::raw("'BP'"))   
      ->orderBy('i_name')
      //->toSql();
      ->paginate($request->numberload);    
      

         if ($request->ajax()) {
              return view('penjualan.POSretail.StokRetail.table-stock', compact('stock'));

          }
          
      return view('penjualan.POSretail.StokRetail.stock',compact('stock'));
    
    
  }

  public function transferItem(Request $request){
    $term = $request->term;

    $results = array();

    $queries = m_item::  
    where('i_type', '=', DB::raw("'BP'"))
    ->where('i_name', 'like', DB::raw('"%'.$request->term.'%"'))        
    
    ->orWhere('i_type', '=', DB::raw("'BJ'"))
    ->where('i_name', 'like', DB::raw('"%'.$request->term.'%"'))       

    ->get();
    
    if ($queries == null) {
      $results[] = [ 'id' => null, 'label' =>'tidak di temukan data terkait'];
    } else {
      foreach ($queries as $query) 
      {
        if($query->s_qty=='')
          $query->s_qty=0;
        $results[] = [ 'id' => $query->i_id, 'label' =>$query->i_code.'-'. $query->i_name, 'code' => $query->i_id,
                       'name' => $query->i_name ];
      }
    }
 
    return Response::json($results);
  }

  public function transferItemGrosir(Request $request){
    
    $term = $request->term;

    $results = array();


    $queries=m_item::leftjoin('d_stock',function($join) use ($request){
        $join->on('i_id', '=', 's_item');        
        $join->on('s_comp', '=', 's_position');                
        $join->on('s_comp', '=',DB::raw("'3'"));                   
    })    
    ->where('i_type', '=',DB::raw("'BJ'"))    
    ->where('i_name', 'like',DB::raw('"%'.$request->term.'%"')) 
    ->orWhere('i_type', '=',DB::raw("'BP'"))       
    ->where('i_name', 'like',DB::raw('"%'.$request->term.'%"'))
    ->orderBy('i_name')
    //->toSql();
    ->get();   
    
    if ($queries == null) {
      $results[] = [ 'id' => null, 'label' =>'tidak di temukan data terkait'];
    } else {
      foreach ($queries as $query) 
      {
        if($query->s_qty=='')
        $query->s_qty=0;
        $results[] = [ 'id' => $query->i_id, 'label' =>$query->i_code.'-'. $query->i_name.'('. $query->s_qty .')', 'code' => $query->i_id,
                       'name' => $query->i_name,
                       'qty' => $query->s_qty ];
      }
    }
 
    return Response::json($results);
  }

  public function update(Request $request, $s_item)
  {
   $data = array(
        's_comp' => 11,
        's_position' => 11,
        's_item' => $s_item,
        's_qty' => $request->s_qty
      );

    $mutcat ='';
   //$sm_qty = 0;

    //cek item 
    $cek = DB::Table('d_stock')
            ->where('s_item',$s_item)
            ->where('s_comp',11)
            ->where('s_position',11)
            ->get();
    //jika item ada
    if(count($cek) == 1){

      //cek penambahan atau pengurangan
      if($data['s_qty'] < $cek[0]->s_qty){
        $mutcat='kurang';
        $sm_qty = ($cek[0]->s_qty) - ($data['s_qty']);
      }elseif($data['s_qty'] > $cek[0]->s_qty){
        $mutcat='tambah';
        $sm_qty = $data['s_qty'] - $cek[0]->s_qty;
      }else{
        $sm_qty = 0;
      }

      $simpan = DB::Table('d_stock')
            ->where('s_item',$s_item)
            ->where('s_comp',11)
            ->where('s_position',11)
            ->update($data);
      
      if($sm_qty != 0){
        $id_smut = DB::Table('d_stock_mutation')->select('sm_detailid')->max('sm_detailid');
        if ($id_smut <= 0 || $id_smut <= '') {
          $id_smut  = 1;
        }else{
          $id_smut += 1;
        }

        $stock = DB::Table('d_stock_mutation')
          ->insert([
                'sm_stock' => $cek[0]->s_id,
                'sm_detailid' => $id_smut,
                'sm_date' => carbon::now()->format('Y-m-d'),
                'sm_comp' => 11,
                'sm_mutcat' => $mutcat == 'tambah' ? 16 : 17,
                'sm_item' => $s_item,
                'sm_qty' => $sm_qty,
                'sm_qty_used' => 0,
                'sm_qty_expired' => 0,
                'sm_detail' => $request->ket,
                'sm_price' => $request->harga,
                'sm_reff' => 0,
                'sm_insert' => carbon::now()->format('Y-m-d')
          ]);
      }
    }

    //jika belum ada item
    if(count($cek) == 0){
        $id = DB::Table('d_stock')->select('s_id')->max('s_id');
        if ($id <= 0 || $id <= '') {
          $id  = 1;
        }else{
          $id += 1;
        }
        $data['s_insert'] = carbon::now()->format('Y-m-d');
        $data['s_id'] = $id;
        $simpan = DB::Table('d_stock')->insert($data);
        

        $mutcat = 'tambah';
        $sm_qty = $request->s_qty;
        if($sm_qty != 0){
          $id_smut = DB::Table('d_stock_mutation')->select('sm_detailid')->max('sm_detailid');
          if ($id_smut <= 0 || $id_smut <= '') {
            $id_smut  = 1;
          }else{
            $id_smut += 1;
          }

          $stock = DB::Table('d_stock_mutation')
            ->insert([
                'sm_stock' => $id,
                'sm_detailid' => $id_smut,
                'sm_date' => carbon::now()->format('Y-m-d'),
                'sm_comp' => 11,
                'sm_mutcat' => 16,
                'sm_item' => $s_item,
                'sm_qty' => $sm_qty,
                'sm_qty_used' => 0,
                'sm_qty_expired' => 0,
                'sm_detail' => $request->ket,
                'sm_price' => $request->harga,
                'sm_reff' => 0,
                'sm_insert' => carbon::now()->format('Y-m-d')
          ]);
        }
        
    }    

    $harga = DB::Table('m_item')
            ->where('i_id',$s_item)
            ->update(['i_price'=>(int)$request->harga]);

    if($request->key == ''){
      return $this->tableStock($request);
    }else{
      return $this->cariStock($request,$request->key);
    }
  }

  public function cariStock(Request $request, $key){
    if($request->numberload=='')
    $request->numberload=10;
    $stock = DB::Table('m_item')
    ->leftjoin('d_stock',function($join){
        $join->on('i_id', '=', 's_item');        
        $join->on('s_comp', '=', 's_position');                
        $join->on('s_comp', '=',DB::raw("'11'"));           
    })    
    ->where(function ($query) {
        $query->where('i_type','BJ')
              ->orWhere('i_type','BP');
      })
    ->where('i_name','like','%'.$key.'%')
    ->orderBy('i_name')
    ->paginate($request->numberload);    

    return view('penjualan.POSretail.stokRetail.table-stock', compact('stock'));
  }
}

