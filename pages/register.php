<?php
require_once("../classes/auth.php");
$auth = new Auth();
$validForm = true;
$errors = ["", "", ""];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!$auth->valid_email($_POST['email'])) {
        $errors[0] = "This email address is already registered.";
        $validForm = false;
    }
    if (!$auth->valid_password($_POST["password"])) {
        $errors[1] = "Use a strong password";
        $validForm = false;
    }
    if (!$auth->valid_confirm_password($_POST["confirmPassword"], $_POST["password"])) {
        $errors[2] = "Passwords do not match.";
        $validForm = false;
    }
    if ($validForm) {
        if ($auth->register($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'])) {
            header("Location: login.php");
            exit();
        } else {
            echo '<div class="text-danger form-text fs-7 mt-1">Something wrong, please try again later.</div>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare Veterinary Clinic - Sign Up</title>

    <!-- Google Fonts: Plus Jakarta Sans / Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <header class="py-3 bg-light">
        <div class="container-fluid px-lg-5">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Logo -->
                <div class="d-flex align-items-center gap-2">
                    <div
                        class="logo-icon-bg d-flex align-items-center justify-content-center text-success rounded-circle">
                        <i class="bi bi-paw-fill fs-5"></i>
                    </div>
                    <div>
                        <h1 class="h6 mb-0 fw-bold text-dark">PetCare</h1>
                        <p class="text-muted small mb-0 fs-7">Veterinary Clinic</p>
                    </div>
                </div>

                <!-- Right Login Link -->
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted small fw-medium">Already registered?</span>
                    <a href="login.php"
                        class="btn btn-outline-success border-2 rounded-3 px-3 py-1 text-decoration-none fw-semibold btn-sm d-flex align-items-center gap-2">
                        Log In <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="py-4 py-lg-5">
        <div class="container px-lg-4">
            <div class="row g-5 align-items-start">

                <!-- LEFT COLUMN -->
                <div class="col-lg-5">
                    <!-- Badge -->
                    <div class="d-inline-flex align-items-center gap-2 badge-green-light px-3 py-1 rounded-pill mb-3">
                        <span class="dot-green"></span>
                        <span class="badge-text text-uppercase">PetCare Client Portal</span>
                    </div>

                    <!-- Heading & Subtitle -->
                    <h2 class="display-6 fw-bold text-dark mb-3 hero-title">
                        Join Our PetCare Community
                    </h2>
                    <p class="text-secondary lead fs-6 mb-4">
                        Create your account to book veterinary appointments and manage your pet's care with ease.
                    </p>

                    <!-- Card Image Container -->
                    <div class="position-relative rounded-4 overflow-hidden mb-4 shadow-sm">
                        <img src="https://images.unsplash.com/photo-1628009368231-7bb7cfcb0def?q=80&w=800&auto=format&fit=crop"
                            alt="Veterinarian with dog and cat" class="img-fluid w-100 object-fit-cover hero-img">

                        <!-- Floating Overlay Card -->
                        <div class="position-absolute bottom-0 start-0 end-0 p-3">
                            <div
                                class="bg-white rounded-3 p-2 px-3 shadow-sm d-flex align-items-center justify-content-between border">
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        class="badge bg-success bg-opacity-10 text-success fw-bold d-flex align-items-center gap-1 py-1 px-2">
                                        <i class="bi bi-star-fill text-warning"></i> 4.9
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark small">Trusted Amman Veterinary Care</h6>
                                        <small class="text-muted fs-7">Over 4,500+ happy pets looked after</small>
                                    </div>
                                </div>
                                <span
                                    class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2 py-1 fs-7 fw-semibold">
                                    Verified
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Feature Bullets -->
                    <ul class="list-unstyled d-flex flex-column gap-2.5 text-secondary fs-6">
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-check2 text-success fw-bold fs-5"></i>
                            <span>Instant 24/7 online appointment booking</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-check2 text-success fw-bold fs-5"></i>
                            <span>Vaccination records & clinical treatment history</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-check2 text-success fw-bold fs-5"></i>
                            <span>Certified veterinary surgeons & direct support</span>
                        </li>
                    </ul>
                </div>

                <!-- RIGHT COLUMN: FORM CARD -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white ms-lg-4">

                        <!-- Form Header -->
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h3 class="fw-bold text-dark mb-1">Create Your Account</h3>
                                <p class="text-secondary small mb-0">Enter your details to get started.</p>
                            </div>
                            <div
                                class="badge bg-light text-secondary border px-2.5 py-2 rounded-3 d-flex align-items-center gap-1.5 fw-normal">
                                <i class="bi bi-shield-check text-success"></i>
                                <span class="fs-7 fw-semibold text-dark">Encrypted SSL</span>
                            </div>
                        </div>

                        <!-- Form -->
                        <form method="POST">
                            <!-- First & Last Name -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label small fw-semibold text-dark">First Name
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i
                                                class="bi bi-person"></i></span>
                                        <input type="text" id="firstName" name="fname"
                                            class="form-control border-start-0 ps-0 text-dark fw-medium"
                                            placeholder="Ahmed" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label small fw-semibold text-dark">Last Name <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i
                                                class="bi bi-person"></i></span>
                                        <input type="text" id="lastName" name="lname"
                                            class="form-control border-start-0 ps-0 text-dark fw-medium"
                                            placeholder="Mohammed" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label small fw-semibold text-dark">Email Address <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i
                                            class="bi bi-envelope"></i></span>
                                    <input type="email" id="email" name="email"
                                        class="form-control border-start-0 ps-0 text-dark fw-medium"
                                        placeholder="your@example.com" required>
                                </div>
                            </div>

                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (!empty($errors[0])) {
                                    echo '<div class="text-danger form-text fs-7 mt-1">'.$errors[0].'</div>';
                                }
                            }
                            ?>

                            <!-- Password -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="password" class="form-label small fw-semibold text-dark mb-0">Password
                                        <span class="text-danger">*</span></label>
                                    <span class="text-success small fw-semibold fs-7 d-flex align-items-center gap-1">
                                        <span class="dot-green"></span> Strong password
                                    </span>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i
                                            class="bi bi-lock"></i></span>
                                    <input type="password" id="password" name="password"
                                        class="form-control border-start-0 border-end-0 ps-0 text-dark fw-medium"
                                        placeholder="••••••••••••••••" required>
                                    <span class="input-group-text bg-white border-start-0 text-muted cursor-pointer"><i
                                            class="bi bi-eye"></i></span>
                                </div>
                                <?php
                                $text_color = "text-muted";
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    if (!empty($errors[1])) {
                                        $text_color = "text-danger";
                                    }
                                }
                                ?>
                                <div class="form-text fs-7 <?= $text_color ?> mt-1">Use a strong password with at least
                                    8 characters.</div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label small fw-semibold text-dark">Confirm
                                    Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i
                                            class="bi bi-shield-check"></i></span>
                                    <input type="password" id="confirmPassword" name="confirmPassword"
                                        class="form-control border-start-0 border-end-0 ps-0 text-dark fw-medium"
                                        placeholder="••••••••••••••••" required>
                                    <span class="input-group-text bg-white border-start-0 text-muted cursor-pointer"><i
                                            class="bi bi-eye"></i></span>
                                </div>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    if (!empty($errors[2])) {
                                        echo '<div class="text-danger form-text fs-7 mt-1">'.$errors[2].'</div>';
                                    }
                                }
                                ?>
                            </div>

                            <!-- Checkbox -->
                            <div class="mb-4 form-check align-items-center">
                                <input type="checkbox" class="form-check-input text-success custom-checkbox" id="terms"
                                    checked required>
                                <label class="form-check-label small text-secondary" for="terms">
                                    I agree to PetCare Clinic's <a href="#"
                                        class="text-dark fw-semibold text-decoration-none">Terms of Service</a> and <a
                                        href="#" class="text-dark fw-semibold text-decoration-none">Privacy Policy</a>.
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="btn btn-emerald w-100 py-2.5 rounded-3 text-white fw-bold d-flex align-items-center justify-content-center gap-2">
                                Create Account <i class="bi bi-arrow-right"></i>
                            </button>

                            <!-- Already have an account link -->
                            <div class="text-center mt-4">
                                <span class="text-muted small">Already have an account?</span>
                                <a href="login.php" class="text-success fw-bold small text-decoration-none ms-1">Log in</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="py-4 mt-auto border-top bg-white">
        <div class="container-fluid px-lg-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

                <div class="d-flex align-items-center gap-2 small text-muted">
                    <span class="dot-green"></span>
                    <span>&copy; 2026 PetCare Veterinary Clinic. All rights reserved.</span>
                </div>

                <div class="d-flex align-items-center gap-3 small">
                    <a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
                    <span class="text-muted opacity-50">•</span>
                    <a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                    <span class="text-muted opacity-50">•</span>
                    <a href="#" class="text-muted text-decoration-none">Amman Clinic Support</a>
                </div>

            </div>
        </div>
    </footer>

</body>

</html>