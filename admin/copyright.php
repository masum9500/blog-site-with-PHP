<?php include"inc/header.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $copy = $fm->validation($_POST['copy']);
                    $copy    = mysqli_real_escape_string($db->link, $copy);

                    if (empty($copy)) {
                       echo "<span style='color:red;font-size:18px'>Find munst not be empty !</span>";
                    }else{
                        $updatequery = "UPDATE  copy_right  SET  copy = '$copy' WHERE id = '1' ";
                        $update_row = $db->update($updatequery);
                        if ($update_row) {
                             echo "<span style='color:green;font-size:18px'>Data Updated Successfully.
                             </span>";
                        }else {
                            echo "<span style='color:red;font-size:18px'>Data Not Updated !</span>";
                        }
                    }
                }
                ?>
                <div class="block copyblock">
                <?php 
                    $query = "SELECT * FROM copy_right  WHERE id = '1'";
                    $copyright = $db->select($query);
                    if ($copyright) {
                        while ($result = $copyright->fetch_assoc()) {
                ?> 
                 <form action="" method="post">
                    <table class="form">	
                   			
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['copy'];?>" name="copy" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
        <?php include"inc/footer.php";?>
