// load javascript component for input form
<?php $this->getThemeElement('page/components/form_input_bottom_js', $__forward) ?>;

let module_path = '<?=$module_path?>';
api_url = base_url+'api_admin/fleetmanagement/bahanbakar/baru/';
target_url = base_url_admin+'fleetmanagement/bahanbakar/';
form_input_data_baru(api_url, target_url);