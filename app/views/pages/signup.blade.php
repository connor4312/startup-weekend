@include('layout.head')
@include('layout.nav')
<div class="container">
<div class="row">
  <div class="col-lg-6 col-lg-offset-3">
    <div id="signupform">
      <form role="form">
  <div class="form-group">
    <label for="emailaddress">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="companyname">Company Name</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Company Name">
  </div>
  <button type="submit" class="btn btn-primary">Create Account</button>
</form>
    </div>
  </div>
</div>

@include('layout.foot')