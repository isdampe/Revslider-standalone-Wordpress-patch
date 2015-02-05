<?php

revsliderpatch_blocklfd();
revsliderpatch_blockafl();

function revsliderpatch_blocklfd()
{
	global $wpdb;

	if(stristr($_SERVER["SCRIPT_FILENAME"],"/wp-admin/admin-ajax.php"))
	{
		$file = preg_replace('/[^\da-zA-Z0-9 -_.]/i', '', $_GET['img']);
		$q = @explode(".",$file);
		$accepted = array("jpg","JPG","jpeg","gif","png","PNG","GIF","");
		if (!in_array($q[count($q)-1],$accepted))
		{
			die();
		}
	}
}

function revsliderpatch_blockafl()
{
	global $wpdb;

	if(stristr($_SERVER["SCRIPT_FILENAME"],"/wp-admin/admin-ajax.php"))
	{
		if($_POST['action'] != "")
			$_POST['action'] = preg_replace('/[^a-zA-Z_\-0-9]/i', '', $_POST['action']);
		else
			$_POST['action'] = preg_replace('/[^a-zA-Z_\-0-9]/i', '', $_REQUEST['action']);
		if($_POST['client_action'] != "")
			$_POST['client_action'] = preg_replace('/[^a-zA-Z_\-0-9]/i', '', $_POST['client_action']);
		else
			$_POST['client_action'] = preg_replace('/[^a-zA-Z_\-0-9]/i', '', $_REQUEST['client_action']);
		if ((stristr($_POST['action'],"revslider_ajax_action") || stristr($_POST['action'],"showbiz_ajax_action")) && $_POST['client_action']=="update_plugin")
		{			
			die();
		}
	}
}
