// load javascript component for input form
<?php $this->getThemeElement('page/components/form_input_bottom_js', $__forward) ?>;

let module_path = '<?=$module_path?>';
api_url = base_url+'api_admin/'+module_path+'/edit/';
target_url = base_url_admin+module_path;
form_input_data_edit(api_url, target_url);