    <div class="container mt-5 text-center">
        <div class="card w-50 m-auto">
            <div class="card-body">
                <h5 class="card-title">Register</h5>
                <form action="register" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="fullname" placeholder="Fullname" value="<?= set_value('fullname');?>">
                    </div>
                    <small class="form-text text-danger"><?= form_error('fullname'); ?></small>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><strong>@</strong></span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= set_value('username');?>">
                    </div>
                    <small class="form-text text-danger"><?= form_error('username'); ?></small>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value('email');?>">
                    </div>
                    <small class="form-text text-danger"><?= form_error('email'); ?></small>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <small class="form-text text-danger"><?= form_error('password'); ?></small>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="passwordconf" placeholder="Password Confirmation">
                    </div>
                    <small class="form-text text-danger"><?= form_error('passwordconf'); ?></small>
                    <button type="submit" class="btn btn-primary col col-lg-12 p-1 mb-2 mt-1">Register</button>
                    <div>
                        <small>Already have an account? <a href="login">Login here</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>