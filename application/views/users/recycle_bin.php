<div class="col-md-12">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Users</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
			
			<?php include('page_common_nav.php'); ?>

			<p></p>
			
			<?=$app_message?>

            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($users) : ?>
                    	<?php foreach ($users as $user) : ?>
		                    <tr>
		                        <td class="user_id"><?=$user->users_id?></td>
		                        <td class="username"><?=$user->username?></td>
		                        <td><?=($user->first_name) ? proper_case("{$user->first_name} {$user->last_name}") : '<span class="label label-danger">No Profile</span>'?></td>
		                        <td><?=$user->role?></td>
		                        <td><?=$user->created_at?></td>
		                        <td><?=$user->updated_at?></td>
		                        <td><a href="<?=base_url("users/retrieve/{$user->users_id}")?>" class="btn btn-success btn-xs confirm-action" confirm-message="Are you sure to retrieve users data?"><i class="fa fa-recycle"></i> Retrieve</a></td>
		                    </tr>
	                	<?php endforeach; ?>
	                <?php else : ?>
	                	<tr>
	                		<td colspan="8">No record found.</td>
	                	</tr>
					<?php endif; ?>
                </tbody>
            </table>

        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>