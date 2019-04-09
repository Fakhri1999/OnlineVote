<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./vendors/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/animate.css">

    <!-- Font import -->
    <link href="https://fonts.googleapis.com/css?family=Amaranth|Boogaloo" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 text-center">
        <div class="card w-50 m-auto">
            <div class="card-body">
                <form action="register" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="fullname" placeholder="Fullname">
                    </div>
                    <small class="form-text text-danger"><?= form_error('fullname'); ?></small>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><strong>@</strong></span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <small class="form-text text-danger"><?= form_error('username'); ?></small>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Email">
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
                        <!-- error here -->
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
</body>

</html>