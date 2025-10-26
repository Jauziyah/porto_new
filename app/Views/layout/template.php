<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
      display: flex;
      flex-direction: column;
      z-index: 1000;
    }

    .sidebar.collapsed {
      width: 80px;
    }

    .sidebar.collapsed .nav-link span {
      display: none;
    }

    .sidebar.collapsed .brand span:first-child {
      display: none;
    }

    .sidebar .nav-link {
      color: #ccc;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 20px;
      font-weight: 500;
      transition: all 0.2s ease;
      text-decoration: none;
      white-space: nowrap;
    }

    .sidebar .nav-link:hover {
      color: #e91e63;
      background-color: rgba(233, 30, 99, 0.1);
      border-radius: 5px;
    }

    .sidebar .nav-link.active {
      color: #e91e63;
      background-color: rgba(233, 30, 99, 0.1);
    }

    .sidebar .brand {
      font-size: 1.2rem;
      color: #e91e63;
      padding: 0 20px;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 10px;
      white-space: nowrap;
    }

    .sidebar-nav {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .nav-top {
      flex: 1;
    }

    .nav-bottom {
      margin-top: auto;
      padding-bottom: 2rem;
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
      cursor: pointer;
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
      <span><i class="bi bi-speedometer2"></i> Admin Dude</span>
      <button id="toggleBtn" class="btn-toggle"><i class="bi bi-list"></i></button>
    </div>

    <div class="sidebar-nav">
      <nav class="nav flex-column nav-top">
        <a href="/content-management" class="nav-link" data-page="content-management">
          <i class="bi bi-file-earmark-text"></i>
          <span>Content Management</span>
        </a>
        <a href="/profile" class="nav-link" data-page="profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
        <a href="/settings" class="nav-link" data-page="settings">
          <i class="bi bi-gear"></i>
          <span>Setting</span>
        </a>
        <a href="/pkl" class="nav-link" data-page="settings">
          <i class="bi bi-gear"></i>
          <span>Pkl</span>
        </a>
      </nav>
      
      <nav class="nav flex-column nav-bottom">
        <a href="/logout" class="nav-link" data-page="logout">
          <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
        </a>
      </nav>
    </div>
  </div>
  
  <!-- Fixed: Content properly wrapped -->
  <div class="content">
    <?= $this->renderSection('content') ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.getElementById('toggleBtn');
      const sidebar = document.getElementById('sidebar');
      const content = document.querySelector('.content');
      const navLinks = document.querySelectorAll('.nav-link');

      // Toggle sidebar
      toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('collapsed');
      });

      // Set active nav link based on current URL
      function setActiveNav() {
        const currentPath = window.location.pathname;
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
          }
        });
      }

      // Set active nav on page load
      setActiveNav();

      // Add click event to nav links
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          // Remove active class from all links
          navLinks.forEach(l => l.classList.remove('active'));
          // Add active class to clicked link
          this.classList.add('active');
        });
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>