<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare - Appointment Details Form</title>
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

        .appointment-form-card {
            max-width: 820px;
            margin: 40px auto;
            border: 1px solid #e9ecef !important;
            border-radius: 20px;
            background-color: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            padding: 40px;
        }

        .form-header-icon {
            width: 48px;
            height: 48px;
            background-color: #e6f2ee;
            color: #1b5341;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 6px;
        }

        .custom-textarea {
            resize: none;
            font-size: 0.9rem;
            color: #2d3748;
            border-color: #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
        }

        .form-control, .form-select {
            border-color: #e2e8f0;
            border-radius: 10px;
            font-size: 0.9rem;
            padding: 10px 14px;
        }

        .form-control:focus, .form-select:focus, .custom-textarea:focus {
            border-color: #1b5341;
            box-shadow: 0 0 0 3px rgba(27, 83, 65, 0.12);
        }

        .calendar-picker-box {
            background-color: #fafbfb;
            border: 1px solid #edf2f7;
            border-radius: 12px;
            padding: 16px 20px;
        }

        .legend-dot {
            width: 6px;
            height: 6px;
            background-color: #a0aec0;
            border-radius: 50%;
            display: inline-block;
        }

        .calendar-day-active {
            width: 34px;
            height: 34px;
            background-color: #1b5341;
            color: #fff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
        }

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

        .btn-outline-cancel {
            border-color: #e2e8f0;
            color: #4a5568;
            background-color: #fff;
            font-weight: 500;
        }

        .btn-outline-cancel:hover {
            background-color: #f8f9fa;
            color: #2d3748;
        }
    </style>
</head>
<body>

    <div class="container py-4">
        <div class="card appointment-form-card">
            
            <!-- Header Section -->
            <div class="d-flex align-items-start gap-3 mb-4 pb-3 border-bottom">
                <div class="form-header-icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-1">Appointment Details</h4>
                    <p class="text-muted small mb-0">Please provide the details below to schedule your visit.</p>
                </div>
            </div>

            <!-- Form -->
            <form>
                <!-- Appointment Description -->
                <div class="mb-4">
                    <label class="form-label">Appointment Description <span class="text-danger">*</span></label>
                    <textarea class="form-control custom-textarea" rows="3">Routine annual checkup, booster rabies vaccination, and mild redness noted in the left ear.</textarea>
                    <div class="form-text text-muted small mt-1">
                        <i class="fa-regular fa-circle-question me-1"></i> Tell us briefly why your pet needs an appointment.
                    </div>
                </div>

                <!-- Pet Species -->
                <div class="mb-4">
                    <label class="form-label">Pet Species <span class="text-danger">*</span></label>
                    <select class="form-select">
                        <option selected>Dog</option>
                        <option>Cat</option>
                        <option>Bird</option>
                        <option>Other</option>
                    </select>
                </div>

                <!-- Appointment Date & Calendar Widget -->
                <div class="mb-4">
                    <label class="form-label">Appointment Date <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white border-end-0 text-muted rounded-start-3"><i class="fa-regular fa-calendar"></i></span>
                        <input type="text" class="form-control border-start-0 border-end-0 shadow-none ps-0" value="24 Oct 2026" readonly>
                        <span class="input-group-text bg-white border-start-0 text-muted rounded-end-3"><i class="fa-solid fa-chevron-down small"></i></span>
                    </div>

                    <!-- Embedded Calendar Picker Widget -->
                    <div class="calendar-picker-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold text-dark small">October 2026</span>
                            <div class="d-flex align-items-center gap-3" style="font-size: 0.75rem;">
                                <span class="text-muted d-flex align-items-center gap-1"><span class="legend-dot"></span> Past dates disabled</span>
                                <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-2 py-1">Available</span>
                            </div>
                        </div>
                        
                        <div class="row text-center text-muted fw-medium mb-2" style="font-size: 0.75rem;">
                            <div class="col">Mo</div>
                            <div class="col">Tu</div>
                            <div class="col">We</div>
                            <div class="col">Th</div>
                            <div class="col">Fr</div>
                            <div class="col text-dark fw-bold">Sa</div>
                            <div class="col">Su</div>
                        </div>

                        <div class="row text-center text-muted small align-items-center" style="font-size: 0.85rem;">
                            <div class="col py-2 opacity-50">19</div>
                            <div class="col py-2 opacity-50">20</div>
                            <div class="col py-2 opacity-50">21</div>
                            <div class="col py-2 opacity-50">22</div>
                            <div class="col py-2 opacity-50">23</div>
                            <div class="col py-1">
                                <span class="calendar-day-active">24</span>
                            </div>
                            <div class="col py-2 text-dark fw-semibold">25</div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Time Slots -->
                <div class="mb-4">
                    <label class="form-label">Appointment Time <span class="text-danger">*</span></label>
                    <div class="row g-3">
                        <!-- Start Time -->
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="text-muted small">Start Time <span class="text-danger">*</span></span>
                                <span class="text-success small fw-semibold">Available</span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted rounded-start-3"><i class="fa-regular fa-clock"></i></span>
                                <input type="text" class="form-control border-start-0 border-end-0 shadow-none ps-0" value="10:00 AM" readonly>
                                <span class="input-group-text bg-white border-start-0 text-muted rounded-end-3"><i class="fa-solid fa-chevron-down small"></i></span>
                            </div>
                            <div class="form-text text-muted small mt-1">
                                <i class="fa-regular fa-circle-question me-1"></i> Choose an available time slot for your visit.
                            </div>
                        </div>
                        <!-- End Time -->
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="text-muted small">End Time <span class="text-danger">*</span></span>
                                <span class="text-muted small">Later than start</span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted rounded-start-3"><i class="fa-regular fa-moon"></i></span>
                                <input type="text" class="form-control border-start-0 border-end-0 shadow-none ps-0" value="10:30 AM" readonly>
                                <span class="input-group-text bg-white border-start-0 text-muted rounded-end-3"><i class="fa-solid fa-chevron-down small"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Action Buttons -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 pt-4 border-top">
                    <button type="button" class="btn btn-outline-cancel rounded-pill px-4 py-2 w-100 w-sm-auto">
                        <i class="fa-solid fa-arrow-left me-2"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-custom-green rounded-pill px-4 py-2 w-100 w-sm-auto fw-medium">
                        <i class="fa-regular fa-calendar-check me-2"></i> Confirm Appointment
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>