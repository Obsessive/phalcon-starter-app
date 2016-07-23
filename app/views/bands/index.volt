{% extends 'layout.volt' %}

{% block title %}My bands{% endblock %}

{% block content %}

{% if pages|length > 0 %}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="header">
                        <h4 class="title">List of your bands</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Genre</th>
                            <tbody>
                                {% for page in pages %}
                                <tr>
                                    <td>{{ page.facebook_page_id }}</td>
                                    <td><a href="/bands/{{ page.id }}">{{ page.name }}</a></td>
                                    <td>{{ page.profile.genre }}</td>
                                </tr>
                                {% endfor %}
                            </tbody>
                        </table>
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