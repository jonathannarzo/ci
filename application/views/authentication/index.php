<div class="login-box">
	<div class="login-logo">
		<a href="<?=base_url('authentication')?>"><b>SIGN</b> IN</a>
	</div><!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>

		<form method="post">
			<div class="form-group has-feedback">
				<input type="text" name="user" class="form-control" placeholder="Username or email">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="pass" class="form-control" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8"></div><!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div><!-- /.col -->
			</div>
		</form>

		<a href="#">I forgot my password</a><br>
		
		<p></p>
		<?=$app_message?>
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->