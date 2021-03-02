<?php
// contains Database
 include "./includes/db.php";
     if(!isset($_SESSION['username'])){
        header('location:index.php');
    }
?>

<!-- Includes header file in each page -->
<?php include "./includes/header.php"; ?>

<!-- Includes Navigation file in each page -->
<?php include "./includes/nav_bar.php"; ?>

<!--  Fetch all user data  and display in tabular form -->

	<div class="container" style="position: absolute;top: 25px;margin-left: 10%;width:95%">
		<table class="table table-bordered table-stripped table-row table-hover table-condensed">
			<tr class="table-primary">
				<th>Sl. No</th>
				<th>Image</th>
				<th>UserName</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Date Of Birth</th>
				<th>Mobile</th>
				<!-- <th>Address</th> -->
				
				<th>Operations</th>
			</tr>
 <?php
 	$query= "Select * from `user`";
 	if ($result= mysqli_query($conn, $query)) {
 		$count = 0;
  // Fetch one and one row
     while ($row = mysqli_fetch_array($result)) {
     	// var_dump($row);
  
 ?>
			<tr>
				<td><?php $count = $count+1; echo $count; ?> </td>
				<td> <?php $src = "./uploads/".$row['photo'];  ?> <img src="<?php echo $src ?>" height="100px" width="110px" alt="Not Found"> </td>
				<!-- It conatins the link -->
				<td><?php echo $row['name']; ?></td>
				<td title="Click Here to Know More"><a href="user_details.php?email=<?php echo $row['email']; ?>"  ><?php echo $row['email']; ?></a></td>
				<td> <?php echo $row['gender']; ?> </td>
				<td> <?php echo date('F d, Y', strtotime($row['dob'])) ; ?> </td>
				<td> <?php echo $row['mobile']; ?> </td>
				<!-- <td> <?php echo $row['permanent_address']; ?> </td> -->
				<td>
				
				<a href="edit_user_data.php?email=<?php echo $row['email']; ?>"><i class="fa fa-edit" style="font-size: 30px ;padding: 5px;margin-left: 10px" title="Edit"></i></a> 
				
				<?php if($_SESSION['username'] !== $row['email']){ ?>

				<form action="delete.php?email=<?php echo $row['email'] ?>" method="POST">
				<button type="submit" name="deleteUser" id="deleteUser" value="<?php echo $row['email'] ?>" onclick= "return confirmToDelete()" ><img src="./images/navigation_icon/icons8-delete-bin-24.png" ></button>
				</form>
				<?php }?>
			</td>
				
			</tr>
	<!-- contains While loop bracket -->
	<?php 
			}
		}

	 ?>
			
		</table>
	</div>
</div>

<!-- This javascript function ask for confirmation before delete a user -->
<script>
 function confirmToDelete($email){
	 $value = document.getElementById('deleteUser').value;
	 $res = confirm("Press OK to delete or Cancel."); 
	 return $res;
 }
</script>
</body>
</html>