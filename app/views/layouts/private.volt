<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Vökuró</title>
  <link href="//netdna.bootstrapcdn.com/bootswatch/3.2.0/united/bootstrap.min.css" rel="stylesheet">
    {{ stylesheet_link('css/style.css') }}
    {{ stylesheet_link('css/jquery.bootgrid.css') }}
    {{ stylesheet_link('css/font-awesome/css/font-awesome.css') }}
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Vökuró</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
          {%- set menus = [
          'Home': null,
          'Users': 'users',
          'Profiles': 'profiles',
          'Permissions': 'permissions'
          ] -%}

          {%- for key, value in menus %}
              {% if value == dispatcher.getControllerName() %}
                <li class="active">{{ link_to(value, key) }}</li>
              {% else %}
                <li>{{ link_to(value, key) }}</li>
              {% endif %}
          {%- endfor -%}
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth.getName() }} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li>{{ link_to('admin/users/changePassword', 'Change Password') }}</li>
          </ul>
        </li>
        <li>{{ link_to('logout', 'Logout') }}</li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  {{ content() }}
</div>
{{ javascript_include('js/jquery/jquery-3.1.0.min.js') }}
{{ javascript_include('js/bootstrap/bootstrap.min.js') }}
{% if grid is defined %}
    {{ javascript_include('js/jquery.bootgrid.js') }}
    {{ javascript_include('js/jquery.bootgrid.fa.js') }}
    {{ partial(grid) }}
{% endif %}
</body>
</html>