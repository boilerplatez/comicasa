<html>
<head>
    {include file="header.tpl" title=foo}
</head>

<body>
{include file="navbar.tpl" title=foo}

<!-- Page Content -->
<div class="container">
	<div class="row center-block">
        <div class="btn-group btn-breadcrumb col-lg-6 col-md-6 col-xs-12 col-sm-12 barsec leftbarsec">
            <a href="#" class="btn btn-primary btn-xs"><i
                        class="glyphicon glyphicon-home"></i> </a>
            <a class="btn btn-primary btn-xs" href="{$smarty.const.CONTEXT_PATH}account/comic/{$comic->id}/{$chapter->vol}">
                {$comic->title} : {$chapter->vol}</a>
            <a class="btn btn-primary btn-xs active"
               href="{$smarty.const.CONTEXT_PATH}account/chapter/{$chapter->id}">
                {$chapter->title}</a>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-9 col-sm-9">
            <div id="upload_progress" class="progress">
                <div class="progress-bar progress-bar-success"></div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-xs-3 col-sm-3">
            <div id="upload_button" class="btn-sm btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i> <span class="hidden-xs">Add</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files[]" multiple>
            </div>
        </div>
		<br>
	</div>
    <hr/>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <div id="pendingfiles" class="pendingfiles">
        <div class="row">
            {foreach from=$pages key=k item=page name=pages}
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="{$smarty.const.CONTEXT_PATH}account/chapter/{$chapter->id}/page/{$page->id}">
                        <img class="img-responsive" src="{$smarty.const.CONTEXT_PATH}static/pub/{$page->thumbnail}" alt="">
                    </a>
                </div>
            {/foreach}
        </div>
    </div>
	<hr>
</div>
<!-- Footer -->
{include file="footer.tpl" title=foo}
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/external/components/webmodules-jquery/jquery.min.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/JavaScript-Templates/js/tmpl.min.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/external/components/webmodules-bootstrap/js/bootstrap.min.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/Gallery/js/jquery.blueimp-gallery.min.js"></script>

<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/jquery-file-upload/js/jquery.fileupload.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<script type="application/javascript"
        src="{$smarty.const.CONTEXT_PATH}src/blueimp/jquery-file-upload/js/jquery.fileupload-validate.js"></script>

<script>
    var CHAPTER_ID = '{$chapter->id}';
</script>
<script type="application/javascript" src="{$smarty.const.CONTEXT_PATH}src/upload.js"></script>
</body>
</html>

