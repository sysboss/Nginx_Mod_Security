<html>
<body>
<?php
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $con = mysqli_connect('localhost','DB_USER','DB_PASS','mysql');
        $result = mysqli_query($con, "SELECT * FROM user WHERE User='$username' AND Password='$password'");

        if(mysqli_num_rows($result) == 0)
            echo 'Invalid username or password';
        else
            echo '<h1>Logged in</h1><p>A Secret for you....</p>';
    }
    else
    {
?>
        <h1> SQL Injection Test Form </h1>
        Update your MySQL connection credentials inside this PHP file.<br />
        Then try to bypass login screen using SQL injection: <code style="background: #eee"> or true -- </code> (space character is required)

        <form action="" method="post" style="padding-top: 28px">
            Username: <input type="text" name="username"/><br />
            Password: <input type="password" name="password"/><br />
            <input type="submit" name="login" value="Login"/>
        </form>
<?php
    }
?>
</body>
</html>
