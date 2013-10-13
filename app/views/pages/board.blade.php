@include('layout.head')
@include('layout.nav')
<div class="container">
<div class="row">
  <!-- ###################### LEFT NAVIGATION -->
  
    <div id="left-nav pull-left">
      <div class="addimage">
        <div class="addimage-inside">
          <img src="{{ URL::to('img/image.png') }}">
          Upload or Paste Images
        </div>
      </div>

      <div class="addimage">
        <div class="addimage-inside">
          <img src="{{ URL::to('img/color.png') }}">
          Create a color swatch
        </div>
      </div>
    </div>
  
  <!-- ####################### BOARD -->
  <div id="board" class="pull-left">
      <div id="board-title pull-left">
          <h1>Moody Logo</h1>
          <h5>Created 10/12/13</h5>
        </div>
      <div id="canvas">
  
        Images goes here
      </div>
    </div>

</div>
</div>
@include('layout.foot')