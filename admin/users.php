<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare Admin - Users Management</title>
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

        /* Metric Cards */
        .metric-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            padding: 20px;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.01);
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
        .bg-gray-soft   { background-color: #f1f5f9; color: #475569; }
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

        /* Verified Database Badge */
        .badge-verified {
            background-color: #d1fae5;
            color: #065f46;
            font-weight: 600;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Filter Toggle Group */
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

        /* Search Input */
        .search-box {
            background-color: #f8f9fa;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.85rem;
            width: 260px;
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

        .user-avatar-circle {
            width: 38px;
            height: 38px;
            background-color: #e2e8f0;
            color: #334155;
            font-weight: 600;
            font-size: 0.85rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Status & Role Badges */
        .status-pill-active {
            background-color: #d1fae5;
            color: #047857;
            font-weight: 600;
            font-size: 0.725rem;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-pill-active::before {
            content: ''; width: 6px; height: 6px; background-color: #047857; border-radius: 50%;
        }

        .status-pill-inactive {
            background-color: #f1f5f9;
            color: #64748b;
            font-weight: 600;
            font-size: 0.725rem;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-pill-inactive::before {
            content: ''; width: 6px; height: 6px; background-color: #64748b; border-radius: 50%;
        }

        .role-pill-user {
            background-color: #f8f9fa;
            color: #475569;
            border: 1px solid #e2e8f0;
            font-weight: 500;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .role-pill-admin {
            background-color: #e6f2ee;
            color: var(--primary-green);
            border: 1px solid #cce5dd;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Action Buttons */
        .btn-action-outline {
            background: transparent;
            border: 1px solid #cbd5e1;
            color: #475569;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 5px 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-action-outline:hover {
            background-color: #f1f5f9;
        }

        .btn-action-success {
            background: transparent;
            border: 1px solid #059669;
            color: #059669;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-action-success:hover {
            background-color: #d1fae5;
        }

        /* Pagination */
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
            <a href="#" class="sidebar-link active">
                <i class="fa-solid fa-users"></i>
                <span>Users</span>
            </a>
            <a href="#" class="sidebar-link">
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
                <div class="breadcrumb-custom">Admin &gt; Users</div>
                <h1 class="page-title">Users Management <span class="text-muted fw-normal fs-6 ms-2">· Manage clinic users, roles, and account status</span>[cite: 7]</h1>
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

            <!-- 4 Metric Cards Grid -->
            <div class="row g-3 mb-4">
                <!-- Metric 1 -->
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Total Accounts</span>[cite: 7]
                            <h2 class="fw-bold text-dark my-1 fs-2">48</h2>[cite: 7]
                            <small class="text-success fw-medium" style="font-size: 0.75rem;"><i class="fa-solid fa-arrow-up me-1"></i>+3 this week</small>[cite: 7]
                        </div>
                        <div class="metric-icon-box bg-green-soft">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                    </div>
                </div>

                <!-- Metric 2 -->
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Active Users</span>[cite: 7]
                            <h2 class="fw-bold text-dark my-1 fs-2">41</h2>[cite: 7]
                            <small class="text-muted" style="font-size: 0.75rem;">85.4% activity rate</small>[cite: 7]
                        </div>
                        <div class="metric-icon-box bg-teal-soft">
                            <i class="fa-regular fa-square-check"></i>
                        </div>
                    </div>
                </div>

                <!-- Metric 3 -->
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Inactive Accounts</span>[cite: 7]
                            <h2 class="fw-bold text-dark my-1 fs-2">7</h2>[cite: 7]
                            <small class="text-muted" style="font-size: 0.75rem;">Require review</small>[cite: 7]
                        </div>
                        <div class="metric-icon-box bg-gray-soft">
                            <i class="fa-regular fa-circle-pause"></i>
                        </div>
                    </div>
                </div>

                <!-- Metric 4 -->
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Super Admins</span>[cite: 7]
                            <h2 class="fw-bold text-dark my-1 fs-2">2</h2>[cite: 7]
                            <small class="text-muted" style="font-size: 0.75rem;">Role guarded</small>[cite: 7]
                        </div>
                        <div class="metric-icon-box bg-purple-soft">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Main Table Card -->
            <div class="main-card">
                
                <!-- Table Header & Filters -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h4 class="fw-bold text-dark mb-0 fs-5">All Users</h4>[cite: 7]
                            <span class="badge-verified">Verified Database</span>[cite: 7]
                        </div>
                        <p class="text-muted small mb-0">View, inspect, and configure access permissions for clinic staff and pet owners.</p>[cite: 7]
                    </div>
                    
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <!-- Filter Toggle Group -->
                        <div class="toggle-group">
                            <button class="toggle-btn active">All (48)</button>[cite: 7]
                            <button class="toggle-btn">Active</button>[cite: 7]
                            <button class="toggle-btn">Inactive</button>[cite: 7]
                        </div>

                        <!-- Search Bar -->
                        <div class="search-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            <input type="text" placeholder="Search by name or email...">[cite: 7]
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 28%;">User</th>[cite: 7]
                                <th scope="col" style="width: 25%;">Contact Email</th>[cite: 7]
                                <th scope="col" style="width: 18%;">Assigned Role</th>[cite: 7]
                                <th scope="col" style="width: 14%;">Status</th>[cite: 7]
                                <th scope="col" class="text-end" style="width: 15%;">Access Controls</th>[cite: 7]
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">SJ</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Sarah Johnson</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Jan 12, 2024</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">sarah.johnson@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-active">Active</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-outline"><i class="fa-regular fa-circle-minus me-1"></i> Make Inactive</button></td>[cite: 7]
                            </tr>

                            <!-- Row 2 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle bg-success text-white">AS</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark d-flex align-items-center gap-2">
                                                Adam Smith <span class="badge bg-success bg-opacity-15 text-success fw-semibold" style="font-size: 0.65rem; padding: 2px 6px;">YOU</span>[cite: 7]
                                            </div>
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Aug 04, 2023</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">adam.smith@example.com</td>[cite: 7]
                                <td><span class="role-pill-admin"><i class="fa-solid fa-shield-halved"></i> Admin</span></td>[cite: 7]
                                <td><span class="status-pill-active">Active</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-outline"><i class="fa-regular fa-circle-minus me-1"></i> Make Inactive</button></td>[cite: 7]
                            </tr>

                            <!-- Row 3 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">LH</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Lina Haddad</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Nov 19, 2023</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">lina.haddad@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-inactive">Inactive</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-success"><i class="fa-regular fa-circle-check me-1"></i> Make Active</button></td>[cite: 7]
                            </tr>

                            <!-- Row 4 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">OK</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Omar Khalil</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Feb 02, 2024</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">omar.khalil@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-active">Active</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-outline"><i class="fa-regular fa-circle-minus me-1"></i> Make Inactive</button></td>[cite: 7]
                            </tr>

                            <!-- Row 5 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">MW</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Maya Wilson</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Dec 14, 2023</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">maya.wilson@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-active">Active</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-outline"><i class="fa-regular fa-circle-minus me-1"></i> Make Inactive</button></td>[cite: 7]
                            </tr>

                            <!-- Row 6 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">DB</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Daniel Brown</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Oct 08, 2023</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">daniel.brown@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-inactive">Inactive</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-success"><i class="fa-regular fa-circle-check me-1"></i> Make Active</button></td>[cite: 7]
                            </tr>

                            <!-- Row 7 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">NI</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Noor Ibrahim</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Jan 30, 2024</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">noor.ibrahim@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-active">Active</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-outline"><i class="fa-regular fa-circle-minus me-1"></i> Make Inactive</button></td>[cite: 7]
                            </tr>

                            <!-- Row 8 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">RD</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Ryan Davis</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Sep 22, 2023</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">ryan.davis@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-active">Active</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-outline"><i class="fa-regular fa-circle-minus me-1"></i> Make Inactive</button></td>[cite: 7]
                            </tr>

                            <!-- Row 9 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">YM</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Yara Mansour</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Jan 18, 2024</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">yara.mansour@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-active">Active</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-outline"><i class="fa-regular fa-circle-minus me-1"></i> Make Inactive</button></td>[cite: 7]
                            </tr>

                            <!-- Row 10 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle">AT</div>[cite: 7]
                                        <div>
                                            <div class="fw-bold text-dark">Alex Taylor</div>[cite: 7]
                                            <div class="text-muted small" style="font-size: 0.75rem;">Registered Aug 15, 2023</div>[cite: 7]
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark small">alex.taylor@example.com</td>[cite: 7]
                                <td><span class="role-pill-user"><i class="fa-regular fa-user text-muted"></i> User</span></td>[cite: 7]
                                <td><span class="status-pill-inactive">Inactive</span></td>[cite: 7]
                                <td class="text-end"><button class="btn-action-success"><i class="fa-regular fa-circle-check me-1"></i> Make Active</button></td>[cite: 7]
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer / Pagination -->
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 pt-4 border-top">
                    <span class="text-muted small">Showing 1–10 of 48 users</span>[cite: 7]
                    <nav>
                        <ul class="pagination pagination-custom mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left small"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>[cite: 7]
                            <li class="page-item"><a class="page-link" href="#">2</a></li>[cite: 7]
                            <li class="page-item"><a class="page-link" href="#">3</a></li>[cite: 7]
                            <li class="page-item"><a class="page-link" href="#">4</a></li>[cite: 7]
                            <li class="page-item"><a class="page-link" href="#">5</a></li>[cite: 7]
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right small"></i></a></li>[cite: 7]
                        </ul>
                    </nav>
                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>