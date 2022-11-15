<?php include"inc/header.php";?>


<?php
	if (!isset($_GET['search']) || $_GET['search'] == NULL) {
		header("Location: 404.php");
	}else{
		$serach = $_GET['search'];
	}
?>
<div class="contentsection contemplete clear">
<div class="maincontent clear">
	<?php
		$query = "SELECT * FROM db_post WHERE title LIKE '%$serach%' or body LIKE '%$serach%'";
		$search  = $db->select($query);
		if ($search) {
			while ($result = $search->fetch_assoc()) {	
		?>
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php  echo $result['id']; ?>"><?php echo $result['title'];?></a></h2>
			<h4><?php echo $fm->formatDate($result['date']);?> <a href="#"><?php echo $result['author'];?></a></h4>
			<a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
			<?php echo $fm->textShorten($result['body']);?>
			<div class="readmore clear">
				<a href="post.php?id=<?php  echo $result['id']; ?>">Read More</a>
			</div>
		</div>
			<?php } }else{echo "Search Keyword not found !!.";} ?>
</div>
<?php include"inc/sidebar.php"?>
<?php include"inc/footer.php"?>