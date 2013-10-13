@include('layout.head')
@include('layout.nav')
<div class="container-board">
    <!-- ###################### LEFT NAVIGATION -->
    <div id="left-nav" class="pull-left">
        <a data-toggle="modal" href="#image" class="btn btn-default btn-add"><i class="icon-picture">Paste image URL</i></a>
        <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">
                            Paste an image URL
                        </h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Text input" id="imageUrl">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-primary" id="addImageButton">Add Image to Board</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
         <a data-toggle="modal" href="#dribbble" class="btn btn-default btn-add"><i class="icon-dribbble">Paste Dribbble URL</i></a>
        <div class="modal fade" id="dribbble" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">
                            Paste a Dribbble URL
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Paste a Dribbble bucket URL to add all the images from the bucket to your board
                        </p><input type="text" class="form-control" placeholder="Text input">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-primary">Add Images to Board</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
         <a data-toggle="modal" href="#pinterest" class="btn btn-default btn-add"><i class="icon-pinterest">Paste a Pinterest URL</i></a>
        <div class="modal fade" id="pinterest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">
                            Paste a Pinterest board URL
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Paste the URL of a Pinterest board to add the images to your mooody board
                        </p><input type="text" class="form-control" placeholder="Text input">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-primary">Add Images to Board</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
         <a class="btn btn-default btn-add" id="addColor"><i class="icon-tint">Create a color swatch</i></a>
        <div id="pickerContainer">
            <div id="pickerCanvas"></div>
            <div class="input-group">
                <input type="text" id="colorHex" class="form-control"> <span class="input-group-btn"><button id="selectColor" type="button" class="btn btn-default"><span class="input-group-btn">Select</span></button></span>
            </div>
        </div>
    </div><!-- ####################### BOARD -->
    <div id="board" class="pull-left">
        <div id="board-title" class="pull-left">
            <h1>
                {{ $board->name }}
            </h1>
            <h5>
                Created {{ Carbon\Carbon::createFromTimeStamp(strtotime($board->created_at))->diffForHumans() }}
            </h5>
        </div>
        <div class="clearfix"></div>
        <div id="act-buttons">
            <div class="btn-group">
                <a class="btn btn-default" href="#" id="moveForwardButton"><i class="icon-chevron-up"></i> Bring Forward</a>
                <a class="btn btn-default" href="#" id="moveBackButton"><i class="icon-chevron-up"></i> Send Backwards</a>
                {{ Form::open(array('url' => '/board/' . $board->key . '/public', 'method' => 'POST', 'id' => 'privacy')) }}
                {{ Form::checkbox('public', 1, $board->public, array('style' => 'display:none')) }}
                <div id="privacybtn" class="toggle-slide"></div>
                {{ Form::close() }}
            </div>
            <a href="#" class="btn btn-primary pull-right" id="saveButton"><i class="icon-download-alt"></i> Save</a>
        </div>
        <div id="canvas" data-key="{{ $board->key }}"></div>
    </div>
</div>
@include('layout.foot')