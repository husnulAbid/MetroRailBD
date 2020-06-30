<!DOCTYPE html>
<html>
<?php  session_start();
?>

<head>
    <title>Metro BD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="frontCustom/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="frontCustom/css/style.css" rel='stylesheet' type='text/css' />
    <link href="frontCustom/css/fontawesome-all.css" rel="stylesheet">
    <link href="frontCustom/css/simpleLightbox.css" rel='stylesheet' type='text/css' />
    <link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">
    <!--link rel="stylesheet" type="text/js" href="js/slider.js"-->
</head>

<body>

<!--/banner-->
<div class="banner" id="home">
    <!-- header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light top-header">
            <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- search -->
            <div class="search">
                <div class="cd-main-header">
                    <ul class="cd-header-buttons">
                        <li>
                            <a class="cd-search-trigger" href="#cd-search">
                                <span></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="cd-search" class="cd-search">
                    <form action="#" method="post">
                        <input name="Search" type="search" placeholder="Click enter after typing...">
                    </form>
                </div>
            </div>
            <!-- //search -->

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link ml-lg-0" href="index.html">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Gallery</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-center" href="#">Team</a>
                            <a class="dropdown-item text-center" href="#">Services</a>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="web/contact.html">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Log In</a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>
    <!-- //header -->
    <!-- banner-text -->
    <div id="wrapper">

        <!-- Slideshow 1 -->
        <div class="rslides_container">
            <ul class="rslides" id="slider1">
                <li>
                    <div class="banner-img">
                        <div class="banner-info text-center">
                            <h3 class="logo">
                                <a class="navbar-brand" href="index.html">
                                    <i class="fa fa-train"></i> Metro Rail Bangladesh</a>
                            </h3>
                            <h4>Let's move you to your new vehicle.</h4>
                            <div class="banner-form">
                                <form action="Api/RoutShow.php" method="post">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <select id="startStation" class="form-control option" name = "startStation">
                                                <option>Transport From</option>

                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select id="endStation" class="form-control option" name = "endStation" >
                                                <option>Transport To</option>

                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </li>
                <li>
                    <div class="banner-img">
                        <div class="banner-info text-center">
                            <h3 class="logo">
                                <a class="navbar-brand" href="index.html">
                                    <i class="fa fa-train"></i> Metro Rail Bangladesh</a>
                            </h3>
                            <h4>Let's move you to your new vehicle.</h4>
                            <div class="banner-form">
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="name" placeholder="Name" required="">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control option">
                                                <option>Transport From</option>
                                                <option>North Uttara Station</option>
                                                <option>Center Uttara Station</option>
                                                <option>Uttara South Station</option>
                                                <option>Pallabi Station</option>
                                                <option>Mirpur 11 Station</option>
                                                <option>Mirpur 10 Station</option>
                                                <option>KAJIPARA Station</option>
                                                <option>Shewrapara Station</option>
                                                <option>Agargao Station</option>
                                                <option>Bijoy saroni Station</option>
                                                <option>Farmgate Station</option>
                                                <option>Karwan Bazar Station</option>
                                                <option>Shabagh Station</option>
                                                <option>Dhaka University Station</option>
                                                <option>Press Club</option>
                                                <option>Motijheel</option>
                                                <option>Mohammodpur</option>
                                                <option>shongkor</option>
                                                <option>dhanmondi 15</option>
                                                <option>jigatola</option>
                                                <option>Science Lab</option>
                                                <option>kakrail</option>
                                                <option>malibag</option>
                                                <option>mouchak</option>
                                                <option>gabtoli</option>
                                                <option>mazar road</option>
                                                <option>konabari</option>
                                                <option>mirpur 1</option>
                                                <option>mirpur 2</option>
                                                <option>mipur 14</option>
                                                <option>kochukhet</option>
                                                <option>shainik club</option>
                                                <option>banani</option>
                                                <option>kakoli</option>
                                                <option>gulshan 2</option>
                                                <option>notun bazar</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control option">
                                                <option>Transport To</option>
                                                <option>North Uttara Station</option>
                                                <option>Center Uttara Station</option>
                                                <option>Uttara South Station</option>
                                                <option>Pallabi Station</option>
                                                <option>Mirpur 11 Station</option>
                                                <option>Mirpur 10 Station</option>
                                                <option>KAJIPARA Station</option>
                                                <option>Shewrapara Station</option>
                                                <option>Agargao Station</option>
                                                <option>Bijoy saroni Station</option>
                                                <option>Farmgate Station</option>
                                                <option>Karwan Bazar Station</option>
                                                <option>Shabagh Station</option>
                                                <option>Dhaka University Station</option>
                                                <option>Press Club</option>
                                                <option>Motijheel</option>
                                                <option>Mohammodpur</option>
                                                <option>shongkor</option>
                                                <option>dhanmondi 15</option>
                                                <option>jigatola</option>
                                                <option>Science Lab</option>
                                                <option>kakrail</option>
                                                <option>malibag</option>
                                                <option>mouchak</option>
                                                <option>gabtoli</option>
                                                <option>mazar road</option>
                                                <option>konabari</option>
                                                <option>mirpur 1</option>
                                                <option>mirpur 2</option>
                                                <option>mipur 14</option>
                                                <option>kochukhet</option>
                                                <option>shainik club</option>
                                                <option>banani</option>
                                                <option>kakoli</option>
                                                <option>gulshan 2</option>
                                                <option>notun bazar</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="banner-img one">
                        <div class="banner-info text-center">
                            <h3 class="logo">
                                <a class="navbar-brand" href="index.html">
                                    <i class="fa fa-train"></i> Metro Rail Bangladesh</a>
                            </h3>
                            <h4>Let's move you to your new vehicle.</h4>
                            <div class="content">
                                <div class="simply-countdown-custom" id="simply-countdown-custom"></div>
                            </div>
                        </div>
                    </div>
                </li>



            </ul>
        </div>
    </div>
</div>
<!-- //banner -->
<!--/banner-bottom-agile-style-->
<section class="banner-bottom-agile-style">
    <div class="container">
        <h3 class="tittle-style text-center">Our History</h3>
        <div class="row inner-sec-layout-agileits">
            <div class="col-lg-6 about-img">
                <img src="frontCustom/img/map1.png" class="img-fluid rounded" alt="">
            </div>
            <div class="col-lg-6 about-info text-left">
                <h4 class="sub-hd mb-4">We give the best</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna
                    aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco labor nisi ut aliquip exea commodo consequat duis
                    aute irudre dolor in elit sed uta labore dolore reprehender</p>
                <p class="sup-para mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna
                    aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco labor nisi ut aliquip exea commodo consequat duis
                    aute irudre dolor in elit sed uta labore dolore reprehender</p>
                <div class="view my-4">
                    <div class="view my-4">
                        <a href="https://www.google.com/maps/d/viewer?mid=1g2rRPQMVuUgDIKyztR9xEgblha4gxVZg&ll=23.784797071130292%2C90.37207447583&z=13" class="btn btn-primary read-m" target="_blank">Read More</a>
                    </div>
                </div>
                <img src="frontCustom/images/banner3.jpg" class="img-fluid rounded" alt="">
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Title Here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="frontCustom/images/banner3.jpg" class="img-fluid rounded" alt="">
                <h4>Sub title here</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna
                    aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--//banner-bottom-agile-style-->
<!--/services-->
<section class="banner-bottom-agile-style services">
    <div class="container">
        <h3 class="tittle-style cen text-center">Moving Services</h3>
        <div class="row inner-sec-layout-agileits">
            <div class="col-lg-6 service-in text-center">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-home"></i>
                        <h5 class="card-title">Local Moving</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna
                            aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco.</p>
                        <div class="view my-4">
                            <a href="single.html" class="btn btn-primary read-m" data-toggle="modal" data-target="#exampleModalCenter">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 service-in  text-center">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-truck"></i>
                        <h5 class="card-title">Long Distance Moves</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna
                            aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco</p>
                        <div class="view my-4">
                            <a href="single.html" class="btn btn-primary read-m" data-toggle="modal" data-target="#exampleModalCenter">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--//services-->
<!--/features-->
<section class="banner-bottom-agile-style">
    <div class="feature-main container-fluid text-left">
        <div class="row">
            <div class="col-lg-3 feature text-left">
                <h3>Special Services</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna..</p>
                <div class="view my-4">
                    <a href="single.html" class="btn btn-primary read-m" data-toggle="modal" data-target="#exampleModalCenter">Read More</a>
                </div>
            </div>
            <div class="col-lg-3 card feature text-left">
                <img src="frontCustom/images/f1.jpg" alt=" " class="img-fluid rounded" />
                <h5 class="card-title">Title goes here</h5>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna..</p>
                <div class="view my-4">
                    <a href="single.html" class="btn btn-primary read-m" data-toggle="modal" data-target="#exampleModalCenter">Read More</a>
                </div>
            </div>
            <div class="col-lg-3 card feature text-left">
                <img src="frontCustom/images/f2.jpg" alt=" " class="img-fluid rounded" />
                <h5 class="card-title">Title goes here</h5>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna..</p>
                <div class="view my-4">
                    <a href="single.html" class="btn btn-primary read-m" data-toggle="modal" data-target="#exampleModalCenter">Read More</a>
                </div>
            </div>
            <div class="col-lg-3 card feature text-left">
                <img src="frontCustom/images/f3.jpg" alt=" " class="img-fluid rounded" />
                <h5 class="card-title">Title goes here</h5>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna..</p>
                <div class="view my-4">
                    <a href="single.html" class="btn btn-primary read-m" data-toggle="modal" data-target="#exampleModalCenter">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//features-->
<!--/areas-->
<section class="banner-bottom-agile-style areas text-center">
    <div class="container">
        <h3 class="tittle-style cen">Worldwide Centres</h3>
        <div class="row inner-sec-layout-agileits">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna
                aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco..</p>
        </div>
    </div>
</section>
<!--//areas-->

<!--footer-->
<footer>
    <div class="container">
        <div class="footer-top-agileits-style text-center">
            <h2 class="logo">
                <a href="index.html">
                    <i class="fa fa-train"></i> Matro Rail Bangladesh</a>
            </h2>
            <p class="para three mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at placerat ante. Praesent nulla nunc, pretium dapibus
                efficitur in, auctor eget elit. Lorem ipsum dolor sit amet consectetur adipiscing elit. Phasellus at placerat ante.
                Praesent nulla nunc</p>
        </div>
        <div class="subscribe-grid text-center">
            <h5>Subscribe for our latest updates</h5>
            <p>Get
                <span>10%</span> off on Using Metro App</p>
            <form action="#" method="post">
                <input class="form-control" type="email" placeholder="Subscribe" name="Subscribe" required="">
                <button class="btn1">
                    <i class="far fa-envelope"></i>
                </button>
            </form>
        </div>
        <div class="row footer-bottom-wthree-agile">
            <div class="col-lg-6 copyright">
                <p>&copy; 2018 . All Rights Reserved
                </p>

            </div>
            <div class="col-lg-6 social-icon footer text-right">
                <div class="icon-social">
                    <a href="#" class="button-footr">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="button-footr">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="button-footr">
                        <i class="fab fa-dribbble"></i>
                    </a>
                    <a href="#" class="button-footr">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>

        <!-- //footer -->
    </div>
</footer>
<!---->

<!-- js -->
<script  src="frontCustom/js/jquery-2.2.3.min.js"></script>

<script src="frontCustom/js/bootstrap.js"></script>
<!-- //js -->
<!--slider-->
<script src="frontCustom/js/responsiveslides.min.js"></script>

<!--//slider-->
<!--search-bar-->
<script src="frontCustom/js/search.js"></script>
<!--//search-bar-->
<script  src="frontCustom/js/simplyCountdown.js"></script>
<link href="frontCustom/css/simplyCountdown.css" rel='stylesheet' type='text/css' />
<script src="frontCustom/js/slider.js"></script>

<!--search-bar-->
<!--/ start-smoth-scrolling -->
<script  src="frontCustom/js/move-top.js"></script>

<!--// end-smoth-scrolling -->
<a href="#home" class="scroll" id="toTop" style="display: block;">
    <span id="toTopHover" style="opacity: 1;"> </span>
</a>

<!-- //Custom-JavaScript-File-Links -->
<script src="frontCustom/js/bootstrap.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var startStation = document.getElementById("startStation");
        var endStation = document.getElementById("endStation");
        //getting stations
        $.ajax({
            type: 'POST',
            url: 'Api/getStations.php',
            async:false,
            data: {
            },
            error: function (ts) {
                alert(ts.responseText);
            },
            success: function(data) {
                //when found names sending them in datalist for suggetions
                //alert(data);
                var obj = JSON.parse(data);
                var datas=obj.station_data;
                for (var key in datas) {
                    if (datas.hasOwnProperty(key)) {
                        var option = document.createElement("option");
                        option.text = datas[key].stationName;
                        startStation.add(option);
                    }
                }
                for (var key in datas) {
                    if (datas.hasOwnProperty(key)) {
                        var option = document.createElement("option");
                        option.text = datas[key].stationName;
                        endStation.add(option);
                    }
                }
            }
        });
    });
</script>

</body>

</html>