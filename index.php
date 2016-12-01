<?php $trans = null; if(IsSet($_GET["trans"])) { $trans = $_GET["trans"]; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>Booking & Sales Transaction Contract</title>
   <!-- Fonts -->
   <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
   <script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
   <!-- Styles -->
   <style>
      html, body {
         background-color: #fff;
         color: #fff;
         font-family: 'Lato', sans-serif;
         font-weight: 100;
         height: 100vh;
         margin: 0;
         font-size: 15px;
      }

      .main {
         width: 100%;
      }

      .main .right-pane {
         right: 0;
         position: fixed;
         height:100%;
         width: 310px;
         box-shadow: -5px 0px 20px 1px #626262;
         background-color: #4c565c;
         background-image: url("dropzone/images/dashboard-bg.png");
         background-repeat: repeat;
         z-index: 9;
      }

      .main .left-pane {
         left: 0;
         position: fixed;
         height:100%;
         width: 80%;
         /*background-color: coral;*/
         z-index: 1;
      }

      .main .left-pane iframe {
         width: 100%;
         height:100%;
      }

      .dashboard {
         padding: 10px;
      }

      .dashboard h3 {
         font-size: 1.3em;
      }

      .trans {
         font-family: 'Lato', sans-serif;
         display: inline-block;
         padding: 6px 12px;
         margin-bottom: 0;
         font-weight: 400;
         font-size: 19px;
         line-height: 1.42857143;
         text-align: center;
         -ms-touch-action: manipulation;
         touch-action: manipulation;
         -webkit-user-select: none;
         -moz-user-select: none;
         -ms-user-select: none;
         user-select: none;
         background-image: none;
         border: 1px solid transparent;
         border-radius: 4px;
         width: 100%;
      }

      .trans_download {
         background-color: #D329D8;
         border-color: #D329D8;
         color: #FFFFFF;
      }

      .trans_download:hover {
         background-color: #FFFFFF;
         border-color: #D329D8;
         color: #D329D8;
      }
   </style>
</head>
<body>
   <div class="main">
      <div class="right-pane">
         <script>
            var trans_num = "http://localhost/kpa/work/transaction/generate/pdf/<?php echo $trans; ?>";
            $(document).ready(function() {
               $("#load_trans").attr("src", trans_num);
            })
            function download() {
               window.location.href =  trans_num + "/download";
            }
         </script>
         <div class="dashboard">
            <h3> Dashboard </h3>
            <div>
               <p>
                  Please click the download button below, then, print, sign, scan and then upload.
               </p>
               <button class='trans trans_download' onclick='download();'> DOWNLOAD  </button>
            </div>
            <div style='margin-top: 10px;'>
               <p>
                  Note: Only .JPG, .PNG, .PDF, .DOC & .DOCX file types are allowed to upload.
               </p>
               <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
               <script> var quota_max_filesize = 250; </script>
               <link href="dropzone/css/dropzone.css" type="text/css" rel="stylesheet" />
               <script src="dropzone/10/dropzone-amd-module.js"></script>
               <form action="upload_process.php?trans=<?php echo $trans; ?>" class="dropzone"></form>
            </div>
         </div>
      </div>
      <div class="left-pane">
         <iframe id="load_trans" frameborder="0" scrolling="no"></iframe>
      </div>
   </div>
</body>
</html>
