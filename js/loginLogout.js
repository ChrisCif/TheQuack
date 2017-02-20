$(document).ready(function(){

	$("#submitLogin").click(function(event){
		event.preventDefault();
		$.ajax({
			url:"functionPHP/loginLogout.php",
			method:"POST",
			data:{inputEmail:$("#inputEmail").val(), inputPassword:$("#inputPassword").val(), loggingIn: true},
			dataType:"JSON",
			success:function(data){
				if(data.charAt(0) == '+')
				{
					console.log('yeah');
					window.location.href = "loggedHome.php";
				}
				console.log(data);
			},
			error:function()
			{
				
				$("#LoginDropDown").append('<div id="errorAppend" class="form-group"> <div class="row"><div class="col-lg-offset-3">User Name or Password is Incorrect</div></div></div>');
			}
		});
	});
	
	$("#submitLogin2").click(function(event){
		event.preventDefault();
		$.ajax({
			url:"functionPHP/loginLogout.php",
			method:"POST",
			data:{inputEmail:$("#inputEmail2").val(), inputPassword:$("#inputPassword2").val(), loggingIn: true},
			dataType:"JSON",
			success:function(data){
				if(data.charAt(0) == '+')
				{
					window.location.href = "loggedHome.php";
				}
				else{
					console.log('nah');
				}
				console.log(data);
			},
		});
	});
	
	$("#submitLogout").click(function(event){
		event.preventDefault();
		$.ajax({
			url:"functionPHP/loginLogout.php",
			method:"POST",
			success:function(data){
				window.location.href = "index.php";
			},
		});
	});
	
});