
<style type="text/css">
#loading {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 100;
  width: 100%;
  height: 100%;
  background-color: rgba(192, 192, 192, 0.5);
  background-image: url("https://i.stack.imgur.com/MnyxU.gif");
  background-repeat: no-repeat;
  background-position: center;
}  
</style>
<div id="loading" style="display: none;"></div>
<div id="nav-stock" class="tab-pane fade">

  <!-- Modal -->
  @include('penjualan.POSretail.stokRetail.transfer')
  <!-- End modal -->

  <!-- Modal Edit stock-->
  @include('penjualan.POSretail.stokRetail.edit')
  <!-- End modal -->

  <div class="row" style="margin-top: 15px;">
    <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- Trigger the modal with a button -->
           
       @if(Auth::user()->punyaAkses('Ritail Transfer','ma_insert'))
                                <div class="" align="right" style="margin-bottom: 15px;">
                                      <button data-toggle="modal" onclick="noNota()" aria-controls="list" role="tab" class="btn-primary btn-flat btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Transfer Item</button>
                                </div>
      @endif
      <div class="pull-right" style="margin-bottom: 15px;">
        <label for="search"><i class="fa fa-search"></i></label>
        <input id="cariStock" type="text/css" placeholder="Cari Data" onkeyup="cariStock($(this).val())">        
      </div>
      <div id="table-stock">
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  function cariStock(key) {
    $.ajax({
        url : baseUrl + "/penjualan/POSretail/stock/table-stock/"+key,
        type: 'get',           
          success:function(response)
          {
            $('#table-stock').html(response);
          }
    });
    console.log(key);
  } 

  function stock(){
       $.ajax({
        url : baseUrl + "/penjualan/POSretail/stock/table-stock",
        type: 'get',           
          success:function(response)
          {
            $('#table-stock').html(response);
          }
        });
  }    

  function updateStock(){
    $('#edit_stock').modal('hide');
    var id = $(".i_id").val();
    var stock = {
      s_qty : $(".s_qty").val(),
      harga : $(".harga").val(),
      ket : $(".ket").val(),
      key : $("#cariStock").val()
    }
      
      $.ajax({
        url : baseUrl + "/penjualan/POSretail/stock/update/"+id,
        data: stock,
        type: 'get',           
          success:function(response)
          {
            $('#table-stock').html(response);
            alert('Berhasil disimpan');
            $(".s_qty").val('');
            $(".harga").val('');
            $(".ket").val('');
          },
          error:function(x, e) {
              if (x.status == 0) {
                alert('ups !! gagal menghubungi server, harap cek kembali koneksi internet anda');
              } else if (x.status == 404) {
                  alert('ups !! Halaman yang diminta tidak dapat ditampilkan.');
              } else if (x.status == 500) {
                  alert("Code telah Terpakai. Harap Cek sekali lagi warning");
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

   function noNota(){
         $.ajax({
                    url         : baseUrl+'/transfer/no-nota',
                    type        : 'get',
                    timeout     : 10000,
                    dataType    :'json',
                    success     : function(response){
                        $('#no-nota').val(response);
                        $('#myTransfer').modal('show');
                        }
                    });
    }

      


</script>