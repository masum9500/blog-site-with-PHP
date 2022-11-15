 <?php include"inc/header.php";?>
 <?php if (Seassion::get('UserRole')!='1') {
echo "<script>window.location = 'index.php';</script>";
}
?>
<div class="grid_10">
<div class="box round first grid">
  <h2>Add New User</h2>
  <div class="block copyblock">
   <?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $fm->validation($_POST['username']);
        $password = $fm->validation(md5($_POST['password']));
        $email = $fm->validation($_POST['email']);
        $role = $fm->validation($_POST['role']);

        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);
        $email = mysqli_real_escape_string($db->link, $email);
        $role = mysqli_real_escape_string($db->link, $role);
       if (empty($username) || empty($password)  || empty($email) || empty($role)) { 
           echo "<span style='color:red;font-size:18px'>Find munst not be empty !</span>";
       }else{

       $mailquery = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
       $mailcheck = $db->select($mailquery);
       if ($mailcheck == true) {
         echo "<span style='color:red;font-size:18px'>Email Already Exist !</span>";
       }else{
        $query = "INSERT INTO tbl_user (username, password, email, role)  VALUES('$username', '$password', '$email', '$role')";
        $catinsert = $db->insert($query);
        if ($catinsert) {
            echo "<span style='color:green;font-size:18px'>User Created Sucessfully..</span>";
        }else{
          echo "<span style='color:green;font-size:18px'>User Not Created..</span>";
        }
       }
     }
   }
   ?> 
    <form action="" method="post">
      <table class="form">					
        <tr>
            <td>
              <label>User name</label>
            </td>
            <td>
                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
            </td>
        </tr>
        <tr>
            <td>
              <label>Password</label>
            </td>
            <td>
                <input type="text" name="password" placeholder="Enter Password..." class="medium" />
            </td>
        </tr>
        <tr>
            <td>
              <label>Email</label>
            </td>
            <td>
                <input type="text" name="email" placeholder="Enter Valid Email..." class="medium" />
            </td>
        </tr>
        <tr>
            <td>
              <label>User Role</label>
            </td>
            <td>
                <select class="select" name="role">
                  <option>Select User Role</option>
                  <option value="1">Admin</option>
                  <option value="2">Author</option>
                  <option value="3">Editor</option>
                </select>
            </td>
        </tr>
        <tr> 
          <td></td>
          <td>
              <input type="submit" name="submit" Value="Create" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
<?php include"inc/footer.php";?>