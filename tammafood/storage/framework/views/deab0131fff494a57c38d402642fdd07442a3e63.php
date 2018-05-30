  
<?php $__env->startSection('content'); ?>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
                        <div class="page-title">Monitoring Order & Stock</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="<?php echo e(url('/home')); ?>">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><i></i>&nbsp;Produksi&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Monitoring Order & Stock</li>
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
                          <li class="active"><a href="#alert-tab" data-toggle="tab">Monitoring Order & Stock</a></li>
                          <!-- <li><a href="#note-tab" data-toggle="tab">2</a></li>
                          <li><a href="#label-badge-tab" data-toggle="tab">3</a></li> -->
                        </ul>
                        <div id="generalTabContent" class="tab-content responsive">
                                
                          <div id="alert-tab" class="tab-pane fade in active">
                                 
                                  <div class="row" style="margin-top:-15px;">

                                    <!-- Modal Nota-->

                                    <div class="modal fade" id="nota" role="dialog">
                                      <div class="modal-dialog modal-lg" >
                                          <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header" style="background-color: #e77c38;">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" style="color: white;">Jumlah Nota</h4>
                                              </div>

                                              <div class="modal-body">
                                                <div class="table-responsive" id="table-nota">
                                                  
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-warning " data-dismiss="modal">Close</button>
                                                
                                              </div>
                                            </div>
                                             
                                        </div>
                                    </div>

                                    <!-- End Modal -->
                                   

                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive" style="margin-top:10px;">
                                          <table class="table tabelan table-hover table-bordered" width="100%" cellspacing="0" id="data">
                                           <thead>
                                              <tr>
                                               <th>Kode Item</th>
                                               <th width="25%">Nama Item</th>
                                               <th>No Nota</th>
                                               <th>Jumlah Order</th>
                                               <th>Jumlah Stok</th>
                                               <th>Jumlah Kebutuhan</th>
                                               <th>Jumlah Rencana Produksi</th>
                                               <th>Jumlah Kekuarangan</th>
                                               <th>Aksi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              
                  
                                            </tbody>
                                          </table> 
                                        </div>                                       
                                      </div>
                                  </div>



                                  <!-- Modal Plan-->
                                  <div class="modal fade" id="modal" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                    <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header" style="background-color: #e77c38;">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 id="title-plan" class="modal-title" style="color: white;">Rencana Produksi</h4>
                                          </div>
                                          <form id="form-plan" onsubmit="return false">

                                            <div class="modal-body" id="table-plan">
                                              
                                            </div>
                                                     
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                              <button id="btnSimpan" type="submit" class="btn btn-primary" onclick="simpan()">Simpan Data</button>
                                            </div>
                                          </form>
                                        </div>
                                      
                                    </div>
                                  </div>
                                  <!-- end modal plan -->

                                  
                          </div>
                                <!-- /div alert-tab -->
                 <!-- div note-tab -->
                            <div id="note-tab" class="tab-pane fade">
                              <div class="row">
                                <div class="panel-body">
                                  <!-- Isi Content -->
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
                  </div>
                </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("extra_scripts"); ?>
<script src="<?php echo e(asset ('assets/script/icheck.min.js')); ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var extensions = {
         "sFilterInput": "form-control input-sm",
        "sLengthSelect": "form-control input-sm"
    }

    // dataMonitoring=$('#data').DataTable();
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
              "url" : baseUrl + "/produksi/monitoringprogress/tabel",
              "type": "GET",
              
        },
        "columns": [
            { "data": "pp_item" },
            { "data": "i_name" },
            { "data": "nota" },
            { "data": "jumlah" ,"className" : "dt-body-right" },
            { "data": "s_qty" ,"className" : "dt-body-right" },
            { "data": "j_butuh" ,"className" : "dt-body-right"},
            { "data": "pp_qty" ,"className" : "dt-body-right"},
            { "data": "j_kurang" ,"className" : "dt-body-right"},
            { "data": "plan" },],
        "order":[2,'desc'],

    });
    

    $.fn.dataTable.ext.errMode = 'none';
 
    $('#data')
    .on( 'error.dt', function ( e, settings, techNote, message ) {
        console.log( 'An error has been reported by DataTables: ', message );
        location.reload();
    } )
    .DataTable();


    $(document).on('click','.plan',function(){
        var id = $(this).data('id');
        var i_name = $(this).data('name');
        $.ajax({
          url : baseUrl + "/produksi/monitoringprogress/plan/"+id,
          type: 'get',   
          
          success:function(response)
          {

            $('#table-plan').html(response);
            //$('#pp_item').val(id);
            $("#judul-plan").text(i_name);



          }
        });
    });

    $(document).on('click','.nota',function(){
        var id = $(this).data('id');
        console.log('nota '+id);
        $.ajax({
        url : baseUrl + "/produksi/monitoringprogress/"+id,
        type: 'get',   
        
        success:function(response)
        {

         $('#table-nota').html(response);
        }
      });
    });



   

});

    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        altFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
      });



    function simpan() {
      $('#btnSimpan').attr('disabled','disabled');
      var form = document.getElementById('form-plan');
      var dataInput = form.getElementsByTagName('input');
      var tabel = $("#table-search input").serialize();
      var pp_item = $('#pp_item').val();
      var rowPlan = $('#rowPlan').val();
      var dataSimpan = tabel+'&pp_item='+pp_item+'&rowPlan='+rowPlan;
      console.log(dataInput.length);
      console.log(dataSimpan);
      // console.log(dataInput[3].value);
      // console.log(dataInput[5].value);
      // console.log(dataInput[7].value);
      for (var i=0; i<dataInput.length ; i++){
        console.log(dataInput[i].value);
      }
      for (var i=6; i<dataInput.length ; i+=2){
        ///validation
        if (dataInput[i].value == '') {
            Command: toastr["warning"]("Kolom Jumlah Rencana tidak boleh kosong ", "Peringatan !")

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
      }
      for (var i=5; i<dataInput.length ; i+=2){
        if (dataInput[i].value == '') {
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
      }
      //if(dataInput.length >)


      $.ajax({
          url : baseUrl + "/produksi/monitoringprogress/monitoring/save",
            type: "GET",
            data : dataSimpan,
            success: function()
            {
              var table = $('#data').DataTable();
              table.ajax.reload( null, false );
              alert('Berhasil disimpan');
              $("#modal").modal("hide");
              $('#btnSimpan').removeAttr('disabled');
            },
            error:function(x, e) {
              $('#btnSimpan').removeAttr('disabled');
              if (x.status == 0) {
                alert('ups !! gagal menghubungi server, harap cek kembali koneksi internet anda');
              } else if (x.status == 404) {
                  alert('ups !! Halaman yang diminta tidak dapat ditampilkan.');
              } else if (x.status == 500) {
                  alert("Code telah Terpakai", "Harap Cek sekali lagi",'warning');
              } else if (e == 'parsererror') {
                  alert('Error.\nParsing JSON Request failed.');
              } else if (e == 'timeout'){
                  alert('Request Time out. Harap coba lagi nanti');
              } else {
                  alert('Unknow Error.\n' + x.responseText);
              }
            }
        });
    }
    
    

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>