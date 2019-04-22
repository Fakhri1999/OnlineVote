<div class="jumbotron jumbotron-fluid">
    <div class="container section text-center txt-150">
        <h1 class="display-4 txt-up text-white">Create your vote <span class="font-weight-bold txt-pink">easily</span><br>and <span class="font-weight-bold txt-pink">better</span> with us</h1>
        <p class="lead"></p>
        <a class="btn btn-lg btn-primary tombol tombol-lg" href="#vote">Get started</a>
    </div>
</div>
<section class="container section-md wow bounceInUp" id="servis">
    <div class="row">
        <div class="container text-center">
            <h1 class="display-4 txt-pink">Our Services</h1>
            <h1 class="text-black">We provide the best service for your online vote</h1>
            <p class="lead">With services that are ready to help and meet your needs</p>
        </div>
    </div>
    <div class="row text-center justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title txt-pink">Vote Room Creation</h3>
                            <hr>
                            <p class="card-text lead">Register first and create your own vote room with unique code
                                and
                                share the code with other people</p>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title txt-pink">Save to File</h3>
                            <hr>
                            <p class="card-text lead">We support many files to store the voting results according
                                with your
                                choice</p>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title txt-pink">Realtime Vote Result</h3>
                            <hr>
                            <p class="card-text lead">Real time live result for the vote maker with automatic result
                                calculation</p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid section-md mt-5 blue" id="vote">
    <div class="wow zoomIn">
        <form action="room" method="post">
            <div class="row">
                <div class="col col-lg-12 mb-2 text-center">
                    <h4>Insert Your <span class="txt-pink">Vote Room's Code</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="input-group col col-lg-6 col-md-6 col-sm-6 col-xs-6 mx-auto">
                    <input type="text" class="form-control" placeholder="" name="codeVote" maxlength="5">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">Enter</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-12 mb-2 text-center">
                    <!-- <?= $this->session->flashdata('rooms'); ?> -->
                </div>
            </div>
        </form>
    </div>
</section>
<section class="container section-md" id="about">
    <div class="row align-items-center">
        <div class="col-12 col-md-12 col-lg-6 col-xl-5">
            <h1 class="wow fadeInDown txt-pink">OnVot Website</h1>
            <p class="lead wow fadeInLeft mb-5">a website that provides voting rooms. With registering you can
                make your own voting room according to your desire and get your own unique code. Here we provide a
                realtime vote result and the results of the vote can be documented into a document</p>
            <p class="wow bounceInUp txt-pink"><strong>Works in every browser:</strong></p>
            <p class="wow bounceInUp h1 text-muted">
                <i class="fab fa fa-chrome mr-3"></i>
                <i class="fab fa fa-safari mr-3"></i>
                <i class="fab fa fa-firefox mr-3"></i>
                <i class="fab fa fa-edge"></i>
            </p>
        </div>
        <div class="col-12 col-md-8 m-auto ml-lg-auto mr-lg-0 col-lg-6 pt-5 pt-lg-0">
            <img alt="image" class="wow fadeInRight img-fluid" src="./assets/image/draws/browsers.svg">
        </div>
    </div>
</section>
<section class="fdb-block">
    <div class="container section">
        <div class="row pb-3">
            <div class="col text-center">
                <h1 class="wow pulse txt-pink">Why Choose Us ?</h1>
                <p class="wow pulse lead">People's choice for an easier online vote with many features from us</p>
            </div>
        </div>
        <div class="row pt-5 justify-content-center align-items-center">
            <div class="col-3 text-center">
                <img alt="image" class="wow fadeIn img-fluid" src="./assets/image/draws/design-life.svg">
                <p class="lead mt-3">Responsive</p>
            </div>
            <div class="col-3 offset-1 text-center">
                <img alt="image" class="wow fadeIn img-fluid" src="./assets/image/draws/designer.svg">
                <p class="lead mt-3">Easy to Use</p>
            </div>
            <div class="col-3 offset-1 text-center">
                <img alt="image" class="wow fadeIn img-fluid" src="./assets/image/draws/design-community.svg">
                <p class="lead mt-3">Beautiful UI</p>
            </div>
        </div>
    </div>
</section>