@include('layout.head')
@include('layout.nav')
<div class="container-board">
  <!-- ###################### LEFT NAVIGATION -->
  
    <div id="left-nav" class="pull-left">
      
          <a data-toggle="modal" href="#image" class="btn btn-default btn-add"><i class="icon-picture"> Paste image URL</i></a>
        

      <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Paste an image URL</h4>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" placeholder="Text input">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Add Image to Board</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

       
        

      <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Paste an image URL</h4>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" placeholder="Text input">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Add Image to Board</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

       <a data-toggle="modal" href="#dribbble" class="btn btn-default btn-add"><i class="icon-dribbble"> Paste Dribbble URL</i></a>
        

      <div class="modal fade" id="dribbble" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Paste a Dribbble URL</h4>
      </div>
      <div class="modal-body">
        <p>Paste a Dribbble bucket URL to add all the images from the bucket to your board</p>
        <input type="text" class="form-control" placeholder="Text input">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Add Images to Board</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

       <a data-toggle="modal" href="#pinterest" class="btn btn-default btn-add"><i class="icon-pinterest"> Paste a Pinterest URL</i></a>
        

      <div class="modal fade" id="pinterest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Paste a Pinterest board URL</h4>
      </div>
      <div class="modal-body">
        <p>Paste the URL of a Pinterest board to add the images to your mooody board</p>
        <input type="text" class="form-control" placeholder="Text input">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Add Images to Board</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<a data-toggle="modal" href="#image" class="btn btn-default btn-add"><i class="icon-tint"> Create a color swatch</i></a>
</div> 


 
  <!-- ####################### BOARD -->
  <div id="board" class="pull-left">
      <div id="board-title" class="pull-left">
          <h1>Moody Logo</h1>
          <h5>Created 10/12/13</h5>
        </div>
  <div class="clearfix"></div>      

  <div id="act-buttons">
<div class="btn-group">
  <a class="btn btn-default" href="#"><i class="icon-chevron-up"></i> Bring Forward</a>
  <a class="btn btn-default" href="#"><i class="icon-chevron-down"></i> Send Backwards</a>
</div>
<a class="btn btn-default"href="#"><i class="icon-share-alt"></i> Share your board</a>
  </div>      
      <div id="canvas">
  
        Images goes here
      </div>
    </div>


</div>
@include('layout.foot')