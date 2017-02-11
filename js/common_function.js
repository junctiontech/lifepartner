function genderChange(value)
{	
	alert('testing');
	if(value=='F')
	{	
		$('#female').show();
		$('#male').hide();
	}
	else if(value== 'M')
	{
		$('#female').hide();
		$('#male').show(); 
	}
	else if(value== 'ALL')
	{
		$('#female').show();
		$('#male').show();
	}
}

function height(value)
{	
	$.ajax({
		url:"Master/heightMaxDropdown",
		type:"post",
		data:{value:value},
	})
	.done(function(result){	
		$('#minHeight').html(result);
	});
}

	
function passwordCHeck()
{
	var value=prompt('Please Enter Password');
	if(value=='admin')
	{	
		window.location.assign('Master/registration');
	}
	else
	{	
		alert('Your password not correct please enter valid password');
		window.location.assign('Master/profileList');
	}
}