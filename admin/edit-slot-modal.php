<?php
require_once("../classes/admin.php");
$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['slot_id'])) {
    if ($admin->editSlote($_POST['slot_id'], $_POST['startTime'], $_POST['endTime'], $_POST['slotDate'])) {
        header('location: slots.php');
    } else {
        echo '<div class="text-danger form-text fs-7 mt-1">Something wrong, please try again later.</div>';
        }
}
?>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f0f2f5;
        color: #333;
    }

    /* Modal Card Styling */
    .modal-card {
        max-width: 580px;
        margin: 50px auto;
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e9ecef;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        padding: 30px;
        position: relative;
    }

    .form-label-custom {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #4a5568;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        border-color: #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        padding: 10px 14px;
        color: #1a202c;
        background-color: #ffffff;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #1b5341;
        box-shadow: 0 0 0 3px rgba(27, 83, 65, 0.12);
    }

    /* Duration & Status Info Box */
    .info-pill-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Status Badge */
    .status-badge-open {
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

    .status-badge-open::before {
        content: '';
        width: 6px;
        height: 6px;
        background-color: #047857;
        border-radius: 50%;
    }

    /* Availability Alert Box */
    .availability-alert {
        background-color: #e6f2ee;
        border: 1px solid #cce5dd;
        border-radius: 12px;
        padding: 12px 16px;
        color: #1b5341;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Buttons */
    .btn-custom-green {
        background-color: #1b5341;
        border-color: #1b5341;
        color: #fff;
        font-weight: 500;
        padding: 10px 24px;
        border-radius: 10px;
    }

    .btn-custom-green:hover {
        background-color: #143e30;
        border-color: #143e30;
        color: #fff;
    }

    .btn-outline-cancel {
        border: 1px solid #e2e8f0;
        background-color: #ffffff;
        color: #4a5568;
        font-weight: 500;
        padding: 10px 24px;
        border-radius: 10px;
    }

    .btn-outline-cancel:hover {
        background-color: #f8f9fa;
        color: #1a202c;
    }

    .btn-close-custom {
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 1.1rem;
        cursor: pointer;
        transition: color 0.2s;
    }

    .btn-close-custom:hover {
        color: #475569;
    }
</style>

<div class="modal fade" id="editSlotModal" tabindex="-1" aria-labelledby="editSlotModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-body p-0 justify-content-center">
                <div class="modal-card m-0">

                    <!-- Modal Header -->
                    <div class="d-flex justify-content-between align-items-start mb-4 pb-3 border-bottom">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">Edit Slot</h4>
                            <p class="text-muted small mb-0">Change a appointment time slot for your clinic.</p>
                        </div>
                        <button class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Modal Form -->
                    <form method="POST">
                        <!-- Date Field -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label-custom mb-0">Date <span class="text-danger">*</span></label>
                                <span class="text-muted" style="font-size: 0.75rem;">Past dates disabled</span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted rounded-start-3">
                                    <i class="fa-regular fa-calendar"></i>
                                </span>

                                <input type="date" class="form-control border-start-0 shadow-none" id="slotDate"
                                    name="slotDate" required>
                            </div>
                        </div>

                        <!-- Start Time & End Time -->
                        <div class="row g-3 mb-4">

                            <!-- Start Time -->
                            <div class="col-md-6">
                                <label for="startTime" class="form-label-custom">
                                    Start Time <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted rounded-start-3">
                                        <i class="fa-regular fa-clock"></i>
                                    </span>

                                    <input type="time" class="form-control border-start-0 shadow-none" id="startTime"
                                        name="startTime" min="09:00" max="16:30" step="1800" required>
                                </div>
                            </div>

                            <!-- End Time -->
                            <div class="col-md-6">
                                <label for="endTime" class="form-label-custom">
                                    End Time <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted rounded-start-3">
                                        <i class="fa-regular fa-clock"></i>
                                    </span>

                                    <input type="time" class="form-control border-start-0 shadow-none" id="endTime"
                                        name="endTime" min="09:30" max="17:00" step="1800" required>
                                </div>
                            </div>
                        </div>

                        <!-- Duration & Status Box -->
                        <div class="mb-3">
                            <div class="info-pill-box">
                                <span class="text-dark small fw-medium d-flex align-items-center gap-2">
                                    <i class="fa-regular fa-clock text-muted"></i> Duration: <strong
                                        class="text-dark">30
                                        minutes</strong>
                                </span>
                                <span class="status-badge-open">Status: Open</span>
                            </div>
                        </div>

                        <!-- Availability Confirmation Alert -->
                        <div class="mb-4">
                            <div class="availability-alert">
                                <i class="fa-regular fa-circle-check fs-5"></i>
                                <span>Selected slot is available with no scheduling conflicts</span>
                            </div>
                        </div>

                        <!-- Hidden input -->
                        <input type="hidden" name="slot_id" id="editSlotId">
                        <!-- Footer Buttons -->
                        <div class="d-flex justify-content-end align-items-center gap-3 pt-3 border-top">
                            <button type="button" class="btn btn-outline-cancel" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-custom-green">
                                <i class="fa-solid fa-plus me-1"></i> Save Slot
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("slotDate");
        const startInput = document.getElementById("startTime");
        const endInput = document.getElementById("endTime");
        const durationText = document.getElementById("durationText");
        const form = document.getElementById("addSlotForm");

        // Disable past dates.
        const today = new Date();
        const localToday = [
            today.getFullYear(),
            String(today.getMonth() + 1).padStart(2, "0"),
            String(today.getDate()).padStart(2, "0")
        ].join("-");

        dateInput.min = localToday;

        // Calculate the slot duration.
        function updateDuration() {
            if (!startInput.value || !endInput.value) {
                durationText.textContent = "—";
                return;
            }

            const [startHour, startMinute] = startInput.value.split(":").map(Number);
            const [endHour, endMinute] = endInput.value.split(":").map(Number);

            const start = startHour * 60 + startMinute;
            const end = endHour * 60 + endMinute;
            const duration = end - start;

            durationText.textContent = duration > 0
                ? `${duration} minutes`
                : "Invalid duration";
        }

        startInput.addEventListener("change", function () {
            if (startInput.value) {
                // End time must be at least 30 minutes after start.
                const [hours, minutes] = startInput.value.split(":").map(Number);
                const total = hours * 60 + minutes + 30;

                const minEnd = `${String(Math.floor(total / 60)).padStart(2, "0")}:${String(total % 60).padStart(2, "0")}`;

                endInput.min = minEnd;

                if (endInput.value && endInput.value < minEnd) {
                    endInput.value = "";
                }
            }

            updateDuration();
        });

        endInput.addEventListener("change", updateDuration);

        form.addEventListener("submit", function (event) {
            const start = startInput.value;
            const end = endInput.value;

            if (dateInput.value < localToday) {
                event.preventDefault();
                alert("Please select today or a future date.");
                return;
            }

            if (!start || !end || start < "09:00" ||
                start > "16:30" || end < "09:30" || end > "17:00" ||
                end <= start) {
                event.preventDefault();
                alert("Choose a valid time between 9:00 AM and 5:00 PM. The end time must be after the start time.");
            }
        });
    });

    const editSlotModal = document.getElementById('editSlotModal');

    editSlotModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const slotId = button.getAttribute('data-slot-id');

        document.getElementById('editSlotId').value = slotId;
    });
</script>