<?php
include_once('../objects/updateService.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | Service</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include '../nav.php'; ?> <!-- Include Navbar -->

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Update Service</h2>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <div class="mb-3">
                    <label for="hourlyRate" class="form-label">Hourly Rate (₱)</label>
                    <input type="number" id="hourlyRate" name="hourlyRate" class="form-control" value="<?php echo htmlspecialchars($hourlyRate ?? ''); ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="displayServices.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">Update Service</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>