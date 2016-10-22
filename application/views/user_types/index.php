<div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Types</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

        	<?php include('page_common_nav.php'); ?>

        	<p></p>
	
			<div class="page-tools">
				<button id="create_type" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-usertype-modal" data-backdrop="static" data-keyboard="false" >
					<i class="fa fa-user-plus"></i> Create User Type
				</button>
			</div>
			
			<p></p>

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
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-default btn-xs"><i class="fa fa-gears"></i> Action</button>
										<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#" class="edit_type"><i class="fa fa-edit text-primary"></i> Edit/View</a></li>
											<li><a href="<?=base_url("user_types/delete_user_type/{$ut->id}")?>" class="confirm-action" confirm-message="Are you sure to delete the user type?"><i class="fa fa-trash text-danger"></i> Delete</a></li>
										</ul>
									</div>
								</td>
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

<!-- Create User Modal -->
<div class="modal fade" id="create-usertype-modal" tabindex="-1" role="dialog" aria-labelledby="create-usertype-modal-label">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form class="form-horizontal" id="create-usertype-form" method="POST">
				<input type="hidden" value="" name="type_id" />
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="create-usertype-modal-label">Create User Type</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Code</label>
						<div class="col-sm-9">
							<input type="text" class="form-control auto-slug" id="user-type-code" name="usertype[code]" placeholder="Code" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Description</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="usertype[description]" placeholder="Description" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Permission Level</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="usertype[permission_level]" value="2" placeholder="Permission level" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				<input type="hidden" name="create_user_type" />
			</form><!-- /.form-horizontal -->
		</div><!-- /.modal-content -->
	</div>
</div>