<?php include"inc/header.php";?>
<?php include"inc/fildpost.php";?>

<?php
    $userid   = Seassion::get('UserId');
    $userrole = Seassion::get('UserRole');
?>



<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name  = mysqli_real_escape_string($db->link, $_POST['name']);
            $username    = mysqli_real_escape_string($db->link, $_POST['username']);
            $email   = mysqli_real_escape_string($db->link, $_POST['email']);
            $details   = mysqli_real_escape_string($db->link, $_POST['details']);
            
             $query = "UPDATE  tbl_user SET name='$name', username = '$username', email = '$email', details = '$details' WHERE id = $userid ";

                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span style='color:green;font-size:18px'>User Data Updated Successfully.
                        </span>";
                    }else {
                        echo "<span style='color:red;font-size:18px'>User Data Not Updated !</span>";
                    }
                }
  
//AND role='$userrole'
        ?>
        <div class="block">
        <?php 
        $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole'";
        $getuser = $db->select($query);
       
        if ($getuser) {
             while ($result = $getuser->fetch_assoc()) {
      
        ?>               
         <form action="" method="post">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>User Name</label>
                    </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $result['username'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" name="email" value="<?php echo $result['email'];?>" class="medium" />
                    </td>
                </tr>
             
                
                
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="details">
                            <?php echo $result['details'];?>
                        </textarea>
                    </td>
                </tr>
                
                
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } }?>
        </div>
    </div>
</div>
<?php include"inc/footer.php";?>