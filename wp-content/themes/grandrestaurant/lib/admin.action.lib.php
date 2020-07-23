<?php
//If clear cache
if(is_admin() && isset($_POST['method']) && !empty($_POST['method']) && $_POST['method'] == 'clear_cache')
{
	//Get theme cache folder
	$upload_dir = wp_upload_dir();
	$cache_dir = '';
	$cache_url = '';
	
	if(isset($upload_dir['basedir']))
	{
		$cache_dir = THEMEUPLOAD;
	}

	if(file_exists($cache_dir."combined.js"))
	{
		unlink($cache_dir."combined.js");
	}
	
	if(file_exists($cache_dir."combined.css"))
	{
		unlink($cache_dir."combined.css");
	}
	
	exit;
}

//If delete sidebar
if(is_admin() && isset($_POST['sidebar_id']) && !empty($_POST['sidebar_id']))
{
	$current_sidebar = get_option('pp_sidebar');
	
	if(isset($current_sidebar[ $_POST['sidebar_id'] ]))
	{
		unset($current_sidebar[ $_POST['sidebar_id'] ]);
		update_option( "pp_sidebar", $current_sidebar );
	}
	
	echo 1;
	exit;
}

//If delete image
if(is_admin() && isset($_POST['field_id']) && !empty($_POST['field_id']) && isset($_GET["page"]) && $_GET["page"] == "functions.php" )
{
	$current_val = get_option($_POST['field_id']);
	delete_option( $_POST['field_id'] );
	
	echo 1;
	exit;
}
?>