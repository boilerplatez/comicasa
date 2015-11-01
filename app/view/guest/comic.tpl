<html>
<head>{include file="header.tpl" title=foo}</head>
<body>
{include file="navbar.tpl" title=foo}
<div class="container">
    <div class="row">
        <div class="btn-group btn-breadcrumb col-lg-7 col-md-6 col-xs-12 col-sm-12 barsec leftbarsec">
            <a href="#" class="btn btn-primary btn-xs"><i
                        class="glyphicon glyphicon-home"></i> </a>
            <a class="btn btn-primary btn-xs" href="{$smarty.const.CONTEXT_PATH}comic/{$comic->id}}">
                {$comic->title}</a>
            <a href="#" class="btn btn-primary btn-xs active">Volume : {$volume}</a>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>
                Title
            </th>
        </tr>
        </thead>
        {foreach from=$chapters item=chapter name=chapters}
            <tr class="">
                <th>#</th>
                <td>
                    <a href="{$smarty.const.CONTEXT_PATH}series/{$comic->id}/{$volume}/ch/{$smarty.foreach.chapters.index+1}">
                        {$chapter->title}
                    </a>
                </td>
            </tr>
        {/foreach}
    </table>
</div>
{include file="footer.tpl" title=foo}
</body>
</html>

