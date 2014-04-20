<?php
    require_once 'config.php';
    require_once 'src/foundationphp/UploadFile.php';
use foundationphp\UploadFile;


    $maxfiles   = ini_get('max_file_uploads');
    $postmax    = UploadFile::convertToBytes(ini_get('post_max_size'));
    $displaymax = UploadFile::convertFromBytes($postmax);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>HTML5 File API</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
	<div id="main">
		<h1>Upload Your Images</h1>
		<form method="post" enctype="multipart/form-data"  action="upload.php">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max;?>">
            <input type="file" name="images[]" id="images" multiple
                   data-maxfiles="<?php echo $maxfiles;?>"
                   data-postmax="<?php echo $postmax;?>"
                   data-displaymax="<?php echo $displaymax;?>">
    		<button type="submit" id="btn">Upload Files!</button>
    	</form>

  	<div id="response"></div>
		<ul id="image-list">

		</ul>
	</div>
	
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script src="upload.js"></script>
</body>
</html>
