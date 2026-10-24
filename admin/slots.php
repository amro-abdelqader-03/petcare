<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare Admin - Slots Management</title>
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

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #f1f3f5;
        }

        .brand-icon-box {
            width: 40px;
            height: 40px;
            background-color: var(--light-green-bg);
            color: var(--primary-green);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .sidebar-nav {
            padding: 20px 12px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.925rem;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #f8f9fa;
            color: var(--primary-green);
        }

        .sidebar-link.active {
            background-color: var(--light-green-bg);
            color: var(--primary-green);
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid #f1f3f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        /* Content Area */
        .dashboard-body {
            padding: 35px;
            flex-grow: 1;
        }

        /* Header Sub-banner */
        .badge-sub {
            background-color: #e6f2ee;
            color: var(--primary-green);
            font-weight: 600;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-sub::before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: var(--primary-green);
            border-radius: 50%;
        }

        .btn-custom-green {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: #fff;
        }

        .btn-custom-green:hover {
            background-color: #143e30;
            border-color: #143e30;
            color: #fff;
        }

        /* Metric Cards */
        .metric-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            padding: 20px;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.01);
            position: relative;
        }

        .metric-card.active-border {
            border-left: 4px solid var(--primary-green);
        }

        .metric-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .bg-green-soft  { background-color: #e6f2ee; color: var(--primary-green); }
        .bg-teal-soft   { background-color: #d1fae5; color: #059669; }
        .bg-purple-soft { background-color: #f3e8ff; color: #7c3aed; }

        /* Main Table Card */
        .main-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            padding: 28px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.01);
            margin-bottom: 25px;
        }

        /* Toggle Button Group */
        .toggle-group {
            background-color: #f1f5f9;
            padding: 4px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
        }

        .toggle-btn {
            border: none;
            background: transparent;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 8px;
            color: #64748b;
        }

        .toggle-btn.active {
            background-color: #ffffff;
            color: var(--primary-green);
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .toggle-badge {
            background-color: #e6f2ee;
            color: var(--primary-green);
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 4px;
        }

        /* Search Input */
        .search-box {
            background-color: #f8f9fa;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.85rem;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 0.85rem;
            width: 100%;
        }

        /* Table Design */
        .table-custom {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table-custom th {
            font-size: 0.725rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            font-weight: 600;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 14px;
        }

        .table-custom td {
            padding: 16px 12px;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.9rem;
        }

        .date-icon-bg {
            width: 36px;
            height: 36px;
            background-color: #e6f2ee;
            color: var(--primary-green);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        /* Status Badges */
        .status-pill-open {
            background-color: #d1fae5;
            color: #047857;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pill-open::before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #047857;
            border-radius: 50%;
        }

        .status-pill-booked {
            background-color: #e0e7ff;
            color: #4338ca;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pill-booked::before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #4338ca;
            border-radius: 50%;
        }

        .action-icon-btn {
            border: none;
            background: transparent;
            color: #94a3b8;
            padding: 4px 6px;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .action-icon-btn:hover {
            color: #475569;
        }

        /* Custom Pagination */
        .pagination-custom .page-item .page-link {
            border: none;
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 8px;
            margin: 0 2px;
            padding: 6px 12px;
        }

        .pagination-custom .page-item.active .page-link {
            background-color: var(--primary-green);
            color: #ffffff;
        }

        /* Bottom Info Box */
        .info-box-card {
            background-color: #e6f2ee;
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .info-icon {
            width: 32px;
            height: 32px;
            background-color: #ffffff;
            color: var(--primary-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
            margin-top: 2px;
        }

        @media (max-width: 992px) {
            .sidebar { width: 70px; }
            .sidebar .sidebar-brand span, .sidebar .sidebar-link span, .sidebar .sidebar-footer div { display: none; }
            .main-content { margin-left: 70px; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon-box">
                <i class="fa-solid fa-paw"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">PetCare</h6>
                <small class="text-muted" style="font-size: 0.65rem; letter-spacing: 0.5px;">ADMIN PANEL</small>
            </div>
        </div>

        <div class="sidebar-nav">
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-users"></i>
                <span>Users</span>
            </a>
            <a href="#" class="sidebar-link active">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Slots</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Appointments</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-shield-dog"></i>
                <span>Pets</span>
            </a>
        </div>

        <div class="sidebar-footer">
            <div class="d-flex align-items-center gap-2 overflow-hidden">
                <div class="admin-avatar flex-shrink-0">A</div>
                <div class="text-truncate">
                    <div class="fw-bold text-dark small text-truncate">Administrator</div>
                    <div class="text-muted" style="font-size: 0.7rem;">System Admin</div>
                </div>
            </div>
            <a href="#" class="text-muted"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Top Header Navbar -->
        <header class="top-navbar">
            <div>
                <div class="breadcrumb-custom">Admin &gt; Slots</div>
                <h1 class="page-title">Slots Management <span class="text-muted fw-normal fs-6 ms-2">· Create and manage appointment availability</span></h1>
            </div>
            <div class="d-flex align-items-center gap-3">
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

        <!-- Page Body Content -->
        <div class="dashboard-body">

            <!-- Title & Add Slot Button Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                <div>
                    <span class="badge-sub mb-2">SCHEDULE ENGINE • CLINIC ROOM A & B</span>
                    <h2 class="fw-bold text-dark mb-0 fs-3">Appointment Slot Registry</h2>
                </div>
                <div>
                    <button class="btn btn-custom-green rounded-pill px-4 py-2 fw-medium d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Add Slot
                    </button>
                </div>
            </div>

            <!-- 4 Metric Cards Grid -->
            <div class="row g-3 mb-4">
                <!-- Metric 1: Total Slots -->
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Total Slots</span>
                            <h2 class="fw-bold text-dark my-1 fs-2">23</h2>
                            <small class="text-muted d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                <i class="fa-regular fa-calendar"></i> Oct 26 – Oct 30
                            </small>
                        </div>
                        <div class="metric-icon-box bg-green-soft">
                            <i class="fa-regular fa-calendar-minus"></i>
                        </div>
                    </div>
                </div>

                <!-- Metric 2: Open Slots -->
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card active-border d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Open Slots</span>
                            <h2 class="fw-bold text-success my-1 fs-2">14</h2>
                            <small class="text-muted d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-circle text-success" style="font-size: 6px;"></i> 60.8% available
                            </small>
                        </div>
                        <div class="metric-icon-box bg-teal-soft">
                            <i class="fa-solid fa-lock-open"></i>
                        </div>
                    </div>
                </div>

                <!-- Metric 3: Booked Slots -->
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Booked Slots</span>
                            <h2 class="fw-bold text-dark my-1 fs-2">9</h2>
                            <small class="text-muted d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                <i class="fa-regular fa-circle-check"></i> 39.2% reserved
                            </small>
                        </div>
                        <div class="metric-icon-box bg-purple-soft">
                            <i class="fa-solid fa-chair"></i>
                        </div>
                    </div>
                </div>

                <!-- Metric 4: Next Available -->
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Next Available</span>
                            <h6 class="fw-bold text-dark my-2" style="font-size: 1.05rem;">Today, 02:00 PM</h6>
                            <small class="text-success fw-medium d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                <i class="fa-regular fa-hourglass-half"></i> In 1 hr 45 min
                            </small>
                        </div>
                        <div class="metric-icon-box bg-teal-soft">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slots Main Table Card -->
            <div class="main-card">
                
                <!-- Table Filters and Search -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold text-dark mb-1 fs-5">All Slots</h4>
                        <p class="text-muted small mb-0">View and manage available appointment time slots.</p>
                    </div>
                    
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <!-- Filter Toggle Group -->
                        <div class="toggle-group">
                            <button class="toggle-btn active">All <span class="toggle-badge">23</span></button>
                            <button class="toggle-btn">Open <span class="ms-1 text-muted" style="font-size: 0.75rem;">14</span></button>
                            <button class="toggle-btn">Booked <span class="ms-1 text-muted" style="font-size: 0.75rem;">9</span></button>
                        </div>

                        <!-- Search Bar -->
                        <div class="search-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            <input type="text" placeholder="Search by date...">
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 25%;">Date</th>
                                <th scope="col" style="width: 20%;">From</th>
                                <th scope="col" style="width: 20%;">To</th>
                                <th scope="col" style="width: 20%;">Status</th>
                                <th scope="col" class="text-end" style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1: Open -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="date-icon-bg">
                                            <i class="fa-regular fa-calendar-days"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">26 Oct 2026</div>
                                            <div class="text-muted small" style="font-size: 0.75rem;">Monday</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold text-dark">09:00 AM</td>
                                <td class="fw-bold text-dark">09:30 AM</td>
                                <td><span class="status-pill-open">Open</span></td>
                                <td class="text-end">
                                    <button class="action-icon-btn"><i class="fa-solid fa-pencil"></i></button>
                                    <button class="action-icon-btn"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>

                            <!-- Row 2: Booked -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="date-icon-bg" style="background-color: #f1f5f9; color: #64748b;">
                                            <i class="fa-regular fa-calendar"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">26 Oct 2026</div>
                                            <div class="text-muted small" style="font-size: 0.75rem;">Monday</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold text-dark">09:30 AM</td>
                                <td class="fw-bold text-dark">10:00 AM</td>
                                <td><span class="status-pill-booked">Booked</span></td>
                                <td class="text-end">
                                    <button class="action-icon-btn"><i class="fa-regular fa-eye"></i></button>
                                    <button class="action-icon-btn"><i class="fa-solid fa-lock"></i></button>
                                </td>
                            </tr>

                            <!-- Row 3: Open -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="date-icon-bg">
                                            <i class="fa-regular fa-calendar-days"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">26 Oct 2026</div>
                                            <div class="text-muted small" style="font-size: 0.75rem;">Monday</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold text-dark">10:00 AM</td>
                                <td class="fw-bold text-dark">10:30 AM</td>
                                <td><span class="status-pill-open">Open</span></td>
                                <td class="text-end">
                                    <button class="action-icon-btn"><i class="fa-solid fa-pencil"></i></button>
                                    <button class="action-icon-btn"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>

                            <!-- Row 4: Booked -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="date-icon-bg" style="background-color: #f1f5f9; color: #64748b;">
                                            <i class="fa-regular fa-calendar"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">26 Oct 2026</div>
                                            <div class="text-muted small" style="font-size: 0.75rem;">Monday</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold text-dark">10:30 AM</td>
                                <td class="fw-bold text-dark">11:00 AM</td>
                                <td><span class="status-pill-booked">Booked</span></td>
                                <td class="text-end">
                                    <button class="action-icon-btn"><i class="fa-regular fa-eye"></i></button>
                                    <button class="action-icon-btn"><i class="fa-solid fa-lock"></i></button>
                                </td>
                            </tr>

                            <!-- Row 5: Open -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="date-icon-bg">
                                            <i class="fa-regular fa-calendar-days"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">26 Oct 2026</div>
                                            <div class="text-muted small" style="font-size: 0.75rem;">Monday</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold text-dark">11:00 AM</td>
                                <td class="fw-bold text-dark">11:30 AM</td>
                                <td><span class="status-pill-open">Open</span></td>
                                <td class="text-end">
                                    <button class="action-icon-btn"><i class="fa-solid fa-pencil"></i></button>
                                    <button class="action-icon-btn"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer / Pagination -->
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 pt-4 border-top">
                    <span class="text-muted small">Showing 1–5 of 23 slots</span>
                    <nav>
                        <ul class="pagination pagination-custom mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left small"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right small"></i></a></li>
                        </ul>
                    </nav>
                </div>

            </div>

            <!-- Bottom Information Banner -->
            <div class="info-box-card">
                <div class="info-icon">
                    <i class="fa-solid fa-info"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">Automated Slot Allocation Rules</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.5;">
                        Standard general examinations require 30-minute buffers. Surgical consultations and dental procedures are automatically granted paired slots. Slots created outside clinic operating hours (08:00 AM – 06:00 PM) will require clinical supervisor confirmation.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>