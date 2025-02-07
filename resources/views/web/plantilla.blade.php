<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="web/images/favicon.png" type="">

  <title> Burgers SRL </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="web/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="web/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="web/css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">
  <div class="hero_area">
    <div class="bg-box">
      <img src="web/images/hero-bg.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="/">
            <span>
              Burgers SRL
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
            <li class="nav-item <?php echo (Request::path() == "/")? "active" : ""; ?>">
                <a class="nav-link" href="/">Inicio<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item <?php echo (Request::path() == "takeaway")? "active" : ""; ?>">
                <a class="nav-link" href="/takeaway">Takeaway</a>
              </li>
              <li class="nav-item <?php echo (Request::path() == "nosotros")? "active" : ""; ?>">
                <a class="nav-link" href="/nosotros">Nosotros</a>
              </li>
              <li class="nav-item <?php echo (Request::path() == "contacto")? "active" : ""; ?>">
                <a class="nav-link" href="/contacto">Contacto</a>
              </li>
            </ul>
            <div class="user_option">
              <a href="/carrito" class="cart_link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
              </a>
              @if(Session::get("idCliente") && Session::get("idCliente") > 0)
              <a href="/mi-cuenta" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <a href="/logout" class="order_online">
                Cerrar sesión
              </a>
              @else
              <a href="/login" class="order_online">
                Ingresar
              </a>
              @endif
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
     @yield("banner")
  </div>

  @yield("contenido")

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
      @foreach($aSucursales AS $sucursal)
        <div class="col-md-3 footer-col">
          <div class="footer_contact">
            <h4>
              {{ $sucursal->nombre }}
            </h4>
            <div class="contact_link_box">
              <a href="*">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  {{ $sucursal->telefono }}
                </span>
              </a>
              <a href="{{ $sucursal->linkmapa }}">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  {{ $sucursal->direccion }}
                </span>
              </a>
              <a href="{{ $sucursal->linkmapa }}" class="order-online">Ir a la ubicación</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="footer-info">
        <p>
          <i class="fa fa-envelope" aria-hidden="true"></i><a href="*" class="order-online">  burgers@email.com</a>
          <br>
          <div class="footer_social">
              <a href="*">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="*">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="*">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="*">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="*">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          <br>
          <a class="footer-logo" href="/">
            <span>
              &copy; Burgers SRL
            </span>
          </a>
        </p>
    </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="web/js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="web/js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="web/js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>