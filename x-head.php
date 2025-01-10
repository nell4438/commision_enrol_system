 <?php 
 $current_url = $_SERVER['REQUEST_URI'];
$url_explde = explode('/', $current_url);
$pagefile_name = $url_explde[2];


  $page_title = "Sto. Niño National Highschool Main Campus - Online Enrollement System";
  $active_ul_product = '';
  $active_ul_product_span = '';




?>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="developer" content="Rhalp Darren R. Cabrera">
    <meta name="generator" content="Jekyll v3.8.5">
    <?php if ($page == "error")  { ?>
      <meta http-equiv="refresh" content="5;url=index" />
    <?php } ?>
    <title><?php echo $page_title;?></title>

    <link rel="icon" href="assets/img/logo/logo.ico" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
 
    <style>
    /* GLOBAL STYLES
    -------------------------------------------------- */


    /* Padding below the footer and lighter body text */

    body {
      /*padding-top: 3rem;
      padding-bottom: 3rem;*/
      color: #5a5a5a;
    }


    /* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */


    /* Carousel base class */

    .carousel {
      margin-bottom: 4rem;
    }


    /* Since positioning the image, we need to help out the caption */

    .carousel-caption {
      bottom: 3rem;
      z-index: 10;
    }


    /* Declare heights because of positioning of img element */

    .carousel-item {
      height: 32rem;
      background-color: #777;
    }

    .carousel-item>img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 32rem;
    }


    /* MARKETING CONTENT
    -------------------------------------------------- */


    /* Center align the text within the three columns below the carousel */

    .marketing .col-lg-4 {
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .marketing h2 {
      font-weight: 400;
    }

    .marketing .col-lg-4 p {
      margin-right: .75rem;
      margin-left: .75rem;
    }


    /* Featurettes
    ------------------------- */

    .featurette-divider {
      margin: 5rem 0;
      /* Space out the Bootstrap <hr> more */
    }


    /* Thin out the marketing headings */

    .featurette-heading {
      font-weight: 300;
      line-height: 1;
      letter-spacing: -.05rem;
    }


    /* RESPONSIVE CSS
    -------------------------------------------------- */

    @media (min-width: 40em) {
      /* Bump up size of carousel content */
      .carousel-caption p {
        margin-bottom: 1.25rem;
        font-size: 1.25rem;
        line-height: 1.4;
      }
      .featurette-heading {
        font-size: 50px;
      }
    }

    @media (min-width: 62em) {
      .featurette-heading {
        margin-top: 7rem;
      }
    }

    body {
      /*background: url('assets/img/background/bg.jpg') no-repeat center center fixed;*/
      background-color: #f3f3f3;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      background-size: cover;
      -o-background-size: cover;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .gradient-green {
      background-color: #1b621e !important;
      /*background: #61ba6d;
            background: -webkit-linear-gradient(to right, #61ba6d, #83c331);
            background: linear-gradient(to right, #61ba6d, #83c331);*/
      color: white;
    }

    .nh {
      padding: 20px;
      font-size: 30px !important;
      width: 50px;
      text-align: center;
      text-decoration: none;
    }

    .nh:hover {
      opacity: 0.7;
    }

    .nh-facebook {
      background: #3B5998;
      color: white;
    }

    .nh-facebook:hover {
      background: #3B5998;
      color: white;
    }


    /* Twitter */

    .nh-twitter {
      background: #55ACEE;
      color: white;
    }

    .inc_con {
      margin-top: -15em;
    }
    #myBtn {
      display: none; /* Hidden by default */
      position: fixed; /* Fixed/sticky position */
      bottom: 20px; /* Place the button at the bottom of the page */
      right: 30px; /* Place the button 30px from the right */
      z-index: 99; /* Make sure it does not overlap */
      border: none; /* Remove borders */
      outline: none; /* Remove outline */
      background-color: #4caf50; /* Set a background color */
      color: white; /* Text color */
      cursor: pointer; /* Add a mouse pointer on hover */
      padding: 10px; /* Some padding */
      border-radius: 10px; /* Rounded corners */
      font-size: 18px; /* Increase font size */
    }

    #myBtn:hover {
      background-color: #555; /* Add a dark-grey background on hover */
    }

    </style>
  <?php if ($page == "news")  { ?>
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
  <?php } ?>

  <?php if ($page == "admission")  { ?>
    <link href="assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" />

    <!-- Optional SmartWizard theme -->
    <link href="assets/plugins/smartwizard/dist/css/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/smartwizard/dist/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/smartwizard/dist/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />
    
  <?php } ?>

    
    <!-- <link href="assets/css/carousel.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="assets/plugins/owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/plugins/owlcarousel/dist/assets/owl.theme.default.min.css">

    <!-- include the style -->
    <link rel="stylesheet" href="assets/plugins/alertifyjs/css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="assets/plugins/alertifyjs/css/themes/default.min.css" />

    <link href="assets/css/icomoon/styles.css" rel="stylesheet" type="text/css">
  </head>