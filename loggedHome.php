<?php
include "settingPHP/header.php";

if(isset($_SESSION['STUDENT_ID']))
{
	include "loggedHomeHelper.php";
}
else
{
	echo 
	"<div class='container'>
		<div class='col-lg-8 col-lg-offset-2' style='text-align:center'>
			<h1>You aren't logged in!</h1>
			<h3>You must login to view this page</h3>
			<form class='form-horizontal col-lg-8 col-lg-offset-2 well'>
				<legend>Login</legend>
				<div class='form-group'>
					<div class='col-lg-10 col-lg-offset-1'>
						<input type='text' class='form-control' id='inputEmail2' placeholder='Email/ID'>
					</div>
				</div>
				<div class='form-group'>
					<div class='col-lg-10 col-lg-offset-1'>
						<input type='password' class='form-control' id='inputPassword2' placeholder='Password'>
					</div>
				</div>
				<div class='form-group'>
					<div class='row'>
						<div class='col-lg-8 col-lg-offset-2'>
							<button type='submit' class='btn btn-primary' id='submitLogin2'>Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>";
}
	
include "settingPHP/footer.php"
?>