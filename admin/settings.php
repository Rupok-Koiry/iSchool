<?php
include 'admin_include/header.php';
include '../db_connection.php';

//Update
if (isset($_REQUEST['submit_btn'])) {
  //Checking All filed is not empty
  if (($_REQUEST['logo'] == '') || ($_REQUEST['footer_text'] == '')) {
    $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">All Fields are Required
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  } else {
    //Getting all value
    $logo = $_REQUEST['logo'];
    $footer_text = $_REQUEST['footer_text'];

    //Getting Video
    $link_video = $_FILES['video']['name'];
    $link_video_tmp = $_FILES['video']['tmp_name'];
    $vid_folder = '../video/' . $link_video;
    //if admin change Video then old Video will delete
    $sql2 = "SELECT video FROM settings";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    //Video extension Check
    $extension_video = pathinfo($link_video, PATHINFO_EXTENSION);
    $valid_extension_video = ['webm', 'mkv', 'mp4'];



    //Getting Image
    $banner = $_FILES['banner']['name'];
    $banner_tmp = $_FILES['banner']['tmp_name'];
    $img_folder = '../image/' . $banner;
    //if admin change image then old image will delete
    $sql3 = "SELECT banner FROM settings";
    $result3 = $conn->query($sql3);
    $row3 = $result3->fetch_assoc();
    //Image extension Check
    $extension_image = pathinfo($banner, PATHINFO_EXTENSION);
    $valid_extension_image = ['jpg', 'jpeg', 'png', 'gif'];



    if ($_FILES['video']['size'] > 1) {
      //if admin change video
      if (in_array($extension_video, $valid_extension_video)) {
        if (file_exists($row2['video']) && !empty($row2['video'])) {
          unlink($row2['video']);
        }
        move_uploaded_file($link_video_tmp, $vid_folder);
        $sql4 = "UPDATE settings SET logo='$logo',video='$vid_folder',footer_text='$footer_text'";
        if ($conn->query($sql4) == true) {
          $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Updated Successfully
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        } else {
          $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Unable to Update
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        }
      } else {
        $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Image Extension Must Be \'webm\', \'mkv\', \'flv\' 
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      }
    }
    if ($_FILES['banner']['size'] > 1) {
      //if admin change banner
      if (in_array($extension_image, $valid_extension_image)) {
        if (file_exists($row3['banner']) && !empty($row3['banner'])) {
          unlink($row3['banner']);
        }
        move_uploaded_file($banner_tmp, $img_folder);
        $sql4= "UPDATE settings SET logo='$logo',banner='$img_folder',footer_text='$footer_text'";
        if ($conn->query($sql4) == true) {
          $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Updated Successfully
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        } else {
          $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Unable to Update
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        }
      } else {
        $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Image Extension Must Be \'jpg\', \'jpeg\', \'png\', \'gif\' 
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      }
    }
    if ($_FILES['banner']['size'] == 0 && $_FILES['video']['size'] == 0) {
      //if admin did not change image
      $sql4 = "UPDATE settings SET logo='$logo',footer_text='$footer_text'";
      if ($conn->query($sql4) == true) {
        $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Updated Successfully
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      } else {
        $msg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Unable to Update
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      }
    }
  }
}
?>
<main>

  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card shadow rounded p-3">
        <h3>Website Settings</h3>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <?php
              $sql = "SELECT * FROM settings";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="logo">Logo</label>
                  <input type="text" class="form-control" id="logo" name="logo" readonly value="<?php echo $row['logo'] ?>">
                </div>
                <div class="form-group">
                  <label for="video">Home Page Video</label>
                  <input type="file" class="form-control-file" id="video" name="video">
                  <video controls class="embed-responsive w-50 mt-3 img-thumbnail">
                    <source src="<?php echo $row['video'] ?>" type="video/mp4">
                  </video>
                </div>
                <div class="form-group">
                  <label for="banner">Banner</label>
                  <input type="file" class="form-control-file" id="banner" name="banner">
                  <img src="<?php echo $row['banner'] ?>" alt="" class="img-fluid w-50 img-thumbnail mt-3">
                </div>
                <div class="form-group">
                  <label for="footer_text">Footer Text</label>

                  <div class="input-group">
                    <input type="text" class="form-control" id="footer_text" name="footer_text" value="<?php echo $row['footer_text'] ?>">
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-success" id="submit_btn" name="submit_btn">Submit</button>
                </div>
              </form>
              <?php
              if (isset($msg)) {
                echo $msg;
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include 'admin_include/footer.php' ?>