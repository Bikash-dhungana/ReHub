
 <?php 

include("db.php");


//handle Create operation(Add New user)
if(isset($_POST["submit"])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $email = $_POST['email'];   
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $gender = $_POST['gender'] ?? 'Not specified';
    $photo = $_POST['photo'] ??'';
    $pattern = "/^(?=.[a-z])(?=.[A-Z])(?=.*\d).{8,}$/";
    $pattern = "/^(?=.[a-z])(?=.[A-Z])(?=.*\d).{8,}$/";
   

$sql = "INSERT INTO store (Name, Address, Phone_Number, Email, Password, Gender,photo) VALUES ('$name', '$address', '$number', '$email', '$password', '$gender','$photo')";

if(mysqli_query($conn, $sql)){
    echo "new record created succesfully";
}
else{
    echo "error".$sql."<br>".mysqli_connect_error($conn);
}
}
$sql = "SELECT * FROM store";
$result=mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
  
</head>

<body>
   
    <form name="nameform" action="" method="post" onsubmit="return formvalidate()">
        <fieldset><legend>Registration Form</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Enter your Name" required><br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" placeholder="Enter your Address" required><br><br>

        <label for="number">Phone Number:</label>
        <input type="number" name="number" placeholder="Enter your Number" required><br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="Enter your Email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Enter your password" required><br><br>

        <textarea name="textarea" rows="2" cols="30" placeholder="About you..."></textarea><br><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female"> Female <br><br>

        <label>Select Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)">
        <br><br>

        <!-- Image Preview -->
        <img id="preview" src="#" alt="Image Preview" style="display: none; max-width: 200px;">
        

        <input type="submit" name="submit" value="Upload">

        <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
<h2>Users list</h2>
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone_Number</th>
            <th>Email</th>
            <th>Password</th>
            <th>gender</th>
            <th>photo</th>
            <th>id</th>
             </tr>
<?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
       <tr>
                <td><?= $row['Name'];?></td>
                <td><?= $row['Address'];?></td>
                <td><?= $row['Phone_Number'];?></td>
                <td><?= $row['Email'];?></td>
                <td><?= $row['password'];?></td>
                <td><?= $row['Gender'];?></td>
                <td><?= $row['photo'];?></td>
                

                <td><?= $row['id'];?></td>
            </tr>
            
            <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No records found:</td>
                </tr>
            <?php endif; ?>
            </thead>
    </table>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>




     <!-- <script>
        function formvalidate(){
            const email = document.forms["nameform"]["email"].value;
            const emailPattern = /^[\w.-]+@[\w.-]+\.\w+$/;
            if(!emailPattern.test(email)){
                alert("Enter a valid email");
                return false;
            }
            return true;
        }
    </script> -->
</body>
</html>