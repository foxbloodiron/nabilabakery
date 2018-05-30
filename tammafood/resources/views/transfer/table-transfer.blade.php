<div class="table-responsive no-padding">       
 <table class="table tabelan table-bordered no-padding" id="data4">
          <thead>
            <tr>
              <th width="7%">No</th>
              <th width="10%">Tanggal</th>    
              <th width="10%">Kode</th>              
              <th width="43%">Catatan</th>
              <th width="10%">Status</th>              
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transferItem as $index=> $data)
            <tr>
              <td>{{  ($transferItem->currentpage()-1) * $transferItem->perpage() + $index + 1  }}</td>
              <td>{{date('Y-m-d',strtotime($data->ti_time))}}</td>
              <td>{{$data->ti_code}}</td>
              <td>{{$data->ti_note}}</td>
              <td class="text-center">
                  @if($data->ti_isapproved=='N' &&  $data->ti_issent=='N' &&  $data->ti_isreceived=='N')
                      <span class="label label-red">Waiting</span>
                  @elseif($data->ti_isapproved=='Y' &&  $data->ti_issent=='N' &&  $data->ti_isreceived=='N')
                      <span class="label label-yellow">Approved</span>
                  @elseif($data->ti_isapproved=='Y' &&  $data->ti_issent=='Y' &&  $data->ti_isreceived=='N')
                      <span class="label label-blue">Sent</span>
                  @elseif($data->ti_isapproved=='Y' &&  $data->ti_issent=='Y' &&  $data->ti_isreceived=='Y')
                      <span class="label label-success">Received</span>
                  @endif
              </td>
              <td class="text-center">
                @if($data->ti_isapproved=='N')
                    @if(Auth::user()->punyaAkses('Ritail Transfer','ma_update'))
                      <a onclick="editTransfer('{{$data->ti_id}}')"    class="btn btn-warning btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                    @endif
                    @if(Auth::user()->punyaAkses('Ritail Transfer','ma_delete'))
                        <a onclick="hapusTransfer('{{$data->ti_id}}')" class="btn btn-danger btn-xs" title="Hapus"
                        ><i class="glyphicon glyphicon-trash"></i></a>
                    @endif
                @else
                  <a onclick="editTransfer('{{$data->ti_id}}')"    class="btn btn-warning btn-xs" title="Edit"   
                  ><i class="fa fa-eye"></i></a>
                @endif

                  
              </td>
         
            </tr> 
            @endforeach
          </tbody>
</table>
<div  class="pull-right">
    {{$transferItem->links()}}
</div>
</div>


