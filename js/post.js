$('#btn_addcat').click(function(){
	$('#form-add-service').hide();
	$('#form_addcat').show();
});

// Запрос на добавление нового сервиса
$('#btn_addservice').click(function(){
	var service_name = $('#service_name').val(),
		min_description = $('#min_description').val(),
		full_description = $('#full_description').val(), 
		country = $('#country').val(),
		areal = $('#areal').val(),
		city = $('#city').val(),
		category = $('#s_category option:selected').text();
		cat_id = $('#s_category option:selected').val();

	$.ajax({
    	type : 'POST',
    	url : '../assets/posts.php',
    	data : {service_name:service_name,min_description:min_description,full_description:full_description,category:category,country:country,areal:areal,city:city,cat_id:cat_id},
    	success : function(data) {
    		if (data==1) {            
    			$('#form_addservice').show();
				$('#form_addcat').hide();
				$("#error").text("Отправленна");
    		}else if(data==2){
    			$("#error").text("Не отправлена");
    		}

    	}
	});
});

// Запрос на добавление категории
$('#add_cat_btn').click(function(){
	var cat_name = $('#cat_name').val();
	$.ajax({
    	type : 'POST',
    	url : '../assets/posts.php',
    	data : {cat_name:cat_name},
    	success : function(data) {
    		if (data==1) {          
    			location.reload();
				$("#error").text("Отправленна");
    		}else if(data==2){
    			$("#error").text("Не отправлена");
    		}

    	}
	});
});

$('#btn_save').click(function(){
	$('#quest').show();
	$('#yes').click(function(){
		$('#quest').hide();
		var adm_name= $('#adm_name').val(),
			adm_password = $('#adm_password').val(),
			adm_email = $('#adm_email').val(), 
			adm_number = $('#adm_number').val();

	 	$.ajax({
    		type : 'POST',
    		url : '../assets/posts.php',
    		data : {adm_name:adm_name,adm_password:adm_password,adm_email:adm_email,adm_number:adm_number},
    		success : function(data) {
    		    if (data==1) {            
				    $("#error").text("Отправленна");
    		    }else if(data==2){
    			    $("#error").text("Не отправлена");
    		    }

    	    }
		});
	});

	$('#no').click(function(){ $('#quest').hide(); });
});