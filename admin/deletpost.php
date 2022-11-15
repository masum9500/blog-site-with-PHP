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
		if (!isset($_GET['deletepost'])|| $_GET['deletepost'] == NULL) {
			echo "<script>window.location = 'postlist.php';</script>";
		}else{
		  $delpostid = $_GET['deletepost'];
		  $query = "SELECT * FROM db_post WHERE id = '$delpostid'";
		  $getData = $db->select($query);
		  if ($getData) {
		  	while ($delimg = $getData->fetch_assoc()) {
		  		$dellink = $delimg['image'];
		  		unlink($dellink);
		  	}
		  }
		  $delquery = "DELETE FROM db_post WHERE id = '$delpostid'";
		  $delete_post = $db->delete($delquery);
		  if ($delete_post) {
               echo "<script>alert('Data Deleted Succeccfully');</script>";
               echo "<script>window.location = 'postlist.php';</script>";
           }else{
                echo "<span style='color:green;font-size:18px'>Data Not Deleted Sucessfully..</span>";
            }
           }

	
?>