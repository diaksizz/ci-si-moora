<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      font-family: "Merriweather", serif;
    }

    .box {
      height: 100vh;
      /* Set height to full viewport height */
      background-color: #d8d6ff;
      /* Ganti dengan path gambar*/
      display: flex;
	  background-image:url('backg.jpeg');
	  background-repeat:no-repeat;
	  background-attachment:fixed;
	  background-size:100%;
      justify-content: center;
      /* Center horizontally */
      align-items: center;
      /* Center vertically */
    }

    .glassmorphic-box {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.18);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.12);
      overflow: hidden;
      max-width: 400px;
      width: 100%;
      padding: 30px;
    }

    .glassmorphic-box h2 {
      color: #fff;
      margin-bottom: 30px;
    }

    .glassmorphic-box form {
      display: grid;
      gap: 15px;
    }

    .glassmorphic-box label {
      color: #fff;
      font-weight: 500;
      font-size: 14px;
    }

    .glassmorphic-box input {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
    }

    .glassmorphic-box button {
      padding: 10px;
      border-radius: 8px;
      background: #3498db;
      color: #fff;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .glassmorphic-box button:hover {
      background: #2980b9;
    }
  </style>
  <title>PP Walisongo</title>
</head>
<?php
if (isset($_GET['alert'])) {
  if ($_GET['alert'] == "gagal") {
    echo "<div class='alert alert-danger'>LOGIN GAGAL! USERNAME DAN PASSWORD SALAH!</div>";
  } else if ($_GET['alert'] == "belum_login") {
    echo "<div class='alert alert-warning'>ANDA HARUS LOGIN UNTUK MENGAKSES DASHBOARD</div>";
  }
}
?>

<body>
  <div id="particles-js" class="box">
    <div class="container position-absolute d-flex justify-content-center align-items-center flex-column">
      <div class="glassmorphic-box">
        <h2>Login</h2>

        <form action="periksa_login.php" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
          </div>
          <div class="row">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  
</body>

</html>
