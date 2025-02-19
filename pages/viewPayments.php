<?php
include_once('../objects/viewBilling.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <?php include '../nav.php'; ?>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white">
                <h3 class="mb-0">Payments</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Booking ID</th>
                                <th>Total Amount</th>
                                <th>Billing Date</th>
                                <th>Balance</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment) { ?>
                                <tr>
                                    <td><?php echo $payment['booking_id']; ?></td>
                                    <td>₱<?php echo number_format($payment['total_amount'], 2); ?></td>
                                    <td><?php echo date('F d, Y', strtotime($payment['billing_date'])); ?></td>
                                    <td>₱<?php echo number_format($payment['balance'], 2); ?></td>
                                    <td>
                                        <span class="badge 
                                            <?php
                                            if ($payment['balance'] == 0) {
                                                echo 'bg-success';
                                            } elseif ($payment['balance'] > 0) {
                                                echo 'bg-warning';
                                            } else {
                                                echo 'bg-danger';
                                            }
                                            ?>">
                                            <?php
                                            if ($payment['balance'] == 0) {
                                                echo 'Paid';
                                            } elseif ($payment['balance'] > 0) {
                                                echo 'Pending';
                                            } else {
                                                echo 'Overdue';
                                            }
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>