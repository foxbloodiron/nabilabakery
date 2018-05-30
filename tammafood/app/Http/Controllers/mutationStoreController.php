<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\d_mutationstore;

use App\m_item;

use Response;

use DB;
class mutationStoreController extends Controller
{
    public function index(){
    $mutationstore=d_mutationstore::
    				join('m_item','i_id','=','ms_item')->
    				join('d_stock',function ($join){
    					$join->on('i_id','=','s_item');    					
    					$join->on('ms_store','=','s_comp');    					
    					$join->on('ms_destination','=','s_position');    					
    				})->    				
    				get();        
    	return view('penjualan.mutasistok.mutasi',compact('mutationstore'));
    }


   public function dataItem(Request $request){
    $term = $request->term;

    $results = array();

    $queries = m_item::
    join('d_stock', function($join){
    	$join->on('m_item.i_id','=','s_item');
    	$join->on('s_comp','=','s_position');
    	$join->on('s_comp','=',DB::raw("'3'"));
    })      
    ->where('i_name', 'like', DB::raw('"%'.$request->term.'%"'))        
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
}
