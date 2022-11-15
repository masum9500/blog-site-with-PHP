
<?php include "inc/header.php";?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

		<?php
		if (isset($_GET['deluser'])) {
		  $id = $_GET['deluser'];
		  $query = "DELETE FROM tbl_user WHERE id = '$id'";
		  $delete_category = $db->delete($query);
		  if ($delete_category) {
               echo "<span style='color:red;font-size:18px'>User Deleted Sucessfully..</span>";
           }else{
                echo "<span style='color:green;font-size:18px'>User Not Deleted .</span>";
            }
           }

	
?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>User Name</th>
					<th>Email</th>
					<th>Details</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * FROM tbl_user ORDER BY id desc";
					$userlist = $db->select($query);
					if ($userlist) {
						$i = 0;
						while ($result =$userlist->fetch_assoc() ) {
							$i++;
				?>				
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['username']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->textShorten($result['details'], 30); ?></td>
					<td>
					<?php 
					if ($result['role']== '0') {
						echo "Admin";
					}elseif ($result['role']== '1') {
						echo "Author";
					}elseif ($result['role']== '2') {
						echo "Editor";
					}
					?>
						
					</td>

					<td><a href="viewuser.php?userid=<?php echo $result['id']?>">View</a>
						<?php if (!Seassion::get('UserRole')=='1') {?>
					  ||<a onclick="return confirm('Are you sure to Delete!!')" href="?deluser=<?php echo $result['id']?>">Delete</a>
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
