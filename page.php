<?php include"inc/header.php"?>
<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
  echo "<script>window.location = 'postlist.php';</script>";
 // header("Location:catlist.php");

}else{
  $id = $_GET['pageid'];
}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
			<?php
				$query = "SELECT * FROM tbl_page WHERE id='$id'";
				$page = $db->select($query);
				if ($page) {
	    			while ($result = $page->fetch_assoc()) {
	            
			?>
				<h2><?php echo $result['name'];?></h2>
				<?php echo $result['body'];?>
	
			<?php } }?>
	</div>

		</div>
		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
					<ul>
						<li><a href="#">Category One</a></li>
						<li><a href="#">Category Two</a></li>
						<li><a href="#">Category Three</a></li>
						<li><a href="#">Category Four</a></li>
						<li><a href="#">Category Five</a></li>						
					</ul>
			</div>
			
<?php include"inc/sidebar.php"?>			
<?php include"inc/footer.php"?>
