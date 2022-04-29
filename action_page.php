<!DOCTYPE html>
<html>
  <body>
  <?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Allow zip file formats
if($FileType != "zip" ) {
  echo "Sorry, only zip files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

$zip = new ZipArchive;
$images = glob($target_dir."*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE );


// foreach ($files as $file) {
// 	
// 		<img src="<?php echo "images/" . $file " style="height: 200px; width: 200px;"/>
// 	 }
// 
// Zip File Name
if ($zip->open($target_file) === TRUE) {
  
    // Unzip Path
    $zip->extractTo('uploads/');
    $zip->close();
    echo 'Unzipped Process Successful!';
    foreach($images as $image) {
      echo '<img src="'.$image.'" style="height: 200px; width: auto;"/>';
  }
} else {
    echo 'Unzipped Process unsuccessful!';
    
}
header("Location: index.php");
?>
  </body>
</html>