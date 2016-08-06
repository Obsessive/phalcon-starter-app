{% extends 'layout.volt' %}

{% block title %}Dashboard{% endblock %}

{% block content %}

    <div class="content" ng-controller="dashboardCtrl">
        <div class="container-fluid">

            <div class="col-md-3">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-user">
                            <div class="image">
                                {% if user.profile.cover %}
                                <img src="{{ user.profile.cover }}" />
                                {% endif %}
                            </div>
                            <div class="content">
                                <div class="author">
                                    <img class="avatar border-white" src="{{ user.profile.picture }}" />
                                  <h4 class="title">{{ user.name }}<br />
                                    <hr>
                                    <small>Registered: <i>{{ user.created_at }}</i></small>
                                  </h4>
                                </div>
                                <br>
                                <div class="text-center">
                                    <button class="btn btn-info" ng-click="showHideEditProfileForm()">Edit profile</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {# Edit profile form #}
                    <div class="col-md-12">
                        <div id="edit-profile-form" class="card hidden">
                            <button style="padding-right: 4px;padding-top: 4px;" ng-click="showHideEditProfileForm()" type="button" class="close">&times;</button>
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form class="form">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input ng-model="name" type="text" class="form-control border-input" placeholder="{{ user.name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input ng-model="location" type="text" class="form-control border-input" placeholder="{{ user.profile.location }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input ng-model="email" type="email" class="form-control border-input" placeholder="{{ user.profile.email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input required ng-model="number" type="text" class="form-control border-input" placeholder="{{ user.profile.number }}">
                                            <small>* Phone number is required for receiving mobile notifications about rehersals</small>
                                        </div>
                                    </div>   
                                    <br>                           
                                    <div class="text-center">
                                        <button ng-click="updateProfile()" type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4 animated fadeInDownBig">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <a href="/bands">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-warning text-center">
                                                <i class="ti-music-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Bands</p>
                                                {{ pageCount }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 animated fadeInDownBig">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <a href="/rehersals">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-loop"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                    <p>Rehersals</p>
                                                <span>{{ rehersalsCount }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 animated fadeInDownBig">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <a href="/venues">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-location-pin"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Venues</p>
                                            {{ venuesCount }}
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
  
{% endblock %}