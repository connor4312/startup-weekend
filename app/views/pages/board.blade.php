@include('layout.head')
@include('layout.nav')
<div class="container">
<div class="row">
  <!-- ###################### LEFT NAVIGATION -->
  
    <div id="left-nav">
      <div class="addimage">
        <div class="addimage-inside">
          <img src="img/image.png">
          Upload or Paste Images
        </div>
      </div>

      <div class="addimage">
        <div class="addimage-inside">
          <img src="img/color.png">
          Create a color swatch
        </div>
      </div>
    </div>
  
  <!-- ####################### BOARD -->
  
    <div id="board-title">
        <h1>Moody Logo</h1>
        <h5>Created 10/12/13</h5>
      </div>
    <div id="board">

      Images goes here
    </div>
  

</div>
</div>
@include('layout.foot')