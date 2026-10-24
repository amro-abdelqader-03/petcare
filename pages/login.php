<?php
require_once("../classes/auth.php");

$auth = new Auth();
$emailError = "";
$passwordError = "";
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($email)) {
        $emailError = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Please enter a valid email address.";
    }

    if (empty($password)) {
        $passwordError = "Password is required.";
    }

    if (empty($emailError) && empty($passwordError)) {
        $user = $auth->login($email, $password);
        if ($user) {
            if ($user["role"] == "user") {
                header("Location: ../index.php");
                exit();
            } elseif ($user["role"] == "admin") {
                header("Location: ../admin/dashboard.php");
                exit();
            }
        } else {
            $loginError = "Invalid email address or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PetCare Veterinary Clinic - Log In</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <header class="py-3 bg-light">
        <div class="container-fluid px-lg-5">
            <div class="d-flex align-items-center justify-content-between">

                <a href="../index.php" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div class="logo-icon-bg d-flex align-items-center justify-content-center
                        text-success rounded-circle">
                        <i class="bi bi-paw-fill fs-5"></i>
                    </div>

                    <div>
                        <h1 class="h6 mb-0 fw-bold text-dark">PetCare</h1>
                        <p class="text-muted small mb-0 fs-7">Veterinary Clinic</p>
                    </div>
                </a>

                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted small fw-medium">
                        New to PetCare?
                    </span>

                    <a href="register.php" class="btn btn-outline-success border-2 rounded-3 px-3 py-1
                        text-decoration-none fw-semibold btn-sm">
                        Sign Up <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="py-4 py-lg-5">
        <div class="container px-lg-4">
            <div class="row g-5 align-items-center justify-content-center">

                <!-- LOGIN FORM -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5
                        bg-white ms-lg-4">

                        <!-- FORM HEADER -->
                        <div class="d-flex justify-content-between
                            align-items-start mb-4">

                            <div>
                                <h3 class="fw-bold text-dark mb-1">
                                    Log In to Your Account
                                </h3>

                                <p class="text-secondary small mb-0">
                                    Enter your credentials to continue.
                                </p>
                            </div>

                            <div class="badge bg-light text-secondary border
                                px-2 py-2 rounded-3 d-flex align-items-center gap-2 fw-normal">
                                <i class="bi bi-shield-check text-success"></i>
                                <span class="fs-7 fw-semibold text-dark">
                                    Secure Login
                                </span>
                            </div>

                        </div>

                        <?php if (!empty($loginError)): ?>
                            <div class="alert alert-danger py-2 small" role="alert">
                                <?= htmlspecialchars($loginError) ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="login.php">

                            <!-- EMAIL -->
                            <div class="mb-3">
                                <label for="email" class="form-label small fw-semibold text-dark">
                                    Email Address
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text bg-white
                                        border-end-0 text-muted">
                                        <i class="bi bi-envelope"></i>
                                    </span>

                                    <input type="email" id="email" name="email" class="form-control border-start-0 ps-0 text-dark fw-medium
                                            <?= !empty($emailError) ? 'is-invalid' : '' ?>"
                                        placeholder="your@example.com"
                                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" autocomplete="email"
                                        required>
                                </div>

                                <?php if (!empty($emailError)): ?>
                                    <div class="text-danger form-text fs-7">
                                        <?= htmlspecialchars($emailError) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- PASSWORD -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between
                                    align-items-center mb-1">

                                    <label for="password" class="form-label small fw-semibold text-dark mb-0">
                                        Password
                                        <span class="text-danger">*</span>
                                    </label>

                                </div>

                                <div class="input-group">
                                    <span class="input-group-text bg-white
                                        border-end-0 text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>

                                    <input type="password" id="password" name="password" class="form-control border-start-0 border-end-0 ps-0 text-dark fw-medium
                                            <?= !empty($passwordError) ? 'is-invalid' : '' ?>"
                                        placeholder="Enter your password" autocomplete="current-password" required>

                                    <button type="button" id="togglePassword"
                                        class="input-group-text bg-white border-start-0 text-muted"
                                        aria-label="Show password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>

                                <?php if (!empty($passwordError)): ?>
                                    <div class="text-danger form-text fs-7">
                                        <?= htmlspecialchars($passwordError) ?>
                                    </div>
                                <?php endif; ?>
                            </div>


                            <!-- SUBMIT -->
                            <button type="submit" class="btn btn-emerald w-100 py-2 rounded-3
                                    text-white fw-bold d-flex align-items-center
                                    justify-content-center gap-2">

                                Log In
                                <i class="bi bi-arrow-right"></i>
                            </button>

                            <!-- REGISTER LINK -->
                            <div class="text-center mt-4">
                                <span class="text-muted small">
                                    Don't have an account?
                                </span>

                                <a href="register.php" class="text-success fw-bold small
                                        text-decoration-none ms-1">
                                    Sign up
                                </a>
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
            <div class="d-flex flex-column flex-md-row justify-content-between
                align-items-center gap-3">

                <div class="d-flex align-items-center gap-2 small text-muted">
                    <span class="dot-green"></span>
                    <span>
                        &copy; 2026 PetCare Veterinary Clinic. All rights reserved.
                    </span>
                </div>

                <div class="d-flex align-items-center gap-3 small">
                    <a href="#" class="text-muted text-decoration-none">
                        Privacy Policy
                    </a>

                    <span class="text-muted opacity-50">•</span>

                    <a href="#" class="text-muted text-decoration-none">
                        Terms of Service
                    </a>

                    <span class="text-muted opacity-50">•</span>

                    <a href="#" class="text-muted text-decoration-none">
                        Amman Clinic Support
                    </a>
                </div>

            </div>
        </div>
    </footer>

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");

        togglePassword.addEventListener("click", function () {
            const isPassword = passwordInput.type === "password";

            passwordInput.type = isPassword ? "text" : "password";

            this.innerHTML = isPassword
                ? '<i class="bi bi-eye-slash"></i>'
                : '<i class="bi bi-eye"></i>';

            this.setAttribute(
                "aria-label",
                isPassword ? "Hide password" : "Show password"
            );
        });
    </script>

</body>

</html>