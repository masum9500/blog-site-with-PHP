<?php include"inc/header.php";?>

<div class="grid_10">

    
    <div class="box round first grid">
        <h2>Change Theme</h2>
       <div class="block copyblock">
       <?php
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $theme = mysqli_real_escape_string($db->link, $_POST['theme']);
           if (empty($theme)) {
               echo "<span style='color:red;font-size:18px'>Find munst not be empty !</span>";
           }else{
            $themequery = "UPDATE tbl_theme SET theme = '$theme' WHERE id ='1'";
            $update_row = $db->update($themequery);
            if ($update_row) {
                echo "<span style='color:green;font-size:18px'>Theme Updated Sucessfully..</span>";
            }
           }
       }
       ?> 

       <?php
       $query = "SELECT * FROM tbl_theme WHERE id='1'";
       $theme = $db->select($query);
       while ($result = $theme->fetch_assoc()) {
       ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input <?php if ($result['theme'] == 'default') { echo "checked";}?> type="radio" name="theme" value="default" class="medium" />Default
                    </td>
                </tr>
                <tr>
                    <td>
                        <input <?php if ($result['theme'] == 'green') { echo "checked";}?> type="radio" name="theme" value="green" class="medium" />Green
                    </td>
                </tr>
                <tr>
                    <td>
                        <input <?php if ($result['theme'] == 'red') { echo "checked";}?> type="radio" name="theme" value="red" class="medium" />Red
                    </td>
                </tr>


				        <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Change" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } ?>
        </div>
    </div>
</div>
<?php include"inc/footer.php";?>