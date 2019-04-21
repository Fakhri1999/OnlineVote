<section class="container mt-3 mb-3">
    <div class="row">
        <div class="col col-lg-12">
            <form action="submitVote" method="post">
                <div class="p-3 card shadow-sm wow fadeIn">
                    <div class="card-body">
                        <div class="row fadeIn">
                            <input type="hidden" name="kode_room" value="<?= $sql[0]->kode_room; ?>">
                            <h2><?= $sql[0]->judul; ?></h2>
                        </div>
                        <div class="row">
                            <p><?= $sql[0]->deskripsi; ?></p>
                        </div>
                        <div class="row wow fadeInUp">
                            <?php foreach ($sql as $value) : ?>
                                <div class="col-lg-4">
                                    <div class="card mx-1 mb-3 shadow-sm">
                                        <div class="card-body">
                                            <!-- <img src="./assets/image/people/1.jpg" alt=""> -->
                                            <div class="text-center">
                                                <input type="radio" name="candidateVote" value="<?= $value->id_pilihan; ?>">
                                                <label>&nbsp; <?= $value->nama_pilihan; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <input class="mx-2 btn btn-outline-success wow fadeInUp" type="submit" value="Submit Vote">
                </div>
            </form>
        </div>
    </div>
</section>