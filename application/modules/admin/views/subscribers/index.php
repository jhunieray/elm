<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<div class="box-title hidden-xs hidden-sm">
					<i class="fa fa-users"></i> Subscribers
				</div>
				<div class="box-title hidden-md hidden-lg text-center">
					<i class="fa fa-users"></i>
				</div>
				<div class="box-tools pull-right hidden-xs hidden-sm">
					<button class="btn btn-sm btn-success btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_create_new" aria-expanded="false" aria-controls="panel_create_new"><i class="fa fa-plus"></i> Add New</button>
					<button class="btn btn-sm btn-default btn-flat menu_btn" id="edit_btn" disabled="" type="button" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit"><i class="fa fa-edit"></i> Update</button>
					<button class="btn btn-sm btn-warning btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_import" aria-expanded="false" aria-controls="panel_import"><i class="fa fa-upload"></i> Import</button>
					<button class="btn btn-sm btn-info btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_export" aria-expanded="false" aria-controls="panel_export"><i class="fa fa-download"></i> Export</button>
					<button class="btn btn-sm btn-danger btn-flat menu_btn"><i class="fa fa-trash"></i> Remove Selected</button>
					<button class="btn btn-sm btn-default btn-flat menu_btn" id="refresh"><i class="fa fa-refresh"></i> Refresh</button>
					<button class="btn btn-sm btn-primary btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_filters" aria-expanded="false" aria-controls="panel_filters"><i class="fa fa-filter"></i> Filters</button>
				</div>
				<div class="box-tools hidden-md hidden-lg">
					<button class="btn btn-sm btn-success btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_create_new" aria-expanded="false" aria-controls="panel_create_new" title="Add New"><i class="fa fa-plus"></i> </button>
					<button class="btn btn-sm btn-default btn-flat menu_btn" id="edit_btn" disabled="" type="button" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit" title="Update"><i class="fa fa-edit"></i> </button>
					<button class="btn btn-sm btn-warning btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_import" aria-expanded="false" aria-controls="panel_import" title="Import"><i class="fa fa-upload"></i> </button>
					<button class="btn btn-sm btn-info btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_export" aria-expanded="false" aria-controls="panel_export" title="Export"><i class="fa fa-download"></i> </button>
					<button class="btn btn-sm btn-danger btn-flat menu_btn" title="Remove Selected"><i class="fa fa-trash"></i> </button>
					<button class="btn btn-sm btn-default btn-flat menu_btn" id="refresh" title="Refresh"><i class="fa fa-refresh"></i> </button>
					<button class="btn btn-sm btn-primary btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_filters" aria-expanded="false" aria-controls="panel_filters" title="Filters"><i class="fa fa-filter"></i> </button>
				</div>
			</div>
			<div class="box-body">
				<div class="collapse custom_panel" id="panel_create_new">
					<?= form_open('api/subscribers/add', array('id' => 'form_add_subscriber')) ?>
				  	<div class="box box-success">
				  		<div class="box-body">
				  			<div class="row">
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Category</label>
				  						<select class="form-control" name="category" id="category" autofocus="">
				  						</select>
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">First Name</label>
				  						<input type="text" id="fname" name="fname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Last Name</label>
				  						<input type="text" id="lname" name="lname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Email Address</label>
				  						<input type="email" id="email_add" name="email_add" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Contact No</label>
				  						<input type="text" id="contact_no" name="contact_no" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Address</label>
				  						<input type="text" id="address" name="address" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  			</div>
				  			<div class="row">
				  				<div class="col-md-12 text-right">
				  					<p id="create_new_msg" class="pull-left"></p>
				  					<button type="button" class="btn btn-flat btn-default" data-toggle="collapse" data-target="#panel_create_new" aria-expanded="false" aria-controls="panel_create_new">Close</button>
				  					<button id="save_subscriber" type="submit" class="btn btn-flat btn-success">Save</button>
				  				</div>
				  			</div>
				  		</div>
				  	</div>
				  	<?= form_close() ?>
				</div>
				<div class="collapse custom_panel" id="panel_edit">
					<?= form_open('api/subscribers/edit', array('id' => 'form_edit_subscriber')) ?>
				  	<div class="box box-warning">
				  		<div class="box-body">
				  			<div class="row">
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Category</label>
				  						<select class="form-control" name="category" id="edit_category" autofocus="">
				  						</select>
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">First Name</label>
				  						<input type="text" id="edit_fname" name="fname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Last Name</label>
				  						<input type="text" id="edit_lname" name="lname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Email Address</label>
				  						<input type="email" id="edit_email_add" name="email_add" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Contact No</label>
				  						<input type="text" id="edit_contact_no" name="contact_no" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Address</label>
				  						<input type="text" id="edit_address" name="address" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  			</div>
				  			<div class="row">
				  				<div class="col-md-12 text-right">
				  					<input type="hidden" id="id" name="id" />
				  					<p id="edit_msg" class="pull-left"></p>
				  					<button type="button" class="btn btn-flat btn-default" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit">Close</button>
				  					<button id="save_subscriber_edit" type="submit" class="btn btn-flat btn-warning">Save</button>
				  				</div>
				  			</div>
				  		</div>
				  	</div>
				  	<?= form_close() ?>
				</div>
				<div class="collapse custom_panel" id="panel_import">
				  	<h1>IMPORT</h1>
				</div>
				<div class="collapse custom_panel" id="panel_export">
				  	<h1>EXPORT</h1>
				</div>
				<div class="collapse custom_panel" id="panel_filters">
				  	<h1>FILTERS</h1>
				</div>
				<table id="subscribers" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Category</th>
							<th>Email</th>
							<th>Name</th>
							<th>Address</th>
							<th>Contact</th>
							<th>Date Added</th>
							<th>Date Updated</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div>
