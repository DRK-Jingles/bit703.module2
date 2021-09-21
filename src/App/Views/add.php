<div id="main">
		<div class="container">
			<div class="row">
				<div class="text-center">
					<h2>Add an image</h2>
				</div>
			</div>
			<div class="row">
				<?php BIT703\Classes\Messages::displayMessage(); ?>
			</div>
			<div class="row">
				<form id="image-form" method="post" class="col col-sm-8 col-md-6" enctype="multipart/form-data">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="title" class="form-control" />
					</div>
					<div class="form-group">
						<label>Description</label>
						<input type="text" name="description" class="form-control" />
					</div>
					<div class="form-group">
						<label>Tags - add a comma after each tag.</label>
						<input type="text" name="tags" class="form-control" />
					</div>
					<div class="form-group">
						<label>Filter</label>
						<select name="filter" class="custom-select">
							<option value="_1977">1977</option>
							<option value="aden">Aden</option>
							<option value="brannan">Brannan</option>
							<option value="brooklyn">Brooklyn</option>
							<option value="clarendon">Clarendon</option>
							<option value="earlybird">Earlybird</option>
							<option value="gingham">Gingham</option>
							<option value="hudson">Hudson</option>
							<option value="inkwell">Inkwell</option>
							<option value="kelvin">Kelvin</option>
							<option value="lark">Lark</option>
							<option value="lofi">Lo-Fi</option>
							<option value="maven">Maven</option>
							<option value="mayfair">Mayfair</option>
							<option value="moon">Moon</option>
							<option value="nashville">Nashville</option>
							<option value="perpetua">Perpetua</option>
							<option value="reyes">Reyes</option>
							<option value="rise">Rise</option>
							<option value="slumber">Slumber</option>
							<option value="stinson">Stinson</option>
							<option value="toaster">Toaster</option>
							<option value="valencia">Valencia</option>
							<option value="walden">Walden</option>
							<option value="willow">Willow</option>
							<option value="xpro2">X-pro II</option>
						</select>
					</div>
					<div id="image-upload" class="form-group">
						<label>Image</label>
						<input type="file" class="form-control-file" name="file" />
					</div>
					<input class="btn btn-primary" name="submit" type="submit" value="Submit" />
				</form>
			</div>
		</div><!-- /.container -->
	</div>