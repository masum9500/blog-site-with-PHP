<?php include"inc/header.php";?>
<style>
    .leftside{float: left;width: 70%}
    .rightside{float: left;width: 30%}
</style>

<div class="grid_10">
<div class="box round first grid">
<h2>Update Site Title and Description</h2>

<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $fm->validation($_POST['title']);
            $slogan = $fm->validation($_POST['slogan']);

            $title  = mysqli_real_escape_string($db->link, $title);
            $slogan    = mysqli_real_escape_string($db->link, $slogan);
            

            $permited  = array('png');
            $file_name = $_FILES['logo']['name'];
            $file_size = $_FILES['logo']['size'];
            $file_temp = $_FILES['logo']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            //$same_image = 'logo'.'.'.$file_ext;
            $uploaded_image = "upload/".$file_name;

            if ($title == "" || $slogan == "") {
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
                        $updatequery = "UPDATE  title_slogan  SET  title = '$title', slogan = '$slogan', 
                        logo = '$uploaded_image' WHERE id = '1' ";

                        $update_row = $db->update($updatequery);
                        if ($update_row) {
                             echo "<span style='color:green;font-size:18px'>Post Updated Successfully.
                             </span>";
                        }else {
                            echo "<span style='color:red;font-size:18px'>Post Not Updated !</span>";
                        }
                     }

                } else{
                     $updatequeryTwo = "UPDATE  title_slogan SET  title = '$title', slogan = '$slogan' WHERE id = '1'" ;

                    $update_row = $db->update($updatequeryTwo);
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

    <?php
    $query = "SELECT * FROM title_slogan WHERE id = '1'";
    $blog_title = $db->select($query);
    if ($blog_title) {
        while ($result = $blog_title->fetch_assoc()) {
            
      
    ?>
<div class="block sloginblock"> 

<div class="leftside">              
 <form action="titleslogan.php" method="post" enctype="multipart/form-data">
    <table class="form">					
        <tr>
            <td>
                <label>Website Title</label>
            </td>
            <td>
                <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
            </td>
        </tr>
		 <tr>
            <td>
                <label>Website Slogan</label>
            </td>
            <td>
                <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Upload Image</label>
            </td>
            <td>
                <input type="file" name="logo" />
            </td>
         </tr>
		 
		
		 <tr>
            <td>
            </td>
            <td>
                <input type="submit" name="submit" Value="Update" />
            </td>
        </tr>
    </table>
    </form>
    </div>

    <div class="rightside">
        <img src="<?php echo $result['logo'];?>" alt="logo" height="150px" width="150px"/>
        
    </div>
</div>
<?php } }?>
</div>
</div>
<?php include"inc/footer.php";?>