		<div class="media-section">
			<div class="images">
				<h3 class="section-title"><i class="fa fa-list-ul"></i> <a href="<?php print $shop_url; ?>"><?php print $lang_shop['site_title']; ?></a> 
				/ <a href="<?php print $shop_url.'category/'.$get_category.'/'; ?>"><?php print is_get_category_name($get_category); ?></a> / <?php print $lang_shop['is_add_items']; ?></h3>
				<?php
					$added = false;
					
					if(isset($_POST['add']))
					{
						$time_settings = get_settings_time(1);
						$time2_settings = get_settings_time(2);
						$absorption_settings = get_settings_time(3);
						
						$time = $time2 = 0;
						if($_POST['count']<=0)
							$_POST['count']=1;
						
						for($i=0;$i<=6;$i++) 
							if($_POST['attrtype'.$i]==0)
								$_POST['attrvalue'.$i]=0;
							
						if(check_item_column("applytype0"))
							for($i=0;$i<=7;$i++) 
								if($_POST['applytype'.$i]==0)
									$_POST['applyvalue'.$i]=0;
								
						if($_POST['socket0']!="")
							$socket0 = $_POST['socket0'];
						else
							$socket0 = 0;
						if($_POST['socket1']!="")
							$socket1 = $_POST['socket1'];
						else
							$socket1 = 0;
						if($_POST['socket2']!="")
							$socket2 = $_POST['socket2'];
						else
							$socket2 = 0;
							
						$item_unique = 0;
									
						$expire = 0;
						if($_POST['promotion_months']>0 || $_POST['promotion_days']>0 || $_POST['promotion_hours']>0 || $_POST['promotion_minutes']>0)
							$expire = strtotime("now +".intval($_POST['promotion_months'])." month +".intval($_POST['promotion_days'])." day +".intval($_POST['promotion_hours'])." hours +".intval($_POST['promotion_minutes'])." minute - 1 hour UTC");
						
						if($_POST['time_months']>0 || $_POST['time_days']>0 || $_POST['time_hours']>0 || $_POST['time_minutes']>0)
						{
							$time = $_POST['time_minutes'] + $_POST['time_hours']*60 + $_POST['time_days']*24*60 + $_POST['time_months']*30*24*60;
							$item_unique = 1;
						}
						
						if($_POST['time2_months']>0 || $_POST['time2_days']>0 || $_POST['time2_hours']>0 || $_POST['time2_minutes']>0)
						{
							$time2 = $_POST['time2_minutes'] + $_POST['time2_hours']*60 + $_POST['time2_days']*24*60 + $_POST['time2_months']*30*24*60;
							$item_unique = 2;
						}
							
						if(check_item_column("applytype0") && check_item_sash($_POST['vnum']) && $time2==0)
						{
							$added = true;
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_items (category, description, pay_type, coins, count, vnum, socket'.$absorption_settings.', socket'.$time_settings.', attrtype0, attrvalue0, attrtype1 , attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6, applytype0, applyvalue0, applytype1, applyvalue1, applytype2, applyvalue2, applytype3, applyvalue3, applytype4, applyvalue4, applytype5, applyvalue5, applytype6, applyvalue6, applytype7, applyvalue7, expire, item_unique) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
							$stmt->execute(array($get_category, $_POST['description'], $_POST['method_pay'], $_POST['coins'], $_POST['count'], $_POST['vnum'], $_POST['absorption'], $time,
												$_POST['attrtype0'], $_POST['attrvalue0'], $_POST['attrtype1'], $_POST['attrvalue1'], $_POST['attrtype2'], $_POST['attrvalue2'], 
												$_POST['attrtype3'], $_POST['attrvalue3'], $_POST['attrtype4'], $_POST['attrvalue4'], $_POST['attrtype5'], $_POST['attrvalue5'], 
												$_POST['attrtype6'], $_POST['attrvalue6'], 
												$_POST['applytype0'], $_POST['applyvalue0'], $_POST['applytype1'], $_POST['applyvalue1'], $_POST['applytype2'], $_POST['applyvalue2'], 
												$_POST['applytype3'], $_POST['applyvalue3'], $_POST['applytype4'], $_POST['applyvalue4'], $_POST['applytype5'], $_POST['applyvalue5'], 
												$_POST['applytype6'], $_POST['applyvalue6'], $_POST['applytype7'], $_POST['applyvalue7'], $expire, $item_unique));
						}
						else if(check_item_column("applytype0") && check_item_sash($_POST['vnum']) && $time2)
						{
							$added = true;
							$type = 1;
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_items (category, description, pay_type, coins, count, vnum, socket'.$absorption_settings.', socket'.$time2_settings.', attrtype0, attrvalue0, attrtype1 , attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6, applytype0, applyvalue0, applytype1, applyvalue1, applytype2, applyvalue2, applytype3, applyvalue3, applytype4, applyvalue4, applytype5, applyvalue5, applytype6, applyvalue6, applytype7, applyvalue7, type, expire, item_unique) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
							$stmt->execute(array($get_category, $_POST['description'], $_POST['method_pay'], $_POST['coins'], $_POST['count'], $_POST['vnum'], $_POST['absorption'], $time2,
												$_POST['attrtype0'], $_POST['attrvalue0'], $_POST['attrtype1'], $_POST['attrvalue1'], $_POST['attrtype2'], $_POST['attrvalue2'], 
												$_POST['attrtype3'], $_POST['attrvalue3'], $_POST['attrtype4'], $_POST['attrvalue4'], $_POST['attrtype5'], $_POST['attrvalue5'], 
												$_POST['attrtype6'], $_POST['attrvalue6'], 
												$_POST['applytype0'], $_POST['applyvalue0'], $_POST['applytype1'], $_POST['applyvalue1'], $_POST['applytype2'], $_POST['applyvalue2'], 
												$_POST['applytype3'], $_POST['applyvalue3'], $_POST['applytype4'], $_POST['applyvalue4'], $_POST['applytype5'], $_POST['applyvalue5'], 
												$_POST['applytype6'], $_POST['applyvalue6'], $_POST['applytype7'], $_POST['applyvalue7'], $type, $expire, $item_unique));
						}
						else if(check_item_column("applytype0") && check_item_sash($_POST['vnum']))
						{
							$added = true;
							$type = 1;
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_items (category, description, pay_type, coins, count, vnum, socket'.$absorption_settings.', socket'.$time_settings.', attrtype0, attrvalue0, attrtype1 , attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6, applytype0, applyvalue0, applytype1, applyvalue1, applytype2, applyvalue2, applytype3, applyvalue3, applytype4, applyvalue4, applytype5, applyvalue5, applytype6, applyvalue6, applytype7, applyvalue7, type, expire, item_unique) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
							$stmt->execute(array($get_category, $_POST['description'], $_POST['method_pay'], $_POST['coins'], $_POST['count'], $_POST['vnum'], $_POST['absorption'], $time,
												$_POST['attrtype0'], $_POST['attrvalue0'], $_POST['attrtype1'], $_POST['attrvalue1'], $_POST['attrtype2'], $_POST['attrvalue2'], 
												$_POST['attrtype3'], $_POST['attrvalue3'], $_POST['attrtype4'], $_POST['attrvalue4'], $_POST['attrtype5'], $_POST['attrvalue5'], 
												$_POST['attrtype6'], $_POST['attrvalue6'], 
												$_POST['applytype0'], $_POST['applyvalue0'], $_POST['applytype1'], $_POST['applyvalue1'], $_POST['applytype2'], $_POST['applyvalue2'], 
												$_POST['applytype3'], $_POST['applyvalue3'], $_POST['applytype4'], $_POST['applyvalue4'], $_POST['applytype5'], $_POST['applyvalue5'], 
												$_POST['applytype6'], $_POST['applyvalue6'], $_POST['applytype7'], $_POST['applyvalue7'], $type, $expire, $item_unique));
						}
						else if(check_item_column("applytype0") && ($socket0 || $socket1 || $socket2))//pietre
						{
							$added = true;
							$type = 2;
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_items (category, description, pay_type, coins, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1 , attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6, applytype0, applyvalue0, applytype1, applyvalue1, applytype2, applyvalue2, applytype3, applyvalue3, applytype4, applyvalue4, applytype5, applyvalue5, applytype6, applyvalue6, applytype7, applyvalue7, type, expire, item_unique) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
							$stmt->execute(array($get_category, $_POST['description'], $_POST['method_pay'], $_POST['coins'], $_POST['count'], $_POST['vnum'], $socket0, $socket1, $socket2,
												$_POST['attrtype0'], $_POST['attrvalue0'], $_POST['attrtype1'], $_POST['attrvalue1'], $_POST['attrtype2'], $_POST['attrvalue2'], 
												$_POST['attrtype3'], $_POST['attrvalue3'], $_POST['attrtype4'], $_POST['attrvalue4'], $_POST['attrtype5'], $_POST['attrvalue5'], 
												$_POST['attrtype6'], $_POST['attrvalue6'], 
												$_POST['applytype0'], $_POST['applyvalue0'], $_POST['applytype1'], $_POST['applyvalue1'], $_POST['applytype2'], $_POST['applyvalue2'], 
												$_POST['applytype3'], $_POST['applyvalue3'], $_POST['applytype4'], $_POST['applyvalue4'], $_POST['applytype5'], $_POST['applyvalue5'], 
												$_POST['applytype6'], $_POST['applyvalue6'], $_POST['applytype7'], $_POST['applyvalue7'], $type, $expire, $item_unique));
						}
						else if($socket0 || $socket1 || $socket2)//pietre
						{
							$added = true;
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_items (category, description, pay_type, coins, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1 , attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6, expire, item_unique) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
							$stmt->execute(array($get_category, $_POST['description'], $_POST['method_pay'], $_POST['coins'], $_POST['count'], $_POST['vnum'], $socket0, $socket1, $socket2,
												$_POST['attrtype0'], $_POST['attrvalue0'], $_POST['attrtype1'], $_POST['attrvalue1'], $_POST['attrtype2'], $_POST['attrvalue2'], 
												$_POST['attrtype3'], $_POST['attrvalue3'], $_POST['attrtype4'], $_POST['attrvalue4'], $_POST['attrtype5'], $_POST['attrvalue5'], 
												$_POST['attrtype6'], $_POST['attrvalue6'], $expire, $item_unique));
						}
						else if($time2==0)
						{
							$added = true;
							$type = 2;
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_items (category, description, pay_type, coins, count, vnum, socket2, attrtype0, attrvalue'.$time_settings.', attrtype1 , attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6, type, expire, item_unique) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
							$stmt->execute(array($get_category, $_POST['description'], $_POST['method_pay'], $_POST['coins'], $_POST['count'], $_POST['vnum'], $time,
												$_POST['attrtype0'], $_POST['attrvalue0'], $_POST['attrtype1'], $_POST['attrvalue1'], $_POST['attrtype2'], $_POST['attrvalue2'], 
												$_POST['attrtype3'], $_POST['attrvalue3'], $_POST['attrtype4'], $_POST['attrvalue4'], $_POST['attrtype5'], $_POST['attrvalue5'], 
												$_POST['attrtype6'], $_POST['attrvalue6'], $type, $expire, $item_unique));
						} else {
							$added = true;
							$type = 1;
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_items (category, description, pay_type, coins, count, vnum, socket'.$time2_settings.', attrtype0, attrvalue0, attrtype1 , attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6, type, expire, item_unique) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
							$stmt->execute(array($get_category, $_POST['description'], $_POST['method_pay'], $_POST['coins'], $_POST['count'], $_POST['vnum'], $time2,
												$_POST['attrtype0'], $_POST['attrvalue0'], $_POST['attrtype1'], $_POST['attrvalue1'], $_POST['attrtype2'], $_POST['attrvalue2'], 
												$_POST['attrtype3'], $_POST['attrvalue3'], $_POST['attrtype4'], $_POST['attrvalue4'], $_POST['attrtype5'], $_POST['attrvalue5'], 
												$_POST['attrtype6'], $_POST['attrvalue6'], $type, $expire, $item_unique));
						}
					}
					
					if($added)
						print '<div class="alert alert-dismissible alert-success">
								<button type="button" class="close" data-dismiss="alert">×</button>
								'.$lang_shop['item_added'].'
							</div>';
				?>
				<form action="" method="post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label" for="vnum">vNum</label>
						<input class="form-control" name="vnum" id="vnum" type="number" required>
					</div>

					<div class="form-group">
						<label class="control-label" for="count">
							<?php print $lang_shop['objects_number']; ?>
						</label>
						<input class="form-control" name="count" id="count" type="number" value="1" required>
					</div>

					<div class="form-group">
						<label class="control-label" for="price">
							<?php print $lang_shop['price_object']; ?>
						</label>

						<div class="row">
							<div class="col-md-9">
								<select class="form-control" name="method_pay">
									<option value="1">MD</option>
									<option value="2">JD</option>
								</select>
							</div>
							<div class="col-md-3">
								<input class="form-control" name="coins" id="coins" type="number" value="10" required>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label" for="description">
							<?php print $lang_shop['description']; ?>
						</label>
						<textarea class="form-control" rows="3" name="description" id="description"></textarea>
					</div>

					<div class="form-group">
						<label class="control-label">
							<?php print $lang_shop['bonuses']; ?>
						</label>
					</div>

					<?php for($i=0;$i<=6;$i++) { ?>
					<div class="form-group">
						<div class="row">
							<div class="col-md-9">
								<select class="form-control" name="attrtype<?php print $i; ?>">
									<option value="0">No</option>
									<?php is_get_bonuses(); ?>
								</select>
							</div>
							<div class="col-md-3">
								<input class="form-control" name="attrvalue<?php print $i; ?>" type="number" value="0" required>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if(check_item_column("applytype0")) { ?>
					<div class="form-group">
						<a class="btn btn-primary" role="button" data-toggle="collapse" href="#sash" aria-expanded="false" aria-controls="sash">
							<?php print $lang_shop['more_bonuses']; ?>
						</a>
						<div class="collapse" id="sash">
							<div class="form-group">
								<label class="control-label" for="absorption">
									<?php print $lang_shop['bonus_absorption']; ?>
								</label>
								<input class="form-control" name="absorption" id="absorption" type="number" value="18">
							</div>
							<div class="form-group">
								<label class="control-label">
									<?php print $lang_shop['bonuses']; ?>
								</label>
							</div>
							<?php for($i=0;$i<=7;$i++) { ?>
							<div class="form-group">
								<div class="row">
									<div class="col-md-9">
										<select class="form-control" name="applytype<?php print $i; ?>">
											<option value="0">No</option>
											<?php is_get_bonuses(); ?>
										</select>
									</div>
									<div class="col-md-3">
										<input class="form-control" name="applyvalue<?php print $i; ?>" type="number" value="0" required>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>

					<?php } ?>
					<div class="form-group">
						<a class="btn btn-primary" role="button" data-toggle="collapse" href="#sockets" aria-expanded="false" aria-controls="sockets">
													Sockets
												</a>
						<div class="collapse" id="sockets">
							<div class="form-group">
								<label class="control-label" for="socket0">Socket (1)</label>
								<input class="form-control" name="socket0" id="socket0" type="number" value="0" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="socket1">Socket (2)</label>
								<input class="form-control" name="socket1" id="socket1" type="number" value="0" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="socket2">Socket (3)</label>
								<input class="form-control" name="socket2" id="socket2" type="number" value="0" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<a class="btn btn-primary" role="button" data-toggle="collapse" href="#time" aria-expanded="false" aria-controls="time">
							<?php print $lang_shop['item_time']; ?>
						</a>
						<div class="collapse" id="time">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-3">
										<label for="months"><?php print ucfirst($lang_shop['months']); ?> (30 <?php print $lang_shop['days']; ?>)</label>
										<input class="form-control" type="number" value="0" id="time_months" name="time_months" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="days"><?php print ucfirst($lang_shop['days']); ?></label>
										<input class="form-control" type="number" value="0" id="time_days" name="time_days" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="hours"><?php print ucfirst($lang_shop['hours']); ?></label>
										<input class="form-control" type="number" value="0" id="time_hours" name="time_hours" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="reason"><?php print ucfirst($lang_shop['minutes']); ?></label>
										<input class="form-control" type="number" value="0" id="time_minutes" name="time_minutes" min="0" required>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<a class="btn btn-primary" role="button" data-toggle="collapse" href="#time2" aria-expanded="false" aria-controls="time2">
							<?php print $lang_shop['item_time']. ' - '.$lang_shop['costumes']; ?>
						</a>
						<div class="collapse" id="time2">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-3">
										<label for="months"><?php print ucfirst($lang_shop['months']); ?> (30 <?php print $lang_shop['days']; ?>)</label>
										<input class="form-control" type="number" value="0" id="time2_months" name="time2_months" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="days"><?php print ucfirst($lang_shop['days']); ?></label>
										<input class="form-control" type="number" value="0" id="time2_days" name="time2_days" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="hours"><?php print ucfirst($lang_shop['hours']); ?></label>
										<input class="form-control" type="number" value="0" id="time2_hours" name="time2_hours" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="reason"><?php print ucfirst($lang_shop['minutes']); ?></label>
										<input class="form-control" type="number" value="0" id="time2_minutes" name="time2_minutes" min="0" required>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<a class="btn btn-danger" role="button" data-toggle="collapse" href="#promotion" aria-expanded="false" aria-controls="promotion">
							<?php print $lang_shop['promotion']; ?>
						</a>
						<div class="collapse" id="promotion">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-3">
										<label for="months"><?php print ucfirst($lang_shop['months']); ?> (30 <?php print $lang_shop['days']; ?>)</label>
										<input class="form-control" type="number" value="0" id="promotion_months" name="promotion_months" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="days"><?php print ucfirst($lang_shop['days']); ?></label>
										<input class="form-control" type="number" value="0" id="promotion_days" name="promotion_days" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="hours"><?php print ucfirst($lang_shop['hours']); ?></label>
										<input class="form-control" type="number" value="0" id="promotion_hours" name="promotion_hours" min="0" required>
									</div>
									<div class="col-lg-3">
										<label for="reason"><?php print ucfirst($lang_shop['minutes']); ?></label>
										<input class="form-control" type="number" value="0" id="promotion_minutes" name="promotion_minutes" min="0" required>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input class="btn btn-success btn-block" name="add" value="<?php print $lang_shop['is_add_items']; ?>" type="submit">
					</div>

				</form>

			</div>
		</div>