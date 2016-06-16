<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>BandManager</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ url('assets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ url('assets/css/paper-dashboard.css') }}" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ url('assets/css/themify-icons.css') }}" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://phalcon.dev" class="simple-text">
                    BandManager
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="/app">
                        <i class="ti-user"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="/app/pages">
                        <i class="ti-view-list-alt"></i>
                        <p>My bands</p>
                    </a>
                </li>
                <li>
                    <a href="/app/rehersals">
                        <i class="ti-loop"></i>
                        <p>Rehersals</p>
                    </a>
                </li>
                <li>
                    <a href="/app">
                        <i class="ti-pencil-alt2"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="maps.html">
                        <i class="ti-map"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html">
                        <i class="ti-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">{% block title %}{% endblock %}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
                                    <p>Notifications</p>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="/logout">
                                <i class="ti-power-off"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        {% block content %}{% endblock %}


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                               Blog
                            </a>
                        </li>
                        <li>
                            <a href="http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{ url('assets/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="{{ url('assets/js/bootstrap-checkbox-radio.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ url('assets/js/bootstrap-notify.js') }}"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="{{ url('assets/js/paper-dashboard.js') }}"></script>

    <!-- Custom scripts -->
    <script src="{{ url('assets/js/app/page.js') }}" type="text/javascript"></script>

    <?php
    $messages = $this->flashSession->getMessages();
    if ( count($messages) > 0) {
    ?>
    <script>
    setTimeout(function() {

    <?php
        foreach ($messages as $messageType => $messageArray) {
            foreach ($messageArray as $message) {
    ?>
            $.notify({
                icon: "ti-info",
                title: "<strong>New notification</strong>",
                message: "<?php echo $message ?>"
            }, {
                type: "danger",
                placement: {
                    from: "bottom",
                    align: "right" 
                }
            });
    <?php
            }
        }
    ?>

        }, 2000);
    </script>

    <?php
    }
    ?>
</html>