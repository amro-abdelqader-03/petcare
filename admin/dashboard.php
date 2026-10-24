<?php
require_once("../classes/admin.php");
session_start();
$admin = new Admin();
if(isset($_SESSION["userID"])){
    if(!$admin->isAdmin($_SESSION["userID"])){
        header("location: ../pages/login.php");
        exit();
    }
}else{
    header("location: ../pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();

    header("Location: ../pages/login.php");
    exit();
}

$totalActivUsers = $admin->totalUsers();
$totalSlots = $admin->totalSlots();
$totalAppointments = $admin->totalAppointments();
$totalPets = $admin->totalPets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare - Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-green: #1b5341;
            --light-green-bg: #e6f2ee;
            --bg-color: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: #333;
            overflow-x: hidden;
        }

        /* Main Content Wrapper */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header Navbar */
        .top-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            padding: 15px 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .breadcrumb-custom {
            font-size: 0.825rem;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0;
        }

        .top-nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notification-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            color: #4a5568;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
        }

        .notification-dot {
            position: absolute;
            top: 8px;
            right: 9px;
            width: 7px;
            height: 7px;
            background-color: #e53e3e;
            border-radius: 50%;
        }

        .admin-profile-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #f8f9fa;
            padding: 6px 14px 6px 6px;
            border-radius: 30px;
            border: 1px solid #e9ecef;
        }

        .admin-avatar {
            width: 32px;
            height: 32px;
            background-color: var(--primary-green);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        /* Dashboard Content Area */
        .dashboard-body {
            padding: 35px;
            flex-grow: 1;
        }

        /* Telemetry Banner */
        .telemetry-banner {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            padding: 28px 32px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.01);
        }

        .badge-telemetry {
            background-color: var(--light-green-bg);
            color: var(--primary-green);
            font-weight: 600;
            font-size: 0.725rem;
            padding: 5px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .badge-telemetry::before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: var(--primary-green);
            border-radius: 50%;
        }

        /* Stat Cards */
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            padding: 22px;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.01);
        }

        .stat-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .bg-green-soft { background-color: #e6f2ee; color: var(--primary-green); }
        .bg-blue-soft  { background-color: #eff6ff; color: #2563eb; }
        .bg-purple-soft{ background-color: #f3e8ff; color: #7c3aed; }
        .bg-orange-soft{ background-color: #fff7ed; color: #c2410c; }

        .stat-badge {
            font-size: 0.725rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* Chart & Content Cards */
        .dashboard-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            padding: 28px;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.01);
        }

        /* Donut Chart Mock */
        .donut-chart-container {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: conic-gradient(
                #1b5341 0deg 142deg,
                #64748b 142deg 275deg,
                #f59e0b 275deg 325deg,
                #ef4444 325deg 360deg
            );
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            position: relative;
        }

        .donut-hole {
            width: 130px;
            height: 130px;
            background-color: #ffffff;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 2px 6px rgba(0,0,0,0.03);
        }

        .status-legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        /* Vertical Bar Chart Mock */
        .bar-chart-wrapper {
            height: 220px;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            padding-top: 20px;
            border-bottom: 1px dashed #e9ecef;
            margin-bottom: 15px;
            position: relative;
        }

        .bar-column {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            height: 100%;
            justify-content: flex-end;
        }

        .bar-fill {
            width: 36px;
            border-radius: 8px 8px 0 0;
            background: linear-gradient(180deg, #34d399 0%, #059669 100%);
            transition: height 0.3s;
        }

        /* Users Progress Bars */
        .user-progress-item {
            margin-bottom: 20px;
        }
        .user-progress-item:last-child {
            margin-bottom: 0;
        }

        .progress-custom {
            height: 8px;
            background-color: #f1f3f5;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar-custom {
            background-color: var(--primary-green);
            border-radius: 10px;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }
            .sidebar .sidebar-brand span,
            .sidebar .sidebar-link span,
            .sidebar .sidebar-footer div {
                display: none;
            }
            .main-content {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>
    <?php
    include("../includes/sidebar.php");
    ?>
    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Top Header Navbar -->
        <header class="top-navbar">
            <div>
                <div class="breadcrumb-custom">Admin &gt; Dashboard</div>
                <h1 class="page-title">Dashboard <span class="text-muted fw-normal fs-6 ms-2">· Overview of your veterinary clinic</span></h1>
            </div>
            <div class="top-nav-actions">
                <button class="notification-btn">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>
                <div class="admin-profile-badge">
                    <div class="admin-avatar">A</div>
                    <span class="fw-bold small text-dark d-none d-sm-inline">Administrator</span>
                </div>
            </div>
        </header>

        <!-- Dashboard Body Content -->
        <div class="dashboard-body">

            <!-- Clinic Overview Banner / Header -->
            <div class="telemetry-banner d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <div>
                    <span class="badge-telemetry">REAL-TIME TELEMETRY</span>
                    <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem;">Clinic Overview</h2>
                    <p class="text-muted mb-0 small">Monitor users, appointment availability, bookings, and registered pets at a glance.</p>
                </div>
                <div>
                    <span class="text-muted small bg-light px-3 py-2 rounded-pill border d-inline-flex align-items-center gap-2">
                        <i class="fa-regular fa-clock text-success"></i> Updated today at 09:42 AM
                    </span>
                </div>
            </div>

            <!-- 4 Stat Cards Row -->
            <div class="row g-4 mb-4">
                <!-- Card 1: Active Users -->
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-box bg-green-soft">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                        </div>
                        <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Active Users</div>
                        <h3 class="fw-bold text-dark mb-1 mt-1 fs-3"><?= $totalActivUsers?></h3>
                        <p class="text-muted small mb-0">Currently active accounts</p>
                    </div>
                </div>

                <!-- Card 2: Total Slots -->
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-box bg-blue-soft">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                        </div>
                        <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Slots</div>
                        <h3 class="fw-bold text-dark mb-1 mt-1 fs-3"><?= $totalSlots?></h3>
                        <p class="text-muted small mb-0">Scheduled appointment slots</p>
                    </div>
                </div>

                <!-- Card 3: Total Appointments -->
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-box bg-purple-soft">
                                <i class="fa-regular fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Appointments</div>
                        <h3 class="fw-bold text-dark mb-1 mt-1 fs-3"><?= $totalAppointments?></h3>
                        <p class="text-muted small mb-0">All recorded appointments</p>
                    </div>
                </div>

                <!-- Card 4: Total Pets -->
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-box bg-orange-soft">
                                <i class="fa-solid fa-paw"></i>
                            </div>
                            <span class="stat-badge bg-warning bg-opacity-10 text-dark fw-semibold">5 Species</span>
                        </div>
                        <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Pets</div>
                        <h3 class="fw-bold text-dark mb-1 mt-1 fs-3"><?=$totalPets?></h3>
                        <p class="text-muted small mb-0">Registered pets</p>
                    </div>
                </div>
            </div>

            <!-- Two Chart Cards Row -->
            <div class="row g-4 mb-4">
                <!-- Left: Appointments by Status -->
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Appointments by Status</h5>
                                <p class="text-muted small mb-0">Distribution of appointments across their current statuses.</p>
                            </div>
                            <i class="fa-solid fa-circle-info text-muted"></i>
                        </div>

                        <!-- Donut Chart -->
                        <div class="py-4">
                            <div class="donut-chart-container">
                                <div class="donut-hole text-center">
                                    <h3 class="fw-bold text-dark mb-0 fs-3">864</h3>
                                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.6rem; letter-spacing: 0.5px;">Appointments</small>
                                </div>
                            </div>
                        </div>

                        <!-- Legend Grid -->
                        <div class="row g-2 pt-3 border-top small">
                            <div class="col-6 d-flex align-items-center justify-content-between px-3">
                                <span class="d-flex align-items-center gap-2"><span class="status-legend-dot" style="background-color: #1b5341;"></span> Confirmed</span>
                                <span class="fw-bold text-dark">340 <span class="text-muted fw-normal" style="font-size: 0.75rem;">(39.4%)</span></span>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-between px-3">
                                <span class="d-flex align-items-center gap-2"><span class="status-legend-dot" style="background-color: #64748b;"></span> Completed</span>
                                <span class="fw-bold text-dark">320 <span class="text-muted fw-normal" style="font-size: 0.75rem;">(37.0%)</span></span>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-between px-3 pt-2">
                                <span class="d-flex align-items-center gap-2"><span class="status-legend-dot" style="background-color: #f59e0b;"></span> Pending</span>
                                <span class="fw-bold text-dark">120 <span class="text-muted fw-normal" style="font-size: 0.75rem;">(13.9%)</span></span>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-between px-3 pt-2">
                                <span class="d-flex align-items-center gap-2"><span class="status-legend-dot" style="background-color: #ef4444;"></span> Cancelled</span>
                                <span class="fw-bold text-dark">84 <span class="text-muted fw-normal" style="font-size: 0.75rem;">(9.7%)</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Appointments by Pet Species -->
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Appointments by Pet Species</h5>
                                <p class="text-muted small mb-0">Number of appointments associated with each pet species.</p>
                            </div>
                            <i class="fa-solid fa-chart-column text-muted"></i>
                        </div>

                        <!-- Vertical Bar Chart -->
                        <div class="bar-chart-wrapper">
                            <!-- Dog -->
                            <div class="bar-column">
                                <span class="small fw-semibold text-dark" style="font-size: 0.75rem;">385</span>
                                <div class="bar-fill" style="height: 160px;"></div>
                            </div>
                            <!-- Cat -->
                            <div class="bar-column">
                                <span class="small fw-semibold text-dark" style="font-size: 0.75rem;">290</span>
                                <div class="bar-fill" style="height: 120px; background: linear-gradient(180deg, #6ee7b7 0%, #10b981 100%);"></div>
                            </div>
                            <!-- Bird -->
                            <div class="bar-column">
                                <span class="small fw-semibold text-dark" style="font-size: 0.75rem;">85</span>
                                <div class="bar-fill" style="height: 45px;"></div>
                            </div>
                            <!-- Rabbit -->
                            <div class="bar-column">
                                <span class="small fw-semibold text-dark" style="font-size: 0.75rem;">64</span>
                                <div class="bar-fill" style="height: 35px;"></div>
                            </div>
                            <!-- Other -->
                            <div class="bar-column">
                                <span class="small fw-semibold text-dark" style="font-size: 0.75rem;">40</span>
                                <div class="bar-fill" style="height: 22px; opacity: 0.7;"></div>
                            </div>
                        </div>

                        <!-- Bar Chart Labels -->
                        <div class="row text-center text-muted small mt-2">
                            <div class="col"><strong class="d-block text-dark small">Dogs</strong><span style="font-size: 0.7rem;">44.5%</span></div>
                            <div class="col"><strong class="d-block text-dark small">Cats</strong><span style="font-size: 0.7rem;">33.5%</span></div>
                            <div class="col"><strong class="d-block text-dark small">Birds</strong><span style="font-size: 0.7rem;">9.8%</span></div>
                            <div class="col"><strong class="d-block text-dark small">Rabbits</strong><span style="font-size: 0.7rem;">7.4%</span></div>
                            <div class="col"><strong class="d-block text-dark small">Other</strong><span style="font-size: 0.7rem;">4.8%</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section: Users by Pet Species -->
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Users by Pet Species</h5>
                        <p class="text-muted small mb-0">Number of users associated with each pet species.</p>
                    </div>
                    <span class="text-muted small bg-light px-3 py-1 rounded-pill border" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-circle-info text-muted me-1"></i> Distinct owners per species (users with multiple pets counted once per species)
                    </span>
                </div>

                <!-- Progress Bar Items -->
                <div class="user-progress-item">
                    <div class="d-flex justify-content-between align-items-center mb-1 small">
                        <span class="fw-semibold text-dark d-flex align-items-center gap-2">
                            <i class="fa-solid fa-dog text-success"></i> Dogs
                        </span>
                        <div>
                            <strong class="text-dark me-2">610</strong>
                            <span class="text-muted" style="font-size: 0.8rem;">48.9%</span>
                        </div>
                    </div>
                    <div class="progress progress-custom">
                        <div class="progress-bar progress-bar-custom" style="width: 48.9%;"></div>
                    </div>
                </div>

                <div class="user-progress-item">
                    <div class="d-flex justify-content-between align-items-center mb-1 small">
                        <span class="fw-semibold text-dark d-flex align-items-center gap-2">
                            <i class="fa-solid fa-cat text-success"></i> Cats
                        </span>
                        <div>
                            <strong class="text-dark me-2">445</strong>
                            <span class="text-muted" style="font-size: 0.8rem;">35.7%</span>
                        </div>
                    </div>
                    <div class="progress progress-custom">
                        <div class="progress-bar progress-bar-custom" style="width: 35.7%;"></div>
                    </div>
                </div>

                <div class="user-progress-item">
                    <div class="d-flex justify-content-between align-items-center mb-1 small">
                        <span class="fw-semibold text-dark d-flex align-items-center gap-2">
                            <i class="fa-solid fa-dove text-success"></i> Birds
                        </span>
                        <div>
                            <strong class="text-dark me-2">128</strong>
                            <span class="text-muted" style="font-size: 0.8rem;">10.3%</span>
                        </div>
                    </div>
                    <div class="progress progress-custom">
                        <div class="progress-bar progress-bar-custom" style="width: 10.3%;"></div>
                    </div>
                </div>

                <div class="user-progress-item">
                    <div class="d-flex justify-content-between align-items-center mb-1 small">
                        <span class="fw-semibold text-dark d-flex align-items-center gap-2">
                            <i class="fa-solid fa-paw text-success"></i> Rabbits
                        </span>
                        <div>
                            <strong class="text-dark me-2">96</strong>
                            <span class="text-muted" style="font-size: 0.8rem;">7.7%</span>
                        </div>
                    </div>
                    <div class="progress progress-custom">
                        <div class="progress-bar progress-bar-custom" style="width: 7.7%;"></div>
                    </div>
                </div>

                <div class="user-progress-item">
                    <div class="d-flex justify-content-between align-items-center mb-1 small">
                        <span class="fw-semibold text-dark d-flex align-items-center gap-2">
                            <i class="fa-solid fa-otter text-success"></i> Other (Reptiles, Exotic, Small Mammals)
                        </span>
                        <div>
                            <strong class="text-dark me-2">52</strong>
                            <span class="text-muted" style="font-size: 0.8rem;">4.2%</span>
                        </div>
                    </div>
                    <div class="progress progress-custom">
                        <div class="progress-bar progress-bar-custom" style="width: 4.2%;"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>