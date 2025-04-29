var ieid = '';
var drTable = {};

function gritter(pesan,jenis="warning"){
	$.bootstrapGrowl(pesan, {
		type: jenis,
		delay: 2500,
		allow_dismiss: true
	});
}

App.datatables();
if(jQuery('#drTable').length>0){
	drTable = jQuery('#drTable')
	.on('preXhr.dt', function ( e, settings, data ){
		NProgress.start();
		$('.btn-submit').prop('disabled',true);
		$('.icon-submit').addClass('fa-circle-o-notch');
		$('.icon-submit').addClass('fa-spin');
	}).DataTable({
			"order"					: [[ 0, "desc" ]],
			"responsive"	  : true,
			"bProcessing"		: true,
			"bServerSide"		: true,
			"sAjaxSource"		: "<?=base_url("api_admin/fleetmanagement/driver/"); ?>",
			"fnServerData"	: function (sSource, aoData, fnCallback, oSettings) {

				oSettings.jqXHR = $.ajax({
					dataType 	: 'json',
					method 		: 'POST',
					url 		: sSource,
					data 		: aoData
				}).success(function (response, status, headers, config) {
					$("#modal-preloader").modal("hide");
					$('#drTable > tbody').off('click', 'tr');
					$('#drTable > tbody').on('click', 'tr', function (e) {
						e.preventDefault();
						NProgress.start();
						var id = $(this).find("td").html();
						ieid = id;
						var url = '<?=base_url(); ?>api_admin/fleetmanagement/bahanbakar/detail/'+id;
						$.get(url).done(function(response){
                            if(response.status==200 || response.status=='200'){
							var dta = response.data;
								$("#ieid").val(dta.id);
								$("#ienama").val(dta.nama);
								$("#ieis_active").val(dta.is_active);

								$("#modal_option").modal("show");
							}else{
								gritter('<h4>Error</h4><p>Tidak dapat mengambil detail data</p>','danger');
							}
                            NProgress.done();
						}).fail(function(){
							NProgress.done();
							gritter('<h4>Error</h4><p>Tidak dapat mengambil detail data</p>','danger');
						});
					});

					$('.btn-submit').prop('disabled',false);
					$('.icon-submit').removeClass('fa-circle-o-notch');
					$('.icon-submit').removeClass('fa-spin');
					NProgress.done();
					fnCallback(response);
				}).error(function (response, status, headers, config) {
					gritter('<h4>Error</h4><p>Tidak dapat mengambil data</p>','danger');
					$('.btn-submit').prop('disabled',false);
					$('.icon-submit').removeClass('fa-circle-o-notch');
					$('.icon-submit').removeClass('fa-spin');
					NProgress.done();
				});
			}
	});
}

//tambah
$("#atambah").on("click",function(e){
	e.preventDefault();
	$("#modal_tambah").modal("show");
});
$("#modal_tambah").on("shown.bs.modal",function(e){
	$("#ftambah").off("submit");
	$("#ftambah").on("submit",function(e){
		e.preventDefault();
		NProgress.start();
		$('.btn-submit').prop('disabled',true);
		$('.icon-submit').addClass('fa-circle-o-notch');
		$('.icon-submit').addClass('fa-spin');

		var fd = new FormData($(this)[0]);
		var url = '<?=base_url('api_admin/fleetmanagement/driver/tambah/');?>';
		$.ajax({
			type: 'post',
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			success: function(respon){
				if(respon.status == 200){
					$("#modal_tambah").modal("hide");
					setTimeout(function(){
						gritter('<h4>Berhasil</h4><p>Data baru berhasil disimpan</p>','success');
						$('.btn-submit').prop('disabled',false);
						$('.icon-submit').removeClass('fa-circle-o-notch');
						$('.icon-submit').removeClass('fa-spin');
						NProgress.done();
						drTable.ajax.reload();
					}, 666);
				}else{
					gritter('<h4>Gagal</h4><p>'+respon.message+'</p>','danger');
					$('.btn-submit').prop('disabled',false);
					$('.icon-submit').removeClass('fa-circle-o-notch');
					$('.icon-submit').removeClass('fa-spin');
					NProgress.done();
				}
			},
			error:function(){
				setTimeout(function(){
					gritter('<h4>Error</h4><p>Proses tambah data tidak bisa dilakukan, coba beberapa saat lagi</p>','warning');
					$('.btn-submit').prop('disabled',false);
					$('.icon-submit').removeClass('fa-circle-o-notch');
					$('.icon-submit').removeClass('fa-spin');
					NProgress.done();
				}, 666);
				return false;
			}
		});
	});
});

$("#modal_tambah").on("hidden.bs.modal",function(e){
	$("#modal_tambah").find("form").trigger("reset");
});

$("#modal_edit").on("shown.bs.modal",function(e){
	//
});
$("#modal_edit").on("hidden.bs.modal",function(e){
	$("#modal_edit").find("form").trigger("reset");
});
$("#fedit").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch');
	$('.icon-submit').addClass('fa-spin');
	var fd = new FormData($(this)[0]);
	var url = '<?=base_url("api_admin/fleetmanagement/driver/edit/"); ?>'+ieid;
	$.ajax({
		type: $(this).attr('method'),
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			NProgress.done();
			if(respon.status == 200){
				$("#modal_edit").modal("hide");
				setTimeout(function(){
					gritter('<h4>Berhasil</h4><p>Proses ubah data telah berhasil!</p>','success');
					$('.btn-submit').prop('disabled',false);
					$('.icon-submit').removeClass('fa-circle-o-notch');
					$('.icon-submit').removeClass('fa-spin');
					NProgress.done();
					drTable.ajax.reload();
				}, 666);
			}else{
				setTimeout(function(){
					gritter('<h4>Gagal</h4><p>'+respon.message+'</p>','danger');
					$('.btn-submit').prop('disabled',false);
					$('.icon-submit').removeClass('fa-circle-o-notch');
					$('.icon-submit').removeClass('fa-spin');
					NProgress.done();
				}, 666);
			}
		},
		error:function(){
			NProgress.done();
			setTimeout(function(){
				gritter('<h4>Error</h4><p>Proses ubah data tidak bisa dilakukan, coba beberapa saat lagi</p>','warning');
				$('.btn-submit').prop('disabled',false);
				$('.icon-submit').removeClass('fa-circle-o-notch');
				$('.icon-submit').removeClass('fa-spin');
				NProgress.done();
			}, 666);
			return false;
		}
	});
});

//hapus
$("#ahapus").on("click",function(e){
	e.preventDefault();
	var id = ieid;
	if(id){
		var c = confirm('apakah anda yakin?');
		if(c){
			NProgress.start();
			$('.btn-submit').prop('disabled',true);
			$('.icon-submit').addClass('fa-circle-o-notch');
			$('.icon-submit').addClass('fa-spin');
			var url = '<?=base_url('api_admin/fleetmanagement/driver/hapus/'); ?>'+id;
			$.get(url).done(function(response){
				if(response.status == 200 || response.status == 200){
					setTimeout(function(){
						gritter('<h4>Berhasil</h4><p>Data berhasil dihapus</p>','success');
						$('.btn-submit').prop('disabled',false);
						$('.icon-submit').removeClass('fa-circle-o-notch');
						$('.icon-submit').removeClass('fa-spin');
						NProgress.done();
						drTable.ajax.reload();
						$("#modal_option").modal("hide");
					}, 666);
				}else{
					setTimeout(function(){
						gritter('<h4>Gagal</h4><p>'+respon.message+'</p>','danger');
						$('.btn-submit').prop('disabled',false);
						$('.icon-submit').removeClass('fa-circle-o-notch');
						$('.icon-submit').removeClass('fa-spin');
						NProgress.done();
					}, 666);
				}
			}).fail(function() {
				setTimeout(function(){
					gritter('<h4>Error</h4><p>Proses penghapusan tidak bisa dilakukan, coba beberapa saat lagi</p>','warning');
					$('.btn-submit').prop('disabled',false);
					$('.icon-submit').removeClass('fa-circle-o-notch');
					$('.icon-submit').removeClass('fa-spin');
					NProgress.done();
				}, 666);
			});
		}
	}
});

$("#bhapus").on("click",function(e){
	e.preventDefault();
	$("#ahapus").trigger("click");
});

//option
$("#aedit").on("click",function(e){
	e.preventDefault();
	$("#modal_option").modal("hide");
	setTimeout(function(){
		$("#modal_edit").modal("show");
	},333);
});


//fill data
var data_fill = <?=json_encode($bdm)?>;
$.each(data_fill,function(k,v){
	$("#ie"+k).val(v);
});
