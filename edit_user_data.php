<?php
 include "includes/db.php";
    if(!isset($_SESSION['username'])){
        header('location:index.php');
    } 

$email = $_GET['email'];

// This contains all data to update 
if(isset($_POST['edit_user_data'])){
  // echo " You are here";
  $name = $_POST['name'];
  // $email = $_POST['email'];
  $password = $_POST['password'];
  $gender=$_POST['gender'];
  // $dob=$_POST['dob'];
  $permanent_address = $_POST['permanentAddress'];
  $marital_status = $_POST['maritalStatus'];
  $mobile = $_POST['mobile'];

// Image Upload
  $targetDir = "uploads/";
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  //$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$query = "UPDATE  `user` SET name = '$name',password = '$password',gender = '$gender',permanent_address = '$permanent_address',marital_status = '$marital_status',mobile = '$mobile'";
  if(!empty($_FILES["file"]["name"])){
     if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
            $photo = $fileName;
            $query.= ",photo = '$photo'";
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
  }
  // echo $query;

             $query.=" WHERE email = '$email' ";
            //  echo $query;
             $result= mysqli_query($conn,$query);



            $matriculation = $_POST['matriculation_school_name'].",".$_POST['matriculation_board_name'].",".$_POST['matriculation_starting_year'].",".$_POST['matriculation_ending_year'].",".$_POST['matriculation_score'] ;
            $intermediate = $_POST['intermediate_school_name'].",".$_POST['intermediate_board_name'].",".$_POST['intermediate_starting_year'].",".$_POST['intermediate_ending_year'].",".$_POST['intermediate_score'] ;
            $graduation = $_POST['graduation_school_name'].",".$_POST['graduation_board_name'].",".$_POST['graduation_starting_year'].",".$_POST['graduation_ending_year'].",".$_POST['graduation_score'] ;
            $post_graduation = $_POST['post_graduation_school_name'].",".$_POST['post_graduation_board_name'].",".$_POST['post_graduation_starting_year'].",".$_POST['post_graduation_ending_year'].",".$_POST['post_graduation_score'] ;
            // $doctorate = $_POST['doctorate_school_name'].",".$_POST['doctorate_board_name'].",".$_POST['mdoctorate_starting_year'].",".$_POST['doctorate_ending_year'].",".$_POST['doctorate_score'] ;


            $equery = "UPDATE  `education` SET matriculation = '$matriculation',intermediate = '$intermediate',graduation = '$graduation',post_graduation = '$post_graduation' WHERE email = $email";
            $education_result = mysqli_query($conn,$equery);


            echo "<script>
                    alert('Data is Updated');
                    window.location.href='./dashboard.php';
                    </script>";
          }
          else{
            // echo " You are outside else block";
          }

 ?>


<?php include "./includes/header.php" ?>

<?php include "./includes/nav_bar.php"; ?>

  <?php
    $query = "SELECT * from `user` LEFT JOIN `education` on user.email = education.email where user.email = '$email'";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_array($result)) {

    ?>

<div class="col-md-6" style="position: absolute;top: 20px;margin-left: 28%"  >
  <form method="POST" action="edit_user_data.php?email=<?=$email?>" enctype="multipart/form-data">
    <h3>Personal Information</h3>
    <div class="container">

    <!-- This division contains input for user name -->
      <div class="form-group">
        <label for="userName">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required="required" value="<?php printf ("%s", $row["name"]); ?>">
      </div>
     
    <!-- This division contains input for date of birth -->
      <div class="form-group">
        <label for="dob">DOB : </label>
        <input type="text" class="form-control" id="datepicker" name="dob" required="required"  value=" <?php echo date("d/m/Y", strtotime($row['dob'])); ?>" disabled>
        <script> 
            $( function() {
    $( "#datepicker" ).datepicker();
  } );

</script>
     
      </div>
    <!-- This division contains input for Gender -->
     <div class="form-group">
        <label for="Gender">Gender</label>
        <select name="gender" id="gender" class="form-control">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Others">Others</option>
        </select>
      </div>

<!-- This division contains input for Marital status -->
      <div class="form-group">
        <label for="MaritalStatus">Marital Status</label>
        <select name="maritalStatus" id="maritalStatus" class="form-control">
        <option value="unmarried">Unmaried</option>
        <option value="married">Married</option>
        <option value="divorced">Divorced</option>
        </select>
      </div>
    </div>

<!-- This division contains input for profile photo -->
    <div class="form-group" >
      <label for="profilePhoto">Profile Photo</label>
      <?php $src = "./uploads/".$row['photo'];  ?>
      <img src="<?php echo $src ?>" height="100px" width="100px" alt="No Image Avalible">
      <input type="file" name="file" id="file" accept="image/*" >
      <!-- <input type="submit" value="Upload Image" name="submit"> -->

    </div>

  <h3>Account Information</h3>
  <div class="container">

<!-- This division contains input for email -->
    <div class="form-group ">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email" required="required" value="<?php printf ('%s', $row['email']); ?>" disabled> 
    </div>

    <!-- This division contains input for password -->
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="required" value="<?php printf ('%s', $row['password']); ?>">
    </div>

<!-- This division contains input for address -->
    <div class="form-group">
      <label for="permanentAddress">Address : </label>
      <input type="text" width="40" name="permanentAddress" class="form-control" value="<?php printf ("%s", $row["permanent_address"]); ?>">
        
      </textarea>
    </div>

<!-- This division contains input for Mobile -->
      <div class="form-group">
      <label for="mobile">Mobile : </label>
      <input type="text" class="form-control" id="mobile" name="mobile" value="<?php printf ('%s', $row['mobile']); ?>">
     </div>
   
    <hr class="hr_3"></hr>
    <!-- This division contains educational details -->
  <h3>Education</h3>

    <?php $row1 = $row['matriculation'];
              $row2 = $row['intermediate'];
              $row3 = $row['graduation'];
              $row4 = $row['post_graduation'];
        $matriculation = preg_split ("/\,/", $row1); 
        $intermediate = preg_split ("/\,/", $row2); 
        $graduation = preg_split ("/\,/", $row3); 
        $post_graduation = preg_split ("/\,/", $row4);  
        ?>

      <div class="container">
      <h4>Matriculation</h4>
        <div class="container">
          <label for="fname">School Name:</label>
          <input type="text" id="matriculation_school_name" name="matriculation_school_name" class="form-control" value="<?php echo $matriculation[0] ?>">
          <label for="boardname">Board Name/University Name:</label>
          <input type="text" id="matriculation_board_name" name="matriculation_board_name" class="form-control" value="<?php echo $matriculation[1] ?>">
          <label for="matriculation_starting_year">Start Year:</label>
          <input type="date" id="matriculation_starting_year" name="matriculation_starting_year" class="form-control" value="<?php echo $matriculation[2] ?>">
          <label for="matriculation_ending_year">End Year:</label>
          <input type="date" id="matriculation_ending_year" name="matriculation_ending_year" class="form-control" value="<?php echo $matriculation[3] ?>">
          <label for="matriculation_score">Percentage/CGPA:</label>
          <input type="text" id="matriculation_score" name="matriculation_score" class="form-control" value="<?php echo $matriculation[4] ?>">
        </div>
      </div>
      <br>

      <div class="container">
      <h4>Intermediate</h4>
        <div class="container">
          <label for="fname">School/College Name:</label>
          <input type="text" id="intermediate_school_name" name="intermediate_school_name" class="form-control" value="<?php echo $intermediate[0] ?>">
          <label for="boardname">Board Name/University Name:</label>
          <input type="text" id="intermediate_board_name" name="intermediate_board_name" class="form-control" value="<?php echo $intermediate[1] ?>">
          <label for="intermediate_starting_year">Start Year:</label>
          <input type="date" id="intermediate_starting_year" name="intermediate_starting_year" class="form-control" value="<?php echo $intermediate[2] ?>">
          <label for="intermediate_ending_year">End Year:</label>
          <input type="date" id="intermediate_ending_year" name="intermediate_ending_year" class="form-control" value="<?php echo $intermediate[3] ?>">
          <label for="intermediate_score">Percentage/CGPA:</label>
          <input type="text" id="intermediate_score" name="intermediate_score" class="form-control" value="<?php echo $intermediate[4] ?>">
        </div>
      </div>
      <br>

      <div class="container">
      <h4>Graduation:</h4>
        <div class="container">
          <label for="fname">College Name:</label>
          <input type="text" id="graduation_school_name" name="graduation_school_name" class="form-control" value="<?php echo $graduation[0] ?>">
          <label for="boardname">Board Name/University Name:</label>
          <input type="text" id="graduation_board_name" name="graduation_board_name" class="form-control" value="<?php echo $graduation[1] ?>">
          <label for="graduation_starting_year">Start Year:</label>
          <input type="date" id="graduation_starting_year" name="graduation_starting_year" class="form-control" value="<?php echo $graduation[2] ?>">
          <label for="graduation_ending_year">End Year:</label>
          <input type="date" id="graduation_ending_year" name="graduation_ending_year" class="form-control" value="<?php echo $graduation[3] ?>">
          <label for="graduation_score">Percentage/CGPA:</label>
          <input type="text" id="graduation_score" name="graduation_score" class="form-control" value="<?php echo $graduation[4] ?>">
        </div>
      </div>
      <br>


      <div class="container">
        <h4>Post Graduation:</h4>
        <div class="container">
          <label for="fname">College Name:</label>
          <input type="text" id="post_graduation_school_name" name="post_graduation_school_name" class="form-control" value="<?php echo $post_graduation[0] ?>">
          <label for="boardname">Board Name/University Name:</label>
          <input type="text" id="post_graduation_board_name" name="post_graduation_board_name" class="form-control" value="<?php echo $post_graduation[1] ?>">
          <label for="post_graduation_starting_year">Start Year:</label>
          <input type="date" id="post_graduation_starting_year" name="post_graduation_starting_year" class="form-control" value="<?php echo $post_graduation[2] ?>">
          <label for="post_graduation_ending_year">End Year:</label>
          <input type="date" id="post_graduation_ending_year" name="post_graduation_ending_year" class="form-control" value="<?php echo $post_graduation[3] ?>">
          <label for="graduation_score">Percentage/CGPA:</label>
          <input type="text" id="post_graduation_score" name="post_graduation_score" class="form-control" value="<?php echo $post_graduation[4] ?>">
        </div>
      </div>
      <br>


   <!-- This division contains submit button to save data -->
     <button type="submit" class="btn btn-primary btn-lg"  name="edit_user_data" style="width:100%">Save</button>

     <br> <br>  <br>  
    </form>
</div>

<?php
 }
 ?>

    
</body>
</html>