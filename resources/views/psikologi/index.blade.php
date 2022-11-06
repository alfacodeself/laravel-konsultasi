
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laravel Konsultasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('landingpage/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('landingpage/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landingpage/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="{{ asset('landingpage/css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="#">Konsultasi App</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    </div>
  </header><!-- End Header -->

    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

        <div class="row">
            <div class="col-lg-9 text-center text-lg-start">
                <h3>{{ $psycholog->judul }}</h3>
                <p>{{ $psycholog->deskripsi }}</p>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-center">
                      Baca panduan pengisiannya, yuk!
                    </h4>
                    <hr>
                    <ol>
                      <li class="mb-2">Gak ada jawaban yang benar atau salah. Isilah dengan jujur sesuai kepribadianmu.</li>
                      <li class="mb-2">Santai aja, tes ini gak diberi waktu, kok.</li>
                      <li class="mb-2">Cari tempat yang nyaman dan kondusif supaya kamu lebih fokus.</li>
                      <li class="mb-2">Jika kamu keluar di tengah tes, maka seluruh proses tes dan jawaban akan hilang.</li>
                      <li class="mb-2">Hasil tes bisa kamu dapatkan setelah mengisi semua pertanyaan dengan lengkap.</li>
                      <li class="mb-2">Untuk melihat hasil tes, kamu diharuskan login dulu ya.</li>
                    </ol>
                    <h5 class="text-center">Selamat mengisi, ya! : )</h5>
                  </div>
                </div>
            </div>
            
            <div class="col-lg-3 cta-btn-container text-center">
                <a class="cta-btn align-middle" href="{{ route('psikologi.show', $psycholog->uuid) }}">Mulai Test</a>
            </div>
        </div>

        </div>
    </section><!-- End Cta Section -->

  <main id="main">
    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-newsletter">
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-md-6 footer-contact">
            <h3>Arsha</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Alfa Code</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>

    
    
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('landingpage/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('landingpage/vendor/waypoints/noframework.waypoints.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('landingpage/js/main.js') }}"></script>

</body>

</html>