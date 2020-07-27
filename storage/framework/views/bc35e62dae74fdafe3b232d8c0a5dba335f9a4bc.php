
<!--message-->
<?php if(session()->has('success')): ?>

<script type="text/javascript">
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
  });

  Toast.fire({
    type: 'success',
    icon: 'success',
    title: '<?php echo session()->get('success'); ?>'
  })
</script>
<?php endif; ?>

<?php if(session()->has('error')): ?>
<script type="text/javascript">
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  Toast.fire({
    type: 'error',
    icon: 'error',
    title: '<?php echo session()->get('error'); ?>'
  })
</script>
<?php endif; ?>

<?php if(session()->has('warning')): ?>
<script type="text/javascript">
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  Toast.fire({
    type: 'warning',
    icon: 'warning',
    title: '<?php echo session()->get('warning'); ?>'
  })

  //===============Toast function================//

</script>
<?php endif; ?>
<?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/partials/alert.blade.php ENDPATH**/ ?>