<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare Veterinary Clinic</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background-color: #fff;
        }
        
        /* Hero Section */
        .hero-section {
            padding: 60px 0;
        }
        .hero-img-container {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }
        .hero-img-container img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }
        .floating-badge {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: #fff;
            padding: 15px 20px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .floating-badge-icon {
            width: 45px;
            height: 45px;
            background-color: #e6f2ee;
            color: #1b5341;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        /* Services Section */
        .services-section {
            padding: 80px 0;
            background-color: #fafbfc;
        }
        .service-card {
            border: none;
            border-radius: 20px;
            padding: 30px 20px;
            background: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            height: 100%;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }
        .service-icon-box {
            width: 50px;
            height: 50px;
            background-color: #e6f2ee;
            color: #1b5341;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 25px;
        }
        /* CTA Banner */
        .cta-banner-section {
            padding: 40px 0 80px 0;
            background-color: #fafbfc;
        }
        .cta-banner {
            background-color: #1b5341;
            border-radius: 24px;
            padding: 60px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <?php
    include("includes/header.php");
    ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <span class="badge badge-custom px-3 py-2 rounded-pill mb-3">
                        <i class="fa-solid fa-paw me-2"></i>CARING FOR YOUR PETS
                    </span>
                    <h1 class="display-4 fw-bold text-dark mb-4 lh-sm">
                        Healthy Pets.<br>Happy Hearts.<br>Better Lives.
                    </h1>
                    <p class="text-muted mb-4 fs-6">
                        From routine checkups to specialized treatments, our caring veterinary team is here to keep your furry family members healthy, vibrant, and always wagging.
                    </p>
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        <a href="#" class="btn btn-custom-green rounded-pill px-4 py-3 fw-medium">
                            <i class="fa-solid fa-calendar-check me-2"></i>Book an Appointment
                        </a>
                        <a href="#" class="text-dark text-decoration-none fw-semibold d-flex align-items-center gap-2">
                            Explore Our Services <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="text-muted small">
                        <i class="fa-solid fa-circle-check text-success me-2"></i>Compassionate care for every paw, whisker, and tail.
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img-container">
                        <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?auto=format&fit=crop&w=800&q=80" alt="Veterinarian with dog">
                        <div class="floating-badge">
                            <div class="floating-badge-icon">
                                <i class="fa-solid fa-shield-dog"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">Professional Pet Care</h6>
                                <small class="text-muted">Your pet is in safe, loving hands.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark mb-3">Our Veterinary Services</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    Everything your pet needs to stay healthy, active, and happy throughout every stage of life.
                </p>
            </div>
            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="fa-solid fa-stethoscope"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">General Checkups</h5>
                        <p class="text-muted small mb-4">
                            Routine physical examinations to carefully monitor your pet's overall wellness and catch any potential concerns early.
                        </p>
                        <a href="#" class="text-dark text-decoration-none fw-semibold small d-flex align-items-center gap-2">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Service 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="fa-solid fa-syringe"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">Vaccinations</h5>
                        <p class="text-muted small mb-4">
                            Tailored immunization schedules and preventative treatments protecting pets against regional infectious diseases.
                        </p>
                        <a href="#" class="text-dark text-decoration-none fw-semibold small d-flex align-items-center gap-2">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Service 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="fa-solid fa-tooth"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">Dental Care</h5>
                        <p class="text-muted small mb-4">
                            Comprehensive dental cleanings, plaque assessments, and gentle oral procedures for fresh breath and healthy gums.
                        </p>
                        <a href="#" class="text-dark text-decoration-none fw-semibold small d-flex align-items-center gap-2">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Service 4 -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <i class="fa-solid fa-kit-medical"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">Emergency Care</h5>
                        <p class="text-muted small mb-4">
                            Immediate triage, diagnostics, and continuous critical attention when life throws unexpected health moments your way.
                        </p>
                        <a href="#" class="text-dark text-decoration-none fw-semibold small d-flex align-items-center gap-2">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner Section -->
    <section class="cta-banner-section">
        <div class="container">
            <div class="cta-banner d-flex flex-column flex-lg-row align-items-center justify-content-between gap-4">
                <div style="max-width: 600px;">
                    <h3 class="fw-bold mb-3">Your Pet Deserves the Best Care</h3>
                    <p class="mb-0 text-light opacity-75">
                        Book a visit with our veterinary team today and give your pet the attentive, compassionate care they deserve.
                    </p>
                </div>
                <div>
                    <a href="#" class="btn btn-light rounded-pill px-4 py-3 fw-semibold text-dark d-flex align-items-center gap-2">
                        Schedule a Visit <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php
    include("includes/footer.php");
    ?>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>