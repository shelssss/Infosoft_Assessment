<?php
include_once('../objects/viewServices.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Services</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include '../nav.php'; ?> <!-- Include Navbar -->

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">All Services</h2>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Service Name</th>
                        <th>Hourly Rate (₱)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($service['serviceName']); ?></td>
                            <td>₱<?php echo number_format($service['hourlyRate'], 2); ?></td>
                            <td>
                                <a href="editService.php?id=<?php echo $service['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>