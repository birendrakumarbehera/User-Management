<?php
	include "./includes/db.php";
	    if(!isset($_SESSION['username'])){
        header('location:index.php');
    }
	$email = $_GET['email'];
	// $query = "SELECT * from `user` INNER JOIN `education` on user.email = education.email where email = '$email'";
	$query = "SELECT * from `user` LEFT JOIN `education` on user.email = education.email where user.email = '$email'";
	$result = mysqli_query($conn,$query);

?>

<?php include "./includes/header.php" ?>

<?php include "./includes/nav_bar.php"; ?>

	<?php

	while ($row = mysqli_fetch_array($result)) {
        

    ?>

	<div class="container" style="position: absolute;top: 20px;margin-left: 20%">
		<div class="container">
  <div class="row">
    <div class="col-6">
      <table >
      	<h3><u>Personal Details</u></h3>
      	<tr>
      		<td>Name :</td>
      		<td><?php printf ("%s", $row["name"]); ?></td>
      	</tr>

      	<tr>
      		<td>Gender :</td>
      		<td><?php printf ("%s", $row["gender"]); ?> </td>
      	</tr>

      	<tr>
      		<td>Age :</td>
      		<td><?php printf ("%s", $row["dob"]); ?> </td>
      	</tr>

      	<tr>
      		<td>Marital Status :</td>
      		<td><?php printf ("%s", $row["marital_status"]); ?> </td>
      	</tr>


      <!-- 	<tr>
      		<td>Nationality :</td>
      		<td><?php printf ("%s", $row["nationality"]); ?> </td>
      	</tr> -->

      	
      </table>
    </div>
    <div class="col-6">
       <?php $src = "./uploads/".$row['photo'];  ?> <img src="<?php echo $src ?>" height="150px" width="200px" alt="Not Found">
    </div>
    
  </div>
<hr class="hr-3">

<h3>Address </h3>
<div class="container">
<div class="row">
	<div class="col-4">
		<h5> </h5>
		<p><?php printf ("%s", $row["permanent_address"]); ?> </p>
	</div>

	
 </div>
</div>

<hr class="hr-3">

<h3>Contacts</h3>
<a href="tel:<?php printf ('%s', $row['mobile']); ?>" ><img src="images/navigation_icon/phone.png" height="25px" width="25px"> <?php printf ('%s', $row['mobile']); ?></a> 
<a href="mailto:<?php printf ('%s', $row['email']); ?>"> <img src="images/navigation_icon/email.jpg" height="25px" width="25px"><?php printf ('%s', $row['email']); ?> </a>

<hr class="hr-3">

<h3>Educational Background </h3>
<?php $row1 = $row['matriculation'];
              $row2 = $row['intermediate'];
              $row3 = $row['graduation'];
              $row4 = $row['post_graduation'];
        $matriculation = preg_split ("/\,/", $row1); 
        $intermediate = preg_split ("/\,/", $row2); 
        $graduation = preg_split ("/\,/", $row3); 
        $post_graduation = preg_split ("/\,/", $row4);  
        ?>


<p><?php echo "School : ".$matriculation[0].", Board : ".$matriculation[1]." from ".$matriculation[2]." to ".$matriculation[3]." with percentage/Cgpa of ".$matriculation[4]?> </p>
<p><?php echo "School : ".$intermediate[0].", Board : ".$intermediate[1]." from ".$intermediate[2]." to ".$intermediate[3]." with percentage/Cgpa of ".$intermediate[4]?> </p>
<p><?php echo "College : ".$graduation[0].", Board : ".$graduation[1]." from ".$graduation[2]." to ".$graduation[3]." with percentage/Cgpa of ".$graduation[4]?> </p>
<p><?php echo "College : ".$post_graduation[0].", Board : ".$post_graduation[1]." from ".$post_graduation[2]." to ".$post_graduation[3]." with percentage/Cgpa of ".$post_graduation[4]?> </p>


<button class="btn btn-secondary btn-lg " onclick="document.location='dashboard.php'"></span>Back</button>
<button type="button" class="btn btn-primary btn-lg" onclick="document.location='edit_user_date.php?email=<?php echo $row['email']; ?>"><a href="edit_user_data.php?email=<?php echo $row['email']; ?>" style="background: none;color: white;width:100%;">Edit</button>


		
	</div>

	<?php

}

	?>

</body>
</html>