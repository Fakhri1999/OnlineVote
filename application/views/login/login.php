    <div class="container mt-5 text-center">
        <div class="card w-50 m-auto">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <?= $this->session->flashdata('message'); ?>
                <form action="login" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <small class="form-text text-danger"><?= form_error('username'); ?></small>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <small class="form-text text-danger"><?= form_error('password'); ?></small>
                    <button class="btn btn-primary col col-lg-12 p-1 mb-2 mt-1" type="submit">Login</button>
                    <a class="btn btn-primary col col-lg-12 p-1 mb-2 mt-1" href="<?=base_url() ?>">Home</a>                
                    <div class="row">
                        <small class="col col-lg-6">Dont have account? <a href="register">Register here</a></small><br>
                        <small class="col col-lg-6">Forget your password? <a href="forget">Click here</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>