        <table class="table tabelan table-bordered table-hover dt-responsive" id="data2">
            <thead>
              <th width="2%">Tanggal Nota</th>
              <th width="15%">No Nota</th>
              <th width="2%">Customer</th>
              <th width="20%">Nominal</th>
              <th width="10%">Status</th>
              <th width="10%">Ubah Status</th>
              <th width="15%">Aksi</th>            
            </thead>
            <tbody>
              @foreach ($detalis as $index => $detail)                       
              <tr>
                <td class="text-center">{{ date('d M Y', strtotime($detail->s_date)) }}</td>
                <td class="text-center">{{ $detail->s_note }}</td>
                <td class="text-center">{{ $detail->c_name }}</td>
                <td>Rp.
                  <span class="pull-right">
                  {{ number_format( $detail->s_gross ,2,',','.')}}
                  </span>
                </td>
                <td class="text-center">
                    @if($detail->s_status=='DR')
                    Draft
                    @elseif($detail->s_status=='WA')
                    Waiting
                    @elseif($detail->s_status=='PR')
                    Progres
                    @elseif($detail->s_status=='FN')
                    Final
                    @elseif($detail->s_status=='PC')
                    Packing
                    @elseif($detail->s_status=='SN')
                    Sending
                    @endif
                </td>
                <td class="text-center">
                  @if($detail->s_status=='FN' || $detail->s_status=='SN' || $detail->s_status=='PC')
                    <button type="button" class="btn btn-success btn-sm glyphicon glyphicon-check" title="Ubah Status" data-toggle="modal"  onclick="ubahStatus('{{ $detail->s_id }}','{{ $detail->s_status }}')" data-target="#modalStatus">
                    </button>
                  @else
                    <button type="button" class="btn btn-success btn-sm glyphicon glyphicon-check" title="Ubah Status" data-toggle="modal"  onclick="ubahStatus('{{ $detail->s_id }}','{{ $detail->s_status }}')" data-target="#modalStatus" disabled="">
                    </button>
                  @endif
                </td>
                <td class="text-center">
                  <div>
                   <button type="button" class="btn btn-success fa fa-eye btn-sm" title="detail" data-toggle="modal"  onclick="lihatDetail('{{ $detail->s_id }}')" data-target="#myItem">
                   </button>
                   <a href="{{ url('/penjualan/POSgrosir/grosir/edit_sales',$detail->s_id) }}" class="btn btn-warning btn-sm" title="Edit" @if($detail->s_status=='FN') disabled  @endif><i class="fa fa-pencil"></i></a>
                   <a onclick="return confirm('Apakah anda yakin?')"; href="{{ url('/penjualan/POSgrosir/grosir/distroy',$detail->s_id) }}" class="btn btn-danger btn-sm" title="Hapus" @if($detail->s_status=='FN') disabled  @endif><i class="fa fa-trash-o"></i></a>

                  </div>                            
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

<script>
  $('#data2').DataTable();

  function ubahStatus(idDetail,status){
     $.ajax({
      url : baseUrl + "/penjualan/POSgrosir/ubahstatus",
      type: 'get',
      data: {status:status, id:idDetail},
      success:function(response){
        $('#ubahStatusSales').html(response);
      }
    });   
  }

</script>
