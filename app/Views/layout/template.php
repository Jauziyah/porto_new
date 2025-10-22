<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1a1a1a;
      color: #ddd;
      font-family: 'Roboto', sans-serif;
      min-height: 100vh;
    }

    .sidebar {
      background-color: #0d1117;
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 250px;
      padding-top: 1rem;
      transition: all 0.3s ease;
    }

    .sidebar.collapsed {
      width: 80px;
    }

    .sidebar .nav-link {
      color: #ccc;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 20px;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .sidebar .nav-link:hover {
      color: #e91e63;
      background-color: rgba(233, 30, 99, 0.1);
      border-radius: 5px;
    }

    .sidebar .nav-link.active {
      color: #e91e63;
    }

    .sidebar .brand {
      font-size: 1.2rem;
      color: #e91e63;
      padding: 0 20px;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .content {
      margin-left: 250px;
      padding: 2rem;
      transition: margin-left 0.3s ease;
      background-color: #111;
      min-height: 100vh;
    }

    .collapsed + .content {
      margin-left: 80px;
    }

    .btn-toggle {
      background: none;
      border: none;
      color: #e91e63;
      font-size: 1.5rem;
    }

    .card {
      background-color: #1c1c1c;
      border: none;
      border-radius: 5px;
      color: #ccc;
    }
  </style>
</head>

<body>
  <div class="sidebar" id="sidebar">
    <div class="brand d-flex align-items-center justify-content-between">
      <span><i class="bi bi-list"></i> Admin Dude</span>
      <button id="toggleBtn" class="btn-toggle"><i class="bi bi-list"></i></button>
    </div>

    <nav class="nav flex-column mt-4">
      <a href="#" class="nav-link active"><i class="bi bi-house"></i> Dashboard</a>
      <a href="#" class="nav-link"><i class="bi bi-people"></i> Users</a>
      <a href="#" class="nav-link"><i class="bi bi-gear"></i> Settings</a>
      <a href="/logout" class="nav-link"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </nav>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.js"></script>
  <script>
    document.getElementById('toggleBtn').addEventListener('click', function() {
      document.getElementById('sidebar').classList.toggle('collapsed');
      document.querySelector('.content').classList.toggle('collapsed');
    });
  </script>
</body>
</html>