<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnVot</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/gijgo.min.css'); ?>">
    
    <!-- Font import -->
    <link href="<?= base_url('assets/fonts/gijgo-material.ttf');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet">
    <script src="<?= base_url('assets/js/sweetalert2@8.js'); ?>"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light blue">
        <div class="container">
            <a class="navbar-brand navbranded" href="<?= site_url(); ?>">OnVot</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarAtas" aria-controls="navbarAtas" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarAtas">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link navlinked" href="<?= site_url('home#servis'); ?>">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinked" href="<?= site_url('#vote'); ?>">Vote</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlinked" href="<?= site_url('#about'); ?>">About</a>
                    </li>
                    <?php if ($this->session->userdata('username') != null) : ?>
                        <li class="nav-item">
                            <a class="nav-link navlinked" href="user">Profile</a>
                        </li>
                        <a class="btn btn-outline-primary tombol pl-5 pr-5" href="logout">Logout</a>
                    <?php else : ?>
                        <a class="btn btn-outline-primary tombol pl-5 pr-5" href="login">Login</a>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End navbar -->

    <?php if ($this->session->flashdata('rooms')) : ?>
        <script>
            swal.fire({
                type: 'error',
                title: "<?= $this->session->flashdata('rooms'); ?>",
                button: false,
                timer: 5000,
            });
        </script>
    <?php endif; ?>