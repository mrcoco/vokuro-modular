<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Vökuró</title>
  <link href="//netdna.bootstrapcdn.com/bootswatch/2.3.1/united/bootstrap.min.css" rel="stylesheet">
    {{ stylesheet_link('css/style.css') }}
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
      <div class="container" style="width: auto;">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        {{ link_to(null, 'class': 'brand', 'Vökuró')}}
        <div class="nav-collapse">
          <ul class="nav">

            {%- set menus = [
              'Home': 'index',
              'About': 'about'
            ] -%}

            {%- for key, value in menus %}
              {% if value == dispatcher.getControllerName() %}
              <li class="active">{{ link_to(value, key) }}</li>
              {% else %}
              <li>{{ link_to(value, key) }}</li>
              {% endif %}
            {%- endfor -%}

          </ul>

          <ul class="nav pull-right">
            {%- if not(logged_in is empty) %}
            <li>{{ link_to('users', 'Users Panel') }}</li>
            <li>{{ link_to('session/logout', 'Logout') }}</li>
            {% else %}
            <li>{{ link_to('session/login', 'Login') }}</li>
            {% endif %}
          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div>

<div class="container main-container">
  {{ content() }}
</div>

<footer>
Made with love by the Phalcon Team

    {{ link_to("privacy", "Privacy Policy") }}
    {{ link_to("terms", "Terms") }}

© {{ date("Y") }} Phalcon Team.
</footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
</body>
</html>
