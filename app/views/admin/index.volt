{% extends 'layout.volt' %}

{% block title %}Admin{% endblock %}

{% block content %}
<div class="col-sm-12 col-md-2 col-md-offset-10 text-center" style="padding-top: 10px">
	<a href="/logout" class="btn btn-info">
	    <i class="ti-power-off"></i>
	</a>
</div>
<style>
	.nav, 
	.navbar,
	.navbar-toggle
 	{
		display: none!important;
	}
</style>

    <div class="content" ng-controller="adminCtrl">

    	{% include 'admin/userDetailsModal.volt' %}
    	{% include 'admin/bandDetailsModal.volt' %}

        <div class="container-fluid">

        	{% include 'admin/usersGraph.volt' %}


        	<div id="users" style="display: none">
	        	<h4 class="title text-center">BandManager users</h4>
	        	<ul class="list-unstyled team-members" ng-repeat="user in users">
		        	<li ng-click="showUserDetails(user)">
		        		<a href="" class="list-group-item">
		        			<div class="row text-center">
			        			<div class="col-md-6">
			        				<h6>{( user.name )}</h6>
			        			</div>
			        			<div class="col-md-6">
			        					Registered: {( user.created_at )}
			        			</div>			        			
		        			</div>	
		        		</a>
		        	</li>
	        	</ul>
	        </div>

        	<div id="bands" style="display: none">
	        	<hr class="text-muted" style="border:1px solid;margin:70px;">
	        	<h4 class="title text-center">BandManager bands</h4>
	        	<ul class="list-unstyled team-members" ng-repeat="band in bands">
		        	<li ng-click="showBandDetails(band)">
		        		<a href="#" class="list-group-item">
		        			<div class="row text-center">
			        			<div class="col-md-6">
			        				<h6>{( band.name )}</h6>
			        			</div>
			        			<div class="col-md-6">
			        				<span>Facebook Page ID: {( band.facebook_page_id )}</span>
			        			</div>		
		        			</div>
		        		</a>
		        	</li>
	        	</ul>
	        </div>

        </div>
    </div>

  
{% endblock %}