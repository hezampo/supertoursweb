<?php

	$action = $_POST['action'];
	
	if($action == 'check_username')
	{
		$u = $_POST['username'];
		_check_username($u);
	}
	
	function _check_username($u)
	{
		$un = array("webwizo", "asif.iqbal", "demo1", "demo2", "demo3");
		if(in_array($u, $un))
		{
			echo "<span class='no'><strong>{$u}</strong> is not available</span>";
		}
		else
		{
			echo "<span class='yes'><strong>{$u}</strong> is available</span>";	
		}
	}

?>