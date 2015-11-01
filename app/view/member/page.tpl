<html>
<head>
    {include file="header.tpl" title=foo}
</head>
<body>

{include file="navbar.tpl" title=foo}
<!-- Page Content -->
<div class="container">
    <form action="" method="POST">
        <div class="row imagebar">
            <div class="btn-group btn-breadcrumb col-lg-7 col-md-6 col-xs-12 col-sm-12 barsec leftbarsec">
                <a href="#" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-home"></i> </a>
                <a class="btn btn-primary btn-xs" href="{$smarty.const.CONTEXT_PATH}account/comic/{$comic->id}/{$chapter->vol}">
                    {$comic->title} : {$chapter->vol}</a>
                <a class="btn btn-primary btn-xs" href="{$smarty.const.CONTEXT_PATH}account/chapter/{$chapter->id}">
                    {$chapter->title}</a>
                <a href="#" class="btn btn-primary btn-xs active">{$page->name}</a>
            </div>
        </div>
    </form>
    <hr/>
    <div class="row">
        <div class="center-block nav-wrapper">
            <img class="img-responsive center-block"
                 src="{$smarty.const.CONTEXT_PATH}static/pri/{$page->file_path}" alt="">
        </div>
    </div>
    <hr>
</div>
<!-- Footer -->
{include file="footer.tpl" title=foo}

</body>
</html>
