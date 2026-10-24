<?php


?>

<style>
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
</style>


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
        <a href="dashboard.php" class="sidebar-link active">
            <i class="fa-solid fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>
        <a href="users.php" class="sidebar-link">
            <i class="fa-solid fa-users"></i>
            <span>Users</span>
        </a>
        <a href="slots.php" class="sidebar-link">
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
        <form method="POST">
            <button type="submit" class="dropdown-item text-danger py-2" name="logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </form>
    </div>
</div>