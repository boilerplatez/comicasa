{include file="navbar.tpl" title=foo}
<!-- Page Content -->
<div class="container">
	<div class="row">
		<div class="center-block">
			<h5 class="page-header">Upload Gallery</h5>
		</div>
		<br>
		<!-- The fileinput-button span is used to style the file input field as button -->
		<div class="row">
			<div class="col-lg-1 col-md-2 col-xs-2 col-sm-2">
				<div id="upload_button" class="btn-sm btn-success fileinput-button">
					<i class="glyphicon glyphicon-plus"></i> <span class="hidden-xs">Add</span>
					<!-- The file input field used as target for the file upload widget -->
					<input id="fileupload" type="file" name="files[]" multiple>
				</div>
			</div>
			<!-- The global progress bar -->
			<div class="col-lg-11 col-md-10 col-xs-10 col-sm-10">
				<div id="upload_progress" class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
			</div>
		</div>
		<!-- The container for the uploaded files -->
		<div id="files" class="files"></div>
		<div id="pendingfiles" class="pendingfiles">
			<div class="row">
				<div class="col-lg-12">
					<h5 class="page-header">Pending Images</h5>
				</div>
				{section name=i loop=$images}
				<div class="col-lg-3 col-md-4 col-xs-6 thumb">
					<a class="thumbnail" href="{$smarty.const.CONTEXT_PATH}image/{$images[i]->id}"> <img
						class="img-responsive"
						src="{$smarty.const.CONTEXT_PATH}static/pub/{$images[i]->file_path}"
						alt="">
					</a>
				</div>
				{/section}
			</div>
		</div>
		<br>
	</div>
	<hr>
</div>
<!-- Footer -->
{include file="footer.tpl" title=foo}
