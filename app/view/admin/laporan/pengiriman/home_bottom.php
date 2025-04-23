$('#btn_dlxls').on('click',function(e){
	e.preventDefault();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch');
	$('.icon-submit').addClass('fa-spin');

	var mindate = $("#fl_mindate").val();
	var maxdate = $("#fl_maxdate").val();
	var url = '<?=base_url_admin('laporan/pengiriman/download_xls/') ?>';
	url = url + '/?mindate='+mindate+'&maxdate='+maxdate;

	setTimeout(function(){
		$('.btn-submit').prop('disabled',false);
		$('.icon-submit').removeClass('fa-circle-o-notch');
		$('.icon-submit').removeClass('fa-spin');
		window.location = url;
	},999);
});