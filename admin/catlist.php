
<?php include "inc/header.php";?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

		<?php
		if (isset($_GET['delcat'])) {
		  $id = $_GET['delcat'];
		  $query = "DELETE FROM tbl_category WHERE id = '$id'";
		  $delete_category = $db->delete($query);
		  if ($delete_category) {
               echo "<span style='color:red;font-size:18px'>Category Deleted Sucessfully..</span>";
           }else{
                echo "<span style='color:green;font-size:18px'>Inserted Sucessfully..</span>";
            }
           }

	
?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * FROM tbl_category ORDER BY id desc";
					$category = $db->select($query);
					if ($category) {
						$i = 0;
						while ($result =$category->fetch_assoc() ) {
							$i++;
				?>				
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><a href="edit.php?catid=<?php echo $result['id']?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete!!')" href="?delcat=<?php echo $result['id']?>">Delete</a></td>
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
