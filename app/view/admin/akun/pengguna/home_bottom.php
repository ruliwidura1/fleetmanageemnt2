var ieid = '';
var nation_code = '';
var growlPesan = '<h4>Error</h4><p>Tidak dapat diproses, silakan coba beberapa saat lagi!</p>';
var growlType = 'danger';
var api_url = '<?=base_url('api_admin/akun/'); ?>';
var drTable = {};

function showDetail() {
  $().btnSubmit();
  var url = '<?=base_url("api_admin/akun/pengguna/detail/")?>'+ieid;
  $.get(url).done(function(response){
    if(response.status==200 || response.status=='200'){
      var dta = response.data;
      //input nilai awal
      $('#edit_modal_judul_id').html(dta.id);
      $("#ieid").val(dta.id);
      $("#ieid1").val(dta.id);
      $("#ieid2").val(dta.id);
      $("#ieid3").val(dta.id);
      $("#ieusername").val(dta.username);
      $("#ienama").val(dta.nama);
      $("#ieemail").val(dta.email);
      $("#ieis_active").val(dta.is_active);
      $("#iefoto").val(dta.foto);
      $("#ienrp").val(dta.nrp);

      //form hak akses
      $("#fha_a_pengguna_id").val(dta.id);
      $("#fha_a_pengguna_username").val(dta.username);
      $("#fha_nation_code").val(nation_code);

      //form welcome message
      $("#fewm_nation_code").val(dta.nation_code);
      $("#fewm_id").val(dta.id);
      $("#fewm_welcome_message").val(dta.welcome_message);

      //form edit foto
      $("#fef_nation_code").val(dta.nation_code);
      $("#fef_id").val(dta.id);

      //form edit password
      $("#fpe_nation_code").val(dta.nation_code);
      $("#fpe_id").val(dta.id);

      //tampilkan modal
      //$("#edit_modal").modal("show");
      $("#option_modal").modal("show");
    }else{
      gritter('<h4>Gagal</h4><p>['+data.status+'] '+data.message+'</p>', 'danger');
    }
    $().btnSubmit('finished');
  }).fail(function(){
    
    $().btnSubmit('finished');
  });
}

App.datatables();
if(jQuery('#drTable').length>0){
	drTable = jQuery('#drTable')
	.on('preXhr.dt', function ( e, settings, data ){
		$().btnSubmit();
	}).DataTable({
			"order"					: [[ 0, "asc" ]],
			"responsive"	  : true,
			"bProcessing"		: true,
			"bServerSide"		: true,
			"sAjaxSource"		: "<?=base_url("api_admin/akun/pengguna/")?>",
			"fnServerParams": function ( aoData ) {
				aoData.push(
					{ "name": "is_active", "value": $("#filter_is_active").val() }
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
					$().btnSubmit('finished');

					$('#drTable > tbody').off('click', 'tr');
					$('#drTable > tbody').on('click', 'tr', function (e) {
						e.preventDefault();
            ieid = $(this).find("td").html();

						showDetail();
					});
					fnCallback(response);
				}).fail(function (response, status, headers, config) {
					
          $().btnSubmit('finished');
				});
			},
	});
	$('.dataTables_filter input').attr('placeholder', 'Cari nama Pengguna');
	$("#filter_button").on("click",function(e){
		e.preventDefault();
		if($("#filter_is_active").val().length>0){
			drTable.order([5, 'asc']).ajax.reload();
		}else{
			drTable.ajax.reload(null, false);
		}
	});
}
$("#baru_button").on("click",function(e){
	e.preventDefault();
	$("#baru_modal").modal("show");
});

$("#baru_modal").on("shown.bs.modal",function(e){
	//
	$("#baru_modal_form").off("submit");
	$("#baru_modal_form").on("submit",function(e){
		e.preventDefault();
    $().btnSubmit();

		var p1 = $("#ipassword").val();
		var p2 = $("#irepassword").val();
		if(p1 != p2){
			$.bootstrapGrowl('Password tidak sama, ulangi', {
				type: 'danger',
				delay: 3456,
				allow_dismiss: true
			});
			$("#ipassword").focus();
			return false;
		}

		var fd = new FormData($(this)[0]);
		var url = '<?=base_url('api_admin/akun/pengguna/tambah/');?>';
		$.ajax({
			type: 'post',
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			success: function(data){
				if (data.status=="200") {
          $("#baru_modal").modal("hide");
          
          drTable.ajax.reload();
				} else {
					
          $().btnSubmit('finished');
				}
			},
			error: function() {
				
        $().btnSubmit('finished');
				return false;
			}
		});
	});
	$("#baru_modal_form_submit_button").off("click");
	$("#baru_modal_form_submit_button").on("click",function(e){
		e.preventDefault();
		$("#baru_modal_form").trigger("submit");
	});
});

$("#baru_modal").on("hidden.bs.modal",function(e){
	$("#baru_modal").find("form").trigger("reset");
});


//edit

$("#modal_hak_akses").on("shown.bs.modal",function(e){
	$("#form_hak_akses").off("submit");
	$("#form_hak_akses").on("submit",function(e) {
		e.preventDefault();
    $().btnSubmit();

		var fd = new FormData($(this)[0]);
		var url = api_url + "pengguna/hak_akses/";

		$.ajax({
			type: 'post',
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			success: function(respon) {
				if (respon.status=="200" || respon.status == 200) {
					growlPesan = '<h4>Sukses</h4><p>'+respon.message+'</p>';
					drTable.ajax.reload();
					growlType = 'success';
					$("#modal_hak_akses").modal("hide");
				}else {
					growlPesan = '<h4>Gagal</h4><p>'+respon.message+'</p>';
					growlType = 'danger';
				}
				setTimeout(function(){
					$.bootstrapGrowl(growlPesan, {
						type: growlType,
						delay: 3456,
						allow_dismiss: true
					});
				}, 666);
			},
			error: function(){
				growlPesan = '<h4>Error</h4><p>Tidak dapat memproses data saat ini, coba lagi nanti</p>';
				growlType = 'warning';
				setTimeout(function(){
					$.bootstrapGrowl(growlPesan, {
						type: growlType,
						delay: 3456,
						allow_dismiss: true
					});
				}, 666);
				return false;
			}
		});
	})

	$("#btambah_access").off("click");
	$("#btambah_access").on("click",function(e){
		e.preventDefault();
		$("#form_hak_akses").trigger("submit");
	});
});

$("#edit_modal").on("shown.bs.modal",function(e){
	//
});
$("#edit_modal").on("hidden.bs.modal",function(e){
	$("#edit_modal").find("form").trigger("reset");
});

$("#edit_modal_form").on("submit",function(e){
	e.preventDefault();
  $().btnSubmit();

	let fd = new FormData($(this)[0]);
	let url = '<?=base_url("api_admin/akun/pengguna/edit/"); ?>';

	$.ajax({
		type: $(this).attr('method'),
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			if (respon.status == 200) {
        $("#edit_modal").modal("hide");
				
				drTable.ajax.reload();
			} else {
				
        $().btnSubmit('finished');
			}
		},
		error: function(){
      
      $().btnSubmit('finished');
			return false;
		}
	});
});

//edit
$("#edit_modal_password").on("shown.bs.modal",function(e){
	//
});
$("#edit_modal_password").on("hidden.bs.modal",function(e){
	$("#edit_modal_password").find("form").trigger("reset");
});
$("#fpe").on("submit",function(e){
	e.preventDefault();
  $().btnSubmit();

	var p1 = $("#fpe_newpassword").val();
	var p2 = $("#fpe_renewpassword").val();
	if(p1.length <= 4){ //>
		$.bootstrapGrowl('Passowrd too short', {
			type: 'danger',
			delay: 3456,
			allow_dismiss: true
		});
		$("#fpe_newpassword").focus();
		return false;
	}
	if(p1 != p2){
		$.bootstrapGrowl('Password not same', {
			type: 'danger',
			delay: 3456,
			allow_dismiss: true
		});
		$("#fpe_newpassword").focus();
		return false;
	}
	var fd = new FormData($(this)[0]);
	var url = '<?=base_url("api_admin/akun/pengguna/editpass/"); ?>';
	$.ajax({
		type: $(this).attr('method'),
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			if(respon.status=="200" || respon.status == 200){
				growlType = 'success';
				growlPesan = '<h4>Sukses</h4><p>Kata sandi telah diubah!</p>';
				drTable.ajax.reload();
			}else{
				growlType = 'danger';
				growlPesan = '<h4>Gagal</h4><p>'+respon.message+'</p>';
			}
			$("#edit_modal_password").modal("hide");
			setTimeout(function(){
				$.bootstrapGrowl(growlPesan, {
					type: growlType,
					delay: 3456,
					allow_dismiss: true
				});
			}, 666);
		},
		error:function(){
			growlPesan = '<h4>Error</h4><p>Tidak dapat memproses data saat ini, coba lagi nanti</p>';
			growlType = 'warning';
			setTimeout(function(){
				$.bootstrapGrowl(growlPesan, {
					type: growlType,
					delay: 3456,
					allow_dismiss: true
				});
			}, 666);
			return false;
		}
	});
});

//edit
$("#edit_modal_wm").on("shown.bs.modal",function(e){
	//
});
$("#edit_modal_wm").on("hidden.bs.modal",function(e){
	$("#edit_modal_wm").find("form").trigger("reset");
});
$("#fewm").on("submit",function(e){
	e.preventDefault();
  $().btnSubmit();
	var fd = new FormData($(this)[0]);
	var url = '<?=base_url("api_admin/akun/pengguna/edit/"); ?>';
	$.ajax({
		type: $(this).attr('method'),
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			if(respon.status=="200" || respon.status == 200){
				growlType = 'success';
				growlPesan = '<h4>Sukses</h4><p>Data berhasil diedit</p>';
				drTable.ajax.reload();
			}else{
				growlType = 'danger';
				growlPesan = '<h4>Gagal</h4><p>'+respon.message+'</p>';
			}
			$("#edit_modal_wm").modal("hide");
			setTimeout(function(){
				$.bootstrapGrowl(growlPesan, {
					type: growlType,
					delay: 3456,
					allow_dismiss: true
				});
			}, 666);
		},
		error:function(){
			growlPesan = '<h4>Error</h4><p>Tidak dapat memproses data saat ini, coba lagi nanti</p>';
			growlType = 'warning';
			setTimeout(function(){
				$.bootstrapGrowl(growlPesan, {
					type: growlType,
					delay: 3456,
					allow_dismiss: true
				});
			}, 666);
			return false;
		}
	});
});

//option
$("#ahak_akses").on("click",function(e){
	e.preventDefault();
  $().btnSubmit();
	$("#option_modal").modal("hide");
	$("#form_hak_akses input[type=checkbox]").prop("checked", false);
	setTimeout(function(){
		$.get(api_url + "pengguna/pengguna_module/"+ieid).done(function(dt){
			$.each(dt,function(k,v){
				$("#"+v).prop("checked",true);
			});
			$("#modal_hak_akses").modal("show");
      $().btnSubmit('finished');
		}).fail(function(){
			alert("Cannot get user modules");
		});

	},333);
});

//hapus
$("#hapus_button").on("click",function(e){
	e.preventDefault();
	var id = ieid;
	if(id){
		var c = confirm('Apakah anda yakin?');
		if(c){
      $().btnSubmit();
			var url = '<?=base_url('api_admin/akun/pengguna/hapus/'); ?>'+id;
			$.get(url).done(function(response){
				if(response.status=="200" || response.status==200){
          

          $("#edit_modal").modal("hide");
					$("#option_modal").modal("hide");

          drTable.ajax.reload();
				}else{
					
				}
			}).fail(function() {
        
				$().btnSubmit('finished');
			});
		}
	}
});

$("#bhapus").on("click",function(e){
	e.preventDefault();
	$("#hapus_button").trigger("click");
});

//option
$("#aedit").on("click",function(e){
	e.preventDefault();
	$("#option_modal").modal("hide");
	setTimeout(function(){
		$("#edit_modal").modal("show");
	},333);
});

//detail
$("#adetail").on("click",function(e){
	e.preventDefault();
	$("#option_modal").modal("hide");
	setTimeout(function(){
		//$("#edit_modal").modal("show");
		alert('masih dalam pengembangan');
	},333);
});

//edit_password
$("#aedit_password").on("click",function(e){
	e.preventDefault();
	$("#option_modal").modal('hide');
	$("#edit_modal_password").modal('show');
});

//edit_welcomemessage
$("#aedit_wm").on("click",function(e){
	e.preventDefault();
	$("#option_modal").modal('hide');
	$("#edit_modal_wm").modal('show');
});

//edit_foto
$("#bprofil_foto").on("click",function(e){
	e.preventDefault();
	$("#option_modal").modal('hide');
	$("#fef").trigger("reset");
	setTimeout(function(){
		$("#modal_profil_foto").modal('show');
	},333);
});

$("#fef").on("submit",function(e){
	e.preventDefault();

  $().btnSubmit();
	var fd = new FormData($(this)[0]);
	var url = '<?=base_url('api_admin/akun/pengguna/edit_foto/');?>';
	$.ajax({
		type: 'post',
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(dt){
			if(dt.status=="200" || dt.status == 200){
				$("#modal_profil_foto").modal("hide");
				setTimeout(function(){
					$.bootstrapGrowl('<h4>Sukses</h4><p>Profile picture updated</p>', {
						type: 'success',
						delay: 3456,
						allow_dismiss: true
					});
				}, 666);
				drTable.ajax.reload();
			}else{
				setTimeout(function(){
					$.bootstrapGrowl('<h4>Gagal</h4><p>'+dt.message+'</p>', {
						type: 'danger',
						delay: 3456,
						allow_dismiss: true
					});
					$("#modal_profil_foto").modal("hide");
				}, 666);
			}
		},
		error:function(){
			growlPesan = '<h4>Error</h4><p>Tidak dapat memproses data saat ini, coba lagi nanti</p>';
			growlType = 'warning';
			setTimeout(function(){
				$.bootstrapGrowl(growlPesan, {
					type: growlType,
					delay: 3456,
					allow_dismiss: true
				});
			}, 666);
			return false;
		}
	});
});
$("#btn_foto_reset").on("click",function(e){
	e.preventDefault();
	var c = confirm("Apakah Anda yakin?");
	if(c){
    $().btnSubmit();
		$.get("<?=base_url("api_admin/akun/pengguna/foto_reset/")?>"+(ieid)).done(function(dt){
			if(dt.status == 200){
				$.bootstrapGrowl("<h4>Sukses</h4><p>Administrator display picture has been resetted</p>", {
					type: "info",
					delay: 3456,
					allow_dismiss: true
				});
				drTable.ajax.reload();
			}else{
				$.bootstrapGrowl("<h4>Gagal</h4><p>"+dt.message+"</p>", {
					type: "danger",
					delay: 3456,
					allow_dismiss: true
				});
			}
		}).fail(function(){
			$.bootstrapGrowl("<h4>Error</h4><p>Cannot reset profile picture right now, please try again later</p>", {
				type: "warning",
				delay: 3456,
				allow_dismiss: true
			});
		})
	}
});