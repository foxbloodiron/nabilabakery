@extends('main')
@section('content')

            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
                        <div class="page-title">Form Manajemen Output Produksi</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/home') }}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><i></i>&nbsp;Produksi&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Manajemen Output Produksi</li><li><i class="fa fa-angle-right"></i>&nbsp;Form Manajemen Output Produksi&nbsp;&nbsp;</i>&nbsp;&nbsp;</li>
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
                              <li class="active"><a href="#alert-tab" data-toggle="tab">Form Manajemen Output Produksi</a></li>
                            <!-- <li><a href="#note-tab" data-toggle="tab">2</a></li>
                            <li><a href="#label-badge-tab-tab" data-toggle="tab">3</a></li> -->
                        </ul>
                        <div id="generalTabContent" class="tab-content responsive">
                          <div id="alert-tab" class="tab-pane fade in active">
                          <div class="row">
                          
                         <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: -10px;margin-bottom: 15px;">  
                           <div class="col-md-5 col-sm-6 col-xs-8" >
                             <h4>Form Manajemen Output Produksi</h4>
                           </div>
                           <div class="col-md-7 col-sm-6 col-xs-4" align="right" style="margin-top:5px;margin-right: -25px;">
                             <a href="{{ url('produksi/o_produksi/produksi3') }}" class="btn"><i class="fa fa-arrow-left"></i></a>
                           </div>
                         </div>
                         
                        
                         <div class="col-md-12 col-sm-12 col-xs-12">
                            <form onsubmit="return false">

                                    <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="padding-bottom: 10px;padding-top: 20px;margin-bottom: 15px;">
                                        

                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            
                                                <label class="tebal">Tanggal Produksi</label>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input value="{{ date('d-m-Y') }}" class="form-control datepicker1 input-sm" type="text">
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            
                                                <label class="tebal">Nama Petugas</label>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" readonly="" class="form-control input-sm" name="" value="{{ Auth::user()->name }}">
                                            </div>
                                            
                                        </div>  
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                          <a href="#" data-toggle="modal" data-target="#create" class="btn btn-box-tool" style="margin-bottom: 15px;"><i class="fa fa-plus"></i>&nbsp;Tambah Hasil Produksi</a>
                                    </div>
                                    
                                    <!-- Modal -->
                                  <div class="modal fade" id="create" role="dialog">
                                    <div class="modal-dialog">
                                    
                                      
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header" style="background-color: #e77c38;">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="color: white;">Tambah Hasil Produksi</h4>
                                          </div>
                                          <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table tabelan table-hover ">
                                                  <tbody>
                                                    <tr>
                                                      <td>Tanggal Produksi</td>
                                                      <td>
                                                        <input type="text" class="form-control datepicker2" id="TanggalProduksi" onchange="SetTanggalProduksi()" name="">
                                                      </td>
                                                    </tr>
                                                    <tr id="tr_spk">
                                                      <td>Nomor SPK</td>
                                                      <td>
                                                        <select class="form-control">
                                                          <option></option>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                      <td>Nama Item</td>
                                                      <td>
                                                        <input type="text" name="" type="text" class="form-control" id="NamaItem" value="" readonly>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td>Jumlah Item</td>
                                                      <td>
                                                        <input type="number" class="form-control" id="JumlahItem" name="" style="text-align: right;">
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" type="submit" onclick="simpanHasilProduct()" >Posting</button>
                                            
                                          </div>

                                        </div>
                                      
                                    </div>
                                  </div>
                                    <div class="table-responsive">
                                      <table class="table tabelan table-bordered table-striped" id="tambah-productPlan">
                                        <thead>
                                         <tr>
                                            <th>Tanggal Produksi</th>
                                            <th>Nomor SPK</th>
                                            <th>Nama Item</th>
                                            <th>Waktu Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                      </table>
                                    </div>

                                    <div align="right" style="padding-top:10px;">
                                        <div id="div_button_save" class="form-group">
                                            <button type="button" id="button_save" class="btn btn-primary">Simpan Data</button> 
                                        </div>
                                    </div>
                              </form>
                          </div>                                       
                        </div>
                      </div>        
                    </div>
                  </div>
                </div>
                            
@endsection
@section("extra_scripts")
<script type="text/javascript"> 

$('#tambah-productPlan').dataTable({
      "responsive":true,
      "pageLength": 10,
      "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
      "language": {
          "searchPlaceholder": "Cari Data",
          "emptyTable": "Tidak ada data",
          "sInfo": "Menampilkan _START_ - _END_ Dari _TOTAL_ Data",
          "infoFiltered" : "",
          "sSearch": '<i class="fa fa-search"></i>',
          "sLengthMenu": "Menampilkan &nbsp; _MENU_ &nbsp; Data",
          "infoEmpty": "",
          "zeroRecords": "Data tidak ditemukan",
          "paginate": {
                  "previous": "Sebelumnya",
                  "next": "Selanjutnya",
              }
        },

      "ajax":{
            "url" : baseUrl + "/produksi/o_produksi/tabel",
            "type": "GET",
            
      },
      "columns": [
          { "data": "pr_date" ,"className" : "dt-body-center"},
          { "data": "spk_code" ,"className" : "dt-body-center"},
          { "data": "i_name" },
          { "data": "prdt_qty" ,"className" : "dt-body-right"},
          { "data": "button" },
      ]

  });

$(document).ready(function() {
    var extensions = {
         "sFilterInput": "form-control input-sm",
        "sLengthSelect": "form-control input-sm"
    }
    // Used when bJQueryUI is false
    $.extend($.fn.dataTableExt.oStdClasses, extensions);
    // Used when bJQueryUI is true
    $.extend($.fn.dataTableExt.oJUIClasses, extensions);
    

});

$('.datepicker1').datepicker({
  format:"dd-mm-yyyy",
  autoclose:true,
  endDate:"today"
});

$('.datepicker2').datepicker({
  format:"dd-mm-yyyy",
  autoclose:true,
  endDate:"today"
});

function SetTanggalProduksi(){
      var tgl1=$('#TanggalProduksi').val();
      $.ajax({
        url : baseUrl + "/produksi/o_produksi/settanggal/"+tgl1,
        type: 'get',

        success:function(response)
        {
         $('#tr_spk').html(response);
        }
    })
}

function SetItem() {
  var elm = $("#mySelect").val();
  var id = $("#"+elm).data("id");
  var idItem = $("#"+elm).data("iditem");
  var namaItem = $("#"+elm).data("namaitem");
  $("#NamaItem").val(namaItem);
  $("#NamaItem").data("id",idItem);
}



function simpanHasilProduct(){
  var tgl = $('#TanggalProduksi').val(),
      spk_id = $('#mySelect').val(),
      idItem = $("#NamaItem").data("id"),
      spk_qty = $("#JumlahItem").val();
      console.log(tgl);
      console.log(spk_id);
      console.log(idItem);
      console.log(spk_qty);
  if (tgl == '') {
    Command: toastr["warning"]("Kolom Tanggal tidak boleh kosong ", "Peringatan !")

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    return false;
  }
  if (spk_id == '') {
    Command: toastr["warning"]("Kolom SPK tidak boleh kosong ", "Peringatan !")

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    return false;
  }
  if (spk_qty == '' || spk_qty <= 0 ) {
    Command: toastr["warning"]("Kolom Jumlah Item tidak boleh kosong ", "Peringatan !")

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    return false;
  }

  $.ajax({
    url : baseUrl + "/produksi/o_produksi/store",
    type: 'get',
    data: {
      tgl: tgl,
      spk_id: spk_id,
      spk_item: idItem,
      spk_qty: spk_qty
    },
    success:function(response){
      $('#create').modal('hide');
        $("#JumlahItem").val('');
        $("#NamaItem").val('');
        $("#mySelect").val('');
        $("#TanggalProduksi").val('');
        // $("input[name='no_hp']").val('');
        // $("textarea[name='alamat']").val('');
        alert('Data Tersimpan');
        window.location.reload();
      }
    })
  }

</script>
@endsection()                           
