 // load the data table javascript component
<?php $this->getThemeElement('page/components/data_table_bottom_js', $__forward); ?>;

let module_path = '<?=$module_path?>';
let api_url = base_url+'api_admin/'+module_path;
let api_url_detail = api_url+'detail/';
let url_detail = base_url_admin+module_path+'detail/';
let url_edit = base_url_admin+module_path+'edit/';
let api_url_hapus = api_url+'hapus/';

// load the datatable javascript logic
data_table_bottom_js(
	api_url, 
	function(){ 
		data_table_row_listener(api_url_detail, url_detail, url_edit, api_url_hapus)
	}
)