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
    <link href="//cdn.rawgit.com/noelboss/featherlight/1.5.0/release/featherlight.min.css" type="text/css" rel="stylesheet" />

</head>
<body>
    <div class="container-fluid" style="padding: 60px">
    	<div class="row" style="padding-bottom: 150px;padding-top: 140px">
    		<br>
            <div class="col-md-10 text-center animated fadeInLeft">
            	<h2 class="text-left">
            		Welcome To <a href="/"><b class="text-danger">BandManager</b></a>
            		<br>
            		<small>Musician`s best friend</small>
            	</h2>
            	<br>
                <div class="text-left">
	            <a href="{{ url }}" class="btn btn-warning btn-fill btn-lg">Try It !</a>
	            <br><br>
            	<small class="text-muted">* BandManager is using Facebook login/register system for user authentication</small>
                </div>
            </div>
            <div class="col-md-2 animated fadeInRightBig text-center" style="border: 1px solid #F1EAE0; border-radius: 5px">
                <div class="card">
                    <div class="col-md-12">
                        <br>
                        <h5 class="text-center">Admin login</h5>
                        <form class="form" method="POST" action="/admin">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="text-muted">Username</small>
                                    <input name="username" type="text" class="form-control border-input" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="text-muted">Password</small>
                                    <input name="password" type="password" class="form-control border-input" />
                                </div>
                            </div>
                            <br>                           
                            <div class="text-center">
                                <input type="submit" class="btn btn-info btn-fill btn-wd" value="Login" />
                            </div>
                            <br>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <div class="row" style="padding-bottom: 100px;padding-top: 100px">
            <div class="col-md-6">
                <a href="#" data-featherlight="assets/img/app/2.jpg">
                    <img src="assets/img/app/2a.jpg" class="img img-responsive">
                </a>
            </div>
            <div class="col-md-6 text-center">
                <h2 class="text-info" style="font-weight: 100;line-height: 50px;padding-top: 4%">
                    Simplest dashboard ever
                </h2>
                <h3 class="text-info" style="font-weight: 100;line-height: 50px;padding-top: 4%">Easy to use dashboard inteface, with all the latest news - at the tip of your hand</h3>
            </div>
        </div>

        <hr>

        <div class="row" style="padding-bottom: 100px;padding-top: 100px">
            <div class="col-md-6 text-center">
                <h2 class="text-info" style="font-weight: 100;line-height: 50px;padding-top: 4%">
                    Easy overview or your band
                </h2>
                <h3 class="text-info" style="font-weight: 100;line-height: 50px;padding-top: 4%">Detailed info about your band, bandmates, latest events, tagged posts - BandManager is smart enough to use Facebook to find out all of that stuff</h3>
            </div>
            <div class="col-md-6">
                <a href="#" data-featherlight="assets/img/app/1.jpg">
                    <img src="assets/img/app/1a.jpg" class="img img-responsive">
                </a>
            </div>
        </div>

        <hr>

        <div class="row" style="padding-bottom: 100px;padding-top: 100px">
            <div class="col-md-6">
                <a href="#" data-featherlight="assets/img/app/3.jpg">
                    <img src="assets/img/app/3a.jpg" class="img img-responsive">
                </a>
            </div>
            <div class="col-md-6 text-center">
                <h2 class="text-info" style="font-weight: 100;line-height: 50px;padding-top: 4%">
                    Manage your rehersals easily
                </h2>
                <h3 class="text-info" style="font-weight: 100;line-height: 50px;padding-top: 4%">Select a band, location, time and date, enter some note for your bandmates - and book your rehersal in a second. BandManager will send SMS info message to each of your bandmates, instantly.</h2>
            </div>
        </div>

        <hr>

        <div class="row" style="padding-bottom: 100px;padding-top: 100px">
            <div class="col-md-6 text-center">
                <h2 class="text-info" style="font-weight: 100;line-height: 50px;padding-top: 4%">
                    Interested in new gigs and venues ?
                </h2>
                <h3 class="text-info" style="font-weight: 100;line-height: 50px;padding-top: 4%">Check out all latest venues, all around the world - you can also read all the reviews for each venue, all from the BandManager app</h2>
            </div>
            <div class="col-md-6">
                <a href="#" data-featherlight="assets/img/app/4.jpg">
                    <img src="assets/img/app/4a.jpg" class="img img-responsive">
                </a>
            </div>
        </div>


        <hr>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="mailto:vfranic@gmail.com">
                               <small>Developer</small>: Vicko Franić (vfranic@gmail.com)
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


    <script src="//code.jquery.com/jquery-latest.js"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.5.0/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>