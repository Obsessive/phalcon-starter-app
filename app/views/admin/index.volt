{% extends 'layout.volt' %}

{% block title %}Admin{% endblock %}

{% block content %}
<a href="/logout" class="col-md-1 col-md-offset-11 text-center">
    <i class="ti-power-off"></i>
    <p>Logout</p>
</a>
<style>
	.nav {
		display: none!important;
	}
</style>

    <div class="content" ng-controller="adminCtrl">
        <div class="container-fluid">

        	<h4 class="title text-center">BandManager users</h4>
        	<ul class="list-unstyled team-members" ng-repeat="user in users">
	        	<li>
	        		<div class="card">
	        			<div class="content">
		        			<div class="row text-center">
		        				<div class="col-md-1">
			        				<img src="{( user.profile.picture )}" class="img img-responsive img-thumbnail">
			        			</div>
			        			<div class="col-md-3">
			        				<h5>{( user.name )}</h5>
			        			</div>
			        			<div class="col-md-3">
			        				<h5>{( user.profile.email )}</h5>
			        			</div>
			        			<div class="col-md-3">
			        				<h5>{( user.profile.location )}</h5>
			        			</div>
		        			</div>	
	        			</div>
	        		</div>
	        	</li>
        	</ul>

        	<hr class="text-muted" style="border:1px solid;margin:70px;">

        	<h4 class="title text-center">BandManager bands</h4>
        	<ul class="list-unstyled team-members" ng-repeat="band in bands">
	        	<li>
	        		<div class="card">
	        			<div class="content">
		        			<div class="row text-center">
		        				<div class="col-md-1">
			        				<img src="{( band.profile.picture )}" class="img img-responsive img-thumbnail">
			        			</div>
			        			<div class="col-md-6">
			        				<h5>{( band.name )}</h5>
			        			</div>
			        			<div class="col-md-5">
			        				<h5>{( band.profile.genre )}</h5>
			        			</div>
		        			</div>	
	        			</div>
	        		</div>
	        	</li>
        	</ul>

        </div>
    </div>

  
{% endblock %}