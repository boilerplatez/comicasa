{include file="navbar.tpl" title=foo}
<!-- Page Content -->
<div class="container">
	<form action="" method="POST">
	<div class="row imagebar">
			<div class="col-lg-7 col-md-6 col-xs-12 col-sm-12 barsec leftbarsec">
				<span class="label label-primary">{$image->name}</span>
			</div>
			<div class="col-lg-5 col-md-6 col-xs-12 col-sm-12 barsec rightbarsec">
					<input value="{$image->id}" name="pid" type="hidden">
					<span class="label label-warning glyphicon glyphicon-certificate">{$image->price}</span>
					{if $user->isValid()} 
						{if $isMyPic} <span><a
							class="btn btn-danger glyphicon glyphicon-trash btn-xs"
							href="{$smarty.const.CONTEXT_PATH}delete/{$image->id}"> Delete</a>
						</span> 
						{elseif $isPaid && !$hasBaught}
							 <button type="submit" id="buy_button" 
							 class="btn btn-success glyphicon glyphicon-save btn-xs" 
							 name="imageAction" value="buyImage" />Buy</button>
						{elseif !$hasSaved}
						<button type="submit" id="save_button" 
						class="btn btn-success btn-xs glyphicon glyphicon-floppy-save"  name="imageAction" 
						value="saveImage">Save</button>
						{elseif $hasSaved && !$hasBaught}
							<button type="submit" id="save_button" 
							class="btn btn-danger btn-xs glyphicon glyphicon-floppy-remove"  name="imageAction" 
							value="unsaveImage">Unsave</button>
						{elseif $hasBaught}
						<span
							class="label label-success btn-xs glyphicon glyphicon-saved">Baught</span>
						{/if} 
						<button type="submit" id="buy_button" 
							 class="btn {if $image->likes==1} btn-info {else} btn-primary{/if} glyphicon glyphicon-thumbs-up btn-xs" 
							 name="imageAction" value="likeImage" />{$image->likes}</button>
					{else}
					 <span><a class="btn btn-primary btn-xs"
						href="{$smarty.const.CONTEXT_PATH}home">Login To View</a> </span>
						<span type="submit" id="buy_button" 
							 class="label label-primary glyphicon glyphicon-thumbs-up btn-xs" 
							 name="imageAction" value="buyImage" />{$image->likes}</span>
					{/if} 
			</div>
	</div>
	</form>
	<hr />
	<div class="row">
		<div class="center-block">
			<img class="img-responsive center-block"
				src="{$smarty.const.CONTEXT_PATH}viewpic/{$image->id}" alt="">
		</div>
	</div>
	<hr>
</div>
<!-- Footer -->
{include file="footer.tpl" title=foo}
