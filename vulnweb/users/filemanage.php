<?php 

  include "../includes/file.php";
  include "../includes/session.php";
  include "../includes/header/dashboardHeader.php";

  $session = new Session;
  session_start();
  $session->userRedirect(); 

  $dir =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR;
  
  if (!empty($_GET['name'])){
    File::remove($dir);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    File::upload($dir);
  }

?>
    
    <div class="container">
        <div class="row">

           <?php
            //scan "uploads" folder and display them accordingly
           $folder = "uploads";
           $results = scandir('uploads');
           foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            
            if (is_file($folder . '/' . $result)) {
                echo '
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="'.$folder . '/' . $result.'" alt="...">
                            <div class="caption">
                            <p><a href="filemanage.php?name='.$result.'" class="btn btn-danger btn-xs" role="button">Remove</a></p>
                        </div>
                    </div>
                </div>';
            }
           }
           ?>

        </div>
          <div class="row">
            <div class="col-lg-12">
               <form class="well" action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="file">File to upload</label>
                    <input type="file" name="file">                  </div>
                  <input type="submit" class="btn btn-lg btn-primary" value="Upload">
                </form>
            </div>
          </div>
    </div> <!-- /container -->
  </body>
</html>