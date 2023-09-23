<div class="media-section">
    <div class="images">
        <h3 class="section-title"><i class="fa fa-list-ul"></i> <a href="<?php print $shop_url; ?>"><?php print $lang_shop['site_title']; ?></a> / <?php print ucfirst($current_page); ?></h3>

		<?php
			$remove = isset($_GET['remove']) ? $_GET['remove'] : null;
			if($remove)
				is_delete_paypal($remove);
			
			if(isset($_POST['edit']))
				is_edit_paypal($_POST['id'], $_POST['price'.$_POST['id']], $_POST['coins'.$_POST['id']]);
				
			if(isset($_POST['add']))
				is_add_paypal($_POST['price'], $_POST['coins']);
		?>
		
        <div class="panel panel-info">
            <div class="panel-heading">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#active" role="tab">
                            <?php print $lang_shop['is_tab1']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#add" role="tab">
                            <?php print $lang_shop['is_tab2']; ?>
                        </a>
                    </li>
                </ul>

            </div>
			<div class="panel-body">


				<div class="tab-content ">
					<div class="tab-pane active" id="active">

						<table class="table table-striped table-hover ">
							<thead>
								<tr>
									<th><?php print ucfirst(mb_strtolower($lang_shop['price'], 'UTF-8')); ?> - &euro;</th>
									<th><?php print $lang_shop['value']; ?> - Coins</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>				
						<?php						
							$paypal_list = get_all_paypal();
						
							if($paypal_list && count($paypal_list) > 0)
							{
									foreach($paypal_list as $key => $row)
									{
						?>
							<form action="" method="post" class="form-horizontal">
								<tr>
									<input type="hidden" name="id" value="<?php print $row['id']; ?>">
									
									<td><input style="max-width: 200px;" class="form-control" name="price<?php print $row['id']; ?>" type="text" value="<?php print $row['price']; ?>"></td>
									
									<td><input style="max-width: 200px;" class="form-control" name="coins<?php print $row['id']; ?>" type="text" value="<?php print $row['coins']; ?>"></td>
									
									<td><input class="btn btn-primary btn-sm" name="edit" value="<?php print $lang_shop['edit']; ?>" type="submit"></td>
									<td><a href="<?php print $shop_url; ?>admin/paypal/<?php print $row['id']; ?>" class="btn btn-danger btn-sm"><?php print $lang_shop['item_remove']; ?></a></td>
								</tr>
							</form>
						<?php
									}
							} else print 'Nothing found';
						?>
							</tbody>
						</table> 
					</div>
					<div class="tab-pane" id="add">
						<form action="" method="post" class="form-horizontal">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="focusedInput"><?php print ucfirst(mb_strtolower($lang_shop['price'], 'UTF-8')); ?> - &euro;</label>
										<input class="form-control" name="price" type="number">
									</div>
									<div class="form-group">
										<label class="control-label" for="focusedInput"><?php print $lang_shop['value']; ?> - Coins</label>
										<input class="form-control" name="coins" type="number">
									</div>
									<div class="form-group">
										<input class="btn btn-success btn-block" name="add" value="<?php print $lang_shop['add_category']; ?>" type="submit">
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>