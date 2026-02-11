<?php
include "../config/koneksi.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($conn,"SELECT * FROM user WHERE username='$username' AND password='$password'");
    if(mysqli_num_rows($q) > 0){
        $_SESSION['user'] = $username;
        header("Location: ../dashboard.php");
        exit;
    } else {
        echo "Login gagal!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Kasir</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-96">
    <h2 class="text-2xl font-bold text-center mb-4">Login Kasir</h2>
    <form method="post">
      <div class="mb-4">
        <input type="text" name="username" placeholder="Username"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="mb-4">
        <input type="password" name="password" placeholder="Password"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <button type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">
        Login
      </button>
    </form>
  </div>
</body>
</html>