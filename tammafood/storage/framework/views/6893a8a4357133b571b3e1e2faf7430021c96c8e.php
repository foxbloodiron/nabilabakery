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
	<?php $__currentLoopData = $nota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($nt->s_note); ?></td>
			<td><?php echo e($nt->c_name); ?></td>
			<td><?php echo e(date('d-m-Y' ,strtotime ($nt->s_date))); ?></td>
			<td style="text-align:right"><?php echo e($nt->sd_qty); ?></td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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