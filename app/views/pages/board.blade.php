@include('layout.head')
@include('layout.nav')
<div class="container-board">
    <!-- ###################### LEFT NAVIGATION -->
    <div id="left-nav" class="pull-left">
        <a data-toggle="modal" href="#image" class="btn btn-default btn-add"><i class="icon-picture"></i> Paste image URL</a>
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
        <a data-toggle="modal" href="#imageupload" class="btn btn-default btn-add"><i class="icon-cloud-upload"></i> Upload Image</a>
        <div class="modal fade" id="imageupload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form action="{{ URL::to('/api/image/upload') }}" method="post" enctype="multipart/form-data" id="imageUpload">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">
                                Upload an Image
                            </h4>
                        </div>
                        <div class="modal-body">
                              <div class="form-group">
                                <label for="exampleInputFile">Upload</label>
                                <input type="file" name="file" id="file">
                                <input type="hidden" name="type" value="upload">
                                <input type="hidden" name="board" value="{{ $board->key }}">
                              </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                              <input type="submit" name="submit" value="Submit" class="btn btn-primary" id="imageUploadButton">
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
         <a data-toggle="modal" href="#dribbble" class="btn btn-default btn-add"><i class="icon-dribbble"></i> Paste Dribbble URL</a>
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
                        </p><input type="text" class="form-control" placeholder="Text input" id="js-dribbble-bucket-in">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-primary" id="js-dribbble-bucket-sub">Add Images to Board</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
         <a data-toggle="modal" href="#pinterest" class="btn btn-default btn-add"><i class="icon-pinterest"></i> Paste a Pinterest URL</a>
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
                        </p><input type="text" class="form-control" placeholder="Text input" id="js-pin-in">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-primary" id="js-pin-sub">Add Images to Board</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
         <a class="btn btn-default btn-add" id="addColor"><i class="icon-tint"></i> Create a color swatch</a>
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
        <div id="act-buttons" class="row">
            <div class="btn-group">
                <a class="btn btn-default" href="#" id="moveForwardButton"><i class="icon-chevron-up"></i> Bring Forward</a>
                <a class="btn btn-default" href="#" id="moveBackButton"><i class="icon-chevron-up"></i> Send Backwards</a>
            </div>
            <a href="#" class="btn btn-primary pull-right" id="saveButton"><i class="icon-download-alt"></i> Save</a>
            <div class="pull-right" style="margin-right:10px">
                {{ Form::open(array('url' => '/board/' . $board->key . '/public', 'method' => 'POST', 'id' => 'privacy')) }}
                <div class="btn-group" data-toggle="buttons">
                  <label class="btn btn-default">
                    {{ Form::radio('public', '0', $board->public ? true : false) }} Private
                  </label>
                  <label class="btn btn-default">
                    {{ Form::radio('public', '1', !$board->public ? true : false) }} Public
                  </label>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div id="canvas" data-key="{{ $board->key }}"></div>
    </div>
</div>
@include('layout.foot')