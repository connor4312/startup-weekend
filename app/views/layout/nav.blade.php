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
          @if (Auth::check())
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Boards <b class="caret"></b></a>
              <ul class="dropdown-menu">
                @if (!Session::get('boards'))
                  <li class="muted">{{ HTML::link('/board', 'Create a Board!') }}</li>
                @else
                  <?php $boards = Session::get('boards') ?>
                  @foreach ($boards as $board)
                    <li>{{ HTML::link('/board/' . $board->key, $board->name) }}</li>
                  @endforeach
                @endif
              </ul>
            </li>
            <li><a href="#"><i class="icon-plus-sign"></i> Create New Board</a></li>
            <li>{{ HTML::link('/account/logout', 'Logout') }}</li>
          </ul>
          @else
          <ul class="nav navbar-nav navbar-right">
            <li>{{ HTML::link('/account/login', 'Login') }}</li>
            <li>{{ HTML::link('/account/register', 'Register') }}</li>
          </ul>
          @endif
        </div>
      </div>
    </div>
  </nav>