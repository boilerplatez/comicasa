{include file="navbar.tpl" title=foo}
<!-- Page Content -->
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="">Latest Updates</h3>
		</div>
	</div>
	<hr />
	<div class="row">
		{section name=i loop=$images}
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail"
				href="{$smarty.const.CONTEXT_PATH}image/{$images[i]->id}"> <img
				class="img-responsive"
				src="{$smarty.const.CONTEXT_PATH}static/pub/{$images[i]->file_path}"
				alt="">
			</a>
		</div>
		{/section}
	</div>
	<hr />
</div>
<!-- Footer -->
{include file="footer.tpl" title=foo}
