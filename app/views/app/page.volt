{% extends 'app/partials/layout.volt' %}

{% block title %}{{ page.name }}{% endblock %}

{% block content %}


<div class="content">
    <div class="container-fluid">
    	<div class="row">

    		{# First column #}
            <div class="col-md-6">

                <div class="card card-user">
                    <div class="image" style="min-height: 200px">
                        {% if page.profile.cover %}
                        <img src="{{ page.profile.cover }}" />
                        {% endif %}
                    </div>
                    <div class="content">
                        <div class="author">
                            <img class="avatar border-white" src="{{ page.profile.picture }}" />
                          <h4 class="title">{{ page.name }}<br><hr></h4>
                           	<h5 class="text-default">{{ page.profile.genre }}</h5>
                        </div>                    
                    </div>
                </div>

				<div class="card">
					<div class="header">
						<h4 class="title">Bandmates</h4>
						<p class="category"><a href="https://www.facebook.com/{{ page.facebook_page_id }}/settings/?tab=admin_roles" target="_blank">
						<h5><i class="ti-pencil"></i>&nbsp;Edit</h5></a></p>
						<hr>
					</div>
					<div class="content">
						<ul class="list-unstyled team-members">
							{% for admin in admins %}
							<li>
								<div class="row text-center center-block">
									<div class="col-xs-3">
										<div class="avatar">
											<img src="{{ admin.profile.picture }}" class="avatar border-white">
										</div>
									</div>
									<div class="col-xs-6">
										{{ admin.name }}
										{% if admin.id == user.id %}
											(Me)
										{% endif %}
										<br />
										<span class="text-muted"><small>Offline</small></span>
									</div>

									<div class="col-xs-3 text-right">
										<btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
									</div>
								</div>
							</li>
							{% endfor %}
						</ul>
					</div>
				</div>

            </div>

            {# Second column #}
            <div class="col-md-6">

				<div class="card">
					<div class="header">
						<h4 class="title">Events</h4>
					</div>
					<div class="content">
						<ul id="events" class="list-unstyled team-members">
							{# Ajax #}
						</ul>
					</div>
				</div>

            </div>

		</div>
	</div>
</div>

<script>
	var pageId = "{{ page.id }}";
</script>
{% endblock %}