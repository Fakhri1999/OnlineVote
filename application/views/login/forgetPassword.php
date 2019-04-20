    <div class="container mt-5 text-center">
        <div class="card w-50 m-auto">
            <div class="card-body">
                <h5 class="card-title">Forget Password</h5>
                <?= $this->session->flashdata('message'); ?>
                <form action="forget" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <small class="form-text text-danger"><?= form_error('username'); ?></small>
                    <button class="btn btn-primary col col-lg-12 p-1 mb-2 mt-1" type="submit">Continue</button>
                    <div>
                        <small>Back to login? <a href="login">Click here</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>