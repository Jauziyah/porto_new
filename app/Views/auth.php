<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background: white;
      padding: 2rem 3rem;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .login-container label {
      display: block;
      margin-bottom: 0.3rem;
      font-weight: bold;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .login-container button {
      width: 100%;
      padding: 0.6rem;
      background-color: #4285f4;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .login-container button:hover {
      background-color: #357ae8;
    }

    .login-container .footer-text {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #666;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Login</h2>
    <form action="/login" method="post">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required />

      <button type="submit">Sign In</button>
    </form>
    <div class="footer-text">
      Forgot your password? <a href="#">Reset it</a>
    </div>
  </div>

</body>
</html>