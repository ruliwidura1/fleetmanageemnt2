function gritter(pesan,jenis="info"){
	$.bootstrapGrowl(pesan, {
		type: jenis,
		delay: 3500,
		allow_dismiss: true
	});
}

$("#bprofil_foto").on("click",function(e){
	e.preventDefault();
	$("#modal_profil_foto").modal('show');
});

$("#bprofil").on("click",function(e){
	e.preventDefault();
	$("#modal_profil_edit").modal('show');
});

$("#bpassword_change").on("click",function(e){
	e.preventDefault();
	$("#modal_password_change").modal('show');
	$("#fmodal_password_change").trigger("reset");
});

$("#fmodal_profil_foto").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	$.ajax({
		url: '<?=base_url('api_admin/profil/picture_change/'); ?>', // Url to which the request is send
		type: "POST",
		data: new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success: function(data){
			NProgress.done();
			if(data.status == "200" || data.status == 200){
				gritter('<h4>Sukses</h4><p>Tampilan gambar berhasil diubah</p>','success');
				setTimeout(function(){
					window.location.reload();
				},1333);
			}else{
				gritter('<h4>Gagal</h4><p>'+data.message+'</p>','warning');
			}
		},
		error: function(d){
			NProgress.done();
			gritter('<h4>Error</h4><p>Tidak dapat mengubah gambar tampilan sekarang, silakan coba lagi</p>','warning');
		}
	});
});

$("#fmodal_profil_edit").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	var fd = $(this).serialize();
	$.post('<?=base_url('api_admin/profil/edit/')?>',fd).done(function(dt){
		$("#modal_profil_edit").modal('hide');
		NProgress.done();
		if(dt.status == 200){
			gritter("<h4>Sukses</h4><p>profile telah diubah</p>",'success');
			setTimeout(function(){
				window.location = '<?=base_url_admin('profil/')?>';
			},2000);
		}else{
			gritter("<h4>Error</h4><p>"+dt.message+"</p>",'danger');
		}
	}).fail(function(){
		$("#modal_profil_edit").modal('hide');
		NProgress.done();
		window.reload();
	})
});

$("#fmodal_password_change").on("submit",function(e){
	e.preventDefault();
	var npw = $("#imodal_password_change_newpassword").val();
	var cpn = $("#imodal_password_change_confirm_newpassword").val();
	if(cpn != npw){
		gritter("<h4>Warning</h4><p>Kata sandi baru dengan konfirmasi kata sandi baru tidak cocok</p>",'warning')
		$("#imodal_password_change_confirm_newpassword").focus();
		return 0;
	}
	NProgress.start();
	var fd = $(this).serialize();
	$.post('<?=base_url('api_admin/profil/password_change/')?>',fd).done(function(dt){
		$("#modal_password_change").modal('hide');
		NProgress.done();
		if(dt.status == 200){
			gritter("<h4>Sukses</h4><p>kata sandi telah dirubah</p>",'success');
			setTimeout(function(){
				window.location = '<?=base_url_admin('profil/')?>';
			},2000);
		}else{
			gritter("<h4>Gagal</h4><p>"+dt.message+"</p>",'danger');
		}
	}).fail(function(){
		$("#modal_password_change").modal('hide');
		gritter("<h4>Error</h4><p>tidak dapat mengubah kata sandi sekarang, silahkan coba lagi nanti</p>",'danger');
		NProgress.done();
		window.reload();
	})
});
