<table class="table tabelan table-hover table-bordered" id="tableNotaPlan">
	<thead>
	  <tr>
	    <th>No Nota</th>
	    <th>Nama</th>
	    <th>Tanggal</th>
	    <th style="width:13%;">Jumlah Order</th>
	  </tr>
	</thead>
	<tbody>
	@foreach($nota as $nt)
		<tr>
			<td>{{ $nt->s_note }}</td>
			<td>{{ $nt->c_name }}</td>
			<td>{{ date('d-m-Y' ,strtotime ($nt->s_date)) }}</td>
			<td style="text-align:right">{{ $nt->sd_qty }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$('#tableNotaPlan').dataTable({
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
	});
</script>