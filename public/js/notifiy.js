$(document).ready(function() {		
	if (!Notification) {
		$('body').append('<h4 style="color:red">*Browser does not support Web Notification</h4>');
		return;
	}
	if (Notification.permission !== "granted") {		
		Notification.requestPermission();
	} else {		
		$.ajax({
			url : "{{ route('getNotificationByUser') }}",
			type: "get",
			success: function(response, textStatus, jqXHR) {
				var response = jQuery.parseJSON(response);
				if(response.result == true) {
					var notificationDetails = response.notif;
					for (var i = notificationDetails.length - 1; i >= 0; i--) {
						var notificationUrl = notificationDetails[i]['url'];
						var notificationObj = new Notification(notificationDetails[i]['title'], {
							icon: notificationDetails[i]['icon'],
							body: notificationDetails[i]['message'],
						});
						notificationObj.onclick = function () {
							window.open(notificationUrl); 
							// notificationObj.close();     
						};
						// setTimeout(function(){
						// 	notificationObj.close();
						// });
					};
				} else {
				}
			},
			error: function(jqXHR, textStatus, errorThrown)	{}
		}); 
	}
});