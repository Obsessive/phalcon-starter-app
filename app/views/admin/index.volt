{% extends 'layout.volt' %}

{% block title %}Admin{% endblock %}

{% block content %}

    <div class="content" ng-controller="adminCtrl">
        <div class="container-fluid">

        	{% for user in users %}
        		{{ user.name }}
        		<br>
        	{% endfor %}
            
        </div>
    </div>
  
{% endblock %}