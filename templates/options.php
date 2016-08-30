<div class="wrap">
	<h2><?php _e( 'WPsocialMe Options', 'wp_sm' ); ?></h2>
	<div style="width:600px;float:left">
		<form method="post" action="options.php">
			<div id="tabs">
					<ul>
						<li><a href="#fb_tab">Facebook</a></li>
						<li><a href="#google_tab">Google</a></li>
						<li><a href="#twitter_tab">Twitter</a></li>
					</ul>
				<div id="fb_tab">
					<table>
						<tr><td><label for="fb_enable"><b>Enable</b></label><td><input type="checkbox" name="fb_enable"><br>
						<tr><td><label for="fb_id">App ID</label><td><input type="text" name="fb_id"><br>
						<tr><td><label for="fb_secret">App Secret</label><td><input type="text" name="fb_secret"><br>
					</table>
				</div>
				<div id="google_tab">
					<table>
						<tr><td><label for="google_enable"><b>Enable</b></label><td><input type="checkbox" name="google_enable"><br>
						<tr><td><label for="google_id">Client ID</label><td><input type="text" name="google_id"><br>
						<tr><td><label for="google_secret">Client Secret</label><td><input type="text" name="google_secret"><br>
					</table>		
				</div>
				<div id="twitter_tab">
					<table>
						<tr><td><label for="twitter_enable"><b>Enable</b></label><td><input type="checkbox" name="twitter_enable"><br>
						<tr><td><label for="twitter_id">Consumer Key</label><td><input type="text" name="twitter_id"><br>
						<tr><td><label for="twitter_secret">Consumer Secret</label><td><input type="text" name="twitter_secret"><br>
					</table>
				</div>
			</div>
			<table>
				<tr><td><h4>Display Options</h4>
				<tr><td><input type="checkbox" name="display_login"><label for="display_login"> Login form</label><br>
				<tr><td><input type="checkbox" name="display_register"><label for="display_register"> Registration form</label><br>
				<tr><td><input type="checkbox" name="display_comments"><label for="display_comments"> Comments</label><br>
			<tr><td><h4>User Avatar</h4>
				<tr><td><input type="radio" name="avatar" value="default"><label for="default_avatar"> Use Wordpress default avatar</label><br>
				<tr><td><input type="radio" name="avatar" value="social"><label for="social_avatar"> Use profile picture from social media</label><br>
			</table>
			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php _e( 'Save Changes', 'wp_sm' ) ?>"/>
			</p>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
		$( "#tabs" ).tabs();
	} );
</script>