    <!-- user profile -->
    <section class="container mt-3">
        <div class="row">
            <div class="col col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="col col-lg-8 text-dark">
                                <p class="font-weight-normal">Name : <?= $this->session->userdata('name'); ?></p>
                                <p class="font-weight-normal">Username : <?= $this->session->userdata('username'); ?></p>
                                <p class="font-weight-normal">Email : <?= $this->session->userdata('email'); ?></p>
                                <p class="font-weight-normal">Room Created : <?= $room; ?></p>
                                <p class="font-weight-normal">Voted : <?= $voted; ?></p>
                            </div>
                            <div class="col col-lg-4 text-right">
                                <button type="button" class="btn btn-md btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-sembarang="paswd" data-func="Password">Edit Password</button>
                                <button type="button" class="btn btn-md btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-sembarang="editprof" data-func="Profile">Edit Profile</button>
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
                        <a class="nav-link active" id="room-tab" data-toggle="tab" href="#room" role="tab" aria-controls="room" aria-selected="true">Room</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="create-tab" data-toggle="tab" href="#createVote" role="tab" aria-controls="createVote" aria-selected="false">Create Vote</a>
                    </li>
                </ul>
                <div class="tab-content" id="profileContent">
                    <div class="bg-white tab-pane fade show active" id="room" role="tabpanel" aria-labelledby="room-tab">
                        <div class="container p-3">
                            <div class="row">
                                <div class="container">
                                    <p class="lead">Vote Room List</p>
                                    <div class="row">
                                        <div class="col-12"><?= $this->session->flashdata('voteNow'); ?></div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <th>#</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Start at</th>
                                                <th>End at</th>
                                                <th>Status</th>
                                                <th>Option</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php
                                                $no = 0;
                                                foreach ($sql as $value) :
                                                    $no++;
                                                    ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $value->kode_room; ?></td>
                                                        <td><?= $value->judul; ?></td>
                                                        <td><?= $value->waktu_pembuatan; ?></td>
                                                        <td><?= $value->waktu_akhir; ?></td>
                                                        <td>
                                                            <?php if ($value->active) : ?>
                                                                <button disabled="disabled" class="btn btn-sm btn-success">Active</button>
                                                            <?php else : ?>
                                                                <button disabled="disabled" class="btn btn-sm btn-secondary">Inactive</button>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary mb-1 mr-1" onClick="roomDetail('<?= $value->kode_room; ?>')"><i class="fa fa-list"></i> Details</button>
                                                            <a class="btn btn-sm btn-outline-success mb-1 mr-1" href="<?= site_url("saveToFile/{$value->kode_room}/excel"); ?>" target="_blank"><i class="fa fa-list"></i> Save to File</a>
                                                            <?php if ($value->active) : ?>
                                                                <button class="btn btn-sm btn-outline-danger mb-1" onClick="endVote('<?= $value->kode_room; ?>')"><i class="fa fa-times"></i> End Vote</button>
                                                            <?php else : ?>
                                                                <button class="btn btn-sm btn-outline-primary mb-1" onClick="startVote('<?= $value->kode_room; ?>')"><i class="fa fa-check"></i> Start Vote</button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade bg-white" id="createVote" role="tabpanel" aria-labelledby="createVote-tab">
                        <div class="container p-3 mb-3">
                            <div class="row">
                                <div class="container">
                                    <p class="lead">Room Vote Creation</p>
                                    <form action="createVote" method="post">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="What food will bring tomorrow ?" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" placeholder="description here..." rows="5"></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <label>Start at</label>
                                                <input name="dateStart" id="datepicker1" placeholder="mm/dd/YYYY" required>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <label>End at</label>
                                                <input name="dateFinish" id="datepicker2" placeholder="mm/dd/YYYY" required>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <label>Candidate</label>
                                                <input type="number" class="form-control" min="2" max="25" placeholder="2" id="numberOfCandidate" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="row mt-3 mb-3 renderThis">
                                                    <!-- <div class="p-3 card shadow-sm wow fadeIn">
                                                        <div class="card-body">
                                                            Render Here
                                                        </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <div class="col-md-12 text-right">
                                                    <button class="btn btn-md btn-danger mr-1" type="reset">Reset</button>
                                                    <button class="btn btn-md btn-primary" type="submit">Submit</button>
                                                </div>
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

    <!-- Modal Box -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formModal">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" id="rowOne"></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputOne" name="inputOne" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" id="rowTwo"></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputTwo" name="inputTwo" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" id="rowThree"></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputThree" name="inputThree" value="" required>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>