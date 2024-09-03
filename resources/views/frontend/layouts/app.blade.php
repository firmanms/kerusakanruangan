<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Simpel Kerudung</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('frontend/assets/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('frontend/assets/img/apple-touch-icon.png ')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css ')}}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css ')}}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/aos/aos.css" rel="stylesheet ')}}">
  <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css ')}}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css ')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('frontend/assets/css/main.css ')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bootslander
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Simpel Kerudung</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda</a></li>
          <li><a href="#about">Tentang</a></li>
          {{-- <li><a href="#features">Features</a></li> --}}
          <li><a href="#faq">Faq</a></li>
          <li><a href="#contact">Kontak</a></li>
          <li><a href="/back">Masuk</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="{{ asset('frontend/assets/img/hero-bg-2.jpg ')}}" alt="" class="hero-bg">

      <div class="container">
        <div class="row gy-4 justify-content-between">
          <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('frontend/assets/img/hero-img1.png ')}}" class="img-fluid animated" alt="">
          </div>

          <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
            <h1>Selamat Datang <span></span></h1>
            <p>Simpel Kerudung Sistem Self Assesment Pelaporan Tingkat Kerusakan Gedung Pendidikan SD di Dinas Pendidikan Kab.  Bandung</p>
            <div class="d-flex">
              {{-- <a href="#about" class="btn-get-started">Get Started</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
            </div>
          </div>

        </div>
      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-xl-5 content">
            <h3>Tentang</h3>
            <h2>Simpel Kerudung</h2>
            <p>Sistem pelaporan tingkat kerusakan gedung pendidikan SD di dinas pendidikan kab.  Bandung adalah sistem self-assessment yang dirancang untuk membantu evaluasi kerusakan pada gedung, khususnya gedung sekolah. Aplikasi ini memungkinkan pengguna, seperti staf sekolah atau pihak terkait, untuk melakukan penilaian mandiri terhadap kondisi fisik gedung sekolah. Dengan sistem ini, pengguna dapat mengidentifikasi kerusakan secara cepat dan efisien, serta melaporkan hasil penilaian untuk diambil tindakan lebih lanjut.</p>
            <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

          <div class="col-xl-7">
            <div class="row gy-4 icon-boxes">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box">
                  <i class="bi bi-file-text"></i>
                  <h3>Pengisian Formulir Penilaian</h3>
                  <p>Pengguna dapat mengisi formulir terkait kondisi fisik gedung sekolah, seperti dinding, atap, lantai, dan fasilitas lainnya.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Pemetaan Kerusakan (Soon)</h3>
                  <p>Hasil penilaian bisa diintegrasikan dengan peta gedung, sehingga lokasi kerusakan dapat dengan mudah diidentifikasi</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-megaphone"></i>
                  <h3>Pelaporan dan Rekomendasi</h3>
                  <p>Setelah penilaian, aplikasi menghasilkan laporan yang bisa digunakan oleh pihak sekolah atau dinas terkait untuk menentukan tindakan perbaikan.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-database"></i>
                  <h3>Database Kerusakan</h3>
                  <p>Semua data penilaian disimpan dalam sistem untuk memudahkan analisis dan perbandingan kondisi dari waktu ke waktu.</p>
                </div>
              </div> <!-- End Icon Box -->

            </div>
          </div>

        </div>
      </div>

    </section><!-- /About Section -->



    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-buildings text-info"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p>Total Gedung</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-emoji-neutral text-success"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Rusak Ringan</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-emoji-frown text-warning"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
              <p>Rusak Sedang</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-emoji-tear text-danger"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
              <p>Rusak Berat</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Details Section -->
    <section id="details" class="details section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Dasar Huku</h2>
        <div><span>DASAR</span> <span class="description-title">HUKUM</span></div>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('frontend/assets/img/details-4.png ')}}" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            <h3>Dasar Hukum</h3>
            <p class="fst-italic">
                Untuk dasar hukum penilaian kerusakan gedung sekolah, terdapat beberapa peraturan yang relevan dari Kementerian Pendidikan dan Kebudayaan (Kemendikbud) serta Kementerian Pekerjaan Umum dan Perumahan Rakyat (Kemnpupr).
            </p>
            <ul>
              <li><i class="bi bi-check"></i><span> UU No. 20 Tahun 2003 tentang Sistem Pendidikan Nasional: Ini adalah dasar utama dalam sistem pendidikan di Indonesia, termasuk pengelolaan dan perawatan infrastruktur pendidikan.</span></li>
              <li><i class="bi bi-check"></i> <span>PP No. 36 Tahun 2005 tentang Pelaksanaan Undang-Undang Bangunan Gedung: Mengatur standar teknis dan prosedur dalam membangun serta merawat gedung, termasuk sekolah.</span></li>
              <li><i class="bi bi-check"></i> <span>Peraturan Menteri PUPR No. 45/PRT/M/2007 tentang Pedoman Teknis Pembangunan Bangunan Gedung Negara: Mengatur standar teknis khususnya untuk gedung negara, termasuk bangunan sekolah​.</span></li>
              <li><i class="bi bi-check"></i> <span>Peraturan Menteri PU No.24 Tahun 2008 tentang Pedoman Pemeliharaan dan Perawatan Bangunan Gedung</span></li>
            </ul>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('frontend/assets/img/details-1.png ')}}" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
            <h3>Harapan</h3>
            <p class="fst-italic">
                Diharapkan Sistem Self Assessment dapat membantu pihak sekolah untuk melakukan penilaian mandiri terhadap kondisi gedung mereka secara lebih cepat dan efisien. Dengan adanya sistem ini, penilaian kerusakan dapat dilakukan sesuai dengan pedoman teknis yang telah ditetapkan, seperti Peraturan Menteri Pekerjaan Umum No. 24 Tahun 2008 tentang Pedoman Pemeliharaan dan Perawatan Bangunan Gedung. Aplikasi ini memungkinkan sekolah untuk memantau kerusakan pada bangunan secara berkala, memastikan bahwa tindakan perbaikan dapat segera diambil sebelum kerusakan semakin parah.
            </p>
            {{-- <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p> --}}
          </div>
        </div><!-- Features Item -->

      </div>

    </section><!-- /Details Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

      <div class="container-fluid">

        <div class="row gy-4">

          <div class="col-lg-12 d-flex flex-column justify-content-center order-2 order-lg-1">

            <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
              <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
              <p>
                "Frequently Asked Questions" (FAQ) atau "Pertanyaan yang Sering Diajukan" adalah sebuah daftar yang berisi pertanyaan-pertanyaan yang sering ditanyakan tentang topik tertentu, beserta jawabannya.
              </p>
            </div>

            <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

              <div class="faq-item faq-active">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Non consectetur a erat nam at lectus urna duis?</h3>
                <div class="faq-content">
                  <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h3>
                <div class="faq-content">
                  <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
                <div class="faq-content">
                  <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

          <div class="col-lg-5 order-1 order-lg-2">
            <img src="assets/img/faq.jpg" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <div><span>Dinas Pendidikan Kabupaten Bandung</span> <span class="description-title"></span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Alamat</h3>
                <p>Jl. Raya Soreang</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Telepon</h3>
                <p>+1 5589 55488 55</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-whatsapp flex-shrink-0"></i>
                <div>
                  <h3>Whatsapp</h3>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email</h3>
                <p>info@example.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4144.982720767044!2d107.52487099558039!3d-7.021754935023216!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ec329f509361%3A0x220e274e55f0494f!2sDinas%20Pendidikan%20Kabupaten%20Bandung!5e1!3m2!1sid!2sid!4v1724690260993!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            {{-- <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form> --}}
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Dinas Pendidikan Kab. Bandung</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Raya Soreang</p>
            <p class="mt-3"><strong>Telepon:</strong> <span>+1 5589 55488 55</span></p>
            <p class="mt-3"><strong>Whatsapp:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-youtube"></i></a>
          </div>
        </div>

        {{-- <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div> --}}

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Dinas Pendidikan X Diskominfo</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js ')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js ')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/aos/aos.js ')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js ')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js ')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js ')}}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('frontend/assets/js/main.js ')}}"></script>

</body>

</html>
