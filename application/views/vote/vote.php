<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnVot</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./vendors/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css">

    <!-- Font import -->
    <link href="https://fonts.googleapis.com/css?family=Amaranth|Boogaloo" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light blue">
        <div class="container">
            <a class="navbar-brand navbranded" href="#">OnVot</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarAtas"
                aria-controls="navbarAtas" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarAtas">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link navlinked" href="#servis">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinked" href="#vote">Vote</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinked" href="#about">About</a>
                    </li>
                    <!-- If login -->

                    <!-- Else -->
                    <a class="btn btn-outline-primary tombol pl-5 pr-5" href="">Login</a>
                </ul>
            </div>
        </div>
    </nav>
    <section class="container mt-3 mb-3">
        <div class="row">
            <div class="col col-lg-12">
                <form action="" method="get">
                    <div class="p-3 card shadow-sm wow fadeIn">
                        <div class="card-body">
                            <div class="row fadeIn">
                                <h2>Title Here</h2>
                                <p class="lead">
                                    a website that provides voting rooms. With registering you can
                                    make your own voting room according to your desire and get your own unique code.
                                </p>
                            </div>
                            <div class="row wow fadeInUp">
                                <div class="col-lg-4">
                                    <div class="card mx-1 mb-3 shadow-sm">
                                        <div class="card-body">
                                            <!-- <img src="./assets/image/people/1.jpg" alt=""> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card mx-1 mb-3 shadow-sm">
                                        <div class="card-body">
                                            <!-- <img src="./assets/image/people/2.jpg" alt=""> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card mx-1 mb-3 shadow-sm">
                                        <div class="card-body">
                                            <!-- <img src="./assets/image/people/3.jpg" alt=""> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="mx-2 btn btn-outline-success wow fadeInUp" type="submit" value="Submit Vote">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <div class="container-fluid p-2 blue" style="padding-top: 60px;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <ul class="nav justify-content-center justify-content-md-start">
                            <li class="nav-item">
                                <a class="nav-link" href="#servis">Service</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#vote">Vote</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">About</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt-4 mt-md-0 text-center text-md-right">
                        <a href="#" class="mx-2"><i class="fab fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" class="mx-2"><i class="fab fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#" class="mx-2"><i class="fab fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="#" class="mx-2"><i class="fab fa fa-pinterest" aria-hidden="true"></i></a>
                        <a href="#" class="mx-2"><i class="fab fa fa-google" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Javascript libs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="./assets/js/wow.min.js"></script>
    <script>
        $(document).ready(function () {
            $("a").on('click', function (event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 1200, function () {
                        window.location.hash = hash;
                    });
                }
            });
        });
        new WOW().init()
    </script>
</body>

</html>