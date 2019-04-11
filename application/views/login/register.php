<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnVot</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/vendors/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/animate.css">

    <!-- Font import -->
    <link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 text-center">
        <div class="card w-50 m-auto">
            <div class="card-body">
                <h5 class="card-title">Register</h5>
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
    <!-- Javascript libs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("a").on('click', function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 1200, function() {
                        window.location.hash = hash;
                    });
                }
            });
        });

        // Animate & wow init
        new WOW().init()

        // Datepicker
        $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
</body>

</html>