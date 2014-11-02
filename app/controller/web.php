<?php 
RudraX::mapRequest("home",function($q,$p,$f,$action="Login"){
	return RudraX::invokeHandler($action);
});
RudraX::mapRequest("album/{aid}",function($q,$p,$f,$aid){
	return RudraX::invokeHandler("ViewAlbum");
});
RudraX::mapRequest("viewpic/{pid}",function($q,$p,$f,$pid){
	return RudraX::invokeHandler("ViewPic");
});
RudraX::mapRequest("static/pri/{uid}/{v}",function($q,$p,$f,$d,$uid,$v){
	//echo "nooo".$v;
	return RudraX::invokeHandler('Pic');
});
RudraX::mapRequest("uploader",function($q,$p,$f,$d){
	return RudraX::invokeHandler('Uploader');
});
RudraX::mapRequest("delete/{pid}",function($q,$p,$f,$pid){
	return RudraX::invokeHandler('DeleteImage');
});
RudraX::mapRequest("upload",function($q,$p,$f,$d){
	return RudraX::invokeHandler('Upload');
});
RudraX::mapRequest("admin/access",function($q,$p,$f,$pid){
	return RudraX::invokeHandler('ImageAccess');
});
RudraX::mapRequest("image/{pid}",function($q,$p,$f,$pid){
	return RudraX::invokeHandler("Image");
});
RudraX::mapRequest("",function(){
	return RudraX::invokeHandler("Images");
});
?>