<div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Types</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
		
			<?php include('page_common_nav.php'); ?>
			
			<p></p>

			<?=$app_message?>

            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>code</th>
                        <th>Description</th>
                        <th>Permission Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
					<?php if ($user_types) : ?>
						<?php foreach ($user_types as $ut) : ?>
							<tr>
								<td class="type_id"><?=$ut->id?></td>
								<td class="type_code"><?=$ut->code?></td>
								<td class="type_description"><?=$ut->description?></td>
								<td class="permission_level"><b class="label label-success"><?=$ut->permission_level?></b></td>
								<td><a href="<?=base_url("user_types/retrieve/{$ut->id}")?>" class="btn btn-success btn-xs confirm-action" confirm-message="Are you sure to retrieve user type data?"><i class="fa fa-recycle"></i> Retrieve</a></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="5">No record found.</td>
						</tr>
					<?php endif; ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>