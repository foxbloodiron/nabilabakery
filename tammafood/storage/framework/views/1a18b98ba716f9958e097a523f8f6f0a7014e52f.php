    <script src="<?php echo e(asset ('assets/script/jquery-1.10.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery-migrate-1.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/bootstrap-hover-dropdown.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/html5shiv.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/respond.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.metisMenu.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.slimscroll.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.cookie.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/js/js_ssb.js')); ?>"></script>
    
    <script src="<?php echo e(asset ('assets/script/custom.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.news-ticker.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.menu.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/pace.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/holder.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/responsive-tabs.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.flot.categories.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.flot.tooltip.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.flot.resize.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.flot.fillbetween.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.flot.stack.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.flot.spline.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/zabuto_calendar.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/index.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/dataTables.bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/toastr/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/bootstrap-live-search/js/bootstrap-select.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/sliptree-multiselect/bootstrap-tokenfield.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/sweetalert/dist/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/sweetalert/dist/sweetalert.js')); ?>"></script>

    <!--LOADING SCRIPTS FOR CHARTS-->
    <script src="<?php echo e(asset ('assets/script/highcharts.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/data.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/drilldown.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/exporting.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/highcharts-more.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/charts-highchart-pie.js')); ?>"></script>
    <script src="<?php echo e(asset ('assets/script/charts-highchart-more.js')); ?>"></script>



    <!--CORE JAVASCRIPT-->
    <script src="<?php echo e(asset ('assets/script/main.js')); ?>"></script>



    <script type="text/javascript">
        var baseUrl = '<?php echo e(url('/')); ?>';
    </script>

    <script type="text/javascript">
        function numberOnly(){
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

        }
        $(document).ready(function(){
            var extensions = {
         "sFilterInput": "form-control input-sm",
        "sLengthSelect": "form-control input-sm"
    }
    // Used when bJQueryUI is false
    $.extend($.fn.dataTableExt.oStdClasses, extensions);
    // Used when bJQueryUI is true
    $.extend($.fn.dataTableExt.oJUIClasses, extensions);

            $("input[type='number']").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
        });

        var extensions = {
             "sFilterInput": "form-control input-sm",
            "sLengthSelect": "form-control input-sm"
        }
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
                "sSearch": '<i class="fa fa-search"></i>',
                "sLengthMenu": "Menampilkan &nbsp; _MENU_ &nbsp; Data",
                "infoEmpty": "",
                "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                     }
              }

            });
        $('#data2').dataTable({
              "responsive":true,

              "pageLength": 10,
            "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
            "language": {
                "searchPlaceholder": "Cari Data",
                "emptyTable": "Tidak ada data",
                "sInfo": "Menampilkan _START_ - _END_ Dari _TOTAL_ Data",
                "sSearch": '<i class="fa fa-search"></i>',
                "sLengthMenu": "Menampilkan &nbsp; _MENU_ &nbsp; Data",
                "infoEmpty": "",
                "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                     }
              }

            });
        $('#data3').dataTable({
              "responsive":true,

              "pageLength": 10,
            "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
            "language": {
                "searchPlaceholder": "Cari Data",
                "emptyTable": "Tidak ada data",
                "sInfo": "Menampilkan _START_ - _END_ Dari _TOTAL_ Data",
                "sSearch": '<i class="fa fa-search"></i>',
                "sLengthMenu": "Menampilkan &nbsp; _MENU_ &nbsp; Data",
                "infoEmpty": "",
                "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                     }
              }

            });
            $('.datepicker').datepicker({
              format: "mm/yyyy",
              viewMode: "months",
              minViewMode: "months"
            });
            $('.datepicker2').datepicker({
              format:"dd/mm/yyyy"
            });
    </script>
