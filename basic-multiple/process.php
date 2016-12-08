<?php
	############ Configuration ##############
	$config["generate_image_file"]				= true;
	$config["generate_thumbnails"]				= true;
	$config["image_max_size"] 					= 500; //Maximum image size (height and width)
	$config["thumbnail_size"]  					= 200; //Thumbnails will be cropped to 200x200 pixels
	$config["thumbnail_prefix"]					= "thumb_"; //Normal thumb Prefix
	$config["destination_folder"]				= 'Storage/IMG-ORIGINAL/'; //upload directory ends with / (slash)
	$config["thumbnail_destination_folder"]		= 'Storage/IMG-THUMB/'; //upload directory ends with / (slash)
	$config["upload_url_original"] 				= "/basic-multiple/Storage/IMG-ORIGINAL/";
	$config["upload_url_thumb"] 				= "/basic-multiple/Storage/IMG-THUMB/";
	$config["quality"] 							= 90; //jpeg quality
	$config["random_file_name"]					= true; //randomize each file name

	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
		exit;  //try detect AJAX request, simply exist if no Ajax
	}

	//specify uploaded file variable
	$config["file_data"] = $_FILES["__files"];

	$config["mag_id"] = $_GET["mid"];

	$path_destination_folder = $config["destination_folder"] . $config["mag_id"] . '';
	if (!file_exists($path_destination_folder)) {
		mkdir($path, 0777, true);
	}

	$path_thumbnail_destination_folder = $config["thumbnail_destination_folder"] . $config["mag_id"] . '';
	if (!file_exists($path_thumbnail_destination_folder)) {
		mkdir($path, 0777, true);
	}

	$config["destination_folder"] = $path_destination_folder . '/';
	$config["thumbnail_destination_folder"] = $path_thumbnail_destination_folder . '/';

	//include sanwebe impage resize class
	include("resize.class.php");

	//create class instance
	$im = new ImageResize($config);

	try{

		$url_thumb = $config["upload_url_thumb"] . $config["mag_id"]  . '/';
		$responses = $im->resize(); //initiate image resize

		echo '<h3>MAG-LOGO</h3>';
		//output thumbnails
		foreach($responses["thumbs"] as $response){
			echo '<img src="'.$url_thumb.$response.'" class="thumbnails" title="'.$response.'" />';
		}

//		echo '<h3>Images</h3>';
//		//output images
//		foreach($responses["images"] as $response){
//			echo '<img src="'.$config["upload_url_original"].$response.'" class="images" title="'.$response.'" />';
//		}

	}catch(Exception $e){
		echo '<div class="error">';
		echo $e->getMessage();
		echo '</div>';
	}

?>