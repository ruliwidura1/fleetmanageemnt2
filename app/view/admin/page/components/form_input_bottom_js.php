$(".input-select2").select2({
	width: "100%"
});

var base_url = '<?=base_url()?>';
var base_url_admin = '<?=base_url_admin()?>';
var current_data = null;

function form_input_data_baru(api_url, target_url, form_id='form_input_data_baru'){
    $("#"+form_id).on("submit",function(e){
        e.preventDefault();
        $().btnSubmit();

        let fd = new FormData($(this)[0]);
        let url = api_url;
        $.ajax({
            type: 'post',
            url: url,
            data: fd,
            processData: false,
            contentType: false,
            success: function(respon){
                if (respon.status == 200) {
                    gritter('<h4>Success</h4><p>New data has been created</p>', 'success');
                    setTimeout(function(){
                        window.location = target_url;
                    }, 4567);
                } else {
                    gritter('<h4>Failed</h4><p>'+respon.message+'</p>', 'danger');
                    $().btnSubmit('finished');
                }
            },
            error:function(){
                setTimeout(function(){
                    gritter('<h4>Error</h4><p>Cannot retrieve data from server, please try again later</p>','warning');
                    $().btnSubmit('finished');
                }, 666);
                return false;
            }
        });
    });
}

function form_input_data_edit(api_url, target_url, form_id='form_input_data_edit'){
    fill_form_data_using_current_data();
    $("#"+form_id).on("submit",function(e){
        e.preventDefault();
        $().btnSubmit();

        let fd = new FormData($(this)[0]);
        let url = api_url+encodeURIComponent(current_data.id);
        $.ajax({
            type: 'post',
            url: url,
            data: fd,
            processData: false,
            contentType: false,
            success: function(respon){
                if (respon.status == 200) {
                    gritter('<h4>Success</h4><p>Data updated successfully</p>', 'success');
                    setTimeout(function(){
                        window.location = target_url;
                    }, 4567);
                } else {
                    gritter('<h4>Failed</h4><p>'+respon.message+'</p>', 'danger');
                    $().btnSubmit('finished');
                }
            },
            error:function(){
                setTimeout(function(){
                    gritter('<h4>Error</h4><p>Cannot retrieve data from server, please try again later</p>','warning');
                    $().btnSubmit('finished');
                }, 666);
                return false;
            }
        });
    });
}

function fill_form_data_using_current_data(callback_fn=null, form_input_data_edit='', input_prefix='ie') {
    $().btnSubmit();
    current_data = <?=isset($current_data) ? json_encode($current_data) : "{}" ?>;
    $.each(current_data, function(key, value){
        $('#'+input_prefix+''+key).val(value);
        $('#'+input_prefix+''+key).trigger('change');
    });
    
    if (typeof callback_fn === 'function') {
        callback_fn();
    }
    $().btnSubmit('finished');
}