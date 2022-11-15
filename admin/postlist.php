<?php include"inc/header.php";?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="3%">No.</th>
					<th width="15%">Post Title</th>
					<th width="27%">Description</th>
					<th width="5%">Category</th>
					<th width="10%">Image</th>
					<th width="5%">Author</th>
					<th width="7%">Tags</th>
					<th width="13%">Date</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT db_post. *, tbl_category.name FROM db_post INNER JOIN tbl_category ON db_post.cat = tbl_category.id ORDER BY db_post.title desc";
					$post = $db->select($query);
					if ($post) {
						$i = 0;
						while ($result =$post->fetch_assoc() ) {
							$i++;
				?>	
				<tr class="odd gradeX">
					<td width="3%"><?php echo $i;?></td>
					<td width="15%"><?php echo $result['title'];?></td>
					<td width="27%"><?php echo $fm->textShorten( $result['body'], 50);?></td>
					<td width="5%"><?php echo $result['name'];?></td>
					<td width="10%" style="margin-top: 10px"><img src="<?php echo $result['image'];?>" alt="post image" height="40px" width="70px" style="margin-top: 10px"/></td>
					<td width="5%"><?php echo $result['author'];?></td>
					<td width="7%"><?php echo $result['tags'];?></td>
					<td width="13%"><?php echo $fm->formatDate($result['date']);?></td>
					<td width="10%">
						<?php
						if (Seassion::get('UserId')==$result['userid'] || Seassion::get('UserRole') == '1') {?>
							<a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a> || 
							<a onclick="return confirm('Are you sure to Delete!');" href="deletpost.php?deletepost=<?php echo $result['id']?>">Delete</a>
						<?php }?>
						
					</td>
				</tr>
				<?php } }?>
			</tbody>
		</table>

       </div>
    </div>
</div>
<?php include"inc/footer.php";?>
<script type="text/javascript">
$(document).ready(function () {
    setupLeftMenu();
    $('.datatable').dataTable();
	setSidebarHeight();
});
</script>
