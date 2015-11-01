<html>
<head>{include file="header.tpl" title=foo}</head>
<body>
{include file="navbar.tpl" title=foo}
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="">Latest Updates</h3>
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
        {foreach from=$comics item=comic}
            <tr class="">
                <th>#</th>
                <td>
                    <a href="{$smarty.const.CONTEXT_PATH}series/{$comic->id}/vol/1">
                        {$comic->title}
                    </a>
                </td>
            </tr>
        {/foreach}
    </table>
</div>
{include file="footer.tpl" title=foo}
</body>
</html>

