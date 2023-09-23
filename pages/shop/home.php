		<?php if(is_loggedin() && web_admin_level()>=9) { ?>
			<a href="<?php print $shop_url; ?>categories" class="btn btn-info"><?php print $lang_shop['administration_categories']; ?></a>
			<a href="<?php print $shop_url; ?>admin/paypal" class="btn btn-success"><?php print $lang_shop['administration_pp']; ?></a>
			</br></br>
		<?php } ?>
				
			<div class="media-section">
				<div class="images">
					<h3 class="section-title"><i class="fa fa-list-ul"></i> <?php print $lang_shop['site_title']; ?> </h3>

					<div class="row">
						<?php
							$list = array();
							$list = is_categories_list();
							
							if(!count($list))
								print 'Nothing found.';
							else {
								foreach($list as $row) {
						?>
							<div class="col-md-3">
								<a href="<?php print $shop_url.'category/'.$row['id'].'/'; ?>">
									<div class="card mb-3 text-center">
										<div class="card-block">
											<div class="min-image-item">
												<center>
													<img class="image-item" src="<?php print $shop_url; ?>images/items/<?php print get_item_image($row['img']); ?>.png">
												</center>
											</div>
											<?php if(checkForPromotions($row['id'])) { ?>
											<p class="card-text"><small class="font-weight-bold strong pull-right text-danger"><?php print $lang_shop['promotion']; ?></small></p>
											<?php } ?>
										</div>
										<div class="card-footer text-muted">
											<a href="<?php print $shop_url.'category/'.$row['id'].'/'; ?>"><?php print $row['name']; ?></a>
										</div>
									</div>
								</a>
							</div>
						
						<?php } } ?>
					</div>
				</div>
			</div>