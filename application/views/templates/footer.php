<footer>
    <div class="container-fluid p-2 blue">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <ul class="nav justify-content-center justify-content-md-start">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('#servis'); ?>">Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('#vote'); ?>">Vote</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('#about'); ?>">About</a>
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
<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/wow.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/gijgo.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/Chart.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/main.js'); ?>"></script>
<script>
    $(document).ready(function() {
        var url = window.location.pathname.split("/").splice(0, 5);

        if(url[2].length > 0){
            console.log('Hash successfully loaded')
            return
        }

        $("a").on('click', function(event) {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;

                if (hash === "#createVote" || hash === "#room") {
                    window.location.hash = hash;
                    return
                }

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