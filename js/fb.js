/* All Facebook functions should be included 
in this function, or at least initiated from here */
window.fbAsyncInit = function() {
	FB.init({
		appId: '148255486267',
		status: true,
		cookie: true,
		xfbml: true,
		oauth: true, // enable OAuth 2.0
		//channelUrl: 'http://www..com/wp-content/themes/cc/channel.php' //custom channel
		channelUrl: 'http://10.0.1.199/cc.com/wp-content/themes/cc/channel.php'
	});
	FB.api('/me', function(response) {
		console.log(response.name);
	});
};
$(function() {
	var e = document.createElement('script'); e.async = true;
	e.src = document.location.protocol +
	'//connect.facebook.net/en_US/all.js';
	document.getElementById('fb-root').appendChild(e);
}());