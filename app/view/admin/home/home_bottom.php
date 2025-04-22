var cdnurl = '<?=$this->cdn_url()?>';
var grafikMostViewed = $('#grafikMostViewed');
var keyHari = [];
var dataGrafikMostViewed = [];

setInterval( function() {
	var seconds = new Date().getSeconds();
	$("#waktu_detik").html(( seconds < 10 ? "0" : "" ) + seconds); //>
},1000);

setInterval( function() {
	var minutes = new Date().getMinutes();
	$("#waktu_menit").html(( minutes < 10 ? "0" : "" ) + minutes); //>
},1000);

setInterval( function() {
	var hours = new Date().getHours();
	$("#waktu_jam").html(( hours < 10 ? "0" : "" ) + hours); //>
}, 1000);
