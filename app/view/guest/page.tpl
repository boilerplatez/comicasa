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
                <a href="#" class="btn btn-primary btn-xs"><i
                            class="glyphicon glyphicon-home"></i> </a>
                <a class="btn btn-primary btn-xs" href="{$smarty.const.CONTEXT_PATH}series/{$comic->id}/vol/{$chapter->vol}">
                    {$comic->title} : {$chapter->vol}</a>
                <a class="btn btn-primary btn-xs"
                   href="{$smarty.const.CONTEXT_PATH}series/{$comic->id}/{$chapter->vol}/ch/{$chapter->inorder}">
                    {$chapter->title}</a>
                <a href="#" class="btn btn-primary btn-xs">{$page->index}</a>
            </div>
        </div>
    </form>
    <hr/>
    <div class="row">
        <div class="center-block nav-wrapper">
            <div class="nav-link nav-left">
             <a  href="{$smarty.const.CONTEXT_PATH}series/{$comic->id}/{$chapter->vol}/ch/{$chapter->inorder}/page/{($page->index==1) ? "-1" : ($page->index-1)}">
                    <span class="glyphicon glyphicon-chevron-left"></span>
            </a></div>
            <img class="img-responsive center-block"
                 src="{$smarty.const.CONTEXT_PATH}static/pri/{$page->file_path}" alt="">
            <div class="nav-link nav-right">
                <a
                   href="{$smarty.const.CONTEXT_PATH}series/{$comic->id}/{$chapter->vol}/ch/{$chapter->inorder}/page/{$page->index+1}">
                    <span class="glyphicon glyphicon-chevron-right"></span>
               </a>
            </div>
        </div>
    </div>
    <hr>
</div>
<!-- Footer -->
{include file="footer.tpl" title=foo}

</body>
</html>
