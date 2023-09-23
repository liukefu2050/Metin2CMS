<?php
	if(isset($_POST['time']) && isset($_POST['time2']) && isset($_POST['absorption']))
		update_settings($_POST['time'], $_POST['time2'], $_POST['absorption'], $_POST['name']);
	
	$time = get_settings_time(1);
	$time2 = get_settings_time(2);
	$absorption = get_settings_time(3);
	$item_name_db = get_settings_time(4);
?>
<div class="media-section">
	<div class="images">
		<h3 class="section-title"><i class="fa fa-list-ul"></i> <a href="<?php print $shop_url; ?>"><?php print $lang_shop['site_title']; ?></a> / <?php print ucfirst($current_page); ?></h3>
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3">
						<label for="time"><?php print $lang_shop['item_time']; ?></label>
						<select class="form-control" name="time">
							<option value="0" <?php if($time==0) print 'selected'; ?>>socket0</option>
							<option value="1" <?php if($time==1) print 'selected'; ?>>socket1</option>
							<option value="2" <?php if($time==2) print 'selected'; ?>>socket2</option>
						</select>
					</div>
					<div class="col-lg-3">
						<label for="time2"><?php print $lang_shop['item_time']. ' - '.$lang_shop['costumes']; ?></label>
						<select class="form-control" name="time2">
							<option value="0" <?php if($time2==0) print 'selected'; ?>>socket0</option>
							<option value="1" <?php if($time2==1) print 'selected'; ?>>socket1</option>
							<option value="2" <?php if($time2==2) print 'selected'; ?>>socket2</option>
						</select>
					</div>
					<div class="col-lg-3">
						<label for="absorption"><?php print $lang_shop['bonus_absorption']; ?></label>
						<select class="form-control" name="absorption">
							<option value="0" <?php if($absorption==0) print 'selected'; ?>>socket0</option>
							<option value="1" <?php if($absorption==1) print 'selected'; ?>>socket1</option>
							<option value="2" <?php if($absorption==2) print 'selected'; ?>>socket2</option>
						</select>
					</div>
					<div class="col-lg-3">
						<label for="name"><?php print $lang_shop['name']; ?></label>
						<select class="form-control" name="name">
							<option value="0" <?php if($item_name_db==0) print 'selected'; ?>>site.db</option>
							<option value="1" <?php if($item_name_db==1) print 'selected'; ?>>item_proto</option>
						</select>
					</div>
					
					<div class="col-lg-3"></br></br>
						<input class="btn btn-success btn-block" name="set" value="Save" type="submit">
					</div>
				</div>
			</div>
	</div>
</div>