<div class="container mt-5 text-center">
   <div class="card w-50 m-auto">
      <div class="card-body">
         <h5 class="card-title">Reset Password</h5>
         <?= $this->session->flashdata('message'); ?>
         <form action="<?= $kode?>" method="post">
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
               </div>
               <input type="password" class="form-control" name="password" placeholder="Enter new password">
            </div>
            <small class="form-text text-danger"><?= form_error('password'); ?></small>
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
               </div>
               <input type="password" class="form-control" name="passwordConf" placeholder="Re-enter new password">
            </div>
            <small class="form-text text-danger"><?= form_error('passwordConf'); ?></small>
            <button class="btn btn-primary col col-lg-12 p-1 mb-2 mt-1" type="submit">Reset password</button>
         </form>
      </div>
   </div>
</div>
</body>

</html>