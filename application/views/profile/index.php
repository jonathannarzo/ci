<div class="col-md-12">
	<?=$app_message?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Information</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
			
			<?php if ($this->selected_user) :?>
	            <div class="panel panel-primary">
	                <div class="panel-heading">Edit User</div>
	                <div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<table>
									<tr>
										<td style="text-align:right"><b>User ID</b></td>
										<td>&nbsp;<b>:</b> <?=$profile_data->users_id?></td>
									</tr>
									<tr>
										<td style="text-align:right"><b>Username</b></td>
										<td>&nbsp;<b>:</b> <?=$profile_data->username?></td>
									</tr>
									<tr>
										<td style="text-align:right"><b>Name</b></td>
										<td>&nbsp;<b>:</b> <?=build_name($profile_data->first_name, $profile_data->last_name)?></td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table>
									<tr>
										<td style="text-align:right"><b>Date Registered</b></td>
										<td>&nbsp;<b>:</b> <?=$profile_data->created_at?></td>
									</tr>
									<tr>
										<td style="text-align:right"><b>Updated</b></td>
										<td>&nbsp;<b>:</b> <?=$profile_data->updated_at?></td>
									</tr>
								</table>
							</div>
						</div>
	                </div>
	            </div>
			<?php endif; ?>

			<ul class="nav nav-tabs" id="profile-tabs">
				<li role="presentation" class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i> Profile</a></li>
				<li role="presentation"><a href="#login_details" data-toggle="tab"><i class="fa fa-lock"></i> Login Details</a></li>
			</ul>
			
			<p></p>

			<div class="tab-content clearfix">
				<div class="tab-pane active" id="profile">

					<form class="form-horizontal" method="POST">

						<div class="form-group <?=(form_error('profile[first_name]') != '') ? 'has-error' : ''?>">
							<label class="col-sm-2 control-label">First Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="profile[first_name]" value="<?=set_value('profile[first_name]', $profile_data->first_name)?>" placeholder="First Name" />
								<?=form_error('profile[first_name]')?>
							</div>
						</div>
						<div class="form-group <?=(form_error('profile[middle_name]') != '') ? 'has-error' : ''?>">
							<label class="col-sm-2 control-label">Middle Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="profile[middle_name]" value="<?=set_value('profile[middle_name]', $profile_data->middle_name)?>" placeholder="Middle Name" />
								<?=form_error('profile[middle_name]')?>
							</div>
						</div>
						<div class="form-group <?=(form_error('profile[last_name]') != '') ? 'has-error' : ''?>">
							<label class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="profile[last_name]" value="<?=set_value('profile[last_name]', $profile_data->last_name)?>" placeholder="Last Name" />
								<?=form_error('profile[last_name]')?>
							</div>
						</div>
						<div class="form-group <?=(form_error('profile[birth_date]') != '') ? 'has-error' : ''?>">
							<label class="col-sm-2 control-label">Birth Date</label>
							<div class="col-sm-10">
								<input type="text" class="form-control date_picker_yview" name="profile[birth_date]" value="<?=set_value('profile[birth_date]', $profile_data->birth_date)?>" placeholder="Birth Date" />
								<?=form_error('profile[birth_date]')?>
							</div>
						</div>
						<div class="form-group <?=(form_error('profile[gender]') != '') ? 'has-error' : ''?>">
							<label class="col-sm-2 control-label">Gender</label>
							<div class="col-sm-10">
								<?php
									$options = array(
										'' => 'Select Gender',
										'male' => 'Male',
										'female' => 'Female'
									);
									echo form_dropdown('profile[gender]', $options, set_value('profile[gender]', $profile_data->gender), 'class="form-control"');
								?>
								<?=form_error('profile[gender]')?>
							</div>
						</div>
						<div class="form-group <?=(form_error('profile[phone_number]') != '') ? 'has-error' : ''?>">
							<label class="col-sm-2 control-label">Phone Number</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="profile[phone_number]" value="<?=set_value('profile[phone_number]', $profile_data->phone_number)?>" placeholder="Phone Number" />
								<?=form_error('profile[phone_number]')?>
							</div>
						</div>

						<button type="submit" name="update_profile" class="btn btn-primary pull-right">Submit</button>

					</form>

				</div><!-- /.tab-pane -->
				<div class="tab-pane" id="login_details">

					<form class="form-horizontal" method="POST">

						<div class="form-group <?=(form_error('user[email]') != '') ? 'has-error' : ''?>">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="user[email]" value="<?=set_value('user[email]', $profile_data->email)?>" placeholder="Email" />
								<?=form_error('user[email]')?>
							</div>
						</div>
						<div class="form-group <?=(form_error('user[username]') != '') ? 'has-error' : ''?>">
							<label class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="user[username]" value="<?=set_value('user[username]', $profile_data->username)?>" placeholder="Username" />
								<?=form_error('user[username]')?>
							</div>
						</div>
						
						<hr />

						<div id="password-change-div">
							<div class="form-group">
								<label class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="change_password" id="change-pass-check"> Change Password
										</label>
									</div>
								</div>
							</div>

							<div class="form-group <?=(form_error('curpassword') != '') ? 'has-error' : ''?>">
								<label class="col-sm-3 control-label">Current Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" name="curpassword" placeholder="Current Password" disabled />
									<?=form_error('curpassword')?>
								</div>
							</div>

							<div class="form-group <?=(form_error('newpassword') != '') ? 'has-error' : ''?>">
								<label class="col-sm-3 control-label">New Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" name="newpassword" placeholder="New Password" disabled />
									<?=form_error('newpassword')?>
								</div>
							</div>

							<div class="form-group <?=(form_error('conpassword') != '') ? 'has-error' : ''?>">
								<label class="col-sm-3 control-label">Confirm New Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" name="conpassword" placeholder="Confirm New Password" disabled />
									<?=form_error('conpassword')?>
								</div>
							</div>
						</div>

						<button type="submit" name="change_login_details" class="btn btn-primary pull-right">Submit</button>

					</form>

				</div><!-- /.tab-pane -->
			</div><!-- /.tab-content -->

        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div><!-- /.col-md-12 -->