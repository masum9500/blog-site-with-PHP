
<?php include"inc/header.php";?>
<?php include"inc/fildpost.php";?>
<?php
$msgid  = mysqli_real_escape_string($db->link, $_GET['msgid']);
if (!isset($msgid) || $msgid == NULL) {
  echo "<script>window.location = 'inbox.php';</script>";
 // header("Location:catlist.php");

}else{
  $id = $_GET['msgid'];
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>View Message</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $to       = $fm->validation($_POST['toEmail']);
            $from     = $fm->validation($_POST['fromEmail']);
            $subject  = $fm->validation($_POST['subject']);
            //$message  = $fm->validation($_POST['body']);
            $message  = mysqli_real_escape_string($db->link, $_POST['body']);

            $sendmail = mail($to, $subject, $message, $from);
            if ($sendmail) {
               echo "Message sent Successfully";
            }else{
                echo "Message not sent";
            }
        }
        ?>
        
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
                        <label>To</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['email'];?>" name="toEmail" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input type="text" name="fromEmail" class="medium" />
                    </td>
                </tr>

               <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input type="text" name="subject" class="medium" />
                    </td>
                </tr>
             
                
                
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            
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