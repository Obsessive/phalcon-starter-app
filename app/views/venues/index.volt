{% extends 'layout.volt' %}

{% block title %}Venues{% endblock %}

{% block content %}
<div class="content" ng-controller="venuesCtrl">
    <div class="container-fluid">

    	<div id="countries">
	    	<h4 class="title">Choose venues country</h4>
	    	<hr>
	        <ul ng-model="venues" ng-repeat="(key, value) in venues | groupBy: 'country'" class="list-group">
	        	<h4 ng-click="showHideVenuesForCountry(key)">
	        		<i class="ti-angle-right"></i>&nbsp;<a>{( key )}</a>
	        	</h4>
	        	<hr>
	        	<div id="{( key )}" class="hidden">
		        	<a ng-repeat="venue in value" ng-click="showVenueDetails(venue)" class="list-group-item">
		        		<h6><i class="ti-location-pin"></i>&nbsp;&nbsp;{( venue.name )} | <small><b>{( venue.address )}</b></small></h6>
		        	</a>
	        	</div>
	        </ul>
	    </div>

		<div id="venueDetails" hidden class="col-md-12" ng-model="selectedVenueData" ng-click="hideVenueDetails()" style="cursor: pointer">
	        <div class="card card-user">
	            <div class="header">
	                <h4 class="title">{( selectedVenueData.name )}</h4>
	                <p class="category">{( selectedVenueData.formatted_address )}</p>
	            </div>
	            <div class="content">
	                <h5>
	                	<small>
	                		<a href="{( selectedVenueData.website )}" target="_blank">{( selectedVenueData.website )}</a>
	                	</small>
	                </h5>
	                <h6>
	                	<i>General rating:</i> {( selectedVenueData.rating )}</h6>
	                <hr>
	                <br>
	                <h4 class="title">Reviews</h4>
	                <br>
	                <div class="list-group">
	                	<li class="list-group-item" ng-repeat="review in selectedVenueData.reviews">
	            			<img class="avatar" src="{( review.profile_photo_url )}" />
	                        <p class="category">
	                        	<i class="ti-user"></i>&nbsp;{( review.author_name )}
	                        	<hr>
	                        	{( review.text )}
	                            <br><br>
	                            <h5>
	                            	<small><i>User rated:</i> {( review.rating )}</small>
	                            </h5>
	                        </p>
	                	</li>
	                </div>
	            </div>
	        </div>
	    </div>

    </div>
</div>

{% endblock %}
	


