@include('layout.head')
@include('layout.nav')
<div class="container">
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
      <div id="signupform">
        <h3>Login to mooody.co</h3>
          @include('layout.error')
          {{ Form::open(array('url' => '/account/login', 'method' => 'POST')) }}
            <div class="form-group">
              <label for="emailaddress">Email address</label>
              {{ Form::email('email', Input::get('email'), array('class' => 'form-control', 'placeholder' => 'Enter Email'))}}
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password'))}}
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            {{ HTML::link('/account/signup', 'Register', array('class' => 'btn btn-default')) }}
          {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

@include('layout.foot')