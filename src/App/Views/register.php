<div id="main">
	<div class="container">
		<div class="row">
			<div class="text-center">
				<h2>Register User</h2>
			</div>
		</div>
		<div class="row">
			<form method="post" class="col col-sm-8 col-md-6">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control" />
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" />
				</div>
				<input class="btn btn-primary" name="submit" type="submit" value="Submit" />
			</form>
		</div>
		<div class="row">
			<?php BIT703\Classes\Messages::displayMessage(); ?>
		</div>
	</div><!-- /.container -->
</div><!-- /.container -->