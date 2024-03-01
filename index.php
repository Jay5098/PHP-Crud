<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>PHP CRUD Application</title>

    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow-x: hidden;
        }

        body {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab, #ff6b6b, #ffd56b);
            background-size: 200% 200%;
            animation: gradientBG 8s ease infinite;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            max-width: 100%;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            margin: auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
        }

        .navbar {
            background-color: rgba(0, 255, 85, 0.75);
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            font-size: 1.5rem;
            color: white;
        }

        .alert {
            position: relative;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .btn-dark {
            background-color: #343a40;
            color: #fff;
        }

        .table {
            margin-top: 20px;
        }

        th, td {
            text-align: center;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .link-dark {
            color: #343a40;
        }

        .link-dark:hover {
            text-decoration: none;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        @keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.fadeInAnimation {
    animation: fadeIn 2s;
}

    </style>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
        Enter Your Details!!
    </nav>

    <div class="container">
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    ' . $msg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>
        <a href="add-new.php" class="btn btn-dark mb-3">Add New</a>

        <div class="table">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Password</th>
                        <th scope="col">Image</th>
                        <th scope="col">Language</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `user_test` WHERE 1";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo isset($row["first_name"]) ? $row["first_name"] : "N/A"; ?></td>
                            <td><?php echo isset($row["last_name"]) ? $row["last_name"] : "N/A"; ?></td>
                            <td><?php echo isset($row["email"]) ? $row["email"] : "N/A"; ?></td>
                            <td><?php echo isset($row["gender"]) ? $row["gender"] : "N/A"; ?></td>
                            <td><?php echo isset($row["password"]) ? $row["password"] : "N/A"; ?></td>
                            <td><?php echo isset($row["confirm_password"]) ? $row["confirm_password"] : "N/A"; ?></td>
                            <td><?php echo isset($row["language"]) ? $row["language"] : ""; ?></td>
                            <td><?php echo isset($row["profile_image"]) ? $row["profile_image"] : ""; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                <a onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger" style="cursor:pointer;">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script>
        function confirmDelete(id) {
            var result = confirm("Are you sure you want to delete this record?");
            if (result) {
                window.location.href = "delete.php?id=" + id;
            }
        }
    </script>
</body>

</html>
