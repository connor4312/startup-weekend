 <body>
<div id="page-wrap">
   <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <div class="container">
    <a class="navbar-brand" href="#">mooody</a>
  

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
      <!-- <li>{{ HTML::link('/account/login', 'Login') }}</li> -->
      <!-- <li>{{ HTML::link('/account/register', 'Register') }}</li> -->
      @else
      <li>{{ HTML::link('/board', 'My Boards') }}</li>
      <li>{{ HTML::link('/board/new', 'New Board') }}</li>
      @endif
    </ul>
</div>
  </div>
  </div><!-- /.navbar-collapse -->
</nav>