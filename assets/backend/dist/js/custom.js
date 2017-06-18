 var protocol = window.location.protocol;
 var base_url = protocol + "//" + document.location.hostname + "/loyaltythailand/";
 var index_page = "admin.php/";
 var site_url = base_url+index_page;

 function getDataUrl(p)
 {
 	var jqXHR = $.ajax({
 		type: "get",
 		url: site_url + p.url,
 		data: p.v,
 		cache: false,
 		async: false
 	});
 	return jqXHR.responseText;
 }

 $(function(){
 	startTime();
 	$('body').on('click', '.link_dialog', function () {
 		var data = {
 			title: 'Loading',
 			type: 'alert',
 			text: '<div class="text-center"><p><i class="fa fa-spinner fa-spin fa-2x"></i></p></div>'
 		};
 		genModal(data);

 		if ($(this).attr('rel') !== '')
 		{
 			if ($(this).hasClass('delete')) {
 				var data = {
 					url: $(this).attr('rel'),
 					title: $(this).attr('title')
 				};
 				deleteData(data);
 			} else {
 				var data = {
 					url: $(this).attr('rel'),
 					title: $(this).attr('title')
 				};
 				genModal(data);
 			}
 		}
 	});
 });
 function genModal(p)
 {
 	if (p.type === 'confirm_print')
 	{
 		$('#myModal .modal-footer').show();
 		$('#myModal .modal-title, #myModal .modal-body').empty();
 		$('#myModal .modal-footer #button-close, #button-confirm, #button-print').show();
 		$('#myModal .modal-footer #button-ok').hide();
 		$('#myModal .modal-title').html(p.title);
 		$('#myModal .modal-body').html('<div class="text-center">' + p.text + '</div>');
 		$('#myModal').modal({
 			backdrop: 'static',
 			keyboard: true
 		});
 	} else if (p.type === 'alert')
 	{
 		$('#myModal .modal-title, #myModal .modal-body').empty();
 		$('#myModal .modal-footer').hide();
 		$('#myModal .modal-title').html(p.title);
 		$('#myModal .modal-body').html(p.text);
 		$('#myModal').modal({
 			backdrop: 'static',
 			keyboard: true
 		});
 	} else if (p.type === 'info1')
 	{
 		$('#myModal .modal-title, #myModal .modal-body').empty();
 		$('#myModal .modal-footer #button-ok, #button-confirm, #button-print').hide();
 		$('#myModal .modal-footer #button-close').show();
 		$('#myModal .modal-title').html(p.title);
 		$('#myModal .modal-body').html(p.text);
 		$('#myModal').modal({
 			backdrop: 'static',
 			keyboard: true
 		});
 	} else if (p.type === 'info')
 	{
 		$('#myModal .modal-title, #myModal .modal-body').empty();
 		$('#myModal .modal-footer #button-close, #button-confirm, #button-print').hide();
 		$('#myModal .modal-footer #button-ok').show();
 		$('#myModal .modal-title').html(p.title);
 		$('#myModal .modal-body').html(p.text);
 		$('#myModal').modal({
 			backdrop: 'static',
 			keyboard: true
 		});
 	} else if (p.type === 'confirm') {
 		$('#myModal .modal-footer').show();
 		$('#myModal .modal-title, #myModal .modal-body').empty();
 		$('#myModal .modal-footer #button-close, #button-confirm').show();
 		$('#myModal .modal-footer #button-ok, #button-print').hide();
 		$('#myModal .modal-title').html(p.title);
 		$('#myModal .modal-body').html('<div class="text-center">' + p.text + '</div>');
 		$('#myModal').modal({
 			backdrop: 'static',
 			keyboard: true
 		});
 	} else {
 		$.ajax({
 			type: "get",
 			url: site_url + p.url,
 			data: p.v,
 			cache: false,
 			dataType: 'html',
 			success: function (result) {
 				try {
 					$('#myModal .modal-title, #myModal .modal-body').empty();
 					$('#myModal .modal-footer').hide();
 					$('#myModal .modal-title').html(p.title);
 					$('#myModal .modal-body').html(result);
 					$('#myModal').modal({
 						backdrop: 'static',
 						keyboard: true,
 						width: '680px'
 					});
 				} catch (e) {
 					alert('Exception while request..');
 				}
 			},
 			error: function (e) {
 				alert('Error while request..');
 			}
 		});
 	}
 }

 function deleteData(p)
 {
 	if (p.type === 'general')
 	{
 		var data = {
 			title: 'Delete',
 			type: 'confirm',
 			text: 'Are you sure to delete ?'
 		};
 		genModal(data);

 		$('body').on('click', '#myModal #button-confirm', function () {
 			var data3 = {
 				url: p.url,
 				redirect: p.redirect
 			};
 			var rs = getDataUrl(data3);
 			var obj = $.parseJSON(rs);
 			if (obj.error.status === true)
 			{

 				$('#myModal .modal-footer').hide();
 				$('#myModal .modal-body').empty();
 				$('#myModal .modal-body').html('<div class="text-center"><p><img src="' + base_url + 'assets/img/ajax-loader.gif" /></p>' + obj.error.message_info + '</div>');
 				setTimeout(function () {
 					$('#myModal').modal('hide');
 					$('#myModal').on('hidden.bs.modal', function (e) {
 						window.location.href = site_url + obj.error.redirect;
 					});
 				}, 3000);
 			} else {

 				$('#myModal .modal-footer').show();
 				$('#myModal .modal-footer #button-close, #button-confirm').hide();
 				$('#myModal .modal-footer #button-ok').show();
 				$('#myModal .modal-body').empty();
 				$('#myModal .modal-body').html('<div class="text-center">' + obj.error.message_info + '</div>');
 			}
 		});
 	} else {

 		var data = {
 			title: 'Delete',
 			type: 'confirm',
 			text: 'Are you sure to delete ?'
 		};

 		genModal(data);

 		$('body').on('click', '#myModal #button-confirm', function () {
 			var data2 = {
 				url: p.url
 			};
 			var rs = getDataUrl(data2);
 			var obj = $.parseJSON(rs);
 			if (obj.error.status === true)
 			{
 				$('#myModal .modal-footer').hide();
 				$('#myModal .modal-body').empty();
 				$('#myModal .modal-body').html('<div class="text-center"><p><i class="fa fa-spinner fa-spin fa-2x"></i></p>' + obj.error.message_info + '</div>');
 				setTimeout(function () {
 					$('#myModal').modal('hide');
 					$('#myModal').on('hidden.bs.modal', function (e) {
 						window.location.href = site_url + obj.error.redirect;
 					});
 				}, 3000);
 			} else {
 				$('#myModal .modal-footer').show();
 				$('#myModal .modal-footer #button-close, #button-confirm').hide();
 				$('#myModal .modal-footer #button-ok').show();
 				$('#myModal .modal-body').empty();
 				$('#myModal .modal-body').html('<div class="text-center">' + obj.error.message_info + '</div>');
 			}
 		});

 	}
 }

 function startTime() {
 	var today = new Date();
 	var h = today.getHours();
 	var m = today.getMinutes();
 	var s = today.getSeconds();
 	m = checkTime(m);
 	s = checkTime(s);
 	// document.getElementById('clock_time').innerHTML =
 	// h + ":" + m + ":" + s;
 	$('#clock_time').html(h + ":" + m + ":" + s);
 	var t = setTimeout(startTime, 500);
 }
 function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function setDdl(url, select, value, val, sel) {
	val = typeof val !== 'undefined' ? val : '';
	sel = typeof sel !== 'undefined' ? sel : 0;
	$.get(base_url + url, {id: value},
		function (data) {
			if (data) {
				var as = JSON.parse(data);
				var selector = select;
				selector.empty();
				if (sel == 1) {
					selector.append("<option value=''>--- Please Select ---</option>");
				}
				var sortedCities = sortProperties(as);
				$.each(sortedCities, function (index, element) {
					var arr1 = toObject(element);
					var selected = (arr1[0] == val ? 'selected' : '');
					selector.append("<option value='" + arr1[0] + "' " + selected + ">" + arr1[1] + "</option>");
				});
			}
		});
}