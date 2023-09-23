		<div class="media-section">
			<div class="images">
				<h3 class="section-title"><i class="fa fa-list-ul"></i> <a href="<?php print $shop_url; ?>"><?php print $lang_shop['site_title']; ?></a> / <?php print $lang_shop['login']; ?></h3>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6 col-md-offset-3">
								<?php
									if(isset($_POST['username'], $_POST['password'])) {
										if(login($_POST['username'], $_POST['password'], 1)) {
											print '<div class="alert alert-dismissible alert-success">
													<button type="button" class="close" data-dismiss="alert">×</button>
													'.$lang_shop['login_success'].'
												</div>';
										}
										else {
											print '<div class="alert alert-dismissible alert-danger">
													<button type="button" class="close" data-dismiss="alert">×</button>
													'.$lang_shop['login_fail'].'
												</div>';
										}
									}
								?>
								<form id="login-form" action="" method="post" role="form">
									<div class="form-group">
										<label for="username"><?php print $lang_shop['name_login']; ?></label>
										<input name="username" id="username" tabindex="1" class="form-control" pattern=".{5,64}" maxlength="64" placeholder="<?php print $lang_shop['name_login']; ?>" required="" type="text" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="username"><?php print $lang_shop['password']; ?></label>
										<input name="password" id="password" tabindex="2" class="form-control" pattern=".{5,16}" maxlength="16" placeholder="<?php print $lang_shop['password']; ?>" required="" type="password">
									</div>
									<div class="form-group">

												<input type="submit" name="login" id="login" class="btn btn-success btn-lg btn-block" value="<?php print $lang_shop['login']; ?>">

									</div>
								</form>
							</div>
						</div>
								
			</div>
		</div>
