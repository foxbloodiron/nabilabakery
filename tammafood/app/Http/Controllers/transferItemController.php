<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\d_transferItem;
use App\d_transferItemDt;
use DB;
use Validator;
use Carbon\Carbon;
use App\d_stock;
use App\d_stock_mutation;
use Auth;
class transferItemController extends Controller
{
    public function noNota(){
        $year = carbon::now()->format('y');
        $month = carbon::now()->format('m');
        $date = carbon::now()->format('d');

    $idreq = d_transferItem::select('ti_id')->max('ti_id');        
        if ($idreq <= 0 || $idreq <= '') {
          $idreq  = 1;
        }else{
          $idreq += 1;
        }                
    $idreq = 'REQ'  . $year . $month . $date . $idreq;
        return json_encode($idreq);
    }
    public function index(){
        return view('transfer.index');
    }
     public function dataTransfer(){        
        $transferItem=d_transferItem::where('ti_order',DB::raw("'RT'"))->paginate();
        return view('transfer.table-transfer',compact('transferItem'));
    }
    public function simpanTransfer(Request $request)
    {
    return DB::transaction(function () use ($request) {
    if(Auth::user()->punyaAkses('Ritail Transfer','ma_insert')){
    	$ti_id=d_transferItem::max('ti_id')+1;
    	d_transferItem::create([
    				'ti_id'			=>$ti_id,
    				'ti_time'		=>date('Y-m-d',strtotime($request->ri_tanggal)), 
    				'ti_code'		=>$request->ri_nomor, 
    				'ti_order'		=>'RT',
    				//'ti_orderstaff'	=>,
    				'ti_note'		=>$request->ri_keterangan,
    				
    	]);
    
    	for ($i=0; $i <count($request->kode_item) ; $i++) { 
    			$tidt_id=d_transferItemDt::where('tidt_id',$ti_id)->max('tidt_detail')+1;
    			 d_transferItemDt::create([
    				'tidt_id'			=>$ti_id,
    				'tidt_detail'		=>$tidt_id, 
    				'tidt_item'		=>$request->kode_item[$i], 
    				'tidt_qty'		=>$request->sd_qty[$i]
    			]);
    	}

    	$data=['status'=>'sukses'];    	
    	return json_encode($data);
      }
      $data=['status'=>'not-allowed'];       
      return json_encode($data);
     
    });

    }

    public function editTransfer(Request $request,$id)
    {
        
        $transferItem=d_transferItem::where('ti_id',$id)->first();
        $transferItemDt=d_transferItemDt::
                        join('m_item','d_transferitem_dt.tidt_item','=','m_item.i_id')->
                        where('tidt_id',$id)->get();
                        

        return view('transfer.edit-transfer',compact('transferItem','transferItemDt'));

    }

    public function updateTransfer(Request $request)
    {
    	return DB::transaction(function () use ($request) {    		
    	$ti_id=d_transferItem::max('ti_id')+1;
    	d_transferItem::create([
    				'ti_id'			=>$ti_id,
    				'ti_time'		=>date('Y-m-d',strtotime($request->ri_tanggal)), 
    				'ti_code'		=>$request->ri_nomor, 
    				'ti_order'		=>'RT',
    				//'ti_orderstaff'	=>,
    				'ti_note'		=>$request->ri_keterangan,
    				
    	]);
    
    	for ($i=0; $i <count($request->kode_item) ; $i++) { 
    			$tidt_id=d_transferItemDt::where('tidt_id',$ti_id)->max('tidt_detail')+1;
    			 d_transferItemDt::create([
    				'tidt_id'			=>$ti_id,
    				'tidt_detail'		=>$tidt_id, 
    				'tidt_item'		=>$request->kode_item[$i], 
    				'tidt_qty'		=>$request->sd_qty[$i]
    			]);
    	}
       
    });

    }

    public function HapusTransfer($id){
        return DB::transaction(function () use ($id) {
             $transferItem=d_transferItem::where('ti_id',$id);             
             if($transferItem->first()->ti_isapproved=='Y'){
                    $data=['status'=>'Gagal','info'=>'Maaf, Permintaan Transfer Item Telah di Setujui'];
                    return json_encode($data);
             }else{
                  $transferItem->delete();
                  $data=['status'=>'sukses'];
                return json_encode($data);
             }
             
        });
    }
     public function indexPenerimaanTransfer(){
        return view('transfer.penerimaan.index');
    }
     public function dataPenerimaanTransfer(){
        $transferItem=d_transferItem::where('ti_issent','Y')->paginate();
        return view('transfer.penerimaan.table-penerimaan',compact('transferItem'));
    }

    public function lihatPenerimaan($id){
              $transferItem=d_transferItem::where('ti_id',$id)->first();
        $transferItemDt=d_transferItemDt::
                        join('m_item','d_transferitem_dt.tidt_item','=','m_item.i_id')->
                        leftjoin('d_stock',function($join){
                        $join->on('i_id', '=', 's_item');        
                        $join->on('s_comp', '=', 's_position');                
                        $join->on('s_comp', '=',DB::raw("'11'"));           
                        })
                        ->where('tidt_id',$id)
                        ->get();
        return view('transfer.penerimaan.penerimaan-transfer',compact('transferItem','transferItemDt'));
    }

public function simpaPenerimaan(Request $request){
    return DB::transaction(function () use ($request) {    
    /*dd($request->all());*/

            for ($i=0; $i <count($request->tidt_id) ; $i++) { 
                $qtyAwal=0;
                $transferItemDt=d_transferItemDt::                        
                                where('tidt_id',$request->tidt_id[$i])->
                                where('tidt_detail',$request->tidt_detail[$i]);
                 if($transferItemDt->first()){
                    $qtyAwal=$transferItemDt->first()->tidt_qty_received;
                }
                $transferItemDt->update([
                    'tidt_qty_received'=>$request->qtyRecieved[$i],
                    'tidt_receivedtime'=>date('Y-m-d g:i:s'),
                ]);

                $stockPosisi=d_stock::                        
                       where('s_item',$request->tidt_item[$i])->
                       where('s_comp',DB::raw('11'))->
                       where('s_position',DB::raw('3'));
                       
                if($stockPosisi->first()){
                     $s_id=$stockPosisi->first()->s_id;
                            $stockPosisi->update([
                                's_qty'=>($stockPosisi->first()->s_qty+$qtyAwal)-$request->qtyRecieved[$i]
                            ]);
                }else{
                            DB::rollback();
                            $data=['status'=>'Gagal','info'=>'Stok Tidak Mencukupi'];
                            return json_encode($data);
                }
//stok mutasi
                 $getStockMutasi = DB::table('d_stock_mutation')
                        ->select('*')
                        ->where('sm_stock', '=', $s_id)
                        ->whereRaw('d_stock_mutation.sm_qty > d_stock_mutation.sm_qty_used')
                        ->where('sm_mutcat', '=', '3')
                        ->orderBy('sm_date')
                        ->get();

                 $totalPermintaan = $request->qtyRecieved[$i];          
                    for ($k = 0; $k < count($getStockMutasi); $k++) {
                        $totalQty = $getStockMutasi[$k]->sm_qty_sisa;
                        if ($totalPermintaan <= $totalQty) {
                            $total[$k]['detailid'] = $getStockMutasi[$k]->sm_detailid;
                            $total[$k]['jumlah'] = $totalPermintaan;
                            $total[$k]['hpp'] = $getStockMutasi[$k]->sm_price;
                            $k = count($getStockMutasi);
                        } elseif ($totalPermintaan > $totalQty) {
                            $total[$k]['detailid'] = $getStockMutasi[$k]->sm_detailid;
                            $total[$k]['jumlah'] = $totalQty;
                            $total[$k]['hpp'] = $getStockMutasi[$k]->sm_price;
                            $totalPermintaan = $totalPermintaan - $totalQty;
                        }
                    }


    for ($l = 0; $l < count($total); $l++) {
        $stock_mutation=d_stock_mutation::where('sm_stock', '=', $s_id)
                            ->where('sm_detailid', '=', $total[$l]['detailid']);
    $sm_qty_used=$stock_mutation->first()->sm_qty_used+$request->qtySend[$i];
    $stock_mutation->update([
            'sm_qty_used'=> $stock_mutation->first()->sm_qty_used+$request->qtySend[$i],
            'sm_qty_sisa'=> $stock_mutation->first()->sm_qty-$sm_qty_used
    ]);

        $detailid = DB::table('d_stock_mutation')
                    ->where('sm_stock', '=', $s_id)
                            ->select('sm_detailid')
                            ->max('sm_detailid')+1;

    d_stock_mutation::create([
                        'sm_stock'    => $s_id,
                        'sm_detailid' => $detailid,
                        'sm_comp'     => 11,
                        'sm_position'     => 3,
                        'sm_date'     => date('Y-m-d'),
                        'sm_item'     => $request->tidt_item[$i],
                        'sm_detail'   => 'Penerimaan Transfer 11/3',
                        'sm_qty'      => $total[$l]['jumlah'],
                        'sm_qty_used'      => 0,
                        'sm_price'    => $total[$l]['hpp'],                                                
                        'sm_reff'     => $request->ri_nomor,
                        'sm_qty_sisa' => $total[$l]['jumlah'],
                        'sm_mutcat'   =>3
                        /*'sm_petugas' = Auth::user()->m_id,*/
                    ]);

    }

                 $stockRetail=d_stock::                        
                       where('s_item',$request->tidt_item[$i])->
                       where('s_comp',DB::raw('11'))->
                       where('s_position',DB::raw('11'));
                $s_id_retail='';
                if($stockRetail->first()){
                    $s_id_retail=$stockRetail->first()->s_id;
                            $stockRetail->update([
                                's_qty'=>($stockRetail->first()->s_qty-$qtyAwal)+$request->qtyRecieved[$i]
                            ]);
                }else{
                            $s_id_retail=d_stock::max('s_id')+1;
                            d_stock::create([
                                    's_id'      =>$s_id_retail,
                                    's_comp'    =>11,
                                    's_position' =>11,
                                    's_item'    =>$request->tidt_item[$i],
                                    's_qty'     =>$request->qtyRecieved[$i],

                            ]);
                }

                  $getStockMutasi = DB::table('d_stock_mutation')
                        ->select('*')
                        ->where('sm_stock', '=', $s_id)
                        ->whereRaw('d_stock_mutation.sm_qty > d_stock_mutation.sm_qty_used')
                        ->where('sm_mutcat', '=', '3')
                        ->orderBy('sm_date')
                        ->get();

                 $totalPermintaan = $request->qtyRecieved[$i];          
                    for ($k = 0; $k < count($getStockMutasi); $k++) {
                        $totalQty = $getStockMutasi[$k]->sm_qty_sisa;
                        if ($totalPermintaan <= $totalQty) {
                            $total[$k]['detailid'] = $getStockMutasi[$k]->sm_detailid;
                            $total[$k]['jumlah'] = $totalPermintaan;
                            $total[$k]['hpp'] = $getStockMutasi[$k]->sm_price;
                            $k = count($getStockMutasi);
                        } elseif ($totalPermintaan > $totalQty) {
                            $total[$k]['detailid'] = $getStockMutasi[$k]->sm_detailid;
                            $total[$k]['jumlah'] = $totalQty;
                            $total[$k]['hpp'] = $getStockMutasi[$k]->sm_price;
                            $totalPermintaan = $totalPermintaan - $totalQty;
                        }
                    }


              for ($l = 0; $l < count($total); $l++) {
    $stock_mutation=d_stock_mutation::where('sm_stock', '=', $s_id)
                            ->where('sm_detailid', '=', $total[$l]['detailid']);
    $sm_qty_used=$stock_mutation->first()->sm_qty_used+$request->qtyRecieved[$i];
    $stock_mutation->update([
            'sm_qty_used'=> $sm_qty_used,
            'sm_qty_sisa'=> $stock_mutation->first()->sm_qty-$sm_qty_used
    ]);

            $detailid = DB::table('d_stock_mutation')
                            ->where('sm_stock', '=', $s_id)
                            ->select('sm_detailid')
                            ->max('sm_detailid')+1;

    d_stock_mutation::create([
                        'sm_stock'    => $s_id_retail,
                        'sm_detailid' => $detailid,
                        'sm_comp'     => 11,
                        'sm_position'     => 11,
                        'sm_date'     => date('Y-m-d'),
                        'sm_item'     => $request->tidt_item[$i],
                        'sm_detail'   => 'Pengurangan Transfer',
                        'sm_qty'      => -$total[$l]['jumlah'],
                        'sm_qty_used'      => 0,
                        'sm_price'    => $total[$l]['hpp'],                                                
                        'sm_reff'     => $request->ri_nomor,
                        'sm_qty_sisa' => -$total[$l]['jumlah'],
                        'sm_mutcat'   =>3
                        /*'sm_petugas' = Auth::user()->m_id,*/
                    ]);

    }






            }
                $transferItem=d_transferItem::where('ti_id',$request->ti_id);

                $transferItem->update([
                            'ti_isreceived'=>'Y'
                                ]);
               $data=['status'=>'sukses'];
               return json_encode($data);

           });
    }

    public function data(){
        return DB::transaction(function () {
                    $iditem=189;

                    $stock = DB::table('d_stock')
                        ->where('s_item', '=', $iditem)
                        ->where('s_comp', '=', 11)
                        ->where('s_position', '=', 11)
                        ->where('s_qty', '!=', 0)
                        ->select('s_id', 's_comp', 's_qty')
                        ->first();


                    $s_id = $stock->s_id;
        /*$getBarang=d_stock_mutation::where('sm_qty_sisa','>',0)->get();*/
 $getStockMutasi = DB::table('d_stock_mutation')
                        ->select('*')
                        ->where('sm_stock', '=', $s_id)
                        ->whereRaw('d_stock_mutation.sm_qty > d_stock_mutation.sm_qty_used')
                        //->where('sm_detail', '=', 'Pembelian')
                        ->orderBy('sm_date')
                        ->get();

                        //dd( $getBarang);


            $totalPermintaan = 35;
           
                    for ($k = 0; $k < count($getStockMutasi); $k++) {
                        $totalQty = $getStockMutasi[$k]->sm_qty_sisa;
                        if ($totalPermintaan <= $totalQty) {
                            $total[$k]['detailid'] = $getStockMutasi[$k]->sm_detailid;
                            $total[$k]['jumlah'] = $totalPermintaan;
                            $total[$k]['hpp'] = $getStockMutasi[$k]->sm_price;
                            $k = count($getStockMutasi);
                        } elseif ($totalPermintaan > $totalQty) {
                            $total[$k]['detailid'] = $getStockMutasi[$k]->sm_detailid;
                            $total[$k]['jumlah'] = $totalQty;
                            $total[$k]['hpp'] = $getStockMutasi[$k]->sm_price;
                            $totalPermintaan = $totalPermintaan - $totalQty;
                        }
                    }


dd($total);

   for ($l = 0; $l < count($total); $l++) {

    }
    /*    while ( $b!=0) {
            $d=d_stock_mutation::where('sm_qty_sisa','>',0);
            $si=$d->first()->sm_qty_sisa-$b;
            if($si>=0){
                $d->update([
                        'sm_qty_sisa'=>$si
                ]);
                $b=$d->first()->sm_qty_sisa-$b;
            }

            else if($si<0){
                $b-=$d->first()->sm_qty_sisa;
                    $d->update([
                        'sm_qty_sisa'=>$b-$d->first()->sm_qty_sisa
                    ]);
            }
            
            

        }*/
   
});
        
        
    }


}
