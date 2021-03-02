<?php
 include "includes/db.php";
 
    if(!isset($_SESSION['username'])){
        header('location:index.php');
    }

if(isset($_POST['add_user'])){
  // echo " You are here";
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $gender=$_POST['gender'];
  $dob=$_POST['dob'];
  $permanent_address = $_POST['permanentAddress'];
  $marital_status = $_POST['maritalStatus'];
  $mobile = $_POST['mobile'];

  // Validating Input fields
      if(strlen($name)<4){
          echo "<script>alert('Name should not be so small');</script>";
      }
      else if(strlen($password)< 8){
        echo "<script>alert('Password length should not be less than 8');</script>";
      }
      
      else if(strlen($mobile)!=10){
        echo "<script>alert('Invalid mobile number');</script>";
      }

      
      else{
          // Image Upload
            $targetDir = "uploads/";
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            //$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(!empty($_FILES["file"]["name"])){
              if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                      $photo = $fileName;
                  }else{
                      $statusMsg = "Sorry, there was an error uploading your file.";
                  }
            }

          // Check if already register or not using email as unique key

            $fetch_email = "SELECT * from `user` where email = '$email'";
            //$output = mysqli_query($conn,$fetch_email);
            if ($result4= mysqli_query($conn, $fetch_email)) {
                  " You are inside result4 if block";
            // Fetch one and one row
              while ($row = mysqli_fetch_row($result4)) {
                // var_dump($row);
                // If email is already present then show message and exit
                if($row[2] == $email){
                  echo "<script>alert('Your Email is already registered')</script>";
                  exit(0);
                }
              }             

                  // If this is new user then insert data

                      $query = "INSERT INTO `user` (`id`,`name`,`email`,`password`,`gender`,`dob`,`permanent_address`,`marital_status`,`mobile`,`photo`) values(NULL,'$name','$email','$password','$gender','$dob','$permanent_address','$marital_status','$mobile','$photo')";
                      $result= mysqli_query($conn,$query);



                      $matriculation = $_POST['matriculation_school_name'].",".$_POST['matriculation_board_name'].",".$_POST['matriculation_starting_year'].",".$_POST['matriculation_ending_year'].",".$_POST['matriculation_score'] ;
                      $intermediate = $_POST['intermediate_school_name'].",".$_POST['intermediate_board_name'].",".$_POST['intermediate_starting_year'].",".$_POST['intermediate_ending_year'].",".$_POST['intermediate_score'] ;


                      $graduation = $_POST['graduation_school_name'].",".$_POST['graduation_board_name'].",".$_POST['graduation_starting_year'].",".$_POST['graduation_ending_year'].",".$_POST['graduation_score'] ;
                      $post_graduation = $_POST['post_graduation_school_name'].",".$_POST['post_graduation_board_name'].",".$_POST['post_graduation_starting_year'].",".$_POST['post_graduation_ending_year'].",".$_POST['post_graduation_score'] ;
                  
                    // Query for educational table

                      $equery = "INSERT INTO `education`(`id`,`email`,`matriculation`,`intermediate`,`graduation`,`post_graduation`) values(NULL,'$email','$matriculation','$intermediate','$graduation','$post_graduation') ";
                      $education_result = mysqli_query($conn,$equery);

                      // echo '<script>alert"user successfully added"</script>';
                      echo "<script>
                      alert('User is Successfully Created');
                      window.location.href='./dashboard.php';
                      </script>";
            }
          } 
  }
      

 ?>


<?php include "./includes/header.php" ?>

<?php include "./includes/nav_bar.php"; ?>

<div class="col-md-6" style="position: absolute;top: 20px;margin-left: 30%" >
  <form method="POST" action="user_registration.php" enctype="multipart/form-data">
    <h3>Personal Information</h3>
    <div class="container">

    <!-- This division contains input for Name -->
      <div class="form-group">
        <label for="userName">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required="required">
      </div>
<!-- This division contains input for Date of birth -->
      <div class="form-group">
        <label for="dob">DOB : </label>
        <input type="date" class="form-control" id="dob" name="dob" required="required">
      </div>
<!-- This division contains input for gender -->
     <div class="form-group">
        <label for="Gender">Gender</label>
        <select name="gender" id="gender" class="form-control" >
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

<!-- This division contains input for Profile photo -->
    <div class="form-group">
      <label for="profilePhoto"> Profile Photo</label>
      <input type="file" name="file" id="file" accept="image/*" required="required">
      <!-- <input type="submit" value="Upload Image" name="submit"> -->

    </div>

  <h3>Account Information</h3>
  <div class="container">

<!-- This division contains input for email -->
    <div class="form-group ">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email" required="required" required="required">
      
      <!-- This division contains input for password -->
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="required" required="required">
    </div>

<!-- This division contains input for Confirm Password -->
    <div class="form-group">
      <label for="confirm_password">Re-type Password:</label>
      <input type="password" class="form-control" id="confirm_password" placeholder="Re-type Password" name="confirm_password" required="required">
    </div>
  </div>


  <h3>Contact Information</h3>
    <div class="form-group">
      <label for="Nationality">Nationality : </label>
       <select name="nationality" id="nationality" class="form-control">
      <option value="indian">Indian</option>
      <option value="others">Others</option>
      </select>
    </div>

<!-- This division contains input for address -->
    <div class="form-group">
      <label for="permanentAddress">Address : </label>
      <textarea rows="2" cols="40" name="permanentAddress" class="form-control" required="required">
        
      </textarea>
    </div>

<!-- This division contains input for Mobile -->
      <div class="form-group">
      <label for="mobile">Mobile : </label>
      <input type="text" class="form-control" id="mobile" name="mobile" required="required">
     </div>
   

  
    <!-- Section for Adding Educational Details -->
    <hr class="hr_3"></hr>
  <h3>Education</h3>
      <div class="container">
      <h4>Matriculation</h4>
        <div class="container">
          <label for="fname">School Name:</label>
          <input type="text" id="matriculation_school_name" name="matriculation_school_name" class="form-control" required="required">
          <label for="boardname">Board Name/University Name:</label>
          <input type="text" id="matriculation_board_name" name="matriculation_board_name" class="form-control" required="required">
          <label for="matriculation_starting_year">Start Year:</label>
          <input type="date" id="matriculation_starting_year" name="matriculation_starting_year" class="form-control" required="required">
          <label for="matriculation_ending_year">End Year:</label>
          <input type="date" id="matriculation_ending_year" name="matriculation_ending_year" class="form-control" required="required">
          <label for="matriculation_score">Percentage/CGPA:</label>
          <input type="text" id="matriculation_score" name="matriculation_score" class="form-control" required="required">
        </div>
      </div>
      <br>


      <div class="container">
      <h4>Intermediate</h4>
        <div class="container">
          <label for="fname">School/College Name:</label>
          <input type="text" id="intermediate_school_name" name="intermediate_school_name" class="form-control" required="required">
          <label for="boardname">Board Name/University Name:</label>
          <input type="text" id="intermediate_board_name" name="intermediate_board_name" class="form-control" required="required">
          <label for="intermediate_starting_year">Start Year:</label>
          <input type="date" id="intermediate_starting_year" name="intermediate_starting_year" class="form-control" required="required">
          <label for="intermediate_ending_year">End Year:</label>
          <input type="date" id="intermediate_ending_year" name="intermediate_ending_year" class="form-control" required="required">
          <label for="intermediate_score">Percentage/CGPA:</label>
          <input type="text" id="intermediate_score" name="intermediate_score" class="form-control" required="required">
        </div>
      </div>
      <br>

      <div class="container">
      <h4>Graduation:</h4>
      <!-- <span style="color:red">* If you don't have any degree just put NULL in the field</span> -->
        <div class="container">
          <label for="fname">College Name:</label>
          <input type="text" id="graduation_school_name" name="graduation_school_name" class="form-control" required="required">
          <label for="boardname">Board Name/University Name:</label>
          <input type="text" id="graduation_board_name" name="graduation_board_name" class="form-control" required="required">
          <label for="graduation_starting_year">Start Year:</label>
          <input type="date" id="graduation_starting_year" name="graduation_starting_year" class="form-control" required="required">
          <label for="graduation_ending_year">End Year:</label>
          <input type="date" id="graduation_ending_year" name="graduation_ending_year" class="form-control" required="required">
          <label for="graduation_score">Percentage/CGPA:</label>
          <input type="text" id="graduation_score" name="graduation_score" class="form-control" required="required">

        </div>
      </div>
      <br>

      <div class="container">
        <h4>Post Graduation:</h4>
        <!-- <span style="color:red">* If you don't have any degree just put NULL in the field</span> -->
        <div class="container">
          <label for="fname">College Name:</label>
          <input type="text" id="post_graduation_school_name" name="post_graduation_school_name" class="form-control" required="required">
          <label for="boardname">Board Name/University Name:</label>
          <input type="text" id="post_graduation_board_name" name="post_graduation_board_name" class="form-control" required="required">
          <label for="post_graduation_starting_year">Start Year:</label>
          <input type="date" id="post_graduation_starting_year" name="post_graduation_starting_year" class="form-control" required="required">
          <label for="post_graduation_ending_year">End Year:</label>
          <input type="date" id="post_graduation_ending_year" name="post_graduation_ending_year" class="form-control" required="required">
          <label for="graduation_score">Percentage/CGPA:</label>
          <input type="text" id="post_graduation_score" name="post_graduation_score" class="form-control" required="required">
        </div>
      </div>
      <br>

      <!-- This division contains Registration Button -->
    <div class="container">
     <button type="submit" class="btn btn-primary btn-lg" value="add_user" name="add_user" style="width:100%;">Add User</button>
     <hr class="hr-3">
     </div>
    </form>

  </div>
</div>


    
</body>
</html>