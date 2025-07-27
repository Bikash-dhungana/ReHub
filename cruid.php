<?php
include 'db.php';

// INSERT or UPDATE
if (isset($_POST['submit'])) {
    $id = $_POST['id'] ?? ''; // optional
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $gender = $_POST['gender'];

    if (!empty($id)) {
        // UPDATE
        $sql = "UPDATE demo SET name='$name', email='$email', address='$address', message='$message', gender='$gender' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully<br>";
        } else {
            echo "Error updating record: " . mysqli_error($conn) . "<br>";
        }
    } else {
        // INSERT
        $sql = "INSERT INTO demo(name, gender, email, message, address) VALUES ('$name','$gender','$email','$message','$address')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully<br>";
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($conn) . "<br>";
        }
    }
}

// DELETE
if (isset($_GET['submit'])) {
    $id = $_GET['submit'];
    $sql = "DELETE FROM demo WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully<br>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn) . "<br>";
    }
}

// READ
$sql = "SELECT * FROM demo";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Form</title>
</head>
<body>
    <form action="" name="nameform" method="POST" onsubmit="return formvalidate()">
        <fieldset>
            <legend><strong>Registration Form</strong></legend>

            <input type="hidden" name="id" value=""> <!-- For insert -->

            <label>Name:</label><br>
            <input type="text" name="name" id="name"><br><br>

            <label>Address:</label><br>
            <input type="text" name="address" id="address"><br><br>

            <label>Email:</label><br>
            <input type="text" name="email" id="email"><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" id="password"><br><br>

            <label>Gender:</label><br>
            <input type="radio" name="gender" value="male" id="male">
            <label for="male">Male</label>
            <input type="radio" name="gender" value="female" id="female">
            <label for="female">Female</label><br><br>

            <label>Message:</label><br>
            <textarea name="message" id="message" rows="3" cols="30" placeholder="Enter your message here"></textarea><br><br>

            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Message</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['message'] ?></td>
                <td><?= $row['address'] ?></td>
                <td>
                    <form method="post" action="" style="display:inline">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="name" value="<?= $row['name'] ?>">
                        <input type="text" name="gender" value="<?= $row['gender'] ?>">
                        <input type="email" name="email" value="<?= $row['email'] ?>">
                        <input type="text" name="message" value="<?= $row['message'] ?>">
                        <input type="text" name="address" value="<?= $row['address'] ?>">
                        <input type="submit" name="submit" value="Update">
                    </form>
                    <a href="form.php?submit=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        function formvalidate() {
            const email = document.forms["nameform"]["email"].value;
            const emailpattern = /^[\w.-]+@[\w.-]+\.\w+$/;
            if (!emailpattern.test(email)) {
                alert("Enter a valid email");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>