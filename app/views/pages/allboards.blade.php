@include('layout.head')
@include('layout.nav')
<div class="container">
<div class="row">
  <!-- ###################### LEFT NAVIGATION -->

  <!-- ####################### BOARD -->
  <div class="col-lg-12">
    <div id="allboards">
        @for ($i = 0, $n = count($boards); $i < $n; $i++)
          @if ($i / 3 == floor($i / 3))
            @if ($i > 0)
              </div>
            @endif
            <div class="row">
          @endif
          <div class="col-lg-3" onClick="window.location='{{ URL::to('/board/' . $boards[$i]->id) }}'">
            <div class="board">
              <img src="img/board.png">
              <div class="board-title">
                <h4>{{ $boards[$i]->name }}</h4>
              </div>
            </div>
          </div>
        @endfor
        @if ($n / 3 == floor($n / 3))
          @if ($n > 0)
            </div>
          @endif
          <div class="row">
        @endif
          <div class="col-lg-3" onClick="window.location='{{ URL::to('/board/new') }}'">
            <div class="newboard">
              <img src="img/create.png">
              <div class="board-title">
                <h4>Create board</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

</div>
</div>
@include('layout.foot')