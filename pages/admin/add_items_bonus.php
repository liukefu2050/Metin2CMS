		<div class="media-section">
			<div class="images">
				<h3 class="section-title"><i class="fa fa-list-ul"></i> <a href="<?php print $shop_url; ?>"><?php print $lang_shop['site_title']; ?></a> 
				/ <a href="<?php print $shop_url.'category/'.$get_category.'/'; ?>"><?php print is_get_category_name($get_category); ?></a> / <?php print $lang_shop['is_add_items'].' ['.$lang_shop['bonus_selection'].']'; ?></h3>
				<?php
					$added = false;
					$bonus_value = is_get_bonuses_values_used();
					if(isset($_POST['add']))
					{
						$bonuses1 = $bonuses2 = array();
						
						$bonuses3 = array(0, $_POST['count']);
						
						$bonuses_count = 0;
						
						for($i=1; $i<=96; $i++)
							if(isset($_POST['bonus_'.$i]))
							{
								$bonuses1[] = 'bonus'.$i.' ';
								$bonuses2[] = '? ';
								$bonuses3[] = $_POST['bonus_value_'.$i];
								$bonuses_count++;
							}
						
						if($bonuses_count>=$_POST['count'])
						{
							$expire = 0;
							if($_POST['promotion_months']>0 || $_POST['promotion_days']>0 || $_POST['promotion_hours']>0 || $_POST['promotion_minutes']>0)
								$expire = strtotime("now +".intval($_POST['promotion_months'])." month +".intval($_POST['promotion_days'])." day +".intval($_POST['promotion_hours'])." hours +".intval($_POST['promotion_minutes'])." minute - 1 hour UTC");
							
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
							
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_items (category, type, description, pay_type, coins, count, vnum, socket0, socket1, socket2, expire) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
							$stmt->execute(array($get_category, 3, $_POST['description'], $_POST['method_pay'], $_POST['coins'], 1, $_POST['vnum'], $socket0, $socket1, $socket2, $expire));
							$bonuses3[0] = $database->getSqliteBonuslastInsertId();
							
							$query1 = join(',',$bonuses1);
							$query2 = join(',',$bonuses2);
							$bonuses3[] = $expire;
							
							$stmt = $database->runQuerySqlite('INSERT INTO item_shop_bonuses (id, count, '.$query1.', expire) VALUES (?,?,?,'.$query2.')');
							$stmt->execute($bonuses3);
							
							$added = true;
						} else
								print '<div class="alert alert-dismissible alert-danger">
										<button type="button" class="close" data-dismiss="alert">×</button>
										Ai selectat prea putine bonusuri.
									</div>';
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
						<label class="control-label" for="price">
							<?php print $lang_shop['bonuses']; ?>
						</label>

						<select class="form-control" name="count">
						<?php for($i=1;$i<=7;$i++) {
								print '<option value="'.$i.'"';
								if($i==4)
									print ' selected';
								print '>'.$i.' '.$lang_shop['bonuses'].'</option>';
						} ?>
						</select>
					</div>
					
					<?php 
						$bonuses = is_get_bonuses_new();
						foreach($bonuses as $row) { 
					?>
					<div class="form-group">
						<div class="row">
							<div class="col-md-9">
								<div class="form-check form-control">
								  <label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="bonus_<?php print $row['id']; ?>">
									<?php print str_replace("[n]", 'XXX', $row[$language_code]); ?>
								  </label>
								</div>
							</div>
							<div class="col-md-3">
								<input class="form-control" name="bonus_value_<?php print $row['id']; ?>" type="number" value="<?php print $bonus_value[$row['id']]; ?>">
							</div>
						</div>
					</div>
					<?php } ?>
					
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
						<a class="btn btn-primary" role="button" data-toggle="collapse" href="#sockets" aria-expanded="false" aria-controls="sockets">Sockets</a>
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
						<input class="btn btn-success btn-block" name="add" value="<?php print $lang_shop['is_add_items']; ?>" type="submit">
					</div>
				</form>
			</div>
		</div>