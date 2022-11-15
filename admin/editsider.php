<?php include"inc/header.php";?>
<?php include"inc/fildpost.php";?>

<?php
if (!isset($_GET['editsliderid']) || $_GET['editsliderid'] == NULL) {
  echo "<script>window.location = 'postlist.php';</script>";
 // header("Location:catlist.php");

}else{
  $sliderid = $_GET['editsliderid'];
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title  = mysqli_real_escape_string($db->link, $_POST['title']);
            

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/slider/".$unique_image;

            if ($title == "" ) {
               echo "<span style='color:red;font-size:18px'>Find munst not be empty !</span>";
            }else{
                if (!empty($file_name)) { 
                    if ($file_size >1048567) {
                     echo "<span class='error'>Image Size should be less then 1MB!
                     </span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                     echo "<span class='error'>You can upload only:-"
                     .implode(', ', $permited)."</span>";
                    } else{
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE  tbl_slider SET title = '$title', image = '$uploaded_image' WHERE id = $sliderid ";

                        $update_row = $db->update($query);
                        if ($update_row) {
                             echo "<span style='color:green;font-size:18px'>Post Updated Successfully.
                             </span>";
                        }else {
                            echo "<span style='color:red;font-size:18px'>Post Not Updated !</span>";
                        }
                     }

                } else{
                     $query = "UPDATE  tbl_slider SET title = '$title' WHERE id = $sliderid ";

                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span style='color:green;font-size:18px'>Post Updated Successfully.
                        </span>";
                    }else {
                        echo "<span style='color:red;font-size:18px'>Post Not Updated !</span>";
                    }
                }
            }      
         }
        ?>
        <div class="block">
        <?php 
        $query = "SELECT * FROM tbl_slider WHERE id = '$sliderid'";
        $getslider = $db->select($query);
        if ($getslider) {
             while ($sliderresult = $getslider->fetch_assoc()) {
                 
              
        ?>               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $sliderresult['title'];?>" class="medium" />
                    </td>
                </tr>
             
               
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $sliderresult['image'];?>" height="80px" width="200px" /><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
                
               
                
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } }?>
        </div>
    </div>
</div>
<?php include"inc/footer.php";?>