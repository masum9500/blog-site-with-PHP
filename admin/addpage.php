
<?php include"inc/header.php";?>
<?php include"inc/fildpost.php";?>

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
                    $query = "INSERT INTO tbl_page (name, body) 
                    VALUES('$name', '$body')";

                    $inserted_rows = $db->insert($query);
                    if ($inserted_rows) {
                         echo "<span style='color:green;font-size:18px'>Page created  Successfully.
                         </span>";
                    }else {
                        echo "<span style='color:red;font-size:18px'>Page Not created  Successfully !</span>";
                    }
                 }
         }
        ?>
        <div class="block">               
         <form action="" method="post" >
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                    </td>
                </tr>
             
                
                
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
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
        </div>
    </div>
</div>
<?php include"inc/footer.php";?>