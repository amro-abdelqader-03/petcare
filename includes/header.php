<?php
session_start();
$is_user_logged_in = true;
if (!isset($_SESSION['userID'])) {
    $is_user_logged_in = false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['logout'])) {
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();
        header("Refresh: 2");
    }
}
?>

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Google Fonts - Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Custom Colors & Buttons */
    .btn-custom-green {
        background-color: #1b5341;
        border-color: #1b5341;
        color: #fff;
    }

    .btn-custom-green:hover {
        background-color: #143e30;
        border-color: #143e30;
        color: #fff;
    }

    .badge-custom {
        background-color: #e6f2ee;
        color: #1b5341;
        font-weight: 500;
    }

    /* Navbar */
    .navbar {
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .navbar-brand {
        font-weight: 700;
        color: #1b5341 !important;
    }

    .nav-link {
        color: #555 !important;
        font-weight: 500;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #1b5341 !important;
    }

    .user-icon-btn {
        width: 40px;
        height: 40px;
        background-color: #e6f2ee;
        color: #1b5341;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>


<!-- Header / Navbar -->
<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <i class="fa-solid fa-paw text-success fs-4"></i>
            <span class="text-dark">PetCare</span>
            <span class="text-muted fw-normal fs-6 d-none d-sm-inline">| Veterinary Clinic</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav gap-3">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="pages/appointments.php">Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            </ul>
        </div>
        <?php if ($is_user_logged_in): ?>
            <div class="d-none d-lg-flex align-items-center gap-3">
                <a href="#" class="btn btn-custom-green rounded-pill px-4 py-2 fw-medium">
                    Book an Appointment
                </a>
                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn d-flex align-items-center gap-2 border-0 p-0" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-icon-btn">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <i class="fa-solid fa-chevron-down small text-muted"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="userDropdown">
                        <li>
                            <form method="POST">
                                <button type="submit" class="dropdown-item text-danger py-2" name="logout">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="d-flex align-items-center gap-3">
                <a href="../petcare/pages/login.php"
                    class="btn btn-outline-success border-2 rounded-3 px-3 py-1 text-decoration-none fw-semibold btn-sm d-flex align-items-center gap-2">
                    Log In <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</nav>