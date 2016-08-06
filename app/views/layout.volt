<!DOCTYPE html>
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

    <!-- Custom -->
    <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet">
</head>
<body ng-app="BandManagerApp">

<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/" class="simple-text">
                    BandManager
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="/dashboard">
                        <i class="ti-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="/bands">
                        <i class="ti-music-alt"></i>
                        <p>My bands</p>
                    </a>
                </li>
                <li>
                    <a href="/rehersals">
                        <i class="ti-loop"></i>
                        <p>Rehersals</p>
                    </a>
                </li>
                <li>
                    <a href="/venues">
                        <i class="ti-location-pin"></i>
                        <p>Venues</p>
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

        <div class="animated fadeIn" style="padding: 0.5em">
            {% block content %}{% endblock %}
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="/">
                               Support
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                FAQ
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    <a href="/">BandManager</a>&nbsp;&copy; <script>document.write(new Date().getFullYear())</script>
                </div>
            </div>
        </footer>

    </div>
</div>

    <!--   Core JS Files   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="{{ url('assets/js/bootstrap-checkbox-radio.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ url('assets/js/bootstrap-notify.js') }}"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="{{ url('assets/js/paper-dashboard.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-filter/0.5.9/angular-filter.min.js"></script>

    <script src="http://momentjs.com/downloads/moment.min.js"></script>

    <!-- Custom scripts -->
    <script src="{{ url('assets/js/app/main.js') }}"></script>

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

</body>
</html>
