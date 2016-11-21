<?php
   if(IsSet($_GET["trans"])) {
      $trans = $_GET["trans"];
   }
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>  var quota_max_filesize = 50; </script>
<link href="dropzone/css/dropzone.css" type="text/css" rel="stylesheet" />
<script src="dropzone/10/dropzone-amd-module.js"></script>
<form action="upload_process.php?trans=<?php echo $trans; ?>" class="dropzone"></form>



