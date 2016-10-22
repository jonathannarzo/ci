<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$_page_title?></title>
	<?=$_styles?>
</head>
<body id="<?=$_body_id?>" class="<?=$_body_class?>">
	
	<div class="wrapper">
		
		<?php
			include('navs/header-nav.php');
			include('navs/left-nav.php');
		?>
		
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<?=$main_content?>
				</div>
			</section>
			
		</div>

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Page execution time:</b> <?=$_elapsed_time?>
			</div>
			<strong>Copyright &copy; <?=date('Y')?>
		</footer>

	</div><!-- /.wrapper -->

	<?=$_scripts?>
</body>
</html>