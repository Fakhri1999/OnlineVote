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
                            <?php foreach ($sql as $value) : ?>
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
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <input class="mx-2 btn btn-outline-success wow fadeInUp" type="submit" value="Submit Vote">
                </div>
            </form>
        </div>
    </div>
</section>