@extends('main')
@section('content')
<style type="text/css">
  .ui-autocomplete { z-index:2147483647; }
</style>
            <!--BEGIN PAGE WRAPPER-->
<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
            <div class="page-title">Form Entri Penjualan Grosir/Online</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/home') }}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><i></i>&nbsp;Penjualan&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Form Entri Penjualan Grosir/Online</li>
        </ol>
        <div class="clearfix">
        </div>
    </div>

      <div class="page-content fadeInRight">
        <div id="tab-general">
            <div class="row mbl">
                <div class="col-lg-12">
                    
                  <div class="col-md-12">
                      <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                      </div>
                  </div>
                    
              <ul id="generalTab" class="nav nav-tabs">
                <li class="active"><a href="#alert-tab" data-toggle="tab">Form Penjualan</a></li>
                <li><a href="#note-tab" data-toggle="tab" onclick="showNote()">Nota Penjualan</a></li>
                <li><a href="#label-badge-tab" data-toggle="tab">Item Penjualan</a></li>
                <li><a href="#nav-stock" data-toggle="tab" onclick="stock()">Stock Grosir</a></li>
                
              </ul>
        <div id="generalTabContent" class="tab-content responsive">

<!-- Trigger the modal with a button -->
                

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">
                  
                  <form id="save_customer">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #e77c38;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: white;">Form Master Data Customer</h4>
                      </div>
                      <div class="modal-body">
                        
                  <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="margin-bottom: 20px; padding-bottom:5px;padding-top:20px; ">

                    <div class="col-md-4 col-sm-3 col-xs-12"> 
                  
                      <label class="tebal">ID Customer</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                            <input type="text" class="form-control input-sm" readonly="true" name="id_cus_ut" value="{{$id_cust}}">
                            <input type="hidden" name="id_cus_ut" value="{{$id_cust}}">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                        
                          <label class="tebal" name="nama_cus">Nama</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="glyphicon glyphicon-user"></i>
                          <input type="hidden" id="namahidden">
                          <input type="text" id="nama_cus" name="nama_cus" class="form-control input-sm"> 
                          @if ($errors->has('nama_cus'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_cus') }}</strong>
                            </span>
                          @endif      
                        </div>                           
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                          <label class="tebal">Tanggal Lahir</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="glyphicon glyphicon-calendar"></i>
                          <input maxlength="10" type="text" id="tgl_lahir" name="tgl_lahir" class="form-control input-sm datepicker2" value="01/01/1990"> 
                          @if ($errors->has('tgl_lahir'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tgl_lahir') }}</strong>
                            </span>
                          @endif     
                        </div>                            
                      </div>
                    </div>



                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                          <label class="tebal">E-mail</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="glyphicon glyphicon-envelope"></i>
                          <input type="email" id="email" name="email" class="form-control input-sm"  value="{{ old('email') }}">
                          @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                          @endif  
                        </div>                                
                      </div>
                    </div>

                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                          <label class="tebal">Tipe Customer</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        
                          <select name="tipe_cust" id="tipe_cust" class="form-control input-sm">
                            <option value="online">Online</option>
                            <option value="retail">retail</option>
                          </select>
                          @if ($errors->has('tipe_cust'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tipe_cust') }}</strong>
                            </span>
                          @endif  
                                                      
                      </div>
                    </div>
                    

                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                        
                          <label class="tebal">Nomor HP</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="glyphicon glyphicon-earphone"></i>
                          <input type="text" id="no_hp" name="no_hp" class="form-control input-sm"  value="{{ old('no_hp') }}">
                          @if ($errors->has('no_hp'))
                            <span class="help-block">
                                <strong>{{ $errors->first('no_hp') }}</strong>
                            </span>
                          @endif   
                        </div>                               
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                        
                          <label class="tebal">Alamat</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="glyphicon glyphicon-home"></i>
                          <textarea id="alamat" name="alamat" class="form-control input-sm"  value="{{ old('alamat') }}"></textarea>

                          @if ($errors->has('alamat'))
                            <span class="help-block">
                                <strong>{{ $errors->first('alamat') }}</strong>
                            </span>
                          @endif                              
                        </div>    
                      </div>
                    </div>
                </div>
                  </div>
                  
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger simpanCus" type="button" onclick="simpan()">Simpan Data</button>
                      </div>
                    </div>
            </form>   
                  </div>
                </div>
@if($ket == 'create')

  <!-- div alert-tab -->
  <div id="alert-tab" class="tab-pane fade in active">
    
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="padding-bottom: 25px;padding-top: 5px;">
          <form id="save_sform">
                        <div class="col-md-9 col-sm-6 col-xs-12" style="margin-top: 15px;">
                          
                            <label class="control-label tebal" for="nama" >Nama Customer</label>
                           
                              <div class="input-group input-group-sm" style="width: 100%;">
                                <input type="text" id="nama" name="s_member" class="form-control" onkeyup="setnama()">

                                <input type="hidden" id="id_cus" name="id_cus" class="form-control">                                   
                                <span class="input-group-btn"><button  type="button" class="btn btn-info btn-sm btn_simpan" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button></span>
                               
                              </div>
                          
                        </div>


                        <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 15px;">
                          
                            <label for="tgl_faktur" class="control-label tebal">Tanggal Faktur</label>
                            
                              <div class="input-group input-group-sm" style="width: 100%;">
                                <input id="tgl_faktur" type="text" name="s_date" class="form-control" readonly="readonly" value="{{ date('d-m-Y') }}">
                              </div>
                         
                        </div>

                        <div class="col-md-9 col-sm-6 col-xs-12" style="margin-top: 15px;">
                          
                           <label class="control-label tebal" for="alamat">Alamat Customer</label>
                            
                              <div class="input-group input-group-sm" style="width: 100%;">
                                <input type="text" id="alamat2" name="sm_alamat" class="form-control">  
                              </div>
                        </div>

                      
                        <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 15px;">
                            
                           <label class="control-label tebal" for="no_faktur" >Nomor Faktur</label>
                           
                            <div class="input-group input-group-sm" style="width: 100%;">
                              <input type="text" id="no_faktur" name="s_nota" class="form-control" readonly="true" value="{{$fatkur}}">
                            </div>
                          
                        </div>
          </form>
        </div>
      </div>
    
     <div class="col-md-12 col-sm-12 col-xs-12">      
            <div style="padding-top: 10px;padding-bottom: 10px;">     
              
              @include('penjualan.POSgrosir.item')

            </div>
      </div> 
      
  <form id="save_item">                     
  <div class="col-md-12 col-sm-12 col-xs-12">

         <div class="col-md-3 col-md-offset-9 col-sm-6 col-sm-offset-6 col-xs-12 tamma-bg" style="margin-bottom: 20px; padding-bottom:5px;padding-top: 10px;">
          <div class="col-md-12 col-sm-12 col-xs-12 ">
              
                <div class="form-group">
                    <label class="control-label tebal" for="penjualan">Total Penjualan</label>
                  <div class="input-group input-group-sm" style="width: 100%;">
                    <input type="text" name="s_gross" readonly="true" id="totalMapPenjualan" class="form-control" style="text-align: right;" value="0">
                  </div>
                </div>


                    <input type="hidden" name="s_disc_percent" readonly="true" id="" class="form-control TotDisPercent totalPercentValue" style="text-align: right;" value="0">
             
                    <input type="hidden" name="s_disc_value" readonly="true" id="" class="form-control TotDisValue i_priceValue totalPercentValue" style="text-align: right;" value="0" onkeyup="rege(event,'i_priceValue');" onblur="setRupiah(event,'i_priceValue')" onclick="setAwal('event','i_priceValue')">


                <div class="form-group">
                    <label class="control-label tebal" for="discount">Total Discount</label>
                  <div class="input-group input-group-sm" style="width: 100%;">
                    <input type="text" name="totalDiscount" readonly="true" id="Total_Discount" class="form-control totalPenjualan" style="text-align: right;" value="0">
                  </div>
                </div>
                <div class="form-group" type="hidden">
                    <label class="control-label tebal" for="penjualan">PPN</label>
                  <div class="input-group input-group-sm" style="width: 100%;">
                    <input type="text" type="hidden" name="s_pajak" readonly="true" class="form-control" style="text-align: right;" value="0">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label tebal" for="discount">Total Amount</label>
                  <div class="input-group input-group-sm " style="width: 100%;">
                      <input type="text" name="s_net" readonly="true" id="total" class="form-control totalAmount totalPenjualan" style="text-align: right;"  value="0">
                  </div>
                </div>                              
          </div>
          </div>
        </div>
         <!-- Start Modal Proses -->
         @include('penjualan.POSgrosir.modal_status')
            <!-- End Modal Proses -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <button style="float: left" class="btn btn-warning simpanDraft" type="button" onclick="sal_save_draft()">Draft</button>&nbsp;&nbsp;    
                <button  class="btn btn-info simpanProgres" data-toggle="modal" data-target="#prosesProgres" type="button" onclick="sal_save_onProgres()">On Progress</button>
                <button style="float: right" class="btn btn-primary" type="button" data-toggle="modal" data-target="#proses">Submit</button>
              </div>
      </form>   
      </div>                                       
    </div>
@else
    <div id="alert-tab" class="tab-pane fade in active">

      <div id="alert-tab" class="tab-pane fade in active">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="padding-bottom: 25px;padding-top: 5px;">
          <form id="save_sform">
                        <div class="col-md-9 col-sm-6 col-xs-12" style="margin-top: 15px;">
                          
                            <label class="control-label tebal" for="nama" >Nama Customer</label>
                           
                              <div class="input-group input-group-sm" style="width: 100%;">
                                <input type="text" id="nama" name="s_member" class="form-control" onkeyup="setnama()" value="{{$edit[0]->c_name}}">

                                <input type="hidden" id="id_cus" name="id_cus" class="form-control" value="{{$edit[0]->s_customer}}">
                                <input type="hidden" id="sd_id" name="sd_id" class="form-control" value="{{$edit[0]->sd_id}}">                                   
                                <span class="input-group-btn"><button  type="button" class="btn btn-info btn-sm btn_simpan" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button></span>
                               
                              </div>
                          
                        </div>


                        <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 15px;">
                          
                            <label for="tgl_faktur" class="control-label tebal">Tanggal Faktur</label>
                            
                              <div class="input-group input-group-sm" style="width: 100%;">
                                <input id="tgl_faktur" type="text" name="s_date" class="form-control" readonly="readonly" value="{{ date('d-m-Y') }}">
                              </div>
                         
                        </div>

                        <div class="col-md-9 col-sm-6 col-xs-12" style="margin-top: 15px;">
                          
                           <label class="control-label tebal" for="alamat">Alamat Customer</label>
                            
                              <div class="input-group input-group-sm" style="width: 100%;">
                                <input type="text" id="alamat2" name="sm_alamat" class="form-control" value="{{$edit[0]->c_address}}  {{$edit[0]->c_hp}}">  
                              </div>
                        </div>

                      
                        <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 15px;">
                            
                           <label class="control-label tebal" for="no_faktur" >Nomor Faktur</label>
                           
                            <div class="input-group input-group-sm" style="width: 100%;">
                              <input type="text" id="no_faktur" name="s_nota" class="form-control" readonly="true" value="{{$edit[0]->s_note}}">
                            </div>
                          
                        </div>

                        <div class="col-md-3 col-md-offset-9 col-sm-12 col-xs-12" style="margin-top: 15px;">
                          
                            <label class="control-label tebal" for="total_amount">Total Amount</label>
                           
                              <div class="input-group input-group-sm" style="width: 100%;">
                                <input type="text" class="form-control" readonly="true" name="s_net"  id="amount">
                                <input type="hidden" name="s_staff" value="{{ Auth::user()->m_id}}" >
                              </div>
                        </div>     
          </form>
        </div>
      </div>
    
     <div class="col-md-12 col-sm-12 col-xs-12">      
            <div style="padding-top: 10px;padding-bottom: 10px;">     
              
              @include('penjualan.POSretail.item_edit')

            </div>
      </div>  
    
    <form id="save_item">              
        <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="col-md-3 col-md-offset-9 col-sm-6 col-sm-offset-6 col-xs-12 tamma-bg" style="margin-bottom: 20px; padding-bottom:5px;padding-top: 10px;">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                
                <div class="form-group">
                    <label class="control-label tebal" for="penjualan">Total Penjualan</label>
                  <div class="input-group input-group-sm " style="width: 100%;">
                      <input type="text" name="s_gros" readonly="true" id="total" class="form-control total" style="text-align: right;" value="Rp. {{ number_format( $edit[0]->s_net ,2,',','.')}}">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label tebal" for="discount">Total Discount</label>
                  <div class="input-group input-group-sm" style="width: 100%;">
                    <input type="text" name="s_disc_value" readonly="true" class="form-control" style="text-align: right;" value="Rp. {{ number_format( $edit[0]->s_disc_value ,2,',','.')}}">
                  </div>
                </div>
                <div class="form-group" type="hidden">
                    <label class="control-label tebal" for="penjualan">PPN</label>
                  <div class="input-group input-group-sm" style="width: 100%;">
                    <input type="text" type="hidden" name="s_pajak" readonly="true" class="form-control" style="text-align: right;" value="0">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label tebal" for="discount">Total Amount</label>
                  <div class="input-group input-group-sm " style="width: 100%;">
                      <input type="text" name="s_net" readonly="true" id="total" class="form-control totalAmount" style="text-align: right;"  value="Rp. {{ number_format( $edit[0]->s_net ,2,',','.')}}">
                  </div>
                </div>                                 
            </div>
            </div>
          </div>
           <!-- Start Modal Proses -->
            <div class="modal fade" id="proses" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: #e77c38;">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" style="color: white;">Proses Form Penjualan Retail</h4>
                        </div>

           <div class="modal-body">
            
            <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="margin-bottom: 20px; padding-bottom:15px;padding-top:15px; ">

              <table class="table">
                <tbody>
                  <tr>
                    <td>Proses</td>
                    <td>
                      <input type="text" name="s_net" readonly="true" id="totalPayment" 
                      class="form-control total" style="text-align: right;" value="0">
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="table" id="tablePayment">
                <tbody class="mc">
                  <tr>
                    <td>
                        <select class="form-control">
                          @foreach ($dataPayment as $data)
                            <option value="{{ $data->pm_id }}">{{ $data->pm_name }}</option>
                          @endforeach
                      </select>
                    </td>
                    <td>
                      <input type="text" name="s_dibayarkan" id="bayar" value="" class="i_price form-control total bandingPayment" style="text-align: right;" onkeyup="rege(event,'i_price');" onblur="setRupiah(event,'i_price')" onclick="setAwal('event','i_price')" >
                    </td>
                    <td>
                     <button type="button" class="btn btn-info" onclick="tambahPayment()"><i class="glyphicon glyphicon-plus"></i></button> <button type="button" class="btn btn-danger hapus" disabled ><i class="glyphicon glyphicon-minus"></i></button>
                    </td>
                  </tr>
                  </tbody>
              </table>
              <table class="table">
                <tbody>
                  <tr>
                    <td>Total Pembayaran</td>
                    <td>
                      <input type="text" readonly="true" class="form-control" id="totPembayaran" style="text-align: right;" 
                      value="0">
                    </td>
                  </tr>
                  <tr>
                    <td>Kembalian</td>
                    <td>
                      <input type="text" name="s_kembalian" value="0" id="kembalian" readonly="true" class="form-control kemblaian" style="text-align: right;">
                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
                    
                        <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                          <button class="btn btn-primary ladda-button" data-style="zoom-in" type="button" onclick="sal_save_finalUpdate()">
                            <span class="ladda-label">Proses</span></button>
                        </div>
                      </div>
                  </div>
              </div>
            <!-- End Modal Proses -->
              <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                 <button style="float: left" class="btn btn-info" type="button" onclick="sal_save_onProgresUpdate()">On Progress</button>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#proses">Submit</button>
              </div>
        </form>   
        </div>                                       
      </div>
    </div>
@endif                           
                          <!-- div note-tab -->
                          <div id="note-tab" class="tab-pane fade">
                            <div class="row">
                              <div class="panel-body" style="padding-top: -30px; margin-top: -30px">
                                <div id="note-show">
                                
                                  <div class="col-md-2 col-sm-3 col-xs-12">
                                    <label class="tebal">Tanggal Belanja</label>
                                  </div>

                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <div class="input-daterange input-group">
                                        <input id="tanggal1" class="form-control input-sm datepicker1 " name="tanggal" type="text"{{--  value="{{ date('d-m-Y') }}" --}}>
                                        <span class="input-group-addon">-</span>
                                        <input id="tanggal2" class="input-sm form-control datepicker2" name="tanggal" type="text" value="{{ date('d-m-Y') }}">
                                      </div>
                                    </div>
                                  </div>
      
                                  <div class="col-md-3 col-sm-3 col-xs-12" align="center">
                                    <button class="btn btn-primary btn-sm btn-flat autoCari" type="button"  onclick="cariTanggal()">
                                      <strong>
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                      </strong>
                                    </button>
                                    <button class="btn btn-info btn-sm btn-flat" type="button">
                                      <strong>
                                        <i class="fa fa-undo" aria-hidden="true"></i>
                                      </strong>
                                    </button>
                                  </div>

                                <div class="col-md-3 col-sm-3 col-xs-12" align="right">
                                    <button class="btn btn-info btn-sm btn-flat" onclick="showHistory()">
                                      <strong>
                                        <i class="fa fa-history" aria-hidden="true"></i>
                                      </strong>
                                    </button>
                                  </div>

                                  <div class="table-responsive" style="padding-top: 15px;">
                                    <div id="dt_nota_jual">

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End DIv note-tab -->

                          <!-- Modal Detail Nota -->     
                                        <div class="modal fade" id="myItem" role="dialog">
                                          <div class="modal-dialog modal-lg" style="width: 90%;margin-left: auto;margin-top: 30px;">
                                          
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header" style="background-color: #e77c38;">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"  style="color: white;">Nama Item</h4>
                                                
                                              </div>
                                              <div class="modal-body">
                                                <div id="detailNota">
                                                  
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                            
                                          </div>
                                        </div>
                            <!-- End Modal Detail Nota -->

                          <!-- Modal Detail Nota -->     
                                        <div class="modal fade" id="modalStatus" role="dialog">
                                          <div class="modal-dialog" style="width: 300px;">
                                          
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header" style="background-color: #e77c38;">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"  style="color: white;">Pilih untuk Merubah Status</h4>
                                                
                                              </div>
                                              <div class="modal-body">
                                                <div id="ubahStatusSales">
                                                  
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="saveStatus()">Simpan</button>
                                              </div>
                                            </div>
                                            
                                          </div>
                                        </div>
                            <!-- End Modal Detail Nota -->
        
                         <!-- div label-badge-tab -->
                          <div id="label-badge-tab" class="tab-pane fade">
                            <div class="row">
                              <div class="panel-body">

                                  <div class="col-md-2 col-sm-3 col-xs-12">
                                    <label class="tebal">Tanggal Belanja</label>
                                  </div>

                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <div class="input-daterange input-group">
                                        <input id="tanggal3" class="form-control input-sm datepicker1" name="tanggal" type="text" {{-- value="{{ date('d-m-Y') }} --}}">
                                        <span class="input-group-addon">-</span>
                                        <input id="tanggal4" class="input-sm form-control datepicker2" name="tanggal" type="text" value="{{ date('d-m-Y') }}">
                                      </div>
                                    </div>
                                  </div>
                                

                                  <div class="col-md-3 col-sm-3 col-xs-12" align="center">
                                    <button class="btn btn-primary btn-sm btn-flat autoCari" type="button" onclick="cariTanggalJual()">
                                      <strong>
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                      </strong>
                                    </button>
                                    <button class="btn btn-info btn-sm btn-flat" type="button">
                                      <strong>
                                        <i class="fa fa-undo" aria-hidden="true"></i>
                                      </strong>
                                    </button>
                                  </div>

                                <div class="table-responsive">
                                  <div id="Data_Jual">
                                  {{-- table Data Jual --}}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                           <!--end div label-badge-tab -->

                           @include('penjualan.POSgrosir.StokGrosir.stock')
                  </div>
        </div>
        <!-- End div generalTab -->
      </div>
    </div>
  </div>
</div>           

@endsection
@section("extra_scripts")

    <script src="{{ asset ('assets/script/bootstrap-datepicker.js') }}"></script>
{{--     <script src="{{ asset ('assets/js/jquery.maskMoney.js') }}"></script> --}}
    <script type="text/javascript">
    
          //mas shomad
        //handle modal edit stock Retail
$(document).on('click','.fa-edit',function(){
var stock = $(this).data('stock'),
      name = $(this).data('name'),
      id = $(this).data('id');
      harga = $(this).data('harga');
          
      $(".s_qty").val(stock);
      $(".i_name").val(name);
      $(".i_id").val(id);
      $(".harga").val(harga);

  });
  //handle

totalPenjualan();
function totalPenjualan(){
  var inputs = document.getElementsByClassName( 'totalPenjualan' ),
  hasil  = [].map.call(inputs, function( input ) {
      if(input.value == '') input.value = 0;
      return input.value;
  });
  console.log(hasil);
  var total = 0;
  for (var i = hasil.length - 1; i >= 0; i--){

    hasil[i] = convertToAngka(hasil[i]);
    hasil[i] = parseInt(hasil[i]);
    total = total + hasil[i];
  }
    if (isNaN(total)) {
        total=0;
      }
  total = convertToRupiah(total);
  // console.log(total);
  $('#totalMapPenjualan').val(total);
}

 // $('.btn').removeAttr('disabled','disabled');
 // $('.btn').attr('disabled','disabled');
  
$(document).ready(function(){ 
    $('.autoCari').trigger('click'); 
  });

var tableDetail;

  tableDetail=$('#detail-penjualan').DataTable();
  tableReq=$('#detail-req').DataTable();

var datatabel1;
    $(document).ready(function() {
var extensions = {
       "sFilterInput": "form-control input-sm",
      "sLengthSelect": "form-control input-sm"
  }
  // Used when bJQueryUI is false
  $.extend($.fn.dataTableExt.oStdClasses, extensions);
  // Used when bJQueryUI is true

    $.extend($.fn.dataTableExt.oJUIClasses, extensions);
    datatabel1 = $('#data-penjualan').DataTable({
          "responsive":true,

        "pageLength": 10,
        "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
        "language": {
            "searchPlaceholder": "Cari Data",
            "emptyTable": "Tidak ada data",
            "sInfo": "Menampilkan _START_ - _END_ Dari _TOTAL_ Data",
            "sSearch": '<i class="fa fa-search"></i>',
            "sLengthMenu": "Menampilkan &nbsp; _MENU_ &nbsp; Data",
            "infoEmpty": "",
            "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya",
                 }
          }

        });

    $('#data2').dataTable({
          "responsive":true,

          "pageLength": 10,
        "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
        "language": {
            "searchPlaceholder": "Cari Data",
            "emptyTable": "Tidak ada data",
            "sInfo": "Menampilkan _START_ - _END_ Dari _TOTAL_ Data",
            "sSearch": '<i class="fa fa-search"></i>',
            "sLengthMenu": "Menampilkan &nbsp; _MENU_ &nbsp; Data",
            "infoEmpty": "",
            "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya",
                 }
          }
        });
    });

  var date = new Date();
  var newdate = new Date(date);

  newdate.setDate(newdate.getDate()-3);
  var nd = new Date(newdate);

       
      $('.datepicker').datepicker({
        format: "mm",
        viewMode: "months",
        minViewMode: "months"
      });
      $('.datepicker1').datepicker({
        autoclose: true,
        format:"dd-mm-yyyy",
        endDate: 'today'
      }).datepicker("setDate", nd);
      $('.datepicker2').datepicker({
        autoclose: true,
        format:"dd-mm-yyyy",
        endDate: 'today'
      });//.datepicker("setDate", "0"); 

function simpan(){
      $('.simpanCus').attr('disabled','disabled');
      var a = $('#save_customer').serialize();
      $.ajax({
        url : baseUrl + "/penjualan/POSgrosir/grosir/store",
        type: 'get',
        data: a,
        success:function(response){
          $('#myModal').modal('hide');
            $("input[name='nama_cus']").val('');
            $("input[name='tgl_lahir']").val('');
            $("input[name='email']").val('');
            $("input[name='tipe_cust']").val('');
            $("input[name='no_hp']").val('');
            $("textarea[name='alamat']").val('');
            alert('Data Tersimpan');
        }
      })
    }

    $("input[name='s_member']").focus();

function sal_save_final(){
   $('.simpanFinal').attr('disabled','disabled');
  var bb = $('#save_sform :input').serialize();
  var cc = $('#save_item :input').serialize();
  var data=tableDetail.$('input').serialize();
  $.ajax({
    url : baseUrl + "/penjualan/POSgrosir/grosir/sal_save_final",
    type: 'get',
    data: bb+'&'+cc+'&'+data,

    success:function(response){
    $('#proses').modal('hide');
      $("input[name='s_member']").val('');
      $("input[name='s_net']").val('');
      $("input[name='s_disc_percent']").val('');
      $("input[name='s_disc_value']").val('');
      $("input[name='s_pajak']").val('');
      $("input[name='s_net']").val('');
      $("input[name='sd_qty[]']").val('');
      $("input[name='sd_sell[]']").val('');
      $("input[name='s_dibayarkan']").val('');
      $("input[name='s_kembalian']").val('');
      $("input[name='sd_disc_percent[]']").val('');
      $("input[name='sd_disc_value[]']").val('');
      $("input[name='sp_method[]']").val('');
      $("input[name='sp_nominal[]']").val('');
      alert('Berhasil');
      window.location.reload();
      } 
    })
  }

function sal_save_onProgres(){
   $('.simpanProgres').attr('disabled','disabled');
  var bb = $('#save_sform :input').serialize();
  var cc = $('#save_item :input').serialize();
  var data=tableDetail.$('input').serialize();
  $.ajax({
    url : baseUrl + "/penjualan/POSgrosir/grosir/sal_save_onprogres",
    type: 'get',
    data: bb+'&'+cc+'&'+data,
    success:function(response){
      $('#proses').modal('hide');
      $("input[name='s_member']").val('');
      $("input[name='s_net']").val('');
      $("input[name='s_pajak']").val('');
      $("input[name='s_net']").val('');
      $("input[name='sd_qty[]']").val('');
      $("input[name='sd_sell[]']").val('');
      $("input[name='sd_disc_percent[]']").val('');
      $("input[name='sd_disc_value[]']").val('');
      alert('Berhasil Menyimpan On_Progres');
      window.location.reload();
      }         
  })
}

function sal_save_draft(){
    $('.simpanDraft').attr('disabled','disabled');   
    var bb = $('#save_sform :input').serialize();
    var cc = $('#save_item :input').serialize();
    var data=tableDetail.$('input').serialize();
    $.ajax({
      url : baseUrl + "/penjualan/POSgrosir/grosir/sal_save_draft",
      type: 'get',
      data: bb+'&'+cc+'&'+data,
      success:function(response){
        $("input[name='id_cus']").val('');
        $("input[name='s_gross']").val('');
        $("input[name='s_net']").val('');
        $("input[name='totalDiscount']").val('');
        $("input[name='s_disc_percent']").val('');
        $("input[name='s_disc_value']").val('');
        $("input[name='s_pajak']").val('');
        $("input[name='sd_qty[]']").val('');
        $("input[name='sd_sell[]']").val('');
        $("input[name='s_pembayaran[]']").val('');
        $("input[name='s_dibayarkan']").val('');
        $("input[name='s_kembalian']").val('');
        $("input[name='sd_disc_percent[]']").val('');
        $("input[name='sd_disc_value[]']").val('');
        alert('di simpan sebagai draft');
        window.location.reload();
      }
    })
  }

function sal_save_finalUpdate(){
    var bb = $('#save_sform :input').serialize();
    var cc = $('#save_item :input').serialize();
    var data=tableDetail.$('input').serialize();
    $.ajax({
      url : baseUrl + "/penjualan/POSgrosir/grosir/sal_save_finalupdate",
      type: 'get',
      data: bb+'&'+cc+'&'+data,

      success:function(response){
        $('#proses').modal('hide');
          $("input[name='s_member']").val('');
          $("input[name='s_gross']").val('');
          $("input[name='s_disc_percent']").val('');
          $("input[name='s_disc_value']").val('');
          $("input[name='s_pajak']").val('');
          $("input[name='s_net']").val('');
          $("input[name='sd_qty[]']").val('');
          $("input[name='sd_sell[]']").val('');
          $("input[name='s_pembayaran[]']").val('');
          $("input[name='s_dibayarkan']").val('');
          $("input[name='s_kembalian']").val('');
          $("input[name='sd_disc_percent[]']").val('');
          $("input[name='sd_disc_value[]']").val('');
          alert('Berhasil');
          window.location.href = "/tammafood/penjualan/POSgrosir/index";
          }         
    })
  }  

function sal_save_onProgresUpdate(){
    var bb = $('#save_sform :input').serialize();
    var cc = $('#save_item :input').serialize();
    var data=tableDetail.$('input').serialize();
    $.ajax({
      url : baseUrl + "/penjualan/POSgrosir/grosir/sal_save_onProgresUpdate",
      type: 'get',
      data: bb+'&'+cc+'&'+data,

      success:function(response){
        $('#proses').modal('hide');
          $("input[name='s_member']").val('');
          $("input[name='s_gross']").val('');
          $("input[name='s_disc_percent']").val('');
          $("input[name='s_disc_value']").val('');
          $("input[name='s_pajak']").val('');
          $("input[name='s_net']").val('');
          $("input[name='sd_qty[]']").val('');
          $("input[name='sd_sell[]']").val('');
          $("input[name='s_pembayaran[]']").val('');
          $("input[name='s_dibayarkan']").val('');
          $("input[name='s_kembalian']").val('');
          $("input[name='sd_disc_percent[]']").val('');
          $("input[name='sd_disc_value[]']").val('');
          alert('Berhasil');
          window.location.href = "/tammafood/penjualan/POSgrosir/index";
          }         
    })
  }

function lihatDetail(idDetail){
     $.ajax({
      url : baseUrl + "/penjualan/POSgrosir/getdata",
      type: 'get',
      data: {x:idDetail},
      success:function(response){
        $('#detailNota').html(response);
      }
    });   
  }

// function ubahStatus(idDetail){
//      $.ajax({
//       url : baseUrl + "/penjualan/POSgrosir/ubahstatus",
//       type: 'get',
//       data: {status:idDetail},
//       success:function(response){
//         $('#ubahStatusSales').html(response);
//       }
//     });   
//   }

    // customer 
$( "#nama" ).autocomplete({
  source: baseUrl+'/penjualan/POSgrosir/grosir/autocomplete',
  minLength: 1,
  select: function(event, ui) 
  {
  $('#id_cus').val(ui.item.id);
  // $('#namahidden').val(ui.item.id);
  $('#nama').val(ui.item.label);
  $('#alamat2').val(ui.item.alamat);
  $("input[name='item']").focus();
  }
});


     //namaitem

$( "#namaitem" ).autocomplete({
  source: baseUrl+'/penjualan/POSgrosir/grosir/autocompleteitem',
  minLength: 1,
  select: function(event, ui) 
  {
  $('#harga').val(ui.item.harga);
  $('#kode').val(ui.item.kode);
  $('#detailnama').val(ui.item.nama);
  $('#namaitem').val(ui.item.label);
  $('#satuan').val(ui.item.satuan);
  $('#s_qty').val(ui.item.s_qty);

  $('#qty').val(ui.item.qty);
  $('#qty').val('1');
  $("input[name='qty']").focus();
  }
});

function UpdateHarga(kode){
  var qty = $('.qty-'+kode).val();
  var harga = $('.harga-'+kode).val();
  console.log(harga);
  var hasil = convertToAngka(harga);
  console.log(hasil);
  hasil = hasil * qty;
  var hasilRp = convertToRupiah(hasil);
  $('.hasil-'+kode).val(hasilRp);
  console.log(hasilRp);
  UpdateTotal();
  // UpdateDiscont();
} 

@if ($ket == 'create') 
var index=0;
var tamp=[];
function tambah() { 
  var kode  =$('#kode').val();      
  var nama  =$('#detailnama').val();             
  var harga =SetFormRupiah($('#harga').val());  
  var y     =($('#harga').val());          
  var qty   =parseInt($('#qty').val());
  var satuan=$('#satuan').val();
  var hasil = parseFloat(qty * y).toFixed(2);
  var x = SetFormRupiah(hasil);
  var b = angkaDesimal(x);
  var stok = $('#s_qty').val();
  var pricevalue ='pricevalue-'+kode+'';
  var event ='event';
  var Hapus = '<button type="button" class="btn btn-danger hapus" onclick="hapus(this)"><i class="fa fa-trash-o"></i></button>';
  var index = tamp.indexOf(kode);

  if ( index == -1){         
    tableDetail.row.add([
      
      nama+'<input type="hidden" name="kode_item[]" class="kode_item kode" value="'+kode+'"><input type="hidden" name="nama_item[]" class="nama_item" value="'+nama+'"> ',
      '<input size="30" style="text-align:right" type="text"  name="sd_qty[]" class="sd_qty form-control qty-'+kode+'" value="'+qty+'" onkeyup="UpdateHarga(\''+kode+'\'); qtyInput(\''+stok+'\', \''+kode+'\'); totalPenjualan()" onchange="qtyInput(\''+stok+'\', \''+kode+'\')"> ',
      satuan+'<input type="hidden" name="satuan[]" class="satuan" value="'+satuan+'"> ',
      '<input type="text" size="10" readonly style="text-align:right" name="harga_item[]" class="harga_item form-control harga-'+kode+'" value="'+harga+'"> ',
      '<div class="input-group"><input type="text" size="11"  style="text-align:right" name="sd_disc_percent[]" class="form-control discpercent hasildiscpercent" value="0" onkeyup="discpercent(this, event);autoJumValPercent()"><span class="input-group-addon">%</span></div> <input name="totalValuePercent[]" type="text" value="0" style="display:none" class="form-control totalValuePercent jumTotValuePercent">',
      '<input type="text" size="10"  id="discmasmoney" style="text-align:right" name="sd_disc_value[]" class="form-control discvalue hasildiscvalue pricevalue-'+kode+'" value="0" onkeyup="discvalue(this, event);autoJumValValue();rege(event,\''+pricevalue+'\')"  onblur="setRupiah(event,\''+pricevalue+'\')" onclick="setAwal(\''+event+'\',\''+pricevalue+'\')" >',
      '<input type="text" size="200" readonly style="text-align:right" name="hasil[]" id="hasil" class="form-control hasil hasil-'+kode+'" value="'+x+'"><input type="hidden" size="200" readonly style="text-align:right" name="" id="hasil2" class="hasil2 form-control" value="'+b+'">',          
      Hapus
      ]);
    tableDetail.draw();
    totalPenjualan();
  index++;
  tamp.push(kode);
      }else{
      var qtyLawas= parseInt($(".qty-"+kode).val());
      $(".qty-"+kode).val(qtyLawas+qty);
      var q = parseInt(qtyLawas+qty);
      var l = parseFloat(q * y).toFixed(2);;
      var k = SetFormRupiah(l);
      $(".hasil-"+kode).val(k);
      }

      $(function(){
      var values = $("input[name='sd_qty[]']")
      .map(function(){return $(this).val();}).get();
      });

      UpdateTotal();
      // UpdateDiscont();
      UpdateSubTotal();
      autoJumValPercent();
  }
    $('#qty').keypress(function(e){
        var charCode;
        if ((e.which && e.which == 13)) {
          charCode = e.which;
        }else if (window.event) {
            e = window.event;
            charCode = e.keyCode;
        }
        if ((e.which && e.which == 13)){
          var isi   = $('#qty').val();
          var jumlah= $('#detailnama').val();
          var stok  = $('#s_qty').val();
          if(isi == '' || jumlah == '' || stok == ''){
            toastr.warning('Item Jumlah Stok tidak boleh kosong');
            return false;
        }
          tambah();
          $("input[name='item']").val('');
          $("input[name='s_qty']").val('');
          $("input[name='qty']").val('');
          $("input[name='item']").focus(); 
             return false;

        }
     });

@else
$("input[name='item']").focus();
var index=0;
var tamp=[];
function tambahEdit() { 
  var kode  =$('#kode').val();      
  var nama  =$('#detailnama').val();             
  var harga =SetFormRupiah($('#harga').val());  
  var y     =($('#harga').val());          
  var qty   =parseInt($('#qty').val());
  var satuan=$('#satuan').val();
  var hasil = parseFloat(qty * y).toFixed(2);
  var x = SetFormRupiah(hasil);
  var b = angkaDesimal(x);
  var stok = $('#s_qty').val();
  var Hapus = '<button type="button" class="btn btn-danger hapus" onclick="hapus(this)"><i class="fa fa-trash-o"></i></button>';
  var index = tamp.indexOf(kode);

  if ( index == -1){         
    tableDetail.row.add([
        '<input type="hidden" name="sd_sales[]" class="kode_item kode" >'+
        '<input type="hidden" name="sd_detailid[]" class="kode_item kode" >'+
      nama+'<input type="hidden" name="kode_item[]" class="kode_item kode" value="'+kode+'"><input type="hidden" name="nama_item[]" class="nama_item" value="'+nama+'"> ',
      '<input size="30" style="text-align:right" type="number"  name="sd_qty[]" class="sd_qty form-control qty-'+kode+'" value="'+qty+'" onkeyup="UpdateHarga(\''+kode+'\'); qtyInput(\''+stok+'\', \''+kode+'\')" onchange="qtyInput(\''+stok+'\', \''+kode+'\')">',
      satuan+'<input type="hidden" name="satuan[]" class="satuan" value="'+satuan+'"> ',
      '<input type="text" size="10" readonly style="text-align:right" name="harga_item[]" class="harga_item form-control harga-'+kode+'" value="'+harga+'">',
      '<div class="input-group"><input type="text" size="11"  style="text-align:right" name="sd_disc_percent[]" class="form-control discpercent" value="" onkeyup="discpercent(this, event)"><span class="input-group-addon">%</span></div> ',
      '<input type="text" size="10"  style="text-align:right" name="sd_disc_percent[]" class="form-control discvalue" value="" onkeyup="discvalue(this, event)" >',
      '<input type="text" size="200" readonly style="text-align:right" name="hasil[]" id="hasil" class="form-control hasil hasil-'+kode+'" value="'+x+'"><input type="hidden" size="200" readonly style="text-align:right" name="" id="hasil2" class="hasil2 form-control" value="'+b+'">',          
      Hapus
      ]);
    tableDetail.draw();

  index++;
  tamp.push(kode);
  }else{
  var qtyLawas= parseInt($(".qty-"+kode).val());
  $(".qty-"+kode).val(qtyLawas+qty);
  var q = parseInt(qtyLawas+qty);
  var l = parseFloat(q * y).toFixed(2);;
  var k = SetFormRupiah(l);
  $(".hasil-"+kode).val(k);
  }

  $(function(){
  var values = $("input[name='sd_qty[]']")
  .map(function(){return $(this).val();}).get();
  });

  UpdateTotal();
  // UpdateDiscont();
  autoJumValPercent();
}

$('#qty').keypress(function(e){
    var charCode;
    if ((e.which && e.which == 13)) {
      charCode = e.which;
    }else if (window.event) {
        e = window.event;
        charCode = e.keyCode;
    }
    if ((e.which && e.which == 13)){
      var isi   = $('#qty').val();
      var jumlah= $('#detailnama').val();
      var stok  = $('#s_qty').val();
      if(isi == '' || jumlah == '' || stok == ''){
        toastr.warning('Item Jumlah Stok tidak boleh kosong');
        return false;
    }
      tambahEdit();
      $("input[name='item']").val('');
      $("input[name='s_qty']").val('');
      $("input[name='qty']").val('');
      $("input[name='item']").focus(); 
         return false;

    }
 });
  
@endif

var hpercent = 0;
function discpercent(inField, e){
    var getIndex = $('input.discpercent:text').index(inField);        
    var diskon = $('input.discpercent:text:eq('+getIndex+')').val();
    var harga = $('input.harga_item:text:eq('+getIndex+')').val();
    var qty = $('input.sd_qty:eq('+getIndex+')').val();
    harga = convertToAngka(harga);
    harga = parseInt(harga);
    diskon = parseInt(diskon);
    qty = parseInt(qty);
    if (isNaN(diskon)) {
      diskon=0;
    }
    hasill = harga * qty;
    if (diskon >= 100) {
      diskon = 0;
      $('input.discpercent:text:eq('+getIndex+')').val(0);
    }
    hpercent = hasill * diskon/100;
    $('input.totalValuePercent:text:eq('+getIndex+')').val(hpercent);
    hasill = hasill - (hasill * diskon/100);
    hasill = convertToRupiah(hasill);
    var dispercent = $('input.hasil:text:eq('+getIndex+')').val(hasill);
    UpdateTotal();  
}

function discvalue(inField, e){
  var getIndex = $('input.discvalue:text').index(inField);   
  var diskon = $('input.discvalue:text:eq('+getIndex+')').val();
  var harga = $('input.harga_item:text:eq('+getIndex+')').val();
  var qty = $('input.sd_qty:eq('+getIndex+')').val();

  harga = convertToAngka(harga);
  harga = parseInt(harga);
  diskon = parseInt(diskon);
  qty = parseInt(qty);
  qty = parseInt(qty);
  if (isNaN(diskon)) {
    diskon=0;
  }
  hasil = harga * qty;
  if (diskon > hasil) {
        diskon = 0;
        $('input.discvalue:text:eq('+getIndex+')').val(0);
      }
  hasil = hasil - hpercent - diskon;
  hasil = convertToRupiah(hasil);
  $('input.hasil:text:eq('+getIndex+')').val(hasil);
  UpdateTotal();
  // UpdateDiscont();
  }

function autoJumValPercent(){
  var inputs = document.getElementsByClassName( 'jumTotValuePercent' ),
  hasil  = [].map.call(inputs, function( input ) {
      return input.value;
  });
  var total = 0;
  for (var i = hasil.length - 1; i >= 0; i--){
    hasil[i] = parseInt(hasil[i]);
    total = total + hasil[i];
  }
  total = convertToRupiah(total);
  // console.log(total);
  $('.TotDisPercent').val(total);
  totalPercentValue();
  }  

function autoJumValValue(){
  var inputs = document.getElementsByClassName( 'hasildiscvalue' ),
  hasil  = [].map.call(inputs, function( input ) {
    if(input.value == '') input.value = 0;
      return input.value;
  });
  // console.log(hasil);
  var total = 0;
  for (var i = hasil.length - 1; i >= 0; i--){
    hasil[i] = convertToAngka(hasil[i]);
    hasil[i] = parseInt(hasil[i]);
    total = total + hasil[i];
  }
    if (isNaN(total)) {
        total=0;
      }
  total = convertToRupiah(total);
  console.log(total);
  $('.TotDisValue').val(total);
  totalPercentValue();
  } 

function totalPercentValue(){
  var inputs = document.getElementsByClassName( 'totalPercentValue' ),
  hasil  = [].map.call(inputs, function( input ) {
      return input.value;
  });
  console.log(hasil);
  var total = 0;
  for (var i = hasil.length - 1; i >= 0; i--){
    hasil[i] = convertToAngka(hasil[i]);
    hasil[i] = parseInt(hasil[i]);
    total = total + hasil[i];
  }
  total = convertToRupiah(total);
  console.log(total);
  $('#Total_Discount').val(total);
}

$('.total').keyup(function() {            
  var sum = angkaDesimal($('#total').val());                  
  var bayar = angkaDesimal($('#bayar').val());
  var hasil=parseFloat(bayar - sum).toFixed(2);
  $('#kembalian').val(SetFormRupiah(hasil));
});  

function UpdateTotal(){
  var inputs = document.getElementsByClassName( 'hasil' ),
      hasil  = [].map.call(inputs, function( input ) {
          return input.value;
      });
  var total = 0;

    for (var i = hasil.length - 1; i >= 0; i--) 
    {
      hasil[i] = convertToAngka(hasil[i]);
      hasil[i] = parseInt(hasil[i]);
      total = total + hasil[i];
    }
    total = convertToRupiah(total);
    $('#total').val(total);
    $('#totalPayment').val(total);
  }

   function UpdateSubTotal(){

    var x = angkaDesimal($('#Total_Discount').val()); 
    var y = angkaDesimal($('.totalAmount').val());
    x = parseFloat(x);
    y = parseFloat(y);
    var jumlahsub = x + y;
    jumlahsub = convertToRupiah(jumlahsub);
    $('#totalMapPenjualan').val(jumlahsub);

  }

function hapus(a){
    var par = a.parentNode.parentNode;
    tableDetail.row(par).remove().draw(false);

    var sum = 0;
        $('.hasil').each(function() {
            sum += Number($(this).val());
        });
        $('#total').val(sum);

    var inputs = document.getElementsByClassName( 'kode' ),
    names  = [].map.call(inputs, function( input ) {
        return input.value;
    });
    tamp = names;

    UpdateTotal();
  }

function UpdateHarga(kode){
    var qty = $('.qty-'+kode).val();
    var harga = $('.harga-'+kode).val();
    console.log(harga);
    var hasil = convertToAngka(harga);
    console.log(hasil);
    hasil = hasil * qty;
    var hasilRp = convertToRupiah(hasil);
    $('.hasil-'+kode).val(hasilRp);
    console.log(hasilRp);
    UpdateTotal();
    // UpdateDiscont();
  } 

function qtyInput(stok, kode){
  input = $('.qty-'+kode).val();
  input = parseInt(input);
  stok = parseInt(stok);
  if (input > stok || input < 1) {
    $('.qty-'+kode).val(1);
  }
  UpdateHarga(kode);
  }

//request
$("#rnamaitem").autocomplete({
source: baseUrl+'/penjualan/POSretail/retail/autocompletereq',
minLength: 1,
select: function(event, ui) 
{
$('#rnamaitem').val(ui.item.label);
$('#rharga').val(ui.item.harga);
$('#rkode').val(ui.item.kode);
$('#rdetailnama').val(ui.item.nama);
$('#rsatuan').val(ui.item.satuan);
$('#rstok').val(ui.item.stok);

$('#rqty').val(ui.item.qty);
}
});

var rindex=0;
var rtamp=[];
function tambahreq() {   
  var kode  =$('#rkode').val();      
  var nama  =$('#rdetailnama').val();                        
  var satuan=$('#rsatuan').val();
  var qty   =$('#rqty').val();
  var stok  =$('#rstok').val();
  var Hapus = '<button type="button" class="btn btn-danger hapus" onclick="rhapus(this)"><i class="fa fa-trash-o"></i></button>';
  var rindex = rtamp.indexOf(kode);


if ( rindex == -1){     
  tableReq.row.add([
    kode+'<input type="hidden" name="kode_item[]" class="kode_item" value="'+kode+'"> ',
    nama+'<input type="hidden" name="nama_item[]" class="nama_item" value="'+nama+'"> ',
    '<input size="30" style="text-align:right" type="text"  name="sd_qty[]" class="sd_qty form-control" value="'+qty+'"> ',
    satuan+'<input type="hidden" name="satuan[]" class="satuan" value="'+satuan+'"> ',
    '',
    Hapus
    ]);

  tableReq.draw();
  rindex++;
  rtamp.push(kode);
}else{
  toastr.warning('item sudah ada');
    }
}

function rhapus(a){
    var par = a.parentNode.parentNode;
    tableReq.row(par).remove().draw(false);
}

function convertToRupiah(angka) {
  var rupiah = '';        
  var angkarev = angka.toString().split('').reverse().join('');
  for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
  var hasil = 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
  return hasil+',00'; 
}

function convertToAngka(rupiah){
  return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}


function cariTanggal(){
  var tgl1=$('#tanggal1').val();
  var tgl2=$('#tanggal2').val();
  $.ajax({
    url : baseUrl + "/penjualan/POSgrosir/get-tanggal/"+tgl1+'/'+tgl2,
    type: 'get',   
    
    success:function(response){
     $('#dt_nota_jual').html(response);
    }
  });
}

function cariTanggalJual(){
  var tgl1=$('#tanggal3').val();
  var tgl2=$('#tanggal4').val();
  $.ajax({
    url : baseUrl + "/penjualan/POSgrosir/get-tanggaljual/"+tgl1+'/'+tgl2,
    type: 'get',   
    success:function(response){
     $('#Data_Jual').html(response);
    }
  });
}
$(document).on('click', '#c .pagination a',function(event){
  $('#loading').css('display','')
  $('li').removeClass('active');
  $(this).parent('li').addClass('active');
  event.preventDefault();
  var myurl = $(this).attr('href');
  var page=$(this).attr('href').split('page=')[1];       
  getData(page); 

});


//thoriq

// paginate stock

function getData(page){   
  
  $.ajax(
        {
            url: baseUrl + '/penjualan/POSgrosir/stock/table-stock?page=' + page,
            type: "get",
            datatype: "html",
           
        })
        .done(function(data)
        {          
          $("#table-stock").html(data);
          $('#loading').css('display','none')
         
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
          $('#loading').css('display','none')
        });
       
}
//paginate stock selesai

//total kembalian final
var hasil = 0;  
$('.simpanFinal').attr('disabled','disabled');     
function updateKembalian(){
  var inputs = document.getElementsByClassName( 'totPayment' ),
  hasil  = [].map.call(inputs, function( input ) {
      return input.value;
  });
    var total = 0;
  for (var i = hasil.length - 1; i >= 0; i--){
    hasil[i] = convertToAngka(hasil[i]);
    hasil[i] = parseInt(hasil[i]);
    total = total + hasil[i];
  }
      if (isNaN(total)) {
      total=0;
    }
  total = convertToRupiah(total);
  // alert(total);
  $('#totPembayaran').val(total);
  var sum = angkaDesimal($('#totPembayaran').val()); 
  var bayar = angkaDesimal($('#totalPayment').val());
  var hasil = parseInt(sum - bayar).toFixed(2);
  if (hasil <= 0) {
      diskon = 0;
    }
  var kembalian = $('#kembalian').val(SetFormRupiah(hasil));

  if (hasil < 0) {
    $('#kembalian').css('background-color','red');
    $('.simpanFinal').attr('disabled','disabled');
  }else{
    $('#kembalian').css('background-color','yellow');
    $('.simpanFinal').removeAttr('disabled','disabled');
  }
  }
UpdateTotalPayment();
function UpdateTotalPayment(){
  var inputs = document.getElementsByClassName('bandingPayment'),
      hasil  = [].map.call(inputs, function( input ) {
          return input.value;
      });
      // console.log(hasil);
  var total = 0;

  for (var i = hasil.length - 1; i >= 0; i--) {
    hasil[i] = convertToAngka(hasil[i]);
    hasil[i] = parseInt(hasil[i]);
    total = total + hasil[i];
    if (isNaN(total)) {
        total=0;
      }
  }
  // console.log(total);
  total = convertToRupiah(total);
  $('#totPembayaran').val(total);
}

//var random
function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}

var dataPayment = 0;
function tambahPayment(){  
  var td = [], select = [];
  var table = document.getElementById('tablePayment');
  var tr = table.getElementsByTagName('tr');
  for(var i=0; i < tr.length; i++){
    td[i] =  tr[i].getElementsByTagName('td')[0];
    select[i] = td[i].getElementsByTagName('select')[0];
  }
  var data = 'data0=';
  for (var i = 0; i < select.length; i++) {
    data += select[i].value+'&';
    data += 'data'+(i+1)+'=';
  }
  data += '&length='+select.length;


  
       $.ajax({
        url : baseUrl + "/pembayaran/POSgrosir/pay-methode",
        type: 'get', 
        data: data,
        dataType:'json',
        success:function(dataPayment){
          guid();
          UpdateTotalPayment();
          var i=0;
          $html='<tr><td><select name="sp_method[]" id="sp_method" class="form-control">';            
          for (i ; i <dataPayment.length; i++) {
              //if(dataPayment[i].pm_id != except){
                var isi=dataPayment[i]['pm_name'];    
                var isi2=dataPayment[i]['pm_id'];  
                $html+='<option value='+isi2+'>'+isi+'</option>';  
              //}            
          }

          var uuid = guid(); 
          var event = 'event';
          var Rp = 'rupiah-'+uuid+''; 
          var spm = "'#sp_method'";
          $html+='</select></td><td><input type="text" name="sp_nominal[]" id="" value="" class="form-control bandingPayment totPayment rupiah-'+uuid+'" onkeyup="updateKembalian();rege(event,\''+Rp+'\')" style="text-align: right;" onblur="setRupiah(event,\''+Rp+'\')" onclick="setAwal(\''+event+'\',\''+Rp+'\')"></td> <td><button type="button" class="btn btn-info" onclick="tambahPayment()"><i class="glyphicon glyphicon-plus"></i></button> <button type="button" class="btn btn-danger hapus" onclick="hapusPayment(this)"><i class="glyphicon glyphicon-minus"></i></button></td></tr>';
        $(".mc").append($html);
     } 
  });
        
     
}
function hapusPayment(a){   
  var par = a.parentNode.parentNode;
  $(par).remove();
  UpdateTotalPayment();
}

//js rupiah

function rege(evt, data){       
    var hitungKoma=0;
    var uang=$('.' + data).val();

    var code =  (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    
        for (m = 0; m < uang.length; m++) {
//            if ((uang.charAt(0)) == '-') {                
//                          
//            }    
        if ((uang.charAt(m)) == ',') {
            hitungKoma++;
        }            
        if (hitungKoma ==1 || hitungKoma ==0) {    
       if(code == 37 || code == 39 || code == 16 || code == 36 && code == 8 
        && code >= 48 || code <= 57){        
    
        }else{
    
      uang = $('.' + data).val().replace(/[^0-9,-]*/g, '');
                $('.' + data).val(uang);
      
   
        }
          
                }else if (hitungKoma >1) {                                        
                    toastr.warning('Harap perikasa kembali inputan anda');
                    var $notifyContainer = $('#toast-container').closest('.toast-top-center');
if ($notifyContainer) {
   // align center
   var windowHeight = $(window).height() - 90;
   $notifyContainer.css("margin-top", windowHeight / 2);
}
                    return false;
                     
                }
        }
    }
    
    //
function setRupiah(evt, nilai)
    {
        $minus=0;
        var code =  (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
        var uangDe;
        if (code != 37 && code != 39 && code != 16 && code != 36 && code != 8)
            var uang = $('.' + nilai).val().replace(/[^0-9,-]*/g, '');
        $('.' + nilai).val(uang);
        var hitungKoma = 0;
        var pisah = new Array();
        var chekArray;
        for (o = 0; o < uang.length; o++) {                        
            if ((uang.charAt(0)) == '-' && uang.length>1) {                
                $minus=1;
                uang=uang.replace(/[^0-9,]*/g, '');
                
                
            } 
             
            else if ((uang.charAt(0)) == '-' && uang.length==1) {                                
                uang.replace(/[^0-9,]*/g, '');                
                uang='';
            } 
            if ((uang.charAt(o)) == ',') {
                hitungKoma++;
                if (hitungKoma == 1) {                        
                    uangDe=parseFloat(uang.replace(',', '.')).toFixed(2);
                    uang=uangDe.replace('.', ',');                       
                    chekArray = uang.split(',');                    
                    
                }else if(hitungKoma > 1){
                    toastr.warning('Harap perikasa kembali inputan anda');
                    var $notifyContainer = $('#toast-container').closest('.toast-top-center');
if ($notifyContainer) {
   // align center
   var windowHeight = $(window).height() - 90;
   $notifyContainer.css("margin-top", windowHeight / 2);
}
                    return false;
                }
            }

        }
        if ($.isArray(chekArray)) {            
            
            var rev = parseInt(chekArray[0], 10).toString().split('').reverse().join('');            
            var rev2 = '';
            for (var l = 0; l < rev.length; l++) {
                rev2 += rev[l];
                if ((l + 1) % 3 === 0 && l !== (rev.length - 1)) {
                    rev2 += '.';
                }
            }
            if (chekArray[1] == '' && $minus==0) {
                $('.' + nilai).val('Rp. ' + rev2.split('').reverse().join('') + ',' + '00');
            }
            if (chekArray[1] == '' && $minus>0) {
                $('.' + nilai).val('Rp. -' + rev2.split('').reverse().join('') + ',' + '00');
            }
            if (chekArray[1] != '' && $minus==0) {
                $('.' + nilai).val('Rp. ' + rev2.split('').reverse().join('') + ',' + chekArray[1]);
            }
            if (chekArray[1] != '' && $minus>0) {
                $('.' + nilai).val('Rp. -' + rev2.split('').reverse().join('') + ',' + chekArray[1]);
            }
//            else{
//                $('.' + nilai).val('Rp. ' + rev2.split('').reverse().join('') + ',' +chekArray[1]);
//            }
        } else {            
            var rev = parseInt(uang, 10).toString().split('').reverse().join('');
            var rev2 = '';
            for (var u = 0; u < rev.length; u++) {
                rev2 += rev[u];
                if ((u + 1) % 3 === 0 && u !== (rev.length - 1)) {
                    rev2 += '.';
                }
            }
            if($minus==0){
            $('.' + nilai).val('Rp. ' + rev2.split('').reverse().join('') + ',' + '00');
            }
            if($minus>0){
            $('.' + nilai).val('Rp. -' + rev2.split('').reverse().join('') + ',' + '00');
            }
            if (uang == '' || uang == '0') {
                $('.' + nilai).val('');
            }
        }
    }

    function setAwal(evt, nilai)
    {   
        var code =  (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
        if (code != 37 || code != 39 || code != 16 || code != 36 || code != 8 )
            var uang = $('.' + nilai).val().replace(/[^0-9,-]*/g, '');
        
        var array = uang.split(',');
        
        if(array[1]=='00'){
            $('.' + nilai).val(array[0]);
        }else{
            $('.' + nilai).val(uang);
        }
      }
//end js rupiah

//fungsi barcode
function uniKeyCode(event) {
  var code = $('#namaitem').val();
  $.ajax({
    url : baseUrl + "/penjualan/POSgrosir/setbarcode",
    type: 'get',
    data: {code:code},
    success:function (response){
      if(response.length == 1){
        $('#namaitem').val(response[0].i_code+' - '+response[0].i_name);
        $("input[name='qty']").focus();
        $('#qty').val(1);
        $('#kode').val(response[0].i_code);
        $('#harga').val(response[0].i_price);
        $('#detailnama').val(response[0].i_name);
        $('#satuan').val(response[0].i_unit);
        $('#s_qty').val(response[0].s_qty);
      }
    }
  }) 
}

  function saveStatus() {
    
    var id = $('#idSales').val();
    console.log(id);
    var status = $('#setStatus').val();
    console.log(status);
    var oldStatus = $('#oldStatus').val();
    console.log(oldStatus);
    $.ajax({
          url         : baseUrl+'/pembayaran/POSgrosir/changestatus',
          type        : 'get',
          timeout     : 10000,  
          data        : { id:id, status:status, oldStatus:oldStatus },
          success     : function(response){
            cariTanggal();
            toastr.warning('Status berhasil di ubah!');         
            $('#modalStatus').modal('hide');
          }
      });
  }

  function showNote() {
    $.ajax({
          url         : baseUrl+'/penjualan/POSgrosir/showNote',
          type        : 'get',
          timeout     : 10000,  
          success     : function(response){
            
            $('#note-show').html(response);
            cariTanggal();
          }
      });
  } 


  function showHistory() {
    $.ajax({
          url         : baseUrl+'/penjualan/POSgrosir/riwayat',
          type        : 'get',
          timeout     : 10000,  
          success     : function(response){
            
            $('#note-show').html(response);
            cariRiwayat();
          }
      });
  } 

  function cariRiwayat(){
    var tgl1=$('#Rtgl1').val();
    var tgl2=$('#Rtgl2').val();
    $.ajax({
      url : baseUrl + "/penjualan/POSgrosir/get-riwayat/"+tgl1+'/'+tgl2,
      type: 'get',   
      
      success:function(response){
       $('#dt_nota_jual').html(response);
      }
    });
  }  

</script>
@endsection()
