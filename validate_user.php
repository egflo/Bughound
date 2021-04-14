		<?php
			session_start();
			
			function isLoggedIn(){
				if(!isset($_SESSION['login'])) {
					echo "<SCRIPT type='text/javascript'>
					alert('User is Not Logged In');
					window.location.replace('index.php');
					</SCRIPT>";	
				}	
			}	
			
			function isValidLevel($min_level){
				$user_level =  (int)$_SESSION["user_level"];
				if($user_level < $min_level) {
				
					return false;
				}			
				return true;
			}
			
		?>