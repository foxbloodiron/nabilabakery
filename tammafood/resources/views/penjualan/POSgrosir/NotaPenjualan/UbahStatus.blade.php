<!-- <table class="table">
    <thead>
      <tr>
        <th class="text-center">Packing</th>
        <th class="text-center">Sending</th>
        <th class="text-center">Received</th>
      </tr>
    </thead>
    <tbody>
      <input type="text" class="hide" name="idSales" id="idSales" value="{{ $sales[0]->s_id }}">
      <tr>
        <td class="text-center">
          <input onchange="Packing()" id="Packing" type="checkbox" value="" name="Packing">
        </td>
        <td class="text-center">
          <input onchange="Sending()" id="Sending" type="checkbox" value="" name="Sending">
        </td>
        <td class="text-center">
          <input onchange="Received()" id="Received" type="checkbox" value="" name="Received">
         </td>
         <select id="setStatus">
           <option value="PC">Packing</option>
           <option value="SN">Sending</option>
           <option value="RC">Received</option>
         </select>
      </tr>
    </tbody>
  </table> -->
<input type="text" class="hide" name="idSales" id="idSales" value="{{ $sales[0]->s_id }}">
<select id="setStatus" style="width: 75%; " class="pull-right">
           <option value="PC">Packing</option>
           <option value="SN">Sending</option>
           <option value="RC">Received</option>
</select>

<script>
  
function Packing() {
      // var cek ='N';
      // if ($('#Packing').prop('checked')) {            
      //       $('#Packing').val('PC');
      // } else {
      //       $('#Packing').val('N');            
      // }
      // cek=$('#Packing').val();            
      // alert($('#idSales').val());
    var id = $('#idSales').val();
    var status = $('#setStatus').val();

     $.ajax({
          url         : baseUrl+'/pembayaran/POSgrosir/changestatus',
          type        : 'get',
          timeout     : 10000,  
          data        : 'idSales='+id+'&status='+status,
          dataType    :'json',
          success     : function(response){
                  if(response.status=='sukses'){
                        toastr.warning('Status berhasil di ubah!');
                  }
              }
          });
  } 
 function Sending() {
  if ($('#Sending').prop('checked')) {            
            $('#Sending').val('Sending');
      } else {
            $('#Sending').val('N');           
      }
    
  } 
  function Received() {
      if ($('#Received').prop('checked')) {            
            $('#Received').val('Received');
      } else {
            $('#Received').val('N');           
      }
  } 
</script>