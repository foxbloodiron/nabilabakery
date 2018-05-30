
<?php $__env->startSection('content'); ?>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
                        <div class="page-title">POS Penjualan Toko | Mobile</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="<?php echo e(url('/home')); ?>">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><i></i>&nbsp;Penjualan&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">POS Penjualan Toko | Mobile</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                    </div>
                </div>
                <div class="page-content">
                    <div id="tab-general">
                        
                        <?php echo $__env->make('penjualan.POSpenjualan.pilihan', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </div>
                    
                </div>
            </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("extra_scripts"); ?>
    <script type="text/javascript">

      </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>