<?php include"inc/header.php";?>
<?php include"inc/fildpost.php";?>

<?php
if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
  echo "<script>window.location = 'inbox.php';</script>";
 // header("Location:catlist.php");

}else{
  $id = $_GET['userid'];
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           echo "<script>window.location = 'userlist.php';</script>";
        }
//AND role='$userrole'
        ?>
        <div class="block">
        <?php 
        $query = "SELECT * FROM tbl_user WHERE id='$id'";
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
                        <input type="text" value="<?php echo $result['name'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>User Name</label>
                    </td>
                    <td>
                        <input type="text"  value="<?php echo $result['username'];?>" class="medium" />
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
                        <textarea class="tinymce" >
                            <?php echo $result['details'];?>
                        </textarea>
                    </td>
                </tr>
                
                
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Ok" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } }?>
        </div>
    </div>
</div>
<?php include"inc/footer.php";?>