<?php
  // upload.php

  if (!empty($_FILES['files'])) {
    $files = $_FILES['files'];
    $uploadedFiles = array();

    foreach ($files['name'] as $key => $value) {
      $filename = $files['name'][$key];
      $tmp_name = $files['tmp_name'][$key];
      $filesize = $files['size'][$key];
      $filetype = $files['type'][$key];

      // Check file type and size
      if ($filesize > 1024 * 1024 * 2) {
        echo "File size exceeds 2MB";
        exit;
      }

      if (!in_array($filetype, array('image/jpeg', 'image/png', 'image/gif'))) {
        echo "Only JPEG, PNG, and GIF files are allowed";
        exit;
      }

      // Upload file
      $upload_dir = 'uploads/';
      $filename = uniqid(). '_'. $filename;
      move_uploaded_file($tmp_name, $upload_dir. $filename);
      $uploadedFiles[] = $filename;
    }

    echo json_encode($uploadedFiles);
  } else {
    echo "No files uploaded";
  }
?>