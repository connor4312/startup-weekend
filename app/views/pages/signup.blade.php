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

<div class="row"><div id="explain">
<div class="col-lg-4">

<h3>Import images</h3>
<img src="img/images.png">
<p>Upload images for your computer, paste them from the web and arrange them however you want.</p>
</div>
<div class="col-lg-4">
<h3>Create colors</h3>
<img src="img/color.png">
<p>Create color swatches right inside of the mooody app and arrange them on your board</p>
</div>
<div class="col-lg-4">
<h3>Share your board</h3>
<img src="img/share.png">
<p>Share your board across the web with friends, colleagues or clients</p>
</div>
</div>

</div>
</div>
@include('layout.foot')