@include('layout.head')
@include('layout.nav')
<div class="row">
  <!-- ###################### LEFT NAVIGATION -->
  <div class="col-lg-1">
    <div id="left-nav">
      <ul>
        <li><a href="#"><img src="img/images.png"></a></li>
        <hr>
        <li><a href="#"><img src="img/color.png"></a></li>
      </ul> 
    </div>
  </div>
  <!-- ####################### BOARD -->
  <div class="col-lg-11">
    <div id="all-boards">
        <div class="row">
          <div class="col-lg-4">
            <div class="board">
              <img src="img/board.png">
              <div class="board-title">
                <h4>Board Name</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="board">
              <img src="img/board.png">
              <div class="board-title">
                <h4>Board Name</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="board">
            </div>
          </div>
        </div>
      </div>
  </div>

</div>
@include('layout.foot')