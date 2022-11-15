<?php 
include"../lib/Seassion.php";
Seassion::checkSession();

?>
<?php include"../config/config.php";?>
<?php include"../lib/Database.php";?>
<?php include"../helpers/Format.php";?>

<?php 
$db = new Database();
?>

<?php
		if (!isset($_GET['deleteslider'])|| $_GET['deleteslider'] == NULL) {
			echo "<script>window.location = 'sliderlist.php';</script>";
		}else{
		  $delslidertid = $_GET['deleteslider'];
		  $query = "SELECT * FROM tbl_slider WHERE id = '$delslidertid'";
		  $getData = $db->select($query);
		  if ($getData) {
		  	while ($delimg = $getData->fetch_assoc()) {
		  		$dellink = $delimg['image'];
		  		unlink($dellink);
		  	}
		  }
		  $delquery = "DELETE FROM tbl_slider WHERE id = '$delslidertid'";
		  $delete_post = $db->delete($delquery);
		  if ($delete_post) {
               echo "<script>alert('Data Deleted Succeccfully');</script>";
               echo "<script>window.location = 'sliderlist.php';</script>";
           }else{
                echo "<span style='color:green;font-size:18px'>Data Not Deleted Sucessfully..</span>";
            }
           }

	
?>