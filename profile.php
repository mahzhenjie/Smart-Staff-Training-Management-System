<?php
session_start();

if (!isset($_SESSION['staff_id'])) {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

if(isset($_POST['upload']))
{
    if(!empty($_FILES['photo']['name']))
    {
        $filename = time() . "_" . $_FILES['photo']['name'];
        $tmpname = $_FILES['photo']['tmp_name'];

        $folder = "uploads/" . $filename;

        move_uploaded_file($tmpname, $folder);

        $stmt = $pdo->prepare(
            "UPDATE staff
             SET photo = ?
             WHERE staff_id = ?"
        );

        $stmt->execute([
            $filename,
            $_SESSION['staff_id']
        ]);

        header("Location: profile.php");
        exit();
    }
}

$stmt = $pdo->prepare(
    "SELECT * FROM staff WHERE staff_id = ?"
);

$stmt->execute([
    $_SESSION['staff_id']
]);

$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>My Profile</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f4f6f9;
    margin:0;
}

.navbar{
    background:#1e293b;
    color:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
}

.navbar a{
    color:white;
    text-decoration:none;
}

.container{
    width:70%;
    margin:40px auto;
}

.card{
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    text-align:center;
}

.profile-img{
    width:180px;
    height:180px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #2563eb;
    margin-bottom:20px;
}

.info{
    margin:15px 0;
    font-size:18px;
    text-align:left;
}

.label{
    font-weight:bold;
    color:#1e293b;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:5px;
    border:none;
    cursor:pointer;
}

.btn:hover{
    background:#1d4ed8;
}

.file{
    margin:15px 0;
}

</style>

</head>

<body>

<div class="navbar">
    <h2>My Profile</h2>

    <a href="dashboard.php">
        Back Dashboard
    </a>
</div>

<div class="container">

    <div class="card">

        <?php
        if(!empty($user['photo'])){
            echo "<img src='uploads/".$user['photo']."' class='profile-img'>";
        }else{
            echo "<img src='default.png' class='profile-img'>";
        }
        ?>

        <form method="POST" enctype="multipart/form-data">

            <input
                type="file"
                name="photo"
                class="file"
                accept="image/*">

            <br>

            <button
                type="submit"
                name="upload"
                class="btn">
                Upload Photo
            </button>

        </form>

        <hr><br>

        <div class="info">
            <span class="label">Staff ID:</span>
            <?php echo $user['staff_id']; ?>
        </div>

        <div class="info">
            <span class="label">Full Name:</span>
            <?php echo $user['full_name']; ?>
        </div>

        <div class="info">
            <span class="label">Username:</span>
            <?php echo $user['username']; ?>
        </div>

        <div class="info">
            <span class="label">Email:</span>
            <?php echo $user['email']; ?>
        </div>

        <div class="info">
            <span class="label">Role:</span>
            <?php echo $user['role']; ?>
        </div>

        <a href="dashboard.php" class="btn">
            Back to Dashboard
        </a>

    </div>

</div>

</body>
</html>
