<!doctype html>
<html lang="es">

<head>

  <!-- Basic -->
  {{--<title>Margo | File not Found</title>--}}

  <!-- Define Charset -->
  <meta charset="utf-8">

  <!-- Responsive Metatag -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="fundación,fundaciones,rehabilitacion,adicción,teo-terapeutico,teo-terapia">
  <!-- Page Description and Author -->
  <meta name="description" content="Margo - Responsive HTML5 Template">
  <meta name="author" content="iThemesLab">
  <meta name='csrf-param' content='authenticity_token'>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS  -->
  {!!Html::style('front-end/asset/css/bootstrap.min.css')!!}
  {{--<link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" media="screen">--}}

  <!-- Font Awesome CSS -->
  {!!Html::style('front-end/css/font-awesome.min.css')!!}
  {{--<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">--}}

  <!-- Slicknav -->
  {!!Html::style('front-end/css/slicknav.css')!!}
  {{--<link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">--}}

  <!-- Margo CSS Styles  -->
  {!!Html::style('front-end/css/style.css')!!}
  {{--<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">--}}

  <!-- Responsive CSS Styles  -->
  {!!Html::style('front-end/css/responsive.css')!!}
  {{--<link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">--}}

  <!-- Css3 Transitions Styles  -->
  {!!Html::style('front-end/css/animate.css')!!}
  {{--<link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">--}}

  <!-- Color CSS Styles  -->
  {!!Html::style('front-end/css/color.css')!!}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/red.css" title="red" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/jade.css" title="jade" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/green.css" title="green" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/blue.css" title="blue" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/beige.css" title="beige" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/cyan.css" title="cyan" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/orange.css" title="orange" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/peach.css" title="peach" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/pink.css" title="pink" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/purple.css" title="purple" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/sky-blue.css" title="sky-blue" media="screen" />--}}
  {{--<link rel="stylesheet" type="text/css" href="css/colors/yellow.css" title="yellow" media="screen" />--}}

  @yield('style')
  <style>
    .twitter-widget ul li {
       margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <!-- Container -->
  <div id="container">
    <!-- Start Header -->
    <div class="hidden-header"></div>
    <header class="clearfix">
      <!-- Start Top Bar -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <!-- Start Contact Info -->
              <ul class="contact-details">
                <li><a href="#"><i class="fa fa-map-marker"></i> Km 12 Vía Acacías</a> </li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> concacto@fundacionantioquia.com</a> </li>
                <li><a href="#"><i class="fa fa-phone"></i> 310 858 9044 - 318 313 8472</a> </li>
              </ul>
              <!-- End Contact Info -->
            </div>
            <div class="col-md-6">
              <!-- Start Social Links -->
              <ul class="social-list">
                <li> <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="#"><i class="fa fa-facebook"></i></a> </li>
                <li> <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="#"><i class="fa fa-twitter"></i></a> </li>
                <li> <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a> </li>
                <li> <a class="dribbble itl-tooltip" data-placement="bottom" title="Dribble" href="#"><i class="fa fa-dribbble"></i></a> </li>
                <li> <a class="linkdin itl-tooltip" data-placement="bottom" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a> </li>
                <li> <a class="flickr itl-tooltip" data-placement="bottom" title="Flickr" href="#"><i class="fa fa-flickr"></i></a> </li>
                <li> <a class="tumblr itl-tooltip" data-placement="bottom" title="Tumblr" href="#"><i class="fa fa-tumblr"></i></a> </li>
                <li> <a class="instgram itl-tooltip" data-placement="bottom" title="Instagram" href="#"><i class="fa fa-instagram"></i></a> </li>
                <li> <a class="vimeo itl-tooltip" data-placement="bottom" title="vimeo" href="#"><i class="fa fa-vimeo-square"></i></a> </li>
                <li> <a class="skype itl-tooltip" data-placement="bottom" title="Skype" href="#"><i class="fa fa-skype"></i></a> </li>
              </ul>
              <!-- End Social Links -->
            </div>
          </div>
        </div>
      </div>
      <!-- End Top Bar -->
      <!-- Start Header ( Logo & Naviagtion ) -->
      @include('layouts.front-end.menu-top')
      <!-- End Header ( Logo & Naviagtion ) -->
    </header>
    <!-- End Header -->

    @yield('encabezado')

    <!-- Start Content -->
    <div id="content">
      @yield('content')
    </div>
    <!-- End Content -->

    <!-- Start Footer -->
    <footer>
      <div class="container">
        <div class="row footer-widgets">

          <!-- Start Subscribe & Social Links Widget -->
          <div class="col-md-3 col-md-offset-2">
            <div class="footer-widget social-widget">
              <h4>Siguenos<span class="head-line"></span></h4>
              <ul class="social-icons">
                <li>
                  <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a class="google" href="#"><i class="fa fa-google-plus"></i></a>
                </li>
                <li>
                  <a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                </li>
                <li>
                  <a class="linkdin" href="#"><i class="fa fa-linkedin"></i></a>
                </li>
                <li>
                  <a class="flickr" href="#"><i class="fa fa-flickr"></i></a>
                </li>
                <li>
                  <a class="tumblr" href="#"><i class="fa fa-tumblr"></i></a>
                </li>
                <li>
                  <a class="instgram" href="#"><i class="fa fa-instagram"></i></a>
                </li>
                <li>
                  <a class="vimeo" href="#"><i class="fa fa-vimeo-square"></i></a>
                </li>
                <li>
                  <a class="skype" href="#"><i class="fa fa-skype"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <!-- .col-md-3 -->
          <!-- End Subscribe & Social Links Widget -->


          <!-- Start Twitter Widget -->
          <div class="col-md-6 col-md-offset-1">
            <div class="footer-widget twitter-widget">
              <h4>Contactenos<span class="head-line"></span></h4>
              <ul>
                <li><i class="fa fa-globe">  </i> <strong>Dirección:</strong> Km 12 Vía Acacías, Vereda la Union, Sector Naturalia, Finca El Paraiso</li>
                <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> concacto@fundacionantioquia.com</li>
                <li><i class="fa fa-mobile"></i> <strong>Phone:</strong> 311 480 8110 - 310 858 9044 - 318 313 8472</li>
              </ul>
            </div>
          </div>
          <!-- .col-md-3 -->
          <!-- End Twitter Widget -->


          <!-- Start Flickr Widget -->
          {{--<div class="col-md-3">--}}
            {{--<div class="footer-widget flickr-widget">--}}
              {{--<h4>Flicker Feed<span class="head-line"></span></h4>--}}
              {{--<ul class="flickr-list">--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-01.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-01.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-02.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-02.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-03.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-03.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-04.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-04.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-05.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-05.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-06.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-06.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-07.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-07.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-08.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-08.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                  {{--<a href="images/flickr-09.jpg" class="lightbox">--}}
                    {{--<img alt="" src="images/flickr-09.jpg">--}}
                  {{--</a>--}}
                {{--</li>--}}
              {{--</ul>--}}
            {{--</div>--}}
          {{--</div>--}}
          <!-- .col-md-3 -->
          <!-- End Flickr Widget -->


          <!-- Start Contact Widget -->
          {{--<div class="col-md-3">--}}
            {{--<div class="footer-widget contact-widget">--}}
              {{--<h4><img src="images/footer-margo.png" class="img-responsive" alt="Footer Logo" /></h4>--}}
              {{--<p>At verovident</p>--}}
              {{--<ul>--}}
                {{--<li><span>Phone Number:</span> +01 234 567 890</li>--}}
                {{--<li><span>Email:</span> company@company.com</li>--}}
                {{--<li><span>Website:</span> www.yourdomain.com</li>--}}
              {{--</ul>--}}
            {{--</div>--}}
          {{--</div>--}}
          <!-- .col-md-3 -->
          <!-- End Contact Widget -->


        </div>
        <!-- .row -->

        <!-- Start Copyright -->
        <div class="copyright-section">
          <div class="row">
            <div class="col-md-12">
              <p style="text-align: center">&copy; 2017 Ceindeted Llanos - Todos los derechos reservados</p>
            </div>
            {{--<div class="col-md-6">--}}
              {{--<ul class="footer-nav">--}}
                {{--<li><a href="#">Sitemap</a></li>--}}
                {{--<li><a href="#">Privacy Policy</a></li>--}}
                {{--<li><a href="#">Contact</a></li>--}}
              {{--</ul>--}}
            {{--</div>--}}
          </div>
        </div>
        <!-- End Copyright -->

      </div>
    </footer>
    <!-- End Footer -->

  </div>
  <!-- End Container -->

  <!-- Go To Top Link -->
  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>




  <!-- Margo JS  -->
  {!!Html::script('front-end/js/jquery-2.1.4.min.js')!!}
  {!!Html::script('front-end/js/jquery.migrate.js')!!}
  {!!Html::script('front-end/js/modernizrr.js')!!}
  {!!Html::script('front-end/asset/js/bootstrap.min.js')!!}
  {!!Html::script('front-end/js/jquery.fitvids.js')!!}
  {!!Html::script('front-end/js/owl.carousel.min.js')!!}
  {!!Html::script('front-end/js/nivo-lightbox.min.js')!!}
  {!!Html::script('front-end/js/jquery.isotope.min.js')!!}
  {!!Html::script('front-end/js/jquery.appear.js')!!}
  {!!Html::script('front-end/js/count-to.js')!!}
  {!!Html::script('front-end/js/jquery.textillate.js')!!}
  {!!Html::script('front-end/js/jquery.lettering.js')!!}
  {!!Html::script('front-end/js/jquery.easypiechart.min.js')!!}
  {!!Html::script('front-end/js/jquery.nicescroll.min.js')!!}
  {!!Html::script('front-end/js/jquery.parallax.js')!!}
  {!!Html::script('front-end/js/mediaelement-and-player.js')!!}
  {!!Html::script('front-end/js/jquery.slicknav.js')!!}
  {!!Html::script('front-end/js/script.js')!!}
  {{--<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.migrate.js"></script>--}}
  {{--<script type="text/javascript" src="js/modernizrr.js"></script>--}}
  {{--<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.fitvids.js"></script>--}}
  {{--<script type="text/javascript" src="js/owl.carousel.min.js"></script>--}}
  {{--<script type="text/javascript" src="js/nivo-lightbox.min.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.isotope.min.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.appear.js"></script>--}}
  {{--<script type="text/javascript" src="js/count-to.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.textillate.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.lettering.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.parallax.js"></script>--}}
  {{--<script type="text/javascript" src="js/mediaelement-and-player.js"></script>--}}
  {{--<script type="text/javascript" src="js/jquery.slicknav.js"></script>--}}


  {{--<!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->--}}
  {{--<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->--}}

  {{--<script type="text/javascript" src="js/script.js"></script>--}}

  <!-- Modal Bootstrap-->
  <div id='modalBs' class='modal fade'>
    <div class="modal-dialog">
      <div class="modal-content">
      </div>
    </div>
  </div>


  {!!Html::script('js/inicio.js')!!}
@yield('script')

  <script>
    $(function () {
        $(".navbar-brand").css("padding-top",0).css("padding-bottom",0);
        var CURRENT_URL = window.location.href;
        // console.log(CURRENT_URL);
        var contador = 1;
        if(CURRENT_URL.split("/")[3]=="")
            CURRENT_URL = CURRENT_URL.substring(0,CURRENT_URL.length-1);

        $(".navbar-right").find('a[href="' + CURRENT_URL + '"]').addClass("active");
    });
  </script>

</body>

</html>