@extends('main')
@section('content')
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
                        <div class="page-title">Manajemen Produksi</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/home') }}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><i></i>&nbsp;Produksi&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Manajemen Produksi</li>
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
                                <li class="active"><a href="#alert-tab" data-toggle="tab">Manajemen Produksi</a></li>
                                <!-- <li><a href="#note-tab" data-toggle="tab">2</a></li>
                                <li><a href="#label-badge-tab" data-toggle="tab">3</a></li> -->
                              </ul>
                              <div id="generalTabContent" class="tab-content responsive">
                                
                                <div id="alert-tab" class="tab-pane fade in active">
                                 
                                    <div class="row" style="margin-top: -5px;">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                     
                           
                                        <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                          <a href="#" data-toggle="modal" onclick="tambahProduksi()" class="btn btn-box-tool" style="margin-bottom: 15px;"><i class="fa fa-plus"></i>&nbsp;Hasil Produksi</a>
                                        </div>


                                     

                                        <div class="table-responsive">
                                          <table class="table tabelan table-hover table-bordered" width="100%" cellspacing="0" id="datab">
                                            <thead>
                                              <tr>
                                                <th width="5%">No</th>
                                                <th width="10%">SPK / Tanggal</th>
                                                <th width="30%">Item</th>
                                                <th width="5%">Jumlah</th>
                                                <th>Hasil Produksi</span></th>
                                                <th>Following Up</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($spk as $index => $data)
                                              <tr>
                                                <td>{{$index}}</td>
                                                <td>
                                                  {{$data->spk_code}}
                                                  /
                                                  {{date('d-m-Y',strtotime($data->spk_date))}}</td>
                                                <td>{{$data->i_name}}</td>
                                                <td>{{$data->pp_qty}}</td>
                                                <td>
                                                <table class="table" style="width: 100%">                                                  
                                                    <th>Waktu</th>
                                                    <th>Jumlah</th>                                   
                                                @foreach ($productresult_dt as $dt)
                                                  @if($dt->pr_spk==$data->spk_code)                   
                                                      <tr>
                                                      <td>{{$dt->prdt_time}}</td>
                                                      <td>{{$dt->prdt_qty}}</td>
                                                      </tr>
                                                  @endif
                                                @endforeach                                              
                                              </table>
                                                </td>                     
                                                <td class="text-center">
 <a  class="btn btn-warning btn-xs" title="Detail"><i class="
glyphicon glyphicon-list-alt"></i> &nbsp;&nbsp; Detail</a>
                  <a  class="btn btn-warning btn-xs" title="Finish"><i class="
glyphicon glyphicon-list-alt"></i> &nbsp;&nbsp; Finish</a>
               
                                                </td>
                                              </tr>                                               
                                            </tbody>
                                          @endforeach
                                            </table> 


                                          </div>                                       
                                        </div>
                                      </div>
                                  {{$spk->links()}}j
                                </div>
                                <!-- /div alert-tab -->

                                

                                <!-- div note-tab -->
                                <div id="note-tab" class="tab-pane fade">
                                  <div class="row">
                                    <div class="panel-body">
                                      <!-- Isi Content -->we we we
                                    </div>
                                  </div>
                                </div><!--/div note-tab -->
                                <!-- div label-badge-tab -->
                                <div id="label-badge-tab" class="tab-pane fade">
                                  <div class="row">
                                    <div class="panel-body">
                                      <!-- Isi content -->we
                                    </div>
                                  </div>
                                </div><!-- /div label-badge-tab -->
                              </div>
                    
                            </div>
                          </div>
                        </div>

                        @include('produksi.spk.create-spk')


@endsection
@section("extra_scripts")
    <script type="text/javascript">      
      $('#datab').dataTable();
      cariTanggal();
      function tambahProduksi(){                
                                    $('#create').modal('show');
      }

      function draft(status){
        var dataPlan=$('#data-product-plan :input').serialize();
        var dataProduksi=$('#data-Produksi :input').serialize();

                  $.ajax({
                        url         : baseUrl+'/produksi/Produksi/simpan-Produksi',
                        type        : 'get',
                        timeout     : 10000,                          
                        dataType    :'json',
                        data        :dataPlan+'&'+dataProduksi+'&status='+status,
                        success     : function(response){
                                if(response.status=='sukses'){
                                    $('#id_Produksi').val(response.id_Produksi);
                                    $('#create').modal('show');
                                    $('#id_plan').val(id);
                                    $('#tgl_plan').val(tgl);
                                    $('#iditem').val(iditem);
                                    $('#item').val(item);
                                    $('#jumlah').val(jumlah);
                                    $('#tgl_Produksi').val(tgl);

                                    
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