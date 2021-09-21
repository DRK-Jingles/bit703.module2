	<div id="hero_wrapper">
		<div id="hero">
			<div class="container-fluid">
				<div class="row">
					<h1>Welcome To Philter</h1>
					<p>Find something cool? Share it with our community.<br/> Look at other images as well</p>
					<?php if(isset($_SESSION['is_logged_in'])) { ?>
							<p><a class="btn btn-primary text-center" href="/image/add">Upload an Image Now</a></p>
					<?php } else { ?>
							<p><a class="btn btn-primary text-center" href="/user/login">Login Now</a></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>