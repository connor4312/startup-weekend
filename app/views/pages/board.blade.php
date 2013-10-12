<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    {{ HTML::style('css/style.css')}}

  </head>
 <body>
   <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Moody</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li><a href="#">Profile</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Boards <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Board 1</a></li>
          <li><a href="#">Board 2</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><p class="navbar-text">Signed in as Kyle</p></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

<div class="row">
  <!-- ###################### LEFT NAVIGATION -->
  <div class="col-lg-1">
    <div id="left-nav">
      <ul>
        <li><a href="#"><img src="img/images.png"></a></li>
        <hr>
        <li><a href="#"><img src="img/color.png"></a></li>
      </ul> 
    </div>
  </div>
  <!-- ####################### BOARD -->
  <div class="col-lg-11">
    <div id="board-title">
        <h1>Moody Logo</h1>
        <h5>Created 10/12/13</h5>
      </div>
    <div id="board">

      Images goes here
    </div>
  </div>

</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/jquery.min.js') }}
  </body>
</html>