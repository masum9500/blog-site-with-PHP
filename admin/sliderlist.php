<?php include"inc/header.php";?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="10%">No.</th>
					<th width="30%">Slider Title</th>					
					<th width="40%">Slider Image</th>					
					<th width="20">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * FROM tbl_slider";
					$post = $db->select($query);
					if ($post) {
						$i = 0;
						while ($result =$post->fetch_assoc() ) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td width="10%"><?php echo $i;?></td>
					<td width="30%"><?php echo $result['title'];?></td>
					<td width="40%" style="margin-top: 10px"><img src="<?php echo $result['image'];?>" alt="post image" height="50px" width="100px" style="margin-top: 10px"/></td>
					<td width="20">
						<?php
						if (Seassion::get('UserRole') == '1') {?>
							<a href="editsider.php?editsliderid=<?php echo $result['id'];?>">Edit</a> || 
							<a onclick="return confirm('Are you sure to Delete!');" href="deletslider.php?deleteslider=<?php echo $result['id']?>">Delete</a>
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
