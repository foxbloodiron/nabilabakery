          <table class="table tabelan table-bordered table-hover dt-responsive" id="data2">
            <thead>
              <th width="2%">Tanggal Nota</th>
              <th width="15%">No Nota</th>
              <th width="2%">Customer</th>
              <th width="25%">Nominal</th>
              <th width="2%">Status</th>
              <th width="10%">Aksi</th>            
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
                    @elseif($detail->s_status=='FN')
                    Final
                    @endif
                </td>
                <td class="text-center">
              <div class="">
               <button type="button" class="btn btn-success fa fa-eye btn-sm" title="detail" data-toggle="modal"  onclick="lihatDetail('{{ $detail->s_id }}')" data-target="#myItem"></button>
               <a href="{{ url('/penjualan/POSretail/retail/edit_sales',$detail->s_id) }}" class="btn btn-warning btn-sm" title="Edit" @if($detail->s_status=='FN') disabled  @endif><i class="fa fa-pencil"></i></a>
               <a onclick="return confirm('Apakah anda yakin?')"; href="{{ url('/penjualan/POSretail/retail/distroy',$detail->s_id) }}" class="btn btn-danger btn-sm" title="Hapus" @if($detail->s_status=='FN') disabled  @endif><i class="fa fa-trash-o"></i></a>

              </div>                            
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
<script>
  $('#data2').DataTable();

</script>