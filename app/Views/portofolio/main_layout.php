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

        .social-icon img {
            width: 20px;
            height: 20px;
            object-fit: contain;
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
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
            color: var(--text-color);
        }

        .service-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-color);
        }

        .icon-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .icon-container img {
            max-width: 70%;
            max-height: 70%;
            object-fit: contain;
        }

        .icon-container i {
            font-size: 36px;
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .icon-container {
                width: 70px;
                height: 70px;
            }

            .service-card {
                padding: 25px 15px;
            }
        }

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

        /* Headings */
        .section-heading {
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 50px;
            font-size: 2.5rem;
            letter-spacing: 0.5px;
        }

        /* Projects Section */
        .projects-section {
            padding: 80px 0;
            background-color: var(--dark-color);
        }

        /* Skills Section */
        .skill-category {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .skill-category:hover {
            border-color: var(--primary-color);
        }

        .skill-title {
            color: var(--text-color);
            font-weight: 600;
            margin-bottom: 15px;
        }

        .tool-icons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .tool-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tool-icon img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        /* Title belt animation */
        .title-belt-container {
            overflow: hidden;
        }

        .title-belt {
            display: flex;
            animation: scrollTitles 20s linear infinite;
        }

        .title-item {
            flex-shrink: 0;
            padding: 0 20px;
        }

        @keyframes scrollTitles {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Hero image */
        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
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

            .social-links-container {
                display: flex;
                justify-content: center;
                margin-bottom: 25px;
            }

            .social-links,
            .skills {
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

        .hero-image-placeholder {
            width: 100%;
            max-width: 500px;
            height: 300px;
            background-color: rgba(0, 55, 149, 0.54);
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-color);
            font-size: 1.2rem;
            margin-left: 40px;
            border: #3a86ff 2px solid;
        }

        @media (max-width: 991.98px) {
            .hero-image-placeholder {
                margin-left: 0;
            }
        }

        @media (max-width: 767.98px) {
            .hero-image-placeholder {
                order: -1;
                margin-bottom: 20px;
                height: 250px;
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
                    <div class="hero-image-placeholder d-lg-none">
                        <img src="<?= base_url('upload/profile/' . ($profile['profile_image'] ?? '')) ?>" alt="<?= $profile['name'] ?? 'Profile Image' ?>" class="hero-image" />
                    </div>
                    <p class="greeting"><?= $profile['greeting'] ?? 'Hallo, Ich bin' ?></p>
                    <h1 class="name"><?= $profile['name'] ?? 'MAULANA EL JAUZIYAH AL GHANI' ?></h1>
                    <h2 class="title">
                        <?php if (!empty($titles)): ?>
                            <?php if (count($titles) === 1): ?>
                                <?= $titles[0]['title'] ?>
                            <?php else: ?>
                                <div class="title-belt-container">
                                    <div class="title-belt">
                                        <?php foreach (array_merge($titles, $titles) as $title): ?>
                                            <div class="title-item">
                                                <?= $title['title'] ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php else: ?>
                            Junior PHP Developer
                        <?php endif ?>
                    </h2>
                    <p class="description">
                        <?= $profile['hero_description'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed rutrum felis. Praesent ultrices mauris a lectus eleifend, quis vehicula nulla sodales. Nullam et lorem eu nulla vehicula pharetra. In la pretium arcu, sed convallis dolor.' ?>
                    </p>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="social-links">
                                <h6 class="section-title">Find me in</h6>
                                <div class="social-links-container">
                                    <?php if (!empty($socialLinks)): ?>
                                        <?php foreach ($socialLinks as $link): ?>
                                            <a href="<?= $link['url'] ?>" class="social-icon" target="_blank" rel="noopener noreferrer" title="<?= $link['platform'] ?>">
                                                <?php if (!empty($link['icon'])): ?>
                                                    <img src="<?= base_url('upload/settings/' . $link['icon']) ?>" alt="<?= $link['platform'] ?>">
                                                <?php else: ?>
                                                    <i class="fab fa-<?= strtolower($link['platform']) ?>"></i>
                                                <?php endif; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="skills">
                                <h6 class="section-title">Best at</h6>
                                <?php if (!empty($skills)): ?>
                                    <?php foreach ($skills as $skill): ?>
                                        <span class="skill-badge">
                                            <?php if (!empty($skill['icon'])): ?>
                                            <?php endif; ?>
                                            <?= $skill['name'] ?>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-custom mt-2">View My Projects</button>
                </div>

                <!-- Image Placeholder Column -->
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-image-placeholder">
                        <img src="<?= base_url('upload/profile/' . ($profile['profile_image'] ?? '')) ?>" alt="<?= $profile['name'] ?? 'Profile Image' ?>" class="hero-image" />
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
                    <h2 class="section-heading"><?= $whatIDo['title'] ?? 'What I Do' ?></h2>
                </div>
            </div>
            <div class="row">
                <?php if (!empty($whatIDo)): ?>
                    <?php foreach ($whatIDo as $service): ?>
                        <div class="col-md-4 mb-4">
                            <div class="service-card text-center">
                                <div class="service-icon">
                                    <?php if (!empty($service['icon'])): ?>
                                        <div class="icon-container">
                                            <img src="<?= base_url('upload/settings/' . $service['icon']) ?>" alt="<?= $service['title'] ?>">
                                        </div>
                                    <?php else: ?>
                                        <div class="icon-container">
                                            <i class="fas fa-code"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h4><?= $service['title'] ?></h4>
                                <p><?= $service['description'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects-section" id="projects">
        <div class="container">
            <h2 class="section-heading mb-5">My Latest Projects</h2>

            <!-- Horizontal Scroll Slider -->
            <div class="project-slider d-flex overflow-auto pb-3">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="project-card me-4 flex-shrink-0">
                            <?php if (!empty($project['images'])): ?>
                                <img src="<?= base_url('upload/project/' . $project['images'][0]['url']) ?>" class="project-img mb-3" alt="<?= $project['title'] ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/400x250/2A2A2A/3a86ff?text=No+Image" class="project-img mb-3" alt="No Image">
                            <?php endif; ?>
                            <h4><?= $project['title'] ?></h4>
                            <p><?= substr($project['description'], 0, 100) . (strlen($project['description']) > 100 ? '...' : '') ?></p>
                            <button class="btn btn-detail" data-bs-toggle="modal" data-bs-target="#projectModal<?= $project['id'] ?>">View Detail</button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Project Modals -->
    <?php if (!empty($projects)): ?>
        <?php foreach ($projects as $project): ?>
            <div class="modal fade" id="projectModal<?= $project['id'] ?>" tabindex="-1" aria-labelledby="projectModal<?= $project['id'] ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="projectModal<?= $project['id'] ?>Label"><?= $project['title'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if (!empty($project['images'])): ?>
                                <div id="carousel-<?= $project['id'] ?>" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="4000">
                                    <div class="carousel-inner rounded" style="max-width: 800px; max-height: 450px; margin: 0 auto;">
                                        <?php foreach ($project['images'] as $index => $image): ?>
                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                <img src="<?= base_url('upload/project/' . $image['url']) ?>" class="d-block w-100" style="object-fit: contain; max-height: 450px;" alt="<?= $project['title'] ?> - Image <?= $index + 1 ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $project['id'] ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $project['id'] ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            <?php else: ?>
                                <img src="https://via.placeholder.com/800x400/2A2A2A/3a86ff?text=No+Image" class="img-fluid rounded mb-4" style="max-width: 800px; max-height: 450px;" alt="No Image">
                            <?php endif; ?>
                            <p><?= $project['description'] ?></p>

                            <?php if (!empty($project['categories'])): ?>
                                <h6 class="mt-4 mb-3">Categories:</h6>
                                <div class="modal-tech-stack">
                                    <?php foreach ($project['categories'] as $category): ?>
                                        <span class="tech-badge"><?= $category['name'] ?? 'Category ' . $category['category_id'] ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($project['tags'])): ?>
                                <h6 class="mt-4 mb-3">Technology Used:</h6>
                                <div class="modal-tech-stack">
                                    <?php foreach ($project['tags'] as $tag): ?>
                                        <span class="tech-badge"><?= $tag['name'] ?? 'Tech ' . $tag['tag_id'] ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-modal-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Skills and Tools Section -->
    <section class="skills-section py-5" id="skills">
        <div class="container">
            <h2 class="section-heading mb-5">Skills and Tools</h2>
            <div class="row g-4">
                <?php if (!empty($techStack)): ?>
                    <?php 
                    // Group tech stack by type
                    $groupedTechStack = [];
                    foreach ($techStack as $tech) {
                        $type = ucfirst($tech['type'] ?? 'Other');
                        $groupedTechStack[$type][] = $tech;
                    }
                    
                    // Display each type as a separate card
                    foreach ($groupedTechStack as $type => $items): 
                    ?>
                        <div class="col-md-6">
                            <div class="skill-category">
                                <h5 class="skill-title"><?= $type ?></h5>
                                <div class="tool-icons">
                                    <?php foreach ($items as $item): ?>
                                        <div class="tool-icon" title="<?= $item['name'] ?>">
                                            <?php if (!empty($item['image_url'])): ?>
                                                <img src="<?= base_url('upload/tech_stack/' . $item['image_url']) ?>" alt="<?= $item['name'] ?>">
                                            <?php else: ?>
                                                <span style="color: var(--primary-color); font-weight: 600; font-size: 0.9rem;">
                                                    <?= strtoupper(substr($item['name'], 0, 2)) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Fallback content when no tech stack data is available -->
                    <div class="col-12">
                        <div class="skill-category text-center">
                            <h5 class="skill-title">Skills and Tools</h5>
                            <p class="text-muted">No skills and tools data available at the moment.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section py-5" id="contact">
        <div class="container">
            <h2 class="section-heading">Get In Touch</h2>

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
                    <?php if (!empty($titles)): ?>
                        <p class="text-muted"><?= $titles[0]['title'] ?></p>
                    <?php else: ?>
                        <p class="text-muted">Junior PHP Developer</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links">
                        <?php if (!empty($socialLinks)): ?>
                            <?php foreach ($socialLinks as $link): ?>
                                <a href="<?= $link['url'] ?>" class="social-icon" target="_blank" rel="noopener noreferrer" title="<?= $link['platform'] ?>">
                                    <?php if (!empty($link['icon'])): ?>
                                        <img src="<?= base_url('upload/settings/' . $link['icon']) ?>" alt="<?= $link['platform'] ?>">
                                    <?php else: ?>
                                        <i class="fab fa-<?= strtolower($link['platform']) ?>"></i>
                                    <?php endif; ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
            anchor.addEventListener('click', function(e) {
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