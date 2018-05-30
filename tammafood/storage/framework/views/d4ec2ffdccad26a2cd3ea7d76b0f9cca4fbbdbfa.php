<!DOCTYPE html>
<html>
     <head>
      
        <?php echo $__env->make('layouts._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('extra_styles'); ?>
     </head>
     <body class="no-skin">
     <?php echo $__env->make('layouts._sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       <div class="main-content">
            <div class="main-content-inner">  
               <?php echo $__env->yieldContent('content'); ?>
            </div>
       </div>  
        <?php echo $__env->make('layouts._scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('extra_scripts'); ?>
    </body>
</html>
