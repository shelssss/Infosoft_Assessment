<?php
include_once('../objects/insertClient.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add | Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include '../nav.php'; ?> 
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Add New Client</h2>

            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Client Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Age</label>
                    <input type="number" id="email" name="age" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" id="phone" name="phoneNumber" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>