<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\d_transferItem;
use App\d_transferItemDt;
use DB;
use Validator;
use Carbon\Carbon;
use App\d_stock;
use App\d_stock_mutation;

class transferItemGrosirController extends Controller
{
    
    public function indexGrosir(){
        return view('transfer-grosir.index-grosir');
    }

    public function dataTransferAppr(){        
        $transferItem=d_transferItem::paginate();
        return view('transfer-grosir.table-transfer',compact('transferItem'));
    }
   
    public function grosirTransfer(){        
        $transferItem=d_transferItem::paginate();
        return view('transfer-grosir.grosir-transfer',compact('transferItem'));
    }
    public function approveTransfer($id){

        $transferItem=d_transferItem::where('ti_id',$id)->first();
        $transferItemDt=d_transferItemDt::
                        join('m_item','d_transferitem_dt.tidt_item','=','m_item.i_id')->
                        leftjoin('d_stock',function($join){
                        $join->on('i_id', '=', 's_item');        
                        $join->on('s_comp', '=', 's_position');                
                        $join->on('s_comp', '=',DB::raw("'3'"));           
                        })->  
                        where('tidt_id',$id)->get();
/*dd($transferItemDt);*/
        return view('transfer-grosir.approve-transfer',compact('transferItem','transferItemDt'));
    }

    public function simpanApprove(Request $request){
return DB::transaction(function () use ($request) {    
           
            $tglAppr='';
            $tglSend='';
            $ttlAppr=0;
            $ttlSend=0;
            $isAppr='N';
            $isSend='N';

            for ($i=0; $i <count($request->tidt_id) ; $i++) {                 
           	 $qtyAwal=0;
                if($request->qtyAppr[$i]!='' || $request->qtyAppr[$i]!='0' && $request->qtyAppr[$i]!='' || $request->qtyAppr[$i]!=null){
                        $tglAppr=date('Y-m-d g:i:s');
                        $ttlAppr++;
                        
                    }
                if($request->qtySend[$i]!='' || $request->qtySend[$i]!='0' && $request->qtySend[$i]!='' || $request->qtySend[$i]!=null){
                        $tglSend=date('Y-m-d g:i:s');
                        $ttlSend++;
                        
                    }
            
                $transferItemDt=d_transferItemDt::                        
                                where('tidt_id',$request->tidt_id[$i])->
                                where('tidt_detail',$request->tidt_detail[$i]);
                if($transferItemDt->first()){
                    $qtyAwal=$transferItemDt->first()->tidt_qty_send;
                }

                $transferItemDt->update([
                    'tidt_qty_appr'=>$request->qtyAppr[$i],
                    'tidt_apprtime'=>$tglAppr,
                    'tidt_qty_send'=>$request->qtySend[$i],
                    'tidt_sendtime'=>$tglSend,
                ]);


                //update qty grosir 3/3
                if($request->qtySend[$i]!='' && $request->qtySend[$i]!=0){
                $stockGrosir=d_stock::                        
                       where('s_item',$request->tidt_item[$i])->
                       where('s_comp',DB::raw('3'))->
                       where('s_position',DB::raw('3'))->
                       select('s_id', 's_comp', 's_qty');

                if($stockGrosir->first()){
                            $stockGrosir->update([
                                's_qty'=>($stockGrosir->first()->s_qty+$qtyAwal)-$request->qtySend[$i]
                            ]);
                    $s_id = $stockGrosir->first()->s_id;
                    $getStockMutasi = DB::table('d_stock_mutation')
                        ->select('*')
                        ->where('sm_stock', '=', $s_id)
                        ->whereRaw('d_stock_mutation.sm_qty > d_stock_mutation.sm_qty_used')
                        ->where('sm_mutcat', '=', '3')
                        ->orderBy('sm_date')
                        ->get();


                $totalPermintaan = $request->qtySend[$i];          
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
                        'sm_comp'     => 3,
                        'sm_position'     => 3,
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
            }

                /*else{
                            DB::rollback();
                            $data=['status'=>'Gagal','info'=>'Stok Tidak Mencukupi'];
                            return json_encode($data);
                }
*/


                //
              


  $stockRetailInGrosir=d_stock::                        
                       where('s_item',$request->tidt_item[$i])->
                       where('s_comp',DB::raw('11'))->
                       where('s_position',DB::raw('3'));
          
                    
                if($stockRetailInGrosir->first()){
                           $s_id = $stockRetailInGrosir->first()->s_id;
                            $stockRetailInGrosir->update([
                                's_qty'=>($stockRetailInGrosir->first()->s_qty-$qtyAwal)+$request->qtySend[$i]
                            ]);
                    }else{
                            $s_id=d_stock::max('s_id')+1;
                            d_stock::create([
                                    's_id'      =>$s_id,
                                    's_comp'    =>11,
                                    's_position' =>3,
                                    's_item'    =>$request->tidt_item[$i],
                                    's_qty'     =>$request->qtySend[$i],

                            ]);                            
                    }

    for ($l = 0; $l < count($total); $l++) {
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
                        'sm_detail'   => 'Transfer',
                        'sm_qty'      => $total[$l]['jumlah'],
                        'sm_qty_used'      => 0,
                        'sm_qty_sisa'      => $total[$l]['jumlah'],
                        'sm_price'    => $total[$l]['hpp'],                                                
                        'sm_reff'     => $request->ri_nomor,
                        'sm_mutcat'   =>3
                        
                    ]);

                 
}





                    }

                    if(count($request->tidt_id)==$ttlAppr){
                        $isAppr='Y';

                    }
                    if(count($request->tidt_id)==$ttlSend){
                        $isSend='Y';
                    }
                $transferItem=d_transferItem::where('ti_id',$request->tidt_id);

                $transferItem->update([
                            'ti_isapproved'=>$isAppr,
                            'ti_issent'=>$isSend
                                ]);
              

               $data=['status'=>'sukses'];
               return json_encode($data);
        });
            
           
    }


        public function simpanTransferGrosir(Request $request){
        return DB::transaction(function () use ($request) {
        $ti_id=d_transferItem::max('ti_id')+1;
        d_transferItem::create([
                    'ti_id'         =>$ti_id,
                    'ti_time'       =>date('Y-m-d',strtotime($request->tf_tanggal)), 
                    'ti_code'       =>$request->tf_nomor, 
                    'ti_order'      =>'GR',
                    //'ti_orderstaff'   =>,
                    'ti_note'       =>$request->tf_keterangan,
                    'ti_isapproved' =>'Y',
                    'ti_issent' =>'Y',
                    
        ]);
    
        for ($i=0; $i <count($request->kode_item) ; $i++) { 
                $tidt_id=d_transferItemDt::where('tidt_id',$ti_id)->max('tidt_detail')+1;
                 d_transferItemDt::create([
                    'tidt_id'           =>$ti_id,
                    'tidt_detail'       =>$tidt_id, 
                    'tidt_item'     =>$request->kode_item[$i], 
                    'tidt_qty'      =>$request->sd_qty[$i],


                    'tidt_qty_appr'=>$request->sd_qty[$i],
                    'tidt_apprtime'=>date('Y-m-d g:i:s'),
                    'tidt_qty_send'=>$request->sd_qty[$i],
                    'tidt_sendtime'=>date('Y-m-d g:i:s'),
                ]);



                  $stockGrosir=d_stock::                        
                       where('s_item',$request->kode_item[$i])->
                       where('s_comp',DB::raw('3'))->
                       where('s_position',DB::raw('3'));
                       $s_id='';
                if($stockGrosir->first()){
                            $stockGrosir->update([
                                's_qty'=>$stockGrosir->first()->s_qty-$request->sd_qty[$i]
                            ]);
                    $s_id=$stockGrosir->first()->s_id;
                }else{
                            DB::rollback();
                            $data=['status'=>'Gagal','info'=>'Stok Tidak Mencukupi'];
                            return json_encode($data);
                }


                 $getStockMutasi = DB::table('d_stock_mutation')
                        ->select('*')
                        ->where('sm_stock', '=', $s_id)
                        ->whereRaw('d_stock_mutation.sm_qty > d_stock_mutation.sm_qty_used')
                        ->where('sm_mutcat', '=', '3')
                        ->orderBy('sm_date')
                        ->get();


                 //stock 11/3
                $stockRetailInGrosir=d_stock::                        
                       where('s_item',$request->kode_item[$i])->
                       where('s_comp',DB::raw('11'))->
                       where('s_position',DB::raw('3'));
                       
                if($stockRetailInGrosir->first()){
                            $stockRetailInGrosir->update([
                                's_qty'=>$stockRetailInGrosir->first()->s_qty+$request->sd_qty[$i]
                            ]);
                    }else{
                            $s_id=d_stock::max('s_id');
                            d_stock::create([
                                    's_id'      =>$s_id+1,
                                    's_comp'    =>11,
                                    's_position' =>3,
                                    's_item'    =>$request->kode_item[$i],
                                    's_qty'     =>$request->sd_qty[$i],

                            ]);
                    }


        }

        $data=['status'=>'sukses'];     
        return json_encode($data);
       
    });
    }

     public function dataTransferGrosir(){        
        $transferItem=d_transferItem::where('ti_order','=','GR')->paginate();
        return view('transfer-grosir.data-transfer-grosir',compact('transferItem'));
    }

    public function EditTransferGrosir($id){
        $transferItem=d_transferItem::where('ti_id',$id)->first();
        $transferItemDt=d_transferItemDt::
                        join('m_item','d_transferitem_dt.tidt_item','=','m_item.i_id')->
                        where('tidt_id',$id)->get();
        return view('transfer-grosir.edit-transfer-grosir',compact('transferItem','transferItemDt'));
    }


      public function UpdateTransferGrosir(Request $request,$id){
        return DB::transaction(function () use ($request,$id) {
         $qtyAwal=0;
        $transferItem=d_transferItem::where('ti_id',$id);
        $transferItem->update([                                                                                
                    'ti_note'       =>$request->ri_keterangan,
        ]);
    
        for ($i=0; $i <count($request->kode_item) ; $i++) { 
            if($request->tidt_id[$i]==''){
                $tidt_id=d_transferItemDt::where('tidt_id',$id)->max('tidt_detail')+1;
                 d_transferItemDt::create([
                    'tidt_id'           =>$id,
                    'tidt_detail'       =>$tidt_id, 
                    'tidt_item'     =>$request->kode_item[$i], 
                    'tidt_qty'      =>$request->sd_qty[$i],

                    'tidt_qty_appr'=>$request->sd_qty[$i],
                    'tidt_apprtime'=>date('Y-m-d g:i:s'),
                    'tidt_qty_send'=>$request->sd_qty[$i],
                    'tidt_sendtime'=>date('Y-m-d g:i:s'),
                ]);
                 //stock 3/3
                $stockGrosir=d_stock::                        
                       where('s_item',$request->kode_item[$i])->
                       where('s_comp',DB::raw('3'))->
                       where('s_position',DB::raw('3'));

                if($stockGrosir->first()){
                            $stockGrosir->update([
                                's_qty'=>$stockGrosir->first()->s_qty-$request->qtySend[$i]
                            ]);
                }else{
                            DB::rollback();
                            $data=['status'=>'Gagal','info'=>'Stok Tidak Mencukupi'];
                            return json_encode($data);
                }



                 //stock 11/3
                $stockRetailInGrosir=d_stock::                        
                       where('s_item',$request->tidt_item[$i])->
                       where('s_comp',DB::raw('11'))->
                       where('s_position',DB::raw('3'));
                       
                if($stockRetailInGrosir->first()){
                            $stockRetailInGrosir->update([
                                's_qty'=>$stockRetailInGrosir->first()->s_qty+$request->qtySend[$i]
                            ]);
                    }else{
                            $s_id=d_stock::max('s_id');
                            d_stock::create([
                                    's_id'      =>$s_id+1,
                                    's_comp'    =>11,
                                    's_position' =>3,
                                    's_item'    =>$request->tidt_item[$i],
                                    's_qty'     =>$request->qtySend[$i],

                            ]);
                    }






            }else if($request->tidt_id[$i]!='') {
                $transferItemDt=d_transferItemDt::where('tidt_id',$id)->where('tidt_detail',$request->tidt_detail[$i]);
                if($transferItemDt->first()){
                    $qtyAwal=$transferItemDt->first()->tidt_qty_send;
                }
                 $transferItemDt->update([                                        
                    'tidt_qty'      =>$request->sd_qty[$i],
                    'tidt_qty_appr'=>$request->sd_qty[$i],
                    'tidt_apprtime'=>date('Y-m-d g:i:s'),
                    'tidt_qty_send'=>$request->sd_qty[$i],
                    'tidt_sendtime'=>date('Y-m-d g:i:s'),
                ]);


               
                  //stock 3/3
                $stockGrosir=d_stock::                        
                       where('s_item',$request->kode_item[$i])->
                       where('s_comp',DB::raw('3'))->
                       where('s_position',DB::raw('3'));

                if($stockGrosir->first()){
                            $stockGrosir->update([
                                's_qty'=>($stockGrosir->first()->s_qty+$qtyAwal)-$request->qtySend[$i]
                            ]);
                }else{
                            DB::rollback();
                            $data=['status'=>'Gagal','info'=>'Stok Tidak Mencukupi'];
                            return json_encode($data);
                }


                   //stock 11/3
                $stockRetailInGrosir=d_stock::                        
                       where('s_item',$request->tidt_item[$i])->
                       where('s_comp',DB::raw('11'))->
                       where('s_position',DB::raw('3'));
                       
                if($stockRetailInGrosir->first()){
                            $stockRetailInGrosir->update([
                                's_qty'=>($stockRetailInGrosir->first()->s_qty-$qtyAwal)+$request->qtySend[$i]
                            ]);
                    }else{
                            $s_id=d_stock::max('s_id');
                            d_stock::create([
                                    's_id'      =>$s_id+1,
                                    's_comp'    =>11,
                                    's_position' =>3,
                                    's_item'    =>$request->tidt_item[$i],
                                    's_qty'     =>$request->qtySend[$i],

                            ]);
                    }




            }
        }
/*dd($request->all());*/
        $data=['status'=>'sukses'];     
        return json_encode($data);
       
    });
    }

       public function HapusTransferGrosir($id){
        return DB::transaction(function () use ($id) {
             $transferItem=d_transferItem::where('ti_id',$id);             
             if($transferItem->first()->ti_isreceived=='Y'){
                    $data=['status'=>'Gagal','info'=>'Maaf, Transfer Item Telah di Terima'];
                    return json_encode($data);
             }else{
                  $transferItem->delete();
                  $data=['status'=>'sukses'];
                return json_encode($data);
             }
             
        });
    }

}
