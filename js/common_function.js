function genderChange(value)
{	
	if(value=='F')
	{	
		$('#female').show();
		$('#male').hide();
	}
	else
	{
		$('#female').hide();
		$('#male').show(); 
	}
}

function height(value)
{	
	$.ajax({
		url:"heightMaxDropdown",
		type:"post",
		data:{value:value},
	})
	.done(function(result){	alert(result);
		$('#minHeight').html(result);
	});
}

	
	