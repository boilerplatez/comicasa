<html>
<head>
    {include file="header.tpl" title=foo}
</head>

<body>
{include file="navbar.tpl" title=foo}
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="btn-group btn-breadcrumb col-lg-7 col-md-6 col-xs-12 col-sm-12 barsec leftbarsec">
            <a href="{$smarty.const.CONTEXT_PATH}" class="btn btn-primary btn-xs"><i
                        class="glyphicon glyphicon-home"></i> </a>
            <a class="btn btn-primary btn-xs" href="{$smarty.const.CONTEXT_PATH}series/{$comic->id}/vol/{$chapter->vol}">
                {$comic->title} : {$chapter->vol}</a>
            <a href="#" class="btn btn-primary btn-xs active">{$chapter->title}</a>
        </div>
    </div>
    <div class="clearfix"><br/></div>
	<div class="row">
		<div id="pendingfiles" class="pendingfiles">
			<div class="row">
				{foreach from=$pages key=k item=page name=pages}
				<div class="col-lg-3 col-md-4 col-xs-6 thumb">
					<a class="thumbnail" href="{$smarty.const.CONTEXT_PATH}series/{$comic->id}/{$chapter->vol}/ch/{$chapter->inorder}/page/{$smarty.foreach.pages.index+1}">
                        <img class="img-responsive" src="{$smarty.const.CONTEXT_PATH}static/pub/{$page->thumbnail}" alt="">
					</a>
				</div>
				{/foreach}
			</div>
		</div>
		<br>
	</div>
	<hr>
</div>
<!-- Footer -->
{include file="footer.tpl" title=foo}
</body>
</html>

