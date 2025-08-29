var ieid = '';
var drTable = {};
var base_url = '<?=base_url()?>';
var base_url_admin = '<?=base_url_admin()?>';
var data_table_current_id = null;
var data_table_element = '#drTable';
var data_table_modal_options = 'modal_data_table_options';

$(".input-select2").select2({
	width: "100%"
});


App.datatables();

function data_table_bottom_js(api_url, click_row_function_callback=null, server_params=null, sort_column_index=0, sort_column_direction="desc")
{
	if (jQuery(data_table_element).length > 0) {
		drTable = jQuery(data_table_element)
		.on('preXhr.dt', function ( e, settings, data ){
			$().btnSubmit();
		}).DataTable({
				"order"          : [[ sort_column_index, sort_column_direction ]],
				"responsive"     : true,
				"bProcessing"    : true,
				"bServerSide"    : true,
				"sAjaxSource"    : api_url,
                "fnServerParams" : function (aoData) {
                    if (server_params && typeof server_params === "object") {
                        for (let key in server_params) {
                            if (server_params.hasOwnProperty(key)) {
                                aoData.push({
                                    name: key,
                                    value: typeof server_params[key] === "function"
                                        ? server_params[key]()
                                        : server_params[key]
                                });
                            }
                        }
                    }
                },
				"fnServerData"  : function (sSource, aoData, fnCallback, oSettings) {
					oSettings.jqXHR = $.ajax({
						dataType 	: 'json',
						method 		: 'POST',
						url 		: sSource,
						data 		: aoData
					}).success(function (response, status, headers, config) {
						$(data_table_element+' > tbody').off('click', 'tr');
						$(data_table_element+' > tbody').on('click', 'tr', function (e) {
							e.preventDefault();
							let column_index = $(this).index();
							data_table_current_id = response.data[column_index][0];
							click_row_function_callback();
						});
						
						$().btnSubmit('finished');
						fnCallback(response);
					}).error(function (response, status, headers, config) {
						gritter('<h4>Error</h4><p>Cannot get data from server</p>','danger');
						$().btnSubmit('finished');
					});
				}
		});
		$('.dataTables_filter input').attr('placeholder', 'Search by keyword');
		if (jQuery("#button_filter").length > 0) {
			$("#button_filter").on("click", function(e){
				e.preventDefault();
				drTable.ajax.reload(null, false);
			});
		}
	}
}

function data_table_button_hapus_listener()
{
	$('#button_data_table_hapus').off('click');
	$('#button_data_table_hapus').on('click', function(e){
		e.preventDefault();
		let confirmation_response = confirm('Are you sure want to delete this data?');
		if (confirmation_response) {
			$().btnSubmit();
			$.get($(this).attr('href')).done(function(response){
				if(Number(response.status) == 200){
					setTimeout(function(){
						gritter('<h4>Success</h4><p>Data was deleted successfully</p>', 'success');
						$().btnSubmit('finished');
						drTable.ajax.reload();
						$("#"+data_table_modal_options).modal("hide");
					}, 666);
				}else{
					setTimeout(function(){
						gritter('<h4>Failed</h4><p>'+respon.message+'</p>', 'warning');
					}, 666);
				}
			}).fail(function() {
				setTimeout(function(){
					gritter('<h4>Error</h4><p>Cannot delete this data right now, please try again later</p>', 'danger');
					$().btnSubmit('finished');
				}, 666);
			});
		}
	});
}

function data_table_row_listener(api_url, url_detail='', url_edit='', api_url_hapus='')
{
	$().btnSubmit();
	let url = api_url+encodeURIComponent(data_table_current_id);
	$.get(url).done(function(response){
		if (Number(response.status) == 200) {
			$("#"+data_table_modal_options).modal("show");
			if (typeof url_detail === 'string' && url_detail.length > 0) {
				$('#button_data_table_detail').show();
				$('#button_data_table_detail').attr('href', url_detail+encodeURIComponent(data_table_current_id));
			}else{
				$('#button_data_table_edit').hide();
			}
			if (typeof url_edit === 'string' && url_edit.length > 0) {
				$('#button_data_table_edit').show();
				$('#button_data_table_edit').attr('href', url_edit+encodeURIComponent(data_table_current_id));
			}else{
				$('#button_data_table_edit').hide();
			}
			if (typeof api_url_hapus === 'string' && api_url_hapus.length > 0) {
				$('#button_data_table_hapus').show();
				$('#button_data_table_hapus').attr('href', api_url_hapus+encodeURIComponent(data_table_current_id));
				data_table_button_hapus_listener();
			}else{
				$('#button_data_table_hapus').hide();
			}
			$().btnSubmit('finished');
		}else{
			gritter('<h4>Error</h4><p>Cannot fetch detail data</p>', 'danger');
		}
	}).fail(function(){
		gritter('<h4>Warning</h4><p>Cannot fetch detail data from server</p>', 'warning');
		$().btnSubmit('finished');
	});
}