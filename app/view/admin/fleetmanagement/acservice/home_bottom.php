var growlPesan = '<h4>Error</h4><p>Tidak dapat diproses, silakan coba beberapa saat lagi!</p>';
var growlType = 'danger';
var drTable = {};
var ieid = '';

App.datatables();


function gritter(pesan,jenis="info"){
	$.bootstrapGrowl(pesan, {
		type: jenis,
		delay: 3456,
		allow_dismiss: true
	});
}

if(jQuery('#drTable').length>0){
	drTable = jQuery('#drTable')
	.on('preXhr.dt', function ( e, settings, data ){
		NProgress.start();
		$('.btn-submit').prop('disabled',true);
		$('.icon-submit').addClass('fa-circle-o-notch fa-spin');
	}).DataTable({
			"order"					: [[ 0, "desc" ]],
			"responsive"	  : true,
			"bProcessing"		: true,
			"bServerSide"		: true,
			"sAjaxSource"		: "<?=base_url("api_admin/fleetmanagement/acservice"); ?>",
			"fnServerParams": function ( aoData ) {
				aoData.push(
          { "name": "is_proses", "value": $("#fl_is_proses").val() },
					{ "name": "sdate", "value": $("#fl_sdate").val() },
					{ "name": "edate", "value": $("#fl_edate").val() }
				);
			},
			"fnServerData"	: function (sSource, aoData, fnCallback, oSettings) {
				oSettings.jqXHR = $.ajax({
					dataType 	: 'json',
					method 		: 'POST',
					url 		: sSource,
					data 		: aoData
				}).done(function (response, status, headers, config) {
					console.log(response);
					$('#drTable > tbody').off('click', 'tr');
					$('#drTable > tbody').on('click', 'tr', function (e) {
						e.preventDefault();
						var id = $(this).find("td").html();
						ieid = id;
						$("#modal_option").modal("show");
						$("#adetail").attr("href","<?=base_url_admin("fleetmanagement/acservice/detail/")?>"+ieid);
						$("#aedit").attr("href","<?=base_url_admin("fleetmanagement/acservice/edit/")?>"+ieid);
					});

					$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
					$('.btn-submit').prop('disabled',false);
					NProgress.done();

					fnCallback(response);
				}).fail(function (response, status, headers, config) {
					gritter("<h4>Error</h4><p>Tidak dapat mengambil data, coba beberapa saat lagi</p>",'warning');
					$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
					$('.btn-submit').prop('disabled',false);
					NProgress.done();
				});
			},
	});
	$('.dataTables_filter input').attr('placeholder', 'Cari');
	$("#fl_button").on("click",function(e){
		e.preventDefault();
		drTable.ajax.reload();
	});
}

//tambah
$("#atambah").on("click",function(e){
	e.preventDefault();
	$("#modal_tambah").modal("show");
});
//change icon
$("#aicon_change").on("click",function(e){
	e.preventDefault();
	$("#modal_option").modal("hide");
	setTimeout(function(){
		$("#ficon_change").trigger("reset");
		$("#modal_icon_change").modal("show");
	},500);
});
//listener on modal tambah show


//hapus
$("#bhapus").on("click",function(e){
	e.preventDefault();
	if(ieid){
		var c = confirm('Apakah kamu yakin?');
		if(c){
			NProgress.start();
			$('.btn-submit').prop('disabled',true);
			$('.icon-submit').addClass('fa-circle-o-notch fa-spin');
			var url = '<?=base_url('api_admin/fleetmanagement/acservice/hapus/')?>'+ieid;
			$.get(url).done(function(response){
				NProgress.done();
				if(response.status==200){
					gritter('<h4>Sukses</h4><p>Data berhasil dihapus</p>','success');
					$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
					$('.btn-submit').prop('disabled',false);
					NProgress.done();

					drTable.ajax.reload();
					$("#modal_option").modal("hide");
					$("#modal_edit").modal("hide");
				}else{
					gritter('<h4>Gagal</h4><p>'+response.message+'</p>','danger');

					$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
					$('.btn-submit').prop('disabled',false);
					NProgress.done();
				}
			}).fail(function() {
				gritter('<h4>Error</h4><p>Tidak dapat menghapus data, Cobalah beberapa saat lagi</p>','danger');
				$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
				$('.btn-submit').prop('disabled',false);
				NProgress.done();
			});
		}
	}
});

$('#btn_dlxls').on('click',function(e){
	e.preventDefault();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch');
	$('.icon-submit').addClass('fa-spin');

	var mindate = $("#fl_sdate").val();
	var maxdate = $("#fl_edate").val();
	var is_proses = $("#fl_is_proses").val();
	var url = '<?=base_url_admin('fleetmanagement/acservice/download_xls/') ?>';
	url = url + '?mindate='+mindate+'&maxdate='+maxdate+'&is_proses='+is_proses;

	setTimeout(function(){
		$('.btn-submit').prop('disabled',false);
		$('.icon-submit').removeClass('fa-circle-o-notch');
		$('.icon-submit').removeClass('fa-spin');
		window.location = url;
	},999);
});
