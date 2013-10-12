@include('layout.head')
@include('layout.nav')
<div class="container">
<div class="row">
  <div class="col-lg-12">
    <div id="hero">
      <div class="hero-cont"><span class="hero-text">Your ideas and inspiration all in one place <br>  Create and share collages</span></div>
    </div>
  </div>

</div>
<div class="row">
<div class="col-lg-12">
<div id="signup">
  <!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
  
  /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
     We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="http://mooody.us7.list-manage.com/subscribe/post?u=4ed0cde0798bc57e7a6750e07&amp;id=db172c22c6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
  <label for="mce-EMAIL"><h3>Signup and be notified of our beta release</h3></label><br>
  <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
  <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">
</form>
</div>

<!--End mc_embed_signup-->

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