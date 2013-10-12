@include('layout.head')
@include('layout.nav')
<div class="container">
<div class="row">
  <div class="col-lg-6 col-lg-offset-3">
    <div id="signupform">
      <h3>Signup for mooody.co</h3>
      @include('layout.error')
      {{ Form::open(array('url' => '/account/signup', 'method' => 'POST')) }}
        <div class="form-group">
          <label for="emailaddress">Email address</label>
          {{ Form::email('email', Input::get('email'), array('class' => 'form-control', 'placeholder' => 'Enter Email'))}}
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          {{ Form::password('password', Input::get('password'), array('class' => 'form-control', 'placeholder' => 'Enter Password'))}}
        </div>
        <div class="form-group">
          <label for="companyname">Company Name</label>
          {{ Form::text('company', Input::get('company'), array('class' => 'form-control', 'placeholder' => 'Enter Company'))}}
        </div>
        <button type="submit" class="btn btn-primary">Create Account</button>
      {{ Form::close() }}
    </div>
  </div>
</div>

@include('layout.foot')