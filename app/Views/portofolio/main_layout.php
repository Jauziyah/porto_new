<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - M.E.J.A Ghani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3a86ff;
            --secondary-color: #8338ec;
            --dark-color: #020A10;
            --light-color: #f8f9fa;
            --gray-color: #6c757d;
            --text-color: #E9ECEF;
        }
        
        body {
            font-family: 'Manrope', sans-serif;
            background-color: var(--dark-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .navbar {
            background-color: var(--dark-color);
            padding: 1.5rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--text-color);
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: var(--text-color);
            font-weight: 500;
            margin: 0 15px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--primary-color);
        }
        
        .navbar-nav .nav-link.active {
            color: var(--primary-color);
        }
        
        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-color);
        }
        
        .hero-section {
            padding: 100px 0 80px;
            background-color: var(--dark-color);
        }
        
        .profile-image {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            margin-bottom: 30px;
        }
        
        .greeting {
            color: var(--primary-color);
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .name {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 15px;
            line-height: 1.2;
        }
        
        .title {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 25px;
            font-weight: 500;
        }
        
        .description {
            color: var(--gray-color);
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 600px;
        }
        
        .social-links {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin-right: 12px;
            color: var(--text-color);
            transition: all 0.3s ease;
            font-size: 1.2rem;
            text-decoration: none;
        }
        
        .social-icon:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }
        
        .skill-badge {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 8px 18px;
            border-radius: 30px;
            margin-right: 12px;
            margin-bottom: 12px;
            color: var(--text-color);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .skill-badge:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            color: white;
        }
        
        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 15px;
            height: 400px;
        }
        
        .grid-item {
            border-radius: 10px;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-color);
            font-size: 0.9rem;
        }
        
        .grid-item.large {
            grid-column: 2;
            grid-row: 1 / span 2;
        }
        
        .grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .services-section {
            padding: 80px 0;
            background-color: rgba(255, 255, 255, 0.03);
        }
        
        .service-card {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 30px;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
        
        .service-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .section-heading {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
        }
        
        /* Mobile and Tablet Styles */
        @media (max-width: 991.98px) {
            .hero-section .row {
                flex-direction: column-reverse;
            }
            
            .profile-image {
                width: 180px;
                height: 180px;
                margin-bottom: 25px;
            }
            
            .name {
                font-size: 2.2rem;
            }
            
            .hero-section {
                padding: 80px 0 60px;
                text-align: center;
            }
            
            .description {
                margin-left: auto;
                margin-right: auto;
            }
            
            .image-grid {
                height: 300px;
                margin-top: 40px;
            }
        }
        
        @media (max-width: 575.98px) {
            .name {
                font-size: 1.8rem;
            }
            
            .title {
                font-size: 1.3rem;
            }
            
            .profile-image {
                width: 150px;
                height: 150px;
            }
            
            .hero-section {
                padding: 60px 0 40px;
            }
            
            .image-grid {
                height: 250px;
            }
            
            .section-heading {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">M.E.J.A Ghani</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">PROJECT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">SKILLS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Content Column -->
                <div class="col-lg-6">
                    <p class="greeting">Hallo, Ich bin</p>
                    <h1 class="name">MAULANA EL JAUZIYAH AL GHANI</h1>
                    <h2 class="title">Junior PHP Developer</h2>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed rutrum felis.  
                        Praesent ultrices mauris a lectus eleifend, quis vehicula nulla sodales. Nullam et  
                        lorem eu nulla vehicula pharetra. In la pretium arcu, sed convallis dolor.
                    </p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="social-links">
                                <h6 class="section-title">Find me in</h6>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="skills">
                                <h6 class="section-title">Best at</h6>
                                <span class="skill-badge">PHP</span>
                                <span class="skill-badge">CodeIgniter</span>
                                <span class="skill-badge">MySQL</span>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-custom mt-2">View My Projects</button>
                </div>
                
                <!-- Image Grid Column -->
                <div class="col-lg-6">
                    <div class="image-grid">
                        <div class="grid-item">
                            <img src="https://via.placeholder.com/300x300/3a86ff/ffffff?text=Project+1" alt="Project 1">
                        </div>
                        <div class="grid-item large">
                            <img src="https://via.placeholder.com/300x600/8338ec/ffffff?text=Project+2" alt="Project 2">
                        </div>
                        <div class="grid-item">
                            <img src="https://via.placeholder.com/300x300/06d6a0/ffffff?text=Project+3" alt="Project 3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-heading">What I Do</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h4>Web Development</h4>
                        <p>Building responsive and modern web applications using the latest technologies.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4>Backend Development</h4>
                        <p>Creating robust server-side solutions with PHP and MySQL databases.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Responsive Design</h4>
                        <p>Ensuring websites look great and function well on all devices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>