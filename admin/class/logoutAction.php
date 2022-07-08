<?php
class logoutAction
{
	function execute()
	{
		global $HOSTNAME_URL;
		echo "Logging you out. Please wait...";
		session_unset();
		session_destroy();
		header("Location: $HOSTNAME_URL/admin/");die();
	}
}

?>