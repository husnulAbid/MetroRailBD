<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Metro Rail BD</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="css/signup.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />

    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->

    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->

    <!-- BEGIN: load jquery -->

    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>

    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>

    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>

    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>

    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>

    <!-- END: load jquery -->

    <script src="js/setup.js" type="text/javascript"></script>
    <script src="js/page/everypage.js" type="text/javascript"></script>

    <!--Dynamically creates ads markup-->

</head>
<body>   

    <div class="container_12">

        <div class="grid_12 header-repeat">

            <div id="branding">
                <!--Logo text -->

                <div class="floatleft">
                    <h1>Metro BD</h1>
                </div>

                <div class="floatright">

                    <div class="floatleft">
                        <!-- Admin Pro Pic-->
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                            
                    </div>

                    <div class="floatleft marginleft10">

                        <ul class="inline-ul floatleft">

                            <li>Admin</li>

                            <li><a href="#">Config</a></li>

                            <li><a href="#">Logout</a></li>

                        </ul>

                        <br />

                        <span class="small grey">Last Login: 3 hours ago</span>

                    </div>

                </div>

                <div class="clear">

                </div>

            </div>

        </div>

        <div class="clear">

        </div>

        <div class="grid_12">

            <ul class="nav main">

                <li class="ic-dashboard"><a href="dashboard.php"><span>Dashboard</span></a> </li>

                <li class="ic-form-style"><a href="javascript:"><span>Controls</span></a>

                    <ul>

                         <li><a href="signup.php" >Sign Up Forms</a> </li>
                         
                        <li><a href="login.php" >Log In Forms</a> </li>

                    </ul>

                </li>

                <li class="ic-typography"><a href="time.php"><span>Time Schedule</span></a></li>

                <li class="ic-grid-tables"><a href="table.php"><span>Data Table</span></a></li>

                <li class="ic-notifications"><a href="notifications.php"><span>Notifications</span></a></li>

            </ul>

        </div>

        <div class="clear">

        </div>

        <div class="grid_2">

            <div class="box sidemenu">

                <div class="block" id="section-menu">

                    <ul class="section menu">

                        <li><a class="menuitem">Menu 1</a>

                            <ul class="submenu">

                                <li><a>Submenu 1</a> </li>

                                <li><a>Submenu 2</a> </li>

                                <!--li><a class="active">Submenu 3</a> </li>

                                <li><a>Submenu 4</a> </li-->

                            </ul>

                        </li>

                        <li><a class="menuitem">Menu 2</a>

                            <ul class="submenu">

                                <li><a>Submenu 1</a> </li>

                                <li><a>Submenu 2</a> </li>

                            </ul>

                        </li>

                        <li><a class="menuitem">Menu 3</a>

                            <ul class="submenu">

                                <li><a>Submenu 1</a> </li>

                                <li><a>Submenu 2</a> </li>

                            </ul>

                        </li>

                        <li><a class="menuitem">Menu 4</a>

                            <ul class="submenu">

                                <li><a>Submenu 1</a> </li>

                                <li><a>Submenu 2</a> </li>

                            </ul>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="grid_10">

            <div class="box round first">
                <div class="block">

                    <!-- Log In-->



                       <h2>Log In Form</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Log In</button>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="/action_page.php">
    <div class="container">
      <h1>Log In</h1>
      
      <hr>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Log In</button>
      </div>
    </div>
  </form>
</div>






                <!-- Log In -->


                 </div>
                <div class="clear">

                </div>

                <div id="site_info">
                    <p>
                        Copyright <a href="#">Metro Admin</a>. All Rights Reserved.
                    </p>
                </div>

    
            </div>
        </div>
    </div>

     

</body>

</html>

