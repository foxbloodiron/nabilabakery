
<table class="table tabelan table-bordered table-hover" id="TbDtDetail">
    <thead>
      <tr>
        <th>No</th>
        <th width="25%">Item</th>
        <th>Type Produk</th>
        <th>Group Produk</th>
        <th>Waktu</th>
        <th>Jumlah</th>
        <th>Satuan</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($detalis as $index => $detail)   
      <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $detail->i_name }}</td>
        <td>
          @if($detail->i_type=='BP')
          Barang Produksi
          @endif
        </td>
        <td>{{ $detail->i_group }}</td>
        <td>{{ $detail->prdt_time }}</td>
        <td>{{ $detail->prdt_qty }}</td>
        <td></td>
      </tr>
    @endforeach
    </tbody>
  </table>

<script>
   $('#TbDtDetail').DataTable();

</script>