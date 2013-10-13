@include('layout.head')
@include('layout.nav')
<div class="row">
  <!-- ###################### LEFT NAVIGATION -->
  <div class="col-lg-1">
    <div id="left-nav">
      <ul>
        <li><a href="#"><img src="{{ URL::to('img/images.png') }}"></a></li>
        <hr>
        <li><a href="#"><img src="{{ img/color.png }}"></a></li>
      </ul> 
    </div>
  </div>
  <!-- ####################### BOARD -->
  <div class="col-lg-11">
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