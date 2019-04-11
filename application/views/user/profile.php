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
                    <!-- <a class="btn btn-md btn-outline-light txt-mid" href="">Login</a> -->
                    <a class="btn btn-outline-primary tombol pl-5 pr-5" href="">Login</a>
                </ul>
            </div>
        </div>
    </nav>

    <!-- user profile -->
    <section class="container mt-3">
        <div class="row">
            <div class="col col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-lg-8 text-dark">
                                <p class="font-weight-normal">Muhammad Wildan Aldiansyah</p>
                                <p class="font-weight-normal">Username : Aldiwildan</p>
                                <p class="font-weight-normal">Email : Aldiwild77@gmail.com</p>
                                <p class="font-weight-normal">Room Created :</p>
                                <p class="font-weight-normal">Voted :</p>
                            </div>
                            <div class="col col-lg-4 text-right">
                                <button class="btn btn-md btn-outline-secondary">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="container">
                <ul class="nav nav-tabs" id="profileList" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="room-tab" data-toggle="tab" href="#room" role="tab"
                            aria-controls="room" aria-selected="true">Room</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="create-tab" data-toggle="tab" href="#createVote" role="tab"
                            aria-controls="createVote" aria-selected="false">Create Vote</a>
                    </li>
                </ul>
                <div class="tab-content" id="profileContent">
                    <div class="bg-white tab-pane fade show active" id="room" role="tabpanel"
                        aria-labelledby="room-tab">
                        <div class="container p-3">
                            <div class="row">
                                <div class="container">
                                    <p class="lead">Vote Room List</p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <th>#</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Start at</th>
                                                <th>End at</th>
                                                <th>Option</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>1</td>
                                                    <td>c8Ak1F</td>
                                                    <td>Pemilihan Ketua Kelas</td>
                                                    <td>27-04-2019</td>
                                                    <td>29-04-2019</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary mb-1 mr-1"><i
                                                                class="fa fa-list"></i> Details</button>
                                                        <button class="btn btn-sm btn-outline-danger mb-1"><i
                                                                class="fa fa-times"></i> End Vote</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>c8Ak1F</td>
                                                    <td>Pemilihan Ketua Kelas</td>
                                                    <td>27-04-2019</td>
                                                    <td>29-04-2019</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary mb-1 mr-1"><i
                                                                class="fa fa-list"></i> Details</button>
                                                        <button class="btn btn-sm btn-outline-danger mb-1"><i
                                                                class="fa fa-times"></i> End Vote</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>c8Ak1F</td>
                                                    <td>Pemilihan Ketua Kelas</td>
                                                    <td>27-04-2019</td>
                                                    <td>29-04-2019</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary mb-1 mr-1"><i
                                                                class="fa fa-list"></i> Details</button>
                                                        <button class="btn btn-sm btn-outline-danger mb-1"><i
                                                                class="fa fa-times"></i> End Vote</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>c8Ak1F</td>
                                                    <td>Pemilihan Ketua Kelas</td>
                                                    <td>27-04-2019</td>
                                                    <td>29-04-2019</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary mb-1 mr-1"><i
                                                                class="fa fa-list"></i> Details</button>
                                                        <button class="btn btn-sm btn-outline-danger mb-1"><i
                                                                class="fa fa-times"></i> End Vote</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade bg-white" id="createVote" role="tabpanel"
                        aria-labelledby="createVote-tab">
                        <div class="container p-3">
                            <div class="row">
                                <div class="container">
                                    <p class="lead">Room Vote Creation</p>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="5"></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <label>Start at</label>
                                                <input name="dateStart" id="datepicker1" required>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <label>End at</label>
                                                <input name="dateFinish" id="datepicker2" required>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <label>Candidate</label>
                                                <div class="form-inline button-click">
                                                    <a class="btn btn-outline-secondary mr-1" id="min" data-min="-"><i
                                                            class="fa fa-minus"></i></a>
                                                    <input type="number" class="form-control mr-1" name="candidateCount"
                                                        min="0" value=0 readonly required>
                                                    <a class="btn btn-outline-secondary " id="plus" data-plus="+"><i
                                                            class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- Render Here -->
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-md btn-danger mr-1" type="reset">Reset</button>
                                                <button class="btn btn-md btn-primary" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container-fluid p-2 blue mt-5">
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