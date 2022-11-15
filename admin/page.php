
<?php include"inc/header.php";?>
<?php include"inc/fildpost.php";?>
<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
  echo "<script>window.location = 'postlist.php';</script>";
 // header("Location:catlist.php");

}else{
  $id = $_GET['pageid'];
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name  = mysqli_real_escape_string($db->link, $_POST['name']);
            $body    = mysqli_real_escape_string($db->link, $_POST['body']);
            

            if ($name == "" || $body == "") {
               echo "<span style='color:red;font-size:18px'>Find munst not be empty !</span>";
            }else{
                    $query = "UPDATE  tbl_page SET name='$name', body = '$body' WHERE id = $id";

                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span style='color:green;font-size:18px'>Page Updated Successfully.
                        </span>";
                    }else {
                        echo "<span style='color:red;font-size:18px'>Page Not Updated !</span>";
                    }
                 }
         }
        ?>
        <div class="block">  

        <?php 
        $query = "SELECT * FROM tbl_page WHERE id = '$id'";
        $getpage = $db->select($query);
        if ($getpage) {
             while ($result = $getpage->fetch_assoc()) {
                 
              
        ?>               
         <form action="" method="post" >
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
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $result['body'];?>
                        </textarea>
                    </td>
                </tr>
               
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Udpate" />
                        <a  onclick="return confirm('Are you sure to Delete This Page !');" href="deletpage.php?deletepage=<?php echo $result['id']?>">Delete</a>
                    </td>
                </tr>
            </table>
            </form>
        <?php } } ?>
        </div>
    </div>
</div>
<?php include"inc/footer.php";?>