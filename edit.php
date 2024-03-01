<?php
include "db_conn.php";

$id = null;

if (isset($_POST["submit"])) {
    if (isset($_POST["id"]) && $_POST["id"] != '') {
        $id = $_POST["id"];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $language = $_POST['language'];
        $sql = "UPDATE `user_test` SET `first_name`=?, `last_name`=?, `email`=?, `gender`=?, `password`=?, `language`=? WHERE `id`=?";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt === false) {
            die('Error: ' . mysqli_error($conn));
        }
        
      // Example conversion (you need to adjust based on your needs)
$languageStr = is_array($language) ? implode(',', $language) : $language;

mysqli_stmt_bind_param($stmt, "sssssss", $first_name, $last_name, $email, $gender, $password, $languageStr, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php?msg=Data updated successfully");
            exit();
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    } else {
        echo "Error: ID not set or empty.";
    }
}

$id = null;

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM `user_test` WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Error: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            echo "Error: User not found.";
            exit();
        }
    } else {
        echo "Failed: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Error: ID not set.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>PHP CRUD Application</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        PHP CRUD Application
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <div class="row mb-3">
        <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo isset($row['first_name']) ? htmlspecialchars($row['first_name']) : ''; ?>">
        </div>

        <div class="col">
            <label class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo isset($row['last_name']) ? htmlspecialchars($row['last_name']) : ''; ?>">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>">
    </div>

                <div class="form-group mb-3">
                    <label>Gender:</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row["gender"] == 'male') ? "checked" : ""; ?>>
                    <label for="male" class="form-input-label">Male</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row["gender"] == 'female') ? "checked" : ""; ?>>
                    <label for="female" class="form-input-label">Female</label>
                </div>
                <div class="col">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter Your Password" required>
</div>

<div class="col">
    <label class="form-label">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Your Password" required>
</div>
                <div>
                <div class="mb-3">
               <label class="form-label">Languages:</label><br>
               <?php
               $worldLanguages = ["English", "Hindi", "Gujarati",];
               foreach ($worldLanguages as $aLanguage) {
                  echo '<div class="form-check">';
                  echo '<input class="form-check-input" type="checkbox" name="language[]" value="' . $aLanguage . '" id="language_' . strtolower($aLanguage) . '">';
                  echo '<label class="form-check-label" for="language_' . strtolower($aLanguage) . '">' . $aLanguage . '</label>';
                  echo '</div>';
               }
?>
<button type="submit" class="btn btn-success" name="submit">Update</button>
    <a href="index.php" class="btn btn-danger">Cancel</a>
</form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
