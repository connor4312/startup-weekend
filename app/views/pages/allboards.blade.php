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
            {{ Input::text('name', '', array('placeholder' => 'Board Name', 'class' => 'form-control', 'id' => 'name'))}}

            <span class="input-group-btn">
              <a class="btn btn-default" id="namegen">Help</a>
            </span>
            <span class="input-group-btn">
             {{ Input::submit('Create', array('class' => 'btn btn-primary')) }}
            </span>
          </div>
        {{ Form::close() }}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
  var nouns = ['time', 'year', 'people', 'way', 'day', 'man', 'thing', 'woman', 'life', 'child', 'world', 'school', 'state', 'family', 'student', 'group', 'country', 'problem', 'hand', 'part', 'place', 'case', 'week', 'company', 'system', 'program', 'question', 'work', 'government', 'number', 'night', 'point', 'home', 'water', 'room', 'mother', 'area', 'money', 'story', 'fact', 'month', 'lot', 'right', 'study', 'book', 'eye', 'job', 'word', 'business', 'issue', 'side', 'kind', 'head', 'house', 'service', 'friend', 'father', 'power', 'hour', 'game', 'line', 'end', 'member', 'law', 'car', 'city', 'community', 'name', 'president', 'team', 'minute', 'idea', 'kid', 'body', 'information', 'back', 'parent', 'face', 'others', 'level', 'office', 'door', 'health', 'person', 'art', 'war', 'history', 'party', 'result', 'change', 'morning', 'reason', 'research', 'girl', 'guy', 'moment', 'air', 'teacher', 'force', 'education']


  var adjs = ['new', 'good', 'high', 'old', 'great', 'big', 'American', 'small', 'large', 'national', 'young', 'different', 'black', 'long', 'little', 'important', 'political', 'bad', 'white', 'real', 'best', 'right', 'social', 'only', 'public', 'sure', 'low', 'early', 'able', 'human', 'local', 'late', 'hard', 'major', 'better', 'economic', 'strong', 'possible', 'whole', 'free', 'military', 'true', 'federal', 'international', 'full', 'special', 'easy', 'clear', 'recent', 'certain', 'personal', 'open', 'red', 'difficult', 'available', 'likely', 'short', 'single', 'medical', 'current', 'wrong', 'private', 'past', 'foreign', 'fine', 'common', 'poor', 'natural', 'significant', 'similar', 'hot', 'dead', 'central', 'happy', 'serious', 'ready', 'simple', 'left', 'physical', 'general', 'environmental', 'financial', 'blue', 'democratic', 'dark', 'various', 'entire', 'close', 'legal', 'religious', 'cold', 'final', 'main', 'green', 'nice', 'huge', 'popular', 'traditional', 'cultural'];

  $('#namegen').click(function() {
    $('#name').val(adjs[Math.floor(Math.random()*adjs.length)] + '-' + nouns[Math.floor(Math.random()*nouns.length)]);
  });
</script>

@include('layout.foot')