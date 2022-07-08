<?php
class logoutAction
{
	function execute()
	{
		global $HOSTNAME_URL;
		unset($_SESSION['USER_LOGIN']);
		unset($_SESSION['USER_ID']);
		unset($_SESSION['USER_NAME']);
		header("Location:$HOSTNAME_URL");
		die();
	}
}
?>