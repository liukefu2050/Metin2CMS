		<?php if(is_loggedin() && web_admin_level()>=9) { ?>
			<a href="<?php print $shop_url.'add/item/'.$get_category.'/'; ?>" class="btn btn-info"><?php print $lang_shop['is_add_items']; ?></a>
			<a href="<?php print $shop_url.'add/bonus/item/'.$get_category.'/'; ?>" class="btn btn-danger"><?php print $lang_shop['is_add_items'].' ['.$lang_shop['bonus_selection'].']'; ?></a>
			</br></br>
		<?php } ?>
			<div class="media-section">
				<div class="images">
					<h3 class="section-title"><i class="fa fa-list-ul"></i> <a href="<?php print $shop_url; ?>"><?php print $lang_shop['site_title']; ?></a> / <?php print is_get_category_name($get_category); ?></h3>

					<div class="row">
						<?php
							$list = array();
							$list = is_items_list($get_category);
							
							if(!count($list))
								print 'Nothing found.';
							else {
								foreach($list as $row) {
						?>
							<div class="col-md-3">
								<a href="<?php print $shop_url.'item/'.$row['id'].'/'; ?>">
									<div class="card mb-3 text-center">
										<div class="card-block">
											<div class="min-image-item">
												<center>
													<img class="image-item" src="<?php print $shop_url; ?>images/items/<?php print get_item_image($row['vnum']); ?>.png">
												</center>
											</div>
											<?php if($row['discount']>0) { ?>
											<span class="badge badge-danger font-weight-bold strong pull-right">- <?php print $row['discount']; ?>%</span>
											<?php } 
												if($row['expire']>0) {
													$expire = date("Y-m-d H:i:s", $row['expire']);
											?>
											<p class="card-text"><small class="font-weight-bold strong pull-right text-danger" data-countdown="<?php print $expire; ?>"></small></p>
											<?php }
												if($row['type']==3) {
											?>
											<p class="card-text"><small class="font-weight-bold strong pull-right text-danger"><?php print $lang_shop['bonus_selection']; ?></small></p>
											<?php } ?>
										</div>
										<div class="card-footer text-muted">
											<a href="<?php print $shop_url.'item/'.$row['id'].'/'; ?>"><?php if(!$item_name_db) print get_item_name($row['vnum']); else print get_item_name_locale_name($row['vnum']); ?></a>
										</div>
									</div>
								</a>
							</div>
						<?php } } ?>
					</div>
				</div>
			</div>