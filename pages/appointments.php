<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userID'])) {
    header('location : index.php');
}

require_once("../classes/database.php");
$db = new Database();

$slots = $db->getAllSlots()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare Veterinary Clinic - Appointments</title>
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
            background-color: #f6f8f7;
        }

        /* Colors & Theme */
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

        /* Navbar */
        .navbar {
            padding: 15px 0;
            background-color: #fff;
            border-bottom: 1px solid #eef0f2;
        }

        .navbar-brand {
            font-weight: 700;
            color: #1b5341 !important;
        }

        .nav-link {
            color: #6c757d !important;
            font-weight: 500;
            padding-bottom: 8px !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #1b5341 !important;
        }

        .nav-link.active {
            border-bottom: 2px solid #1b5341;
        }

        .user-profile-btn {
            background-color: #e6f2ee;
            color: #1b5341;
            border-radius: 30px;
            padding: 5px 14px 5px 6px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            border: none;
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            background-color: #1b5341;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        /* Main Section Cards */
        .appointments-card {
            background-color: #ffffff;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            padding: 24px;
            margin-bottom: 30px;
        }

        /* Search & Filter Bar */
        .search-input-group {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 4px 12px;
            border: 1px solid #e9ecef;
        }

        .search-input-group input {
            background: transparent;
            border: none;
            box-shadow: none !important;
            font-size: 0.9rem;
        }

        .filter-btn {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 8px;
            border: none;
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .filter-btn.active {
            background-color: #1b5341;
            color: #ffffff;
        }

        /* Table Styling */
        .table-custom {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table-custom th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #8898aa;
            font-weight: 600;
            border-bottom: 1px solid #edf2f7;
            padding-bottom: 12px;
        }

        .table-custom td {
            padding: 18px 12px;
            border-bottom: 1px solid #f1f3f5;
        }

        /* Date Icon Boxes */
        .date-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .date-icon-green {
            background-color: #e6f2ee;
            color: #1b5341;
        }

        .date-icon-amber {
            background-color: #fff7ed;
            color: #d97706;
        }

        .date-icon-blue {
            background-color: #eff6ff;
            color: #2563eb;
        }

        .date-icon-red {
            background-color: #fef2f2;
            color: #dc2626;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-confirmed {
            background-color: #e6f2ee;
            color: #1b5341;
        }

        .status-confirmed::before {
            background-color: #1b5341;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #b45309;
        }

        .status-pending::before {
            background-color: #b45309;
        }

        .status-completed {
            background-color: #f1f5f9;
            color: #64748b;
        }

        .status-completed::before {
            background-color: #64748b;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .status-cancelled::before {
            background-color: #b91c1c;
        }

        /* Actions */
        .btn-view-details {
            background-color: #e6f2ee;
            color: #1b5341;
            font-size: 0.825rem;
            font-weight: 600;
            border-radius: 8px;
            padding: 6px 14px;
            border: none;
            transition: all 0.2s;
        }

        .btn-view-details:hover {
            background-color: #d2e7e0;
            color: #143e30;
        }

        .action-more-btn {
            color: #a0aec0;
            border: none;
            background: none;
            font-size: 1.1rem;
            padding: 4px;
        }

        /* Empty State */
        .empty-state-icon {
            width: 70px;
            height: 70px;
            background-color: #e6f2ee;
            color: #1b5341;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 20px auto;
        }

        /* Footer */
        footer {
            background-color: #0f382b;
            color: #9cb3ac;
            padding: 60px 0 30px 0;
            margin-top: 80px;
        }

        footer h5 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.05rem;
        }

        footer ul li {
            margin-bottom: 10px;
        }

        footer a {
            color: #9cb3ac;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 40px;
            padding-top: 20px;
            text-align: center;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <i class="fa-solid fa-paw fs-4 text-success"></i>
                <span class="text-dark">PetCare</span>
                <span class="text-muted fw-normal fs-6 d-none d-sm-inline">Veterinary Clinic</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Appointments</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button class="user-profile-btn">
                    <span class="user-avatar">A</span>
                    <span>Amro</span>
                    <i class="fa-solid fa-chevron-down ms-1 text-muted small"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Appointments Page Header Section -->
        <div class="row align-items-center mb-4">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <span class="badge badge-custom px-3 py-2 rounded-pill mb-2">
                    <i class="fa-solid fa-circle me-1" style="font-size: 7px;"></i> YOUR PET'S CARE
                </span>
                <h2 class="fw-bold text-dark mb-1">My Appointments</h2>
                <p class="text-muted mb-0 small">Manage your veterinary visits, check appointment details, and book your
                    pet's next visit.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="book_appoitment.php" class="btn btn-custom-green rounded-pill px-4 py-2 fw-medium">
                    <i class="fa-regular fa-calendar-plus me-2"></i>+ Book an Appointment
                </a>
            </div>
        </div>

        <!-- 1. Appointments Card View -->
        <div class="appointments-card">

            <!-- Filters & Search Bar -->
            <div class="row g-3 align-items-center mb-4">
                <div class="col-lg-4 col-md-5">
                    <div class="input-group search-input-group align-items-center">
                        <span class="text-muted me-2"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Search appointments by description...">
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 d-flex flex-wrap align-items-center justify-content-md-end gap-2">
                    <button class="filter-btn active">All</button>
                    <button class="filter-btn">Pending</button>
                    <button class="filter-btn">Confirmed</button>
                    <button class="filter-btn">Completed</button>
                    <button class="filter-btn">Cancelled</button>
                    <div class="vr mx-1 d-none d-lg-block"></div>
                    <div class="dropdown">
                        <button
                            class="btn btn-sm btn-outline-light text-dark border-0 dropdown-toggle d-flex align-items-center gap-1"
                            type="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-sliders text-muted me-1"></i>
                            <span class="small text-muted">Sort by:</span> <strong class="small">Newest first</strong>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end small">
                            <li><a class="dropdown-item active" href="#">Newest first</a></li>
                            <li><a class="dropdown-item" href="#">Oldest first</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 25%;">APPOINTMENT DATE & TIME</th>
                            <th scope="col" style="width: 35%;">DESCRIPTION</th>
                            <th scope="col" style="width: 20%;">STATUS</th>
                            <th scope="col" class="text-end" style="width: 20%;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1: Confirmed -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="date-icon-box date-icon-green">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">24 Oct 2026</div>
                                        <div class="text-muted small"><i class="fa-regular fa-clock me-1"></i>10:00 AM –
                                            10:30 AM</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">Routine health checkup for my dog.</div>
                                <div class="text-muted small"><i class="fa-solid fa-stethoscope me-1"></i>Dr. Sarah
                                    Jenkins</div>
                            </td>
                            <td>
                                <span class="status-badge status-confirmed">Confirmed</span>
                            </td>
                            <td class="text-end">
                                <button class="btn-view-details me-2">View Details</button>
                                <button class="action-more-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            </td>
                        </tr>

                        <!-- Row 2: Pending -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="date-icon-box date-icon-amber">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">04 Nov 2026</div>
                                        <div class="text-muted small"><i class="fa-regular fa-clock me-1"></i>02:15 PM –
                                            02:45 PM</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">Vaccination and general health examination.</div>
                                <div class="text-muted small">Annual Rabies & DHPP Booster</div>
                            </td>
                            <td>
                                <span class="status-badge status-pending">Pending</span>
                            </td>
                            <td class="text-end">
                                <button class="btn-view-details me-2">View Details</button>
                                <button class="action-more-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            </td>
                        </tr>

                        <!-- Row 3: Completed -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="date-icon-box date-icon-blue">
                                        <i class="fa-regular fa-calendar-check"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">12 Sep 2026</div>
                                        <div class="text-muted small"><i class="fa-regular fa-clock me-1"></i>11:00 AM –
                                            11:45 AM</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">Follow-up examination after ear infection treatment.
                                </div>
                                <div class="text-muted small">Prescription Completed</div>
                            </td>
                            <td>
                                <span class="status-badge status-completed">Completed</span>
                            </td>
                            <td class="text-end">
                                <button class="btn-view-details">View Details</button>
                            </td>
                        </tr>

                        <!-- Row 4: Cancelled -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="date-icon-box date-icon-red">
                                        <i class="fa-regular fa-calendar-xmark"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">18 Aug 2026</div>
                                        <div class="text-muted small"><i class="fa-regular fa-clock me-1"></i>04:00 PM –
                                            04:30 PM</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">Annual health check for my cat.</div>
                                <div class="text-muted small">Cancelled by Owner</div>
                            </td>
                            <td>
                                <span class="status-badge status-cancelled">Cancelled</span>
                            </td>
                            <td class="text-end">
                                <button class="btn-view-details">View Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section Label for Preview Section -->
        <div class="d-flex justify-content-between align-items-center mt-5 mb-3 px-2">
            <span class="text-uppercase text-muted fw-semibold small tracking-wide">
                <i class="fa-regular fa-eye me-1"></i> Empty State View Preview
            </span>
            <span class="text-muted small">Shown when no bookings exist</span>
        </div>

        <!-- 2. Empty State Preview Card -->
        <div class="appointments-card text-center py-5">
            <div class="empty-state-icon">
                <i class="fa-regular fa-calendar-plus"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">No Appointments Yet</h4>
            <p class="text-muted small mb-4">Your pet's next checkup is just a few clicks away.</p>
            <a href="#" class="btn btn-custom-green rounded-pill px-4 py-2 fw-medium">
                <i class="fa-solid fa-plus me-1"></i> Book an Appointment
            </a>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-paw text-success fs-4"></i>
                        <h5 class="mb-0 text-white">PetCare</h5>
                    </div>
                    <p class="small mb-4">
                        Caring for your pets with compassion, expertise, and love.
                    </p>
                </div>
                <div class="col-6 col-lg-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Appointments</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h5>Our Services</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#">General Checkups</a></li>
                        <li><a href="#">Vaccinations</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fa-solid fa-phone me-2 text-success"></i> +962 7X XXX XXXX</li>
                        <li class="mb-2"><i class="fa-solid fa-envelope me-2 text-success"></i> info@petcareclinic.com
                        </li>
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2 text-success"></i> Amman, Jordan</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">&copy; 2026 PetCare Veterinary Clinic. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>