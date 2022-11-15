<?php 
include"../lib/Seassion.php";
Seassion::checkSession();

?>
<?php include"../config/config.php";?>
<?php include"../lib/Database.php";?>


<?php 
$db = new Database();
?>

<?php
		if (!isset($_GET['deletepage'])|| $_GET['deletepage'] == NULL) {
			echo "<script>window.location = 'index.php';</script>";
		}else{
		  $delpageid = $_GET['deletepage'];
		  $delquery = "DELETE FROM tbl_page WHERE id = '$delpageid'";
		  $delete_page = $db->delete($delquery);
		  if ($delete_page) {
               echo "<script>alert('Data Deleted Succeccfully');</script>";
               echo "<script>window.location = 'index.php';</script>";
           }else{
                echo "<span style='color:green;font-size:18px'>Data Not Deleted Sucessfully..</span>";
            }
           }

	
?>