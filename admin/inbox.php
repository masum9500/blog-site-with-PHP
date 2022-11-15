<?php include"inc/header.php";?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        if (isset($_GET['seenid'])) {
        	$seenid = $_GET['seenid'];
        	$updatequery = "UPDATE  tbl_contact  SET  status = '1' WHERE id = '$seenid' ";

                        $update_row = $db->update($updatequery);
                        if ($update_row) {
                             echo "<span style='color:green;font-size:18px'>Seen Successfully.
                             </span>";
                        }else {
                            echo "<span style='color:red;font-size:18px'>Seen Not Successfully !</span>";
                        }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$query = "SELECT * FROM tbl_contact WHERE status  = '0' ORDER BY id desc";
			$contact = $db->select($query);
			if ($contact) {
				$i = 0;
				while ($result =$contact->fetch_assoc() ) {
					$i++;
			?>	
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['firstname'];?> <?php echo $result['lastname'];?></td>
					<td><?php echo $result['email'];?></td>
					<td><?php echo $fm->textShorten($result['body'],30);?></td>
					<td><?php echo $fm->formatDate($result['date']);?></td>
					
					<td>
						<a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> || 
						<a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a> ||
						<a onclick="return confirm('Are you sure to Seen box!');" href="?seenid=<?php echo $result['id'];?>">Seen</a>
					</td>
				</tr>
			<?php } }?>	
				
				
			</tbody>
		</table>
       </div>
    </div>





    <div class="box round first grid">
        <h2>Seen Message</h2>
        <?php
        if (isset($_GET['delid'])) {
        	$delid = $_GET['delid'];
        	$delquery = "DELETE FROM tbl_contact WHERE id = '$delid'";
                $update_row = $db->delete($delquery);
                if ($update_row) {
                     echo "<span style='color:green;font-size:18px'>Delete Successfully.
                     </span>";
                }else {
                    echo "<span style='color:red;font-size:18px'>Seen Not Successfully !</span>";
                }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$query = "SELECT * FROM tbl_contact WHERE status  = '1' ORDER BY id desc";
			$contact = $db->select($query);
			if ($contact) {
				$i = 0;
				while ($result =$contact->fetch_assoc() ) {
					$i++;
			?>	
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['firstname'];?> <?php echo $result['lastname'];?></td>
					<td><?php echo $result['email'];?></td>
					<td><?php echo $fm->textShorten($result['body'],30);?></td>
					<td><?php echo $fm->formatDate($result['date']);?></td>
					
					<td>
						<a onclick="return confirm('Are you sure to Delete!');" href="?delid=<?php echo $result['id'];?>">Delete</a> 
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