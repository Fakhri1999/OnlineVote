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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./assets/js/wow.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/main.js'); ?>" type="text/javascript"></script>
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