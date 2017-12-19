<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<div class="box-title">
					<i class="fa fa-dashboard"></i> Dashboard
				</div>
			</div>
			<div class="box-body text-center">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1>
							<i class="fa fa-dashboard"></i>
							<br>
							Welcome
						</h1>
						<p>You will see more info on this page after you start using the system and manage your email list and manage your subscribers. </p>
						<a class="btn btn-md btn-info"><i class="fa fa-list"></i> Manage Email List</a>
						<a href="<?= base_url('admin/subscribers') ?>" class="btn btn-md btn-info"><i class="fa fa-inbox"></i> Manage Subscribers</a>
					</div>
				</div>
				<br>
				<div class="row">
			        <div class="col-lg-3 col-xs-6">
			          <!-- small box -->
			          <div class="small-box bg-aqua">
			            <div class="inner">
			              <h3><?= $subscribers_count ?></h3>

			              <p>Subscribers</p>
			            </div>
			            <div class="icon">
			              <i class="fa fa-users"></i>
			            </div>
			            <a href="<?= base_url('admin/subscribers') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			          </div>
			        </div>
			        <!-- ./col -->
			        <div class="col-lg-3 col-xs-6">
			          <!-- small box -->
			          <div class="small-box bg-green">
			            <div class="inner">
			              <h3>53</h3>

			              <p>Email List</p>
			            </div>
			            <div class="icon">
			              <i class="fa fa-envelope"></i>
			            </div>
			            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			          </div>
			        </div>
			        <!-- ./col -->
			        <div class="col-lg-3 col-xs-6">
			          <!-- small box -->
			          <div class="small-box bg-yellow">
			            <div class="inner">
			              <h3>44</h3>

			              <p>Suppression List</p>
			            </div>
			            <div class="icon">
			              <i class="fa fa-list"></i>
			            </div>
			            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			          </div>
			        </div>
			        <!-- ./col -->
			        <div class="col-lg-3 col-xs-6">
			          <!-- small box -->
			          <div class="small-box bg-red">
			            <div class="inner">
			              <h3>65</h3>

			              <p>Blacklisted Emails</p>
			            </div>
			            <div class="icon">
			              <i class="fa fa-ban"></i>
			            </div>
			            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			          </div>
			        </div>
			        <!-- ./col -->
			      </div>
			</div>
		</div>
	</div>	
</div>
