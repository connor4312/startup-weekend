@include('layout.head')
@include('layout.nav')
<div class="container">
  <div class="row">
    <!-- ###################### LEFT NAVIGATION -->

    <!-- ####################### BOARD -->
    <div class="col-lg-12">
      <div id="allboards">
          @for ($i = 0, $n = count($boards); $i < $n; $i++)
            @if ($i / 4 == floor($i / 4))
              @if ($i > 0)
                </div>
              @endif
              <div class="row">
            @endif
            <div class="col-lg-3" onClick="window.location='{{ URL::to('/board/' . $boards[$i]->key) }}'">
              <div class="board">
                <img src="img/board.png">
                <div class="board-title">
                  <h4>{{ $boards[$i]->name }}</h4>
                </div>
              </div>
            </div>
          @endfor
          @if ($n / 4 == floor($n / 4))
            @if ($n > 0)
              </div>
            @endif
            <div class="row">
          @endif
            <div class="col-lg-3" data-toggle="modal" href="#myModal">
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Create New Board</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => '/board/new', 'method' => 'POST')) }}
          <div class="input-group">
            {{ Form::text('name', '', array('placeholder' => 'Board Name', 'class' => 'form-control', 'id' => 'name'))}}

            <span class="input-group-btn">
              <a class="btn btn-default" id="namegen">Help</a>
             {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
            </span>
          </div>
        {{ Form::close() }}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@include('layout.foot')