<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
  <title>SAZLibrary</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('/assets/img/brand/favicon.png') }}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
  type="text/css">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .card {
        width: 200px; /* Lebar tetap card */
        height: 300px; /* Tinggi tetap card */
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        margin: 0 auto;
        display: flex; /* Gunakan flexbox untuk tata letak */
        flex-direction: column; /* Atur orientasi ke kolom */
        justify-content: center; /* Pusatkan vertikal */
        align-items: center; /* Pusatkan horizontal */
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-img-top {
        width: 100%;
        height: 70%; /* Sesuaikan tinggi gambar sesuai kebutuhan */
        object-fit: cover;
    }

    .card-title {
        margin-top: 10px;
        text-align: center; /* Pusatkan teks judul di dalam card */
    }
</style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="logo"><a href="index.html"><img src="assets/img/brand/blue.png" alt="Logo"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
            <li><a class="nav-link scrollto" href="#daftar-buku">Gallery</a></li>
            <li><a class="nav-link scrollto" href="#testimonials">Rating</a></li>
            <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
            <li class="getstarted">
                <a class="scrollto" href="{{ route('login') }}" id="signin">SignIn</a>
                <span class="separator">|</span>
                <a class="scrollto" href="{{ route('register') }}" id="signup">SignUp</a>
            </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>

    <!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
          <div>
            <h1>Selamat datang di SAZLibrary!</h1>
            <h2>SAZLibrary menyediakan akses mudah untuk membaca dan meminjam buku secara online. Temukan koleksi buku
                kami
                dan nikmati pengalaman meminjam yang mudah dan nyaman.</h2>
          </div>
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Gallery Section ======= -->
    <section id="daftar-buku" class="daftar-buku">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Daftar Buku</h2>
                <p>Temukan berbagai judul buku yang menarik di SAZLibrary.</p>
            </div>
        </div>

        <div class="container-fluid" data-aos="fade-up">
        <div class="gallery-slider swiper">
            <div class="swiper-wrapper">
                @forelse ($bukus as $buku)
                <div class="swiper-slide">
    <div class="card">
        <img src="{{ asset('uploads/images/' . $buku->gambar) }}" class="card-img-top" alt="{{ $buku->judul }}">
        <div class="card-body">
            <h5 class="card-title">{{ $buku->judul }}</h5>
            <!-- tambahkan informasi lainnya seperti pengarang, genre, dll sesuai kebutuhan -->
        </div>
    </div>
</div>


                @empty
                    <p>Tidak ada data buku.</p>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    </section><!-- End Gallery Section -->

   <!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Ulasan Buku</h2>
            <p>Berikut adalah ulasan dari beberapa pembaca yang menggunakan SAZLibrary.</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @forelse ($bukus as $buku)
                    @forelse ($buku->ulasans as $ulasan)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <h3 style="text-align: center;">{{ $ulasan->user->name }} - {{ $buku->judul }}</h3>
                                <h4 style="text-align: center;">{!! str_repeat('<i class ="fa fa-star"></i>', $ulasan->rating) !!}</h4>
                                <p style="text-align: center;">
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    {{ $ulasan->ulasan }}
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    @empty
                    
                    @endforelse
                @empty
                    <!--  -->
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- End Testimonials Section -->

   <!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Kontak Kami</h2>
            <p>Hubungi kami jika Anda memiliki pertanyaan atau komentar.</p>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-6">
                <div style="background-color: #E0D7C8;" class="row">
                    <div class="col-lg-6 info">
                        <i class="bx bx-map"></i>
                        <h4>Alamat</h4>
                        <p>Jalan Inovasi No. 42 Central TechHub District<br>Kota Bogor, 54321
                            Indonesia</p>
                    </div>
                    <div class="col-lg-6 info">
                        <i class="bx bx-phone"></i>
                        <h4>Hubungi Kami</h4>
                        <p>(+62)838-0324-6357</p>
                    </div>
                    <div class="col-lg-6 info">
                        <i class="bx bx-envelope"></i>
                        <h4>Email</h4>
                        <p>contact@sazlibrary.com<br>contact@sazcode.com</p>
                    </div>
                    <div class="col-lg-6 info">
                        <i class="bx bx-time-five"></i>
                        <h4>Jam Kerja</h4>
                        <p>Senin - Jumat: 9AM s/d 5PM</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Contact Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Salwa Adia Zahra</span></strong>. XII RPL 1
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
