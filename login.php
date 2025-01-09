<?php
session_start();
include "koneksi.php";  

?>

<!DOCTYPE html>
<html>
<head>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <style>
        body {
            background-color: #f8d7da;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
            .login-card {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        text-align: center;
            }
        .login-card img {
        border-radius: 50%;
        }

        .login-card h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .login-card .form-control {
            border-radius: 20px;
            margin-bottom: 15px;
        }
        .login-card .btn {
            background-color: #dc3545;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
        }
    </style>
</head>
<body>
<div class="login-card">
    <!-- Ikon User -->
    <img alt="User icon" src="https://placehold.co/50x50" class="mb-3" width="50" height="50"/>
    
    <!-- Judul -->
    <h2 class="mb-4">My Daily Journal</h2>
    
    <!-- Form Login -->
    <form action="login_process.php" method="POST">
        <!-- Input Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input class="form-control" id="username" name="username" placeholder="Enter your username" type="text" required/>
        </div>
        
        <!-- Input Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input class="form-control" id="password" name="password" placeholder="Enter your password" type="password" required/>
        </div>
        
        <!-- Tombol Login -->
        <button class="btn btn-primary btn-block" type="submit">Login</button>
    </form>
</div>
</body>
</html>
