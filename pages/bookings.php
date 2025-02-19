<?php
include_once('../objects/viewBookings.php');
include_once('../objects/processPayment.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <?php include '../nav.php'; ?>
</head>


<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Bookings Summary</h2>
            <a href="createBookings.php" class="btn btn-primary">Create Booking</a>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Booking Name</th>
                    <th>Service</th>
                    <th>Hourly Rate</th>
                    <th>Hours</th>
                    <th>Date</th>
                    <th>Total Cost</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($bookings)) {
                    foreach ($bookings as $booking) {
                ?>
                        <tr>
                            <td><?php echo $booking['bookingName']; ?></td>
                            <td><?php echo $booking['serviceName']; ?></td>
                            <td>₱<?php echo number_format($booking['hourlyRate'], 2); ?></td>
                            <td><?php echo $booking['hours']; ?> hrs</td>
                            <td><?php echo date('F d, Y', strtotime($booking['date'])); ?></td>
                            <td><strong>₱<?php echo number_format($booking['totalCost'], 2); ?></strong></td>
                            <td><strong>₱<?php echo number_format($booking['balance'], 2); ?></strong></td>
                            <td><?php echo $booking['status']; ?></td>
                            <td> <a href="processPayment.php?id=<?php echo $booking['id']; ?>" class="btn btn-success btn-sm">Process Payment</a></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="9" class="text-center">No bookings found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>