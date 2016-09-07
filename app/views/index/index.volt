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

</head>
<body>
    <div class="container">
    	<div class="row">
    		<br>
            <div class="col-md-12 jumbotron text-center animated flipInY">
            	<h2>
            		<i>Welcome To BandManager</i>
            		<br>
            		<small>Musician`s best friend</small>
            	</h2>
            	<br>
	            <a href="{{ url }}" class="btn btn-success btn-lg">Login/Register</a>
	            <br><br>
            	<small>* BandManager is using Facebook login/register system for user authentication</small>
            </div>
          	<div class="col-md-12">
          		<hr>
          	</div>
            <div class="col-md-8 col-md-offset-2">
                {# Login form #}
                <div class="col-md-12 animated fadeInUp">
                	<h6>You have admin or test user credentials?</h6>
                    <div id="login-form" class="card">
                        <div class="header">
                            <h4 class="title">Admin/Test user login</h4>
                        </div>
                                 
                        <div class="col-md-6">
                            <br>
                            <h5 class="text-center">TEST USER</h5>
                            <form class="form" method="POST" action="/login">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input name="username" type="text" class="form-control border-input" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" type="password" class="form-control border-input" />
                                    </div>
                                </div>
                                <br>                           
                                <div class="text-center">
                                    <input type="submit" class="btn btn-info btn-fill btn-wd" value="Test user login"></input>
                                </div>
                                <br>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <br>
                            <h5 class="text-center">ADMIN</h5>
                            <form class="form" method="POST" action="/admin">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Admin username</label>
                                        <input name="username" type="text" class="form-control border-input" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" type="password" class="form-control border-input" />
                                    </div>
                                </div>
                                <br>                           
                                <div class="text-center">
                                    <input type="submit" class="btn btn-info btn-fill btn-wd" value="Admin user login"></input>
                                </div>
                                <br>
                            </form>
                        </div>

                    </div>
                </div>
        	</div>

    	</div>
    </div>
</body>
</html>