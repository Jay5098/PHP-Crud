<?php
include "db_conn.php";

$first_name = $last_name = $email = $gender = $password = $confirm_password = "";
$language = [];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $first_name = $_POST['first_name'] ?? "";
   $last_name = $_POST['last_name'] ?? "";
   $email = $_POST['email'] ?? "";
   $gender = $_POST['gender'] ?? "";
   $password = $_POST['password'] ?? "";
   $confirm_password = $_POST['confirm_password'] ?? "";
   $language = $_POST['language'] ?? [];

   $language_str = !empty($language) ? implode(", ", $language) : "";
   if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
      $image_name = $_FILES['image']['name'];
      $image_tem_name = $_FILES['image']['tmp_name'];
      $image = 'upload/' . $image_name;  // image upload path
  
      // Ensure the upload directory exists
      if (!file_exists('images/')) {
          mkdir('images/', 0777, true); // Create the directory if it does not exist
      }
  
      move_uploaded_file($image_tem_name, "images/$image");
  } else {
      $image = ''; // Set default or handle the absence of the upload as needed
  }
   if (empty($first_name) || empty($last_name) || empty($email) || empty($gender) || empty($password) || empty($confirm_password) || empty($language_str)) {
      $errors[] = "All fields are required.";
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format.";
   } elseif ($password !== $confirm_password) {
      $errors[] = "Passwords do not match.";
   } else {
      $sql = "INSERT INTO user_test(first_name, last_name, email, gender, password, language, profile_image) VALUES ('.$first_name.','. $last_name.','. $email.','. $gender.','. $password.','. $language_str.','. $image.')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>PHP CRUD Application</title>
</head>

<body>
   <style>
      @keyframes gradientBG {
         0% {
            background-position: 0% 70%;
         }

         25% {
            background-position: 100% 30%;
         }

         50% {
            background-position: 0% 30%;
         }

         75% {
            background-position: 100% 70%;
         }

         100% {
            background-position: 0% 70%;
         }
      }

      body {
         background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab, #ff6b6b, #ffd56b);
         background-size: 200% 200%;
         animation: gradientBG 8s ease infinite;
         height: 100vh;
         margin: 0;
         background-repeat: no-repeat;
         background-attachment: fixed;
      }

      .container {
         background-color: rgba(255, 255, 255, 0.85);
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      }

      nav.navbar {
         background-color: rgba(0, 255, 85, 0.75);
      }
   </style>

   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Enter Your Details!!
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
         <div class="col mb-3">
         <label class="form-label">First Name:</label>
         <input type="text" class="form-control" name="first_name" placeholder="Your First Name" required>
         <div class="invalid-feedback">First Name is required.</div>
      </div>

      <!-- Last Name field -->
      <div class="col mb-3">
         <label class="form-label">Last Name:</label>
         <input type="text" class="form-control" name="last_name" placeholder="Your Last Name" required>
         <div class="invalid-feedback">Last Name is required.</div>
      </div>


            <div class="mb-3">
               <label class="form-label">Email:</label>
               <input type="email" class="form-control" name="email" placeholder="name@example.com">
               <div id="emailAlert" class="alert alert-danger" role="alert" style="display: none;">
                  Please enter a valid email address.
               </div>
               <?php if (!empty($errors)): ?>
                  <div class="alert alert-danger" role="alert">
                     <?php foreach ($errors as $error): ?>
                        <p>
                           <?php echo $error; ?>
                        </p>
                     <?php endforeach; ?>
                  </div>
               <?php endif; ?>
            </div>

            <div class="form-group mb-3">
         <label>Gender:</label>
         &nbsp;
         <input type="radio" class="form-check-input" name="gender" id="male" value="male" required>
         <label for="male" class="form-input-label">Male</label>
         &nbsp;
         <input type="radio" class="form-check-input" name="gender" id="female" value="female" required>
         <label for="female" class="form-input-label">Female</label>
         <div class="invalid-feedback">Please select your gender.</div>
      </div>
            <div class="col">
               <label for="password">Password:</label>
               <input type="password" id="password" name="password" class="form-control"
                  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                  placeholder="Enter Your Password" required>
            </div>

            <div class="col">
               <label class="form-label">Confirm Password:</label>
               <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                  placeholder="Confirm Your Password" required>
            </div>
            <div class="mb-3">
               <label class="form-label">Languages:</label><br>
               <div class="invalid-feedback">Please select at least one language.</div>
               
               <?php
               $worldLanguages = ["English", "Hindi", "Gujarati",];
               foreach ($worldLanguages as $aLanguage) {
                  echo '<div class="form-check">';
                  echo '<input class="form-check-input" type="checkbox" name="language[]" value="' . $aLanguage . '" id="language_' . strtolower($aLanguage) . '">';
                  echo '<label class="form-check-label" for="language_' . strtolower($aLanguage) . '">' . $aLanguage . '</label>';
                  echo '</div>';
               }
               ?>
            </div>
            </select>
            <div id="validationServer04Feedback" class="invalid-feedback">
               <?php
               if (isset($_POST['language']) && empty($_POST['language'])) {
                  echo "Please select a Your Language.";
               }

               if (empty($password) || empty($confirm_password)) {
                  $errors[] = "Password and confirm password are required.";
               } else if ($password !== $confirm_password) {
                  $errors[] = "Passwords do not match.";
               }

               ?>
         </div>
         <form action="add-new.php" method="post" enctype="multipart/form-data">
    <label for="image">Choose Image:</label>
    <input type="file" name="image" id="image" accept="image/*">
   <button type="submit" class="btn btn-success mb-4" name="submit">Save</button>
   <a href="index.php" class="btn btn-danger mb-4">Cancel</a>
</form>
</form>
   </div>
   </div>


   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"></script>
   <script>
      document.addEventListener("DOMContentLoaded", function () {
         var form = document.querySelector("form");
         var password = document.getElementById("password");
         var confirm_password = document.getElementById("confirm_password");

         function validatePassword() {
            if (password.value !== confirm_password.value) {
               confirm_password.setCustomValidity("Passwords do not match.");
            } else {
               confirm_password.setCustomValidity('');
            }
         }

         password.onchange = validatePassword;
         confirm_password.onkeyup = validatePassword;

         form.onsubmit = function (e) {
            validatePassword();
            if (!this.checkValidity()) {
               e.preventDefault();
            }
         };
      });
      var confirm_password = document.getElementById("confirm_password");

   </script>

</body>

</html>