<?php
include_once('../objects/viewAvailableTools.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Tools</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <?php include '../nav.php'; ?>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white">
                <h3 class="mb-0">Available Tools</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Tool Name</th>
                                <th>Used in Service</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tools as $tool) { ?>
                                <tr>
                                    <td><?php echo $tool['toolName']; ?></td>
                                    <td><?php echo $tool['serviceUsed']; ?></td>
                                    <td>
                                        <span class="badge 
                                            <?php echo ($tool['status'] == 'Available') ? 'bg-success' : 'bg-danger'; ?>">
                                            <?php echo $tool['status']; ?>
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