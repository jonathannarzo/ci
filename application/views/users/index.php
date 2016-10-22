<div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Users</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

			<?php include('page_common_nav.php'); ?>

			<p></p>

			<div class="page-tools clearfix">
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-user-modal" data-backdrop="static" data-keyboard="false" >
					<i class="fa fa-user-plus"></i> Create User
				</button>
			</div>
			
			<p></p>

            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
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
		                        <td><?=($user->is_disabled) ? '<span class="label label-danger">disabled</span>' : '<span class="label label-success">active</span>'?></td>
		                        <td><?=$user->created_at?></td>
		                        <td><?=$user->updated_at?></td>
		                        <td>
									<div class="btn-group">
										<button type="button" class="btn btn-default btn-xs"><i class="fa fa-gears"></i> Action</button>
										<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="<?=base_url("profile/index/{$user->users_id}")?>" class="confirm-action" confirm-message="Edit user profile?"><i class="fa fa-edit text-primary"></i> Edit/View</a></li>
											<li>
												<?php if ($user->is_disabled) : ?>
													<a href="<?=base_url("users/enable_user/{$user->users_id}")?>" class="confirm-action" confirm-message="Are you sure to enable the user?"><i class="fa fa-check text-success"></i> Enable</a>
												<?php else : ?>
													<a href="<?=base_url("users/disable_user/{$user->users_id}")?>" class="confirm-action" confirm-message="Are you sure to disable the user?"><i class="fa fa-ban text-danger"></i> Disable</a>
												<?php endif; ?>
											</li>
											<li><a href="#" class="reset-password"><i class="fa fa-refresh text-warning"></i> Reset password</a></li>
											<li><a href="<?=base_url("users/delete_user/{$user->users_id}")?>" class="confirm-action" confirm-message="Are you sure to delete the user?"><i class="fa fa-trash text-danger"></i> Delete</a></li>
										</ul>
									</div>
                     			</td>
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

<!-- Create User Modal -->
<div class="modal fade" id="create-user-modal" tabindex="-1" role="dialog" aria-labelledby="create-user-modal-label">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form class="form-horizontal" id="create-user-form" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="create-user-modal-label">Create User</h4>
				</div>
				<div class="modal-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#login_details" aria-controls="login_details" role="tab" data-toggle="tab">Login Details</a></li>
						<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
					</ul>
					<p></p>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="login_details">
							<div class="form-group ci-form-validate">
								<label class="col-sm-3 control-label">User Type</label>
								<div class="col-sm-9">
									<?=form_dropdown('user[user_type_code]', $user_type_codes, '', 'class="form-control"')?>
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="user[email]" placeholder="Email" />
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-3 control-label">Username</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="user[username]" placeholder="Username" />
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-3 control-label">Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" name="password" placeholder="Password" />
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-3 control-label">Confirm Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" name="conpassword" placeholder="Confirm Password" />
								</div>
							</div>
						</div>

						<div role="tabpanel" class="tab-pane" id="profile">
							<div class="form-group ci-form-validate">
								<label class="col-sm-2 control-label">First Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="profile[first_name]" placeholder="First Name" />
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-2 control-label">Middle Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="profile[middle_name]" placeholder="Middle Name" />
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-2 control-label">Last Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="profile[last_name]" placeholder="Last Name" />
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-2 control-label">Birth Date</label>
								<div class="col-sm-10">
									<input type="text" class="form-control date_picker_yview" name="profile[birth_date]" placeholder="Birth Date" />
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-2 control-label">Gender</label>
								<div class="col-sm-10">
									<?php
										$options = array(
											'' => '-- Select Gender --',
											'male' => 'Male',
											'female' => 'Female'
										);
										echo form_dropdown('profile[gender]', $options, '', 'class="form-control"');
									?>
								</div>
							</div>
							<div class="form-group ci-form-validate">
								<label class="col-sm-2 control-label">Phone Number</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="profile[phone_number]" placeholder="Phone Number" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				<input type="hidden" name="create_profile" />
			</form><!-- /.form-horizontal -->
		</div><!-- /.modal-content -->
	</div>
</div>

<!-- Duplicated User Modal -->
<div class="modal fade" id="duplicated-user-modal" tabindex="-1" role="dialog" aria-labelledby="duplicated-user-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="duplicated-user-modal-label">The user below is already registered:</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>

<!-- Reset password Modal -->
<div class="modal fade" id="reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="reset-password-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?=base_url('users/reset_password')?>" method="POST" id="reset-password-form" class="form-horizontal">
				<input type="hidden" name="user_id" />
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="reset-password-modal-label">Reset User password</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Username</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="username" disabled />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">New Password</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="password" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="reset_password" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div>
</div>