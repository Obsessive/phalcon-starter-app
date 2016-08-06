{% extends 'layout.volt' %}

{% block title %}My bands{% endblock %}

{% block content %}

{% if pages|length > 0 %}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="header">
                        <h4 class="title">List of your bands</h4>
                        <br>
                    </div>

                    <div class="content table-responsive table-full-width">
                        <ul class="list-unstyled team-members list-group">
                        {% for page in pages %}
                            <a href="/bands/{{ page.id }}" class="list-group-item">
                                <li>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img class="avatar" src="{{ page.profile.picture }}" />
                                        </div>
                                        <div class="col-md-8">
                                            <h5>{{ page.name }}</h5>
                                            <small>{{page.profile.genre }}</small>
                                        </div>
                                    </div>
                                </li>
                            </a>
                        {% endfor %}


                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% else %}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="typo-line text-center">
                <h4><p class="category">Whoops !</p>No bands found.</h4>
                <hr>
                <a class="btn btn-info btn-fill btn-wd" href="/bands/update">Update</a>
            </div>
        </div>
    </div>
</div>
{% endif %}

{% endblock %}