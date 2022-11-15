
<?php include"inc/header.php";?>
<?php include"inc/fildpost.php";?>
<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
  echo "<script>window.location = 'inbox.php';</script>";
 // header("Location:catlist.php");

}else{
  $id = $_GET['msgid'];
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php';</script>";
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>View Message</h2>
        
        <div class="block">               
         <form action="" method="post" >
            <?php
        
            $query = "SELECT * FROM tbl_contact WHERE id  = '$id'";
            $contact = $db->select($query);
            if ($contact) {
                while ($result =$contact->fetch_assoc() ) {

        ?>
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname'];?>" class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['email'];?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Date</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $fm->formatDate
                        ($result['date']);?>" class="medium" />
                    </td>
                </tr>
             
                
                
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce">
                            <?php echo $result['body'];?>
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