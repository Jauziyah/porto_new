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
            --accent-color: #CB476E;
            --dark-color: #020A10;
            --light-color: #f8f9fa;
            --gray-color: #6c757d;
            --text-color: #E9ECEF;
        }
        
        html {
            scroll-behavior: smooth;
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
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 1rem 0;
            background-color: rgba(2, 10, 16, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--accent-color) !important;
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
        
        /* Single Profile Image Styles */
        .profile-image-container {
            position: relative;
            max-width: 450px;
            margin: 0 auto;
        }
        
        .profile-image-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 100%; /* 1:1 Aspect Ratio */
            overflow: hidden;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 4px;
        }
        
        .profile-image {
            position: absolute;
            top: 4px;
            left: 4px;
            right: 4px;
            bottom: 4px;
            width: calc(100% - 8px);
            height: calc(100% - 8px);
            object-fit: cover;
            border-radius: 16px;
            background-color: var(--dark-color);
        }
        
        /* Decorative elements */
        .profile-image-container::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary-color), transparent);
            border-radius: 20px;
            opacity: 0.3;
            z-index: -1;
        }
        
        .profile-image-container::after {
            content: '';
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, transparent, var(--accent-color));
            border-radius: 20px;
            opacity: 0.3;
            z-index: -1;
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
        
        .service-card h4 {
            color: var(--text-color);
            margin-bottom: 15px;
        }
        
        .service-card p {
            color: var(--gray-color);
        }
        
        .section-heading {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
            color: var(--text-color);
        }

        /* Skills and Tools Section */
        .skills-section {
            padding: 80px 0;
            background-color: rgba(255, 255, 255, 0.03);
        }

        .skill-category {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .skill-category:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }

        .skill-title {
            color: var(--text-color);
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .tool-icons {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .tool-icon {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 10px;
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .tool-icon img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 5px;
        }

        .tool-icon:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Projects Section */
        .projects-section {
            padding: 80px 0;
            background-color: var(--dark-color);
        }

        /* Carousel Styling */
        .carousel-inner img {
            border-radius: 10px;
            object-fit: cover;
            height: 500px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        /* Project slider */
        .project-slider {
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) rgba(255, 255, 255, 0.1);
        }

        .project-slider::-webkit-scrollbar {
            height: 8px;
        }

        .project-slider::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .project-slider::-webkit-scrollbar-thumb {
            background-color: var(--primary-color);
            border-radius: 10px;
        }

        .project-card {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 20px;
            width: 320px;
            flex: 0 0 auto;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
        }

        .project-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }

        .project-img {
            width: 100%;
            border-radius: 10px;
            height: 180px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .project-card h4 {
            color: var(--text-color);
            margin-bottom: 10px;
            font-weight: 600;
        }

        .project-card p {
            color: var(--gray-color);
            font-size: 0.95rem;
            flex-grow: 1;
            margin-bottom: 15px;
        }

        .btn-detail {
            background-color: var(--accent-color);
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            width: 100%;
        }

        .btn-detail:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        /* Modal Styling */
        .modal-content {
            background-color: var(--dark-color);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px 30px 15px;
        }

        .modal-title {
            color: var(--text-color);
            font-weight: 600;
            font-size: 1.5rem;
        }

        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .modal-body {
            padding: 25px 30px;
            color: var(--text-color);
        }

        .modal-tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }

        .tech-badge {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-color);
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 30px 25px;
        }

        .btn-modal {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 25px;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-modal:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-modal-secondary {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-color);
            padding: 10px 25px;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-modal-secondary:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        /* Contact Section */
        .contact-section {
            padding: 80px 0;
            background-color: var(--dark-color);
        }

        .contact-card {
            background-color: rgba(255, 255, 255, 0.05);
            max-width: 700px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            border-color: var(--primary-color);
        }

        .form-label {
            color: var(--text-color);
            font-weight: 500;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-color);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: none;
            background-color: rgba(255, 255, 255, 0.15);
            color: var(--text-color);
        }

        .btn-contact {
            background-color: var(--accent-color);
            color: white;
            padding: 12px 40px;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-contact:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }
        
        /* Footer */
        .footer {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 40px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Tablet View Optimizations (768px - 991px) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            /* Hero Section Tablet Fixes */
            .hero-section {
                padding: 90px 0 70px;
            }
            
            .hero-section .row {
                flex-direction: column-reverse;
                text-align: center;
            }
            
            .name {
                font-size: 2.8rem;
                margin-bottom: 15px;
            }
            
            .title {
                font-size: 1.6rem;
                margin-bottom: 25px;
            }
            
            .description {
                font-size: 1.1rem;
                max-width: 85%;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 35px;
            }
            
            .profile-image-container {
                max-width: 350px;
                margin: 40px auto 0;
            }
            
            .social-links-container {
                display: flex;
                justify-content: center;
                margin-bottom: 25px;
            }
            
            .social-links, .skills {
                text-align: center;
                margin-bottom: 25px;
            }
            
            .social-icon {
                margin: 0 10px 10px;
            }
            
            .skill-badge {
                margin: 0 8px 12px;
            }
            
            .btn-custom {
                padding: 14px 35px;
                font-size: 1.05rem;
            }
            
            /* Services Section */
            .service-card {
                padding: 25px;
                margin-bottom: 25px;
            }
            
            .service-icon {
                font-size: 2.3rem;
            }
            
            /* Projects Section */
            .project-card {
                width: 300px;
            }
            
            .carousel-inner img {
                height: 400px;
            }
            
            /* Skills Section */
            .skill-category {
                padding: 22px;
                margin-bottom: 20px;
            }
            
            .tool-icons {
                gap: 12px;
                justify-content: center;
            }
            
            .tool-icon {
                width: 62px;
                height: 62px;
            }
            
            /* Contact Section */
            .contact-card {
                padding: 35px 30px;
            }
            
            /* General */
            .section-heading {
                font-size: 2.4rem;
                margin-bottom: 45px;
            }
        }
        
        /* Mobile Styles */
        @media (max-width: 767.98px) {
            .hero-section {
                padding: 80px 0 60px;
                text-align: center;
            }
            
            .name {
                font-size: 2.2rem;
            }
            
            .description {
                margin-left: auto;
                margin-right: auto;
            }
            
            .profile-image-container {
                max-width: 300px;
                margin-top: 40px;
            }
            
            .project-card {
                width: 85%;
                margin: 0 auto 1.5rem;
            }
            
            .carousel-inner img {
                height: 300px;
            }
            
            .skill-category {
                text-align: center;
                margin-bottom: 25px;
            }
            
            .tool-icons {
                justify-content: center;
            }
            
            .contact-card {
                padding: 30px 20px;
            }
            
            .section-heading {
                font-size: 2.2rem;
            }
        }
        
        @media (max-width: 575.98px) {
            .name {
                font-size: 1.8rem;
            }
            
            .title {
                font-size: 1.3rem;
            }
            
            .hero-section {
                padding: 60px 0 40px;
            }
            
            .profile-image-container {
                max-width: 250px;
            }
            
            .section-heading {
                font-size: 2rem;
            }
            
            .tool-icons {
                gap: 10px;
            }
            
            .tool-icon {
                width: 55px;
                height: 55px;
            }
            
            .tool-icon img {
                width: 35px;
                height: 35px;
            }
            
            .skill-category {
                padding: 20px;
            }
            
            .contact-card {
                padding: 25px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">M.E.J.A Ghani</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">ABOUT ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">PROJECT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#skills">SKILLS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
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
                                <div class="social-links-container">
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
                
                <!-- Profile Image Column -->
                <div class="col-lg-6">
                    <div class="profile-image-container">
                        <div class="profile-image-wrapper">
                            <img src="https://via.placeholder.com/450x450/2A2A2A/3a86ff?text=Profile+Photo" alt="Profile Photo" class="profile-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="about">
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

    <!-- Projects Section -->
    <section class="projects-section" id="projects">
        <div class="container">
            <h2 class="section-heading mb-5">My Latest Projects</h2>


            <!-- Horizontal Scroll Slider -->
            <div class="project-slider d-flex overflow-auto pb-3">
                <div class="project-card me-4 flex-shrink-0">
                    <img src="https://via.placeholder.com/400x250/2A2A2A/3a86ff?text=Kopsis+Project" class="project-img mb-3" alt="Project">
                    <h4>Kopsis Project</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed rutrum felis. Nullam et lorem eu nulla vehicula pharetra.</p>
                    <button class="btn btn-detail" data-bs-toggle="modal" data-bs-target="#projectModal1">View Detail</button>
                </div>
                <div class="project-card me-4 flex-shrink-0">
                    <img src="https://via.placeholder.com/400x250/2A2A2A/8338ec?text=Student+App" class="project-img mb-3" alt="Project">
                    <h4>Student Management</h4>
                    <p>Modern web app for managing students and classes efficiently with PHP backend and MySQL databases.</p>
                    <button class="btn btn-detail" data-bs-toggle="modal" data-bs-target="#projectModal2">View Detail</button>
                </div>
                <div class="project-card me-4 flex-shrink-0">
                    <img src="https://via.placeholder.com/400x250/2A2A2A/CB476E?text=E-Shop" class="project-img mb-3" alt="Project">
                    <h4>E-Shop CMS</h4>
                    <p>Responsive online shop management system built with CodeIgniter framework for lightweight performance.</p>
                    <button class="btn btn-detail" data-bs-toggle="modal" data-bs-target="#projectModal3">View Detail</button>
                </div>
                <div class="project-card me-4 flex-shrink-0">
                    <img src="https://via.placeholder.com/400x250/2A2A2A/3a86ff?text=Portfolio" class="project-img mb-3" alt="Project">
                    <h4>Personal Portfolio</h4>
                    <p>My fully responsive personal portfolio website featuring a clean design and smooth animations.</p>
                    <button class="btn btn-detail" data-bs-toggle="modal" data-bs-target="#projectModal4">View Detail</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Modals -->
    <!-- Modal 1 -->
    <div class="modal fade" id="projectModal1" tabindex="-1" aria-labelledby="projectModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModal1Label">Kopsis Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="https://via.placeholder.com/800x400/2A2A2A/3a86ff?text=Kopsis+Project+Details" class="img-fluid rounded mb-4" alt="Project Details">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed rutrum felis. Praesent ultrices mauris a lectus eleifend, quis vehicula nulla sodales.</p>
                    <p>Nullam et lorem eu nulla vehicula pharetra. In la pretium arcu, sed convallis dolor. Vivamus ac justo euismod, aliquet nisl et, ultricies nunc.</p>
                    <h6 class="mt-4 mb-3">Technologies Used:</h6>
                    <div class="modal-tech-stack">
                        <span class="tech-badge">PHP</span>
                        <span class="tech-badge">CodeIgniter</span>
                        <span class="tech-badge">MySQL</span>
                        <span class="tech-badge">Bootstrap</span>
                        <span class="tech-badge">JavaScript</span>
                    </div>

                    <h6 class="mt-4 mb-3">Tags:</h6>
                    <div class="modal-tech-stack">
                        <span class="tech-badge">PHP</span>
                        <span class="tech-badge">CodeIgniter</span>
                        <span class="tech-badge">MySQL</span>
                        <span class="tech-badge">Bootstrap</span>
                        <span class="tech-badge">JavaScript</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modal-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Skills and Tools Section -->
    <section class="skills-section py-5" id="skills">
        <div class="container">
            <h2 class="section-heading mb-5">Skills and Tools</h2>
            <div class="row g-4">
                <!-- UI/UX Design -->
                <div class="col-md-6">
                    <div class="skill-category">
                        <h5 class="skill-title">UI/UX Design</h5>
                        <div class="tool-icons">
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/CB476E?text=F" alt="Figma">
                            </div>
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/3a86ff?text=C" alt="CodeIgniter">
                            </div>
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/E9ECEF?text=G" alt="GitHub">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Database Management -->
                <div class="col-md-6">
                    <div class="skill-category">
                        <h5 class="skill-title">Database Management</h5>
                        <div class="tool-icons">
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/3a86ff?text=M" alt="MySQL">
                            </div>
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/CB476E?text=C" alt="CodeIgniter">
                            </div>
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/E9ECEF?text=G" alt="GitHub">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Version Control -->
                <div class="col-md-6">
                    <div class="skill-category">
                        <h5 class="skill-title">Version Control</h5>
                        <div class="tool-icons">
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/3a86ff?text=G" alt="GitHub">
                            </div>
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/CB476E?text=C" alt="CodeIgniter">
                            </div>
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/8338ec?text=F" alt="Figma">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Other Tools -->
                <div class="col-md-6">
                    <div class="skill-category">
                        <h5 class="skill-title">Other Tools</h5>
                        <div class="tool-icons">
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/3a86ff?text=M" alt="MySQL">
                            </div>
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/CB476E?text=C" alt="CodeIgniter">
                            </div>
                            <div class="tool-icon">
                                <img src="https://via.placeholder.com/60x60/1A1A1A/E9ECEF?text=G" alt="GitHub">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section py-5" id="contact">
        <div class="container">
            <h2 class="section-heading mb-5">Get In Touch</h2>

            <div class="contact-card mx-auto p-4">
                <form action="send_email.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-contact">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>M.E.J.A Ghani</h5>
                    <p class="text-muted">Junior PHP Developer</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links">
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
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted">&copy; 2023 M.E.J.A Ghani. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>