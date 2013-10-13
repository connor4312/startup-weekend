@include('layout.head')
@include('layout.nav')
<div class="container-board">
  <!-- ###################### LEFT NAVIGATION -->
  
    <div id="left-nav" class="pull-left">
      <div class="addimage">
        <div class="addimage-inside">
          <img src="{{ URL::to('img/images.png') }}">
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
  <div id="board">
      <div id="board-title" class="pull-left">
          <h1>Moody Logo</h1>
          <h5>Created 10/12/13</h5>
        </div>
      <div id="canvas">
  
        Images goes here
      </div>
    </div>


</div>
@include('layout.foot')