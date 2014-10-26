<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{$smarty.const.CONTEXT_PATH}">{$pname}</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				{if $user->isValid()}
				<li><a><span class="badge label-warning glyphicon glyphicon-certificate">{$user->getCoins()}</span></a></li>
				<li><a href="{$smarty.const.CONTEXT_PATH}upload">Upload</a></li>
				<li><a href="{$smarty.const.CONTEXT_PATH}home?action=Logout">Logout</a>
				</li> {else}
				<li><a href="{$smarty.const.CONTEXT_PATH}home">Login</a>
				</li> {/if}
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>
