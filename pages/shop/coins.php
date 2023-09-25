		<?php if(is_loggedin() && web_admin_level()>=9) { ?>
			<a href="<?php print $shop_url.'admin/paypal'; ?>" class="btn btn-info"><?php print $lang_shop['administration_pp']; ?></a>
			</br></br>
		<?php } 
			$paypal_paid = isset($_GET['m']) ? $_GET['m'] : null;
		?>
		<div class="media-section">
			<div class="images">
			
				<h3 class="section-title"><i class="fa fa-list-ul"></i> <a href="<?php print $shop_url; ?>"><?php print $lang_shop['site_title']; ?></a> / <?php print $lang_shop['pay']; ?></h3>

				
				
				<?php if($paypal_paid=='success') { ?>
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Info:</strong> <?php print $lang_shop['paypal_wait']; ?></div>
				<?php } ?>
				<div class="well">
					<div class="row">
						<?php
							if(!count($list))
								print 'Nothing found.';
							else {
								$i = 0;
								foreach($list as $row) {
									$i++;
						?>
						<form action="" method="post" class="form-horizontal" id="paypal<?php print $i; ?>" class="hidden">
							<input type="hidden" name="id" value="<?php print $row['id']; ?>">
							<input type="submit" id="submit-form<?php print $row['id']; ?>" class="hidden" />
						</form>
						
						<div class="col-md-3">
							<a href="#" onclick="document.forms['paypal<?php print $i; ?>'].submit(); return false;">
								<div class="card mb-3 text-center">
									<div class="card-block">
										<div class="min-image-item">
											<center>
												<img class="image-item" src="<?php print $shop_url; ?>images/paypal.png">
											</center>
										</div>
									</div>
									<div class="card-footer text-muted">
										<?php print $row['price']; ?> &euro; - <?php print $row['coins']; ?> MD
									</div>
								</div>
							</a>
						</div>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>