{% extends 'layout.volt' %}

{% block title %}Rehersals{% endblock %}

{% block content %}

<div class="content" ng-controller="rehersalsCtrl">
    <div class="container-fluid">

		{% if bands|length == 0 %}
		<div class="row">
			<div class="col-md-12 text-center">
				<h4>You have no bands, so you can`t add any rehersals.<br><br>
				Check you Facebook band page, you need to have admin/user role on the page to see it in BandManager.</h4>
			</div>
		</div>
		{% else %}

        <div class="row">
            <div class="col-md-8">

				<div class="card">
					<div class="content">
						<ul class="list-unstyled team-members">
							{% for band in bands %}
							<li style="border-bottom: 1px solid #bbb">

								<div class="row">
									<div class="col-xs-6">
										<div class="avatar">
											<img src="{{ band.profile.picture }}" class="avatar border-white">
										</div>
									</div>
									<div class="col-xs-6">
										<h5 class="text-right">{{ band.name }}</h5>
									</div>
								</div>

								<br>
								{% if band.rehersals|length > 0 %}									
								<div class="row" style="margin-left: 5px;margin-right: 5px;">
									<div class="col-xs-4">
										<span class="text-info">Location</span>
									</div>
									<div class="col-xs-4">
										<span class="text-info">Date/Time</span>
									</div>
									<div class="col-xs-4">
										<span class="text-info">Note</span>
									</div>		
								</div>
								{% else %}
								<span class="text-muted"><h6>No rehersals</h6></span>
								{% endif %}

								{% for rehersal in band.rehersals %}
								<div class="row alert alert-warning" style="margin-left: 5px;margin-right: 5px;">
									<div class="col-xs-4">
										<small>{{ rehersal.location }}</small>
									</div>
									<div class="col-xs-4">
										<small>{{ rehersal.scheduled_at }}</small>
									</div>
									<div class="col-xs-4">
										<small>{{ rehersal.note }}</small>
									</div>									
								</div>
								{% endfor %}
							</li>
							
							{% endfor %}
						</ul>
					</div>
				</div>

			</div>

            <div class="card col-md-4">
                <div class="header">
                    <h4 class="title">Add new rehersal</h4>
                </div>
                <div class="content">
                    <form class="form">
                  		<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Band</label>
                                    <select class="form-control border-input">
                                    	{% for band in bands %}
                                    		<option value="{{ band.id }}">
                                    			{{ band.name }}
                                    		</option>
                                    	{% endfor %}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input ng-model="location" type="text" class="form-control border-input" placeholder="Location..." />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date/Time</label>
                                   	<input ng-model="dateTime" type="datetime-local" class="form-control border-input" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea ng-model="note" rows="5" class="form-control border-input" placeholder="Add a note for your bandmates..."></textarea>
                                </div>
                            </div>
                     	</div>
                        <hr>                               
                        <div class="text-center">
                            <button ng-click="addRehersal()" class="btn btn-info btn-fill btn-wd">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{% endif %}

{% endblock %}