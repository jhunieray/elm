<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<div class="box-title hidden-xs hidden-sm">
					<i class="fa fa-bar-chart"></i> Categories
				</div>
				<div class="box-title hidden-md hidden-lg text-center">
					<i class="fa fa-users"></i>
				</div>
				<div class="box-tools pull-right hidden-xs hidden-sm">
					<button class="btn btn-sm btn-success btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_create_new" aria-expanded="false" aria-controls="panel_create_new"><i class="fa fa-plus"></i> Add New</button>
					<button class="btn btn-sm btn-info btn-flat menu_btn"  id="copy_btn" disabled="" type="button" data-toggle="collapse" data-target="#panel_copy" aria-expanded="false" aria-controls="panel_copy"><i class="fa fa-external-link"></i> Copy</button>
					<button class="btn btn-sm btn-warning btn-flat menu_btn" id="cat_edit_btn" disabled="" type="button" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit"><i class="fa fa-edit"></i> Update</button>
					<button class="btn btn-sm btn-danger btn-flat menu_btn" id="cat_del_btn" disabled=""><i class="fa fa-trash"></i> Remove Selected</button>
					<button class="btn btn-sm btn-default btn-flat menu_btn" id="refresh"><i class="fa fa-refresh"></i> Refresh</button>
					<button class="btn btn-sm btn-primary btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_filters" aria-expanded="false" aria-controls="panel_filters"><i class="fa fa-filter"></i> Filters</button>
				</div>
				<div class="box-tools hidden-md hidden-lg">
					<button class="btn btn-sm btn-success btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_create_new" aria-expanded="false" aria-controls="panel_create_new" title="Add New"><i class="fa fa-plus"></i> </button>
					<button class="btn btn-sm btn-info btn-flat menu_btn" id="copy_btn" disabled="" type="button" data-toggle="collapse" data-target="#panel_export" aria-expanded="false" aria-controls="panel_copy" title="Copy"><i class="fa fa-external-link"></i> </button>
					<button class="btn btn-sm btn-warning btn-flat menu_btn" id="cat_edit_btn" disabled="" type="button" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit" title="Update"><i class="fa fa-edit"></i> </button>
					<button class="btn btn-sm btn-danger btn-flat menu_btn" id="cat_del_btn" title="Remove Selected" disabled=""><i class="fa fa-trash"></i> </button>
					<button class="btn btn-sm btn-default btn-flat menu_btn" id="refresh" title="Refresh"><i class="fa fa-refresh"></i> </button>
					<button class="btn btn-sm btn-primary btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_filters" aria-expanded="false" aria-controls="panel_filters" title="Filters"><i class="fa fa-filter"></i> </button>
				</div>
			</div>
			<div class="box-body">
				<div class="collapse custom_panel" id="panel_create_new">
					<?= form_open('api/categories/add', array('id' => 'form_add_categories')) ?>
				  	<div class="box box-success">
				  		<div class="box-body">
				  			<div class="row">
				  				<div class="col-md-3 col-md-offset-4 ">
				  					<div class="form-group">
				  						<label class="form-label">Category Name</label>
				  						<input type="text" id="cname" name="cname" class="form-control" required />
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
					<?= form_open('api/categories/edit', array('id' => 'form_edit_categories')) ?>
				  	<div class="box box-warning">
				  		<div class="box-body">
				  			<div class="row">
				  				<div class="col-md-3 col-md-offset-4">
				  					<div class="form-group">
				  						<label class="form-label">Category Name</label>
				  						<input type="text" id="edit_cname" name="edit_cname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  			</div>
				  			<div class="row">
				  				<div class="col-md-12 text-right">
				  					<input type="hidden" id="id" name="id" />
				  					<p id="edit_msg" class="pull-left"></p>
				  					<button type="button" class="btn btn-flat btn-default" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit">Close</button>
				  					<button id="save_categories_edit" type="submit" class="btn btn-flat btn-warning">Save</button>
				  				</div>
				  			</div>
				  		</div>
				  	</div>
				  	<?= form_close() ?>
				</div>
				<div class="collapse custom_panel" id="panel_filters">
				  	<h1>FILTERS</h1>
				</div>
				<table id="categories" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th style="white-space: nowrap;">ID</th>
							<th style="white-space: nowrap;">Category</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
