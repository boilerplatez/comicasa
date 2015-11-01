<html>
<head>{include file="header.tpl" title=foo}</head>
<body>
{include file="navbar.tpl" title=foo}
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h4 class="">{$comic->title}</h4>
        </div>
        <div class="col-lg-6">
            <form action2="{$smarty.const.CONTEXT_PATH}member/comic/add" method="POST">
                <span class="pull-right"><button type="submit" name="action" value="add_chapter"class="glyphicon glyphicon-plus" style="font-size: 20px"></button></span>
                <span class="pull-right"><input name="title"></span>
            </form>
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
        {foreach from=$chapters item=chapter}
            <tr class="">
                <th>#</th>
                <td>
                    <a href="{$smarty.const.CONTEXT_PATH}account/chapter/{$chapter->id}">
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

