$(".input-select2").select2({
	width: "100%"
});

$("#ftambah").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch fa-spin');

	var fd = new FormData($(this)[0]);
	var url = '<?= base_url("api_admin/fleetmanagement/monitoring/baru/")?>';

	$.ajax({
		type: $(this).attr('method'),
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			if(respon.status==200){
				gritter('<h4>Sukses</h4><p>Data berhasil ditambahkan</p>','success');
				setTimeout(function(){
					window.location = '<?=base_url_admin('fleetmanagement/monitoring/')?>';
				},3000);
			}else{
				gritter('<h4>Gagal</h4><p>'+respon.message+'</p>','danger');
				$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
				$('.btn-submit').prop('disabled',false);
				NProgress.done();
			}
		},
		error:function(){
			setTimeout(function(){
				gritter('<h4>Error</h4><p>Tidak dapat menambah data, silahkan coba beberapa saat lagi</p>','warning');
			}, 666);

			$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
			$('.btn-submit').prop('disabled',false);
			NProgress.done();
			return false;
		}
	});
});

//url get alamat
var provinsi_id = 0;
var kabkota_id = 0;
var provinsi = '';
var kabkota = '';
var kecamatan = '';
var kelurahan = '';
var base_url_alamat = 'https://alamat.thecloudalert.com/api/';


function getKelurahan(){
	NProgress.start();
	var pid = $("#ikecamatan :selected").attr("data-id");
	var url = base_url_alamat+'kelurahan/get/?d_kecamatan_id='+pid;
	$.get(url).done(function(dt){
		NProgress.done();
		if(dt.status == 200){
			var h = '<option value="">-- Pilih --</option>';
			$.each(dt.result,function(k,v){
				h += '<option class="pilihan" value="'+v.text+'" data-id="'+v.id+'">'+v.text+'</option>';
			});
			$("#ikelurahan").html(h);

			$("#ikelurahan").on("change",function(){
				kelurahan = $("#ikelurahan :selected").text();
				console.log(kelurahan);
			})
		}
	}).fail(function(){
		NProgress.done();
		console.log("error ambil kecamatan");
	})
}

function getKecamatan(){
	NProgress.start();
	var pid = $("#ikabkota :selected").attr("data-id");
	var url = base_url_alamat+'kecamatan/get/?d_kabkota_id='+pid;
	$.get(url).done(function(dt){
		NProgress.done();
		if(dt.status == 200){
			var h = '<option value="">-- Pilih --</option>';
			$.each(dt.result,function(k,v){
				h += '<option class="pilihan" value="'+v.text+'" data-id="'+v.id+'">'+v.text+'</option>';
			});
			$("#ikecamatan").html(h);

			$("#ikecamatan").on("change",function(){
				kecamatan = $("#ikecamatan :selected").text();
				console.log(kecamatan);
				getKelurahan();
			})
		}
	}).fail(function(){
		NProgress.done();
		console.log("error ambil kecamatan");
	})
}

function getKabkota(){
	NProgress.start();
	var pid = $("#iprovinsi :selected").attr("data-id");
	var url = base_url_alamat+'kabkota/get/?d_provinsi_id='+pid;
	$.get(url).done(function(dt){
		NProgress.done();
		if(dt.status == 200){
			var h = '<option value="">-- Pilih --</option>';
			$.each(dt.result,function(k,v){
				h += '<option class="pilihan" value="'+v.text+'" data-id="'+v.id+'">'+v.text+'</option>';
			});
			$("#ikabkota").html(h);

			$("#ikabkota").on("change",function(){
				kabkota_id = this.value;
				kabkota = $("#ikabkota :selected").text();
				getKecamatan();
			})
		}else{
			NProgress.done();
			console.log(dt.status+","+dt.message);
		}
	}).fail(function(){
		console.log("error ambil provinsi");
	})
}

//get provinsi
NProgress.start();
$.get(base_url_alamat+'provinsi/get/').done(function(dt){
	NProgress.done();
	if(dt.status == 200){
		var h = '<option value="">-- Pilih --</option>';
		$.each(dt.result,function(k,v){
			h += '<option class="pilihan" value="'+v.text+'" data-id="'+v.id+'">'+v.text+'</option>';
		});
		$("#iprovinsi").html(h);

		$("#iprovinsi").on("change",function(){
			provinsi_id = this.value;
			provinsi = $("#iprovinsi :selected").text();
			console.log(provinsi_id+','+provinsi);
			getKabkota();
		});
	}
}).fail(function(){
	NProgress.done();
	console.log("error ambil provinsi");
});
