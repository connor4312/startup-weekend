@include('layout.head')
@include('layout.nav')
<div class="row">
  <!-- ###################### LEFT NAVIGATION -->

  <!-- ####################### BOARD -->
  <div class="col-lg-12">
    <div id="allboards">
        <div class="row">
          <div class="col-lg-3">
            <div class="board">
              <img src="img/board.png">
              <div class="board-title">
                <h4>Board Name</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="board">
              <img src="img/board.png">
              <div class="board-title">
                <h4>Board Name</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="createboard">
              <p><i class="icon-plus icon-4x"></i></p>
            </div>
          </div>
        </div>
      </div>
  </div>

</div>
@include('layout.foot')