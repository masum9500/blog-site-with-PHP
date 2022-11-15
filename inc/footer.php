<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	    <?php
				$query = "SELECT * FROM copy_right WHERE id = '1'";
    			$copyright = $db->select($query);
    			if ($copyright) {
        			while ($result = $copyright->fetch_assoc()) {
            
		?>
	  <p>&copy; <?php echo $result['copy'];?></p>
	<?php } }?>
	</div>
	<div class="fixedicon clear">
		<?php
			$query = "SELECT * FROM tbl_social WHERE id = '1'";
			$blog_social = $db->select($query);
			if ($blog_social) {
    			while ($result = $blog_social->fetch_assoc()) {
            
		?>
		<a href="<?php echo $result['fb'];?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['tw'];?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['ln'];?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['gp'];?>"><img src="images/gl.png" alt="GooglePlus"/></a>
	<?php } }?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>