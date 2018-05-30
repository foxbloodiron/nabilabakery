@extends('main')
@section('content')
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
                        <div class="page-title">Manajemen SPK</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/home') }}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><i></i>&nbsp;Produksi&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Manajemen SPK</li>
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
                                <li class="active"><a href="#note-tab" data-toggle="tab">Rencana Produksi</a></li>
                                <li ><a href="#alert-tab" data-toggle="tab">Manajemen SPK</a></li>
                                
                                <!-- <li><a href="#label-badge-tab" data-toggle="tab">3</a></li> -->
                              </ul>
                              <div id="generalTabContent" class="tab-content responsive">
                                
                                <div id="alert-tab" class="tab-pane fade ">
                                 
                                    <div class="row" style="margin-top: -5px;">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                     
                           
                                        <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                          <a href="#" data-toggle="modal" onclick="tambahSpk()" class="btn btn-box-tool" style="margin-bottom: 15px;"><i class="fa fa-plus"></i>&nbsp;Tambah SPK</a>
                                        </div>


                                    


                                        <div class="table-responsive">
                                          <table class="table tabelan table-hover table-bordered" width="100%" cellspacing="0" id="data">
                                            <thead>
                                              <tr>
                                                <th>No</th>                                    
                                                <th>Tanggal</th>
                                                <th>No SPK</th>
                                                <th>Item</th>
                                                <th>Jumlah</th>
                                                <th>Following Up</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($spk as $index => $data)
                                              <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{date('d-m-Y',strtotime($data->spk_date))}}</td>
                                                <td>{{$data->spk_code}}</td>
                                                <td>{{$data->i_name}}</td>
                                                <td>{{$data->pp_qty}}</td>                                                
                                                <td class="text-center">
                  <a  class="btn btn-warning btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-danger btn-xs" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                                                </td>
                                              </tr>                                               
                                            </tbody>
                                          @endforeach
                                            </table> 
                                          </div>                                       
                                        </div>
                                      </div>
                                  
                                </div>
                                <!-- /div alert-tab -->

                                <!-- Rencana -->
                                @include('keuangan.spk.bahan')
                                <!-- End Rencana -->

                                <!-- div note-tab -->
                                <!--/div note-tab -->
                                <!-- div label-badge-tab -->
                                <div id="note-tab" class="tab-pane fade in active">
                                  <div class="row">
                                    <div class="panel-body">
                                      

  <div class="table-responsive">
              <table class="table tabelan table-hover table-bordered" id="table-plan">
                <thead>
                  <tr>
                    <th width="10%">Tanggal</th>
                    <th width="30%">Item</th>
                    <th width="10%">Jumlah</th>
                    {{-- <th width="50%">Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                @foreach($productplan as $dataPlan)                 
                  <tr>
                    <td>
                        {{date('d-m-Y',strtotime($dataPlan->pp_date))}}
                    </td>
                    <td>{{$dataPlan->i_name}}</td>
                    <td>
                        {{$dataPlan->pp_qty}}
                    </td>
                     {{-- <td>
                        <button class="btn btn-warning btn-sm" title="Buat SPK" onclick="BuatSpk('{{$dataPlan->pp_id}}','{{date('d-m-Y',strtotime($dataPlan->pp_date))}}','{{$dataPlan->i_name}}','{{$dataPlan->pp_qty}}','{{$dataPlan->pp_item}}')">
                          <i class="fa  fa-plus"></i>
                        </button>                        
                    </td> --}}
                  </tr>
                @endforeach
                </tbody>
              </table>
  </div>







                                    </div>
                                  </div>
                                </div><!-- /div label-badge-tab -->
                              </div>
                    
                            </div>
                          </div>
                        </div>
<!-- Modal -->
      @include('keuangan.spk.table-production-plan')
      @include('keuangan.spk.create-spk')
<!-- End Modal -->

@endsection
@section("extra_scripts")
<script src="{{ asset ('assets/script/icheck.min.js') }}"></script>
    <script type="text/javascript">      
        function BuatSpk(id,tgl,item,jumlah,iditem){
             $.ajax({
                        url         : baseUrl+'/produksi/spk/create-id',
                        type        : 'get',
                        timeout     : 10000,                          
                        dataType    :'json',
                        success     : function(response){
                                if(response.status=='sukses'){
                                    $('#id_spk').val(response.id_spk);
                                    $('#create-data').modal('show');
                                    $('#id_plan').val(id);
                                    $('#tgl_plan').val(tgl);
                                    $('#iditem').val(iditem);
                                    $('#item').val(item);
                                    $('#jumlah').val(jumlah);
                                    $('#tgl_spk').val(tgl);

                                    
                                }

                        }
              });
      }
      function tambahSpk(){         
      cariTanggal();       
                                    $('#table-production-plan').modal('show');
      }

      function draft(status){
        var dataPlan=$('#data-product-plan :input').serialize();
        var dataSpk=$('#data-spk :input').serialize();

                  $.ajax({
                        url         : baseUrl+'/produksi/spk/simpan-spk',
                        type        : 'get',
                        timeout     : 10000,                          
                        dataType    :'json',
                        data        :dataPlan+'&'+dataSpk+'&status='+status,
                        success     : function(response){
                                if(response.status=='sukses'){
                                    $('#id_spk').val(response.id_spk);
                                    $('#create').modal('show');
                                    $('#id_plan').val(id);
                                    $('#tgl_plan').val(tgl);
                                    $('#iditem').val(iditem);
                                    $('#item').val(item);
                                    $('#jumlah').val(jumlah);
                                    $('#tgl_spk').val(tgl);
                                    location.reload();

                                    
                                }

                        }
              });
      }

        function final(status){
        var dataPlan=$('#data-product-plan :input').serialize();
        var dataSpk=$('#data-spk :input').serialize();

                  $.ajax({
                        url         : baseUrl+'/produksi/spk/simpan-spk',
                        type        : 'get',
                        timeout     : 10000,                          
                        dataType    :'json',
                        data        :dataPlan+'&'+dataSpk+'&status='+status,
                        success     : function(response){
                                if(response.status=='sukses'){
                                    $('#id_spk').val(response.id_spk);
                                    $('#create').modal('show');
                                    $('#id_plan').val(id);
                                    $('#tgl_plan').val(tgl);
                                    $('#iditem').val(iditem);
                                    $('#item').val(item);
                                    $('#jumlah').val(jumlah);
                                    $('#tgl_spk').val(tgl);
                                    location.reload();

                                    
                                }

                        }
              });
      }

      function final(status){
        
      }
     
     $(document).ready(function() {
    var extensions = {
         "sFilterInput": "form-control input-sm",
        "sLengthSelect": "form-control input-sm"
    }
    // Used when bJQueryUI is false
    $.extend($.fn.dataTableExt.oStdClasses, extensions);
    // Used when bJQueryUI is true
    $.extend($.fn.dataTableExt.oJUIClasses, extensions);
    $('#data').dataTable({
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
    $('#data3').dataTable({
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
      $('.datepicker').datepicker({
        format: "mm",
        viewMode: "months",
        minViewMode: "months"
      });
      $('.datepicker2').datepicker({
        format:"dd-mm-yyyy"
      });    
      </script>
@endsection()