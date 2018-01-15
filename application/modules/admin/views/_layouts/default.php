<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>">
<input type="hidden" id="site_url" name="site_url" value="<?= site_url() ?>">
<div class="wrapper">

	<?php $this->load->view('_partials/navbar'); ?>

	<?php // Left side column. contains the logo and sidebar ?>
	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel" style="height:65px">
				<div class="pull-left info" style="left:5px">
					<p><?php echo $user->first_name; ?></p>
					<a href="panel/account"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<?php // (Optional) Add Search box here ?>
			<?php //$this->load->view('_partials/sidemenu_search'); ?>
			<?php $this->load->view('_partials/sidemenu'); ?>
		</section>
	</aside>

	<?php // Right side column. Contains the navbar and content of the page ?>
	<div class="content-wrapper">
		<section class="content-header">
			<h1><i class="fa fa-inbox fa-fw"></i> <?php echo $page_title; ?></h1>
			<?php $this->load->view('_partials/breadcrumb'); ?>
		</section>
		<section class="content">
			<?php $this->load->view($inner_view); ?>
			<?php $this->load->view('_partials/back_btn'); ?>
		</section>
	</div>

	<?php // Footer ?>
	<?php $this->load->view('_partials/footer'); ?>

</div>