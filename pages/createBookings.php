<?php
include_once('../objects/createBookings.php');
include_once('../objects/viewSelectionClient.php');
include_once('../objects/viewSelectionService.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add | Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include '../nav.php'; ?> <!-- Include Navbar -->

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Create New Booking</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Booking Name</label>
                    <input type="text" id="name" name="bookingName" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="client" class="form-label">Client Name</label>
                    <select name="clientName" id="client" class="form-select" required>
                        <option selected disabled value="">Select Client</option>
                        <?php foreach ($clients as $client) { ?>
                            <option value="<?php echo $client['name']; ?>"><?php echo $client['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>

                <h3 class="mt-4">Services</h3>
                <div id="services-container">
                    <div class="service-container mb-3 p-3 border rounded">
                        <label class="form-label">Service</label>
                        <select name="service[]" class="form-select" required>
                            <option selected disabled value="">Select Service</option>
                            <?php foreach ($services as $service) { ?>
                                <option value="<?php echo $service['id']; ?>"><?php echo $service['serviceName']; ?> (₱<?php echo $service['hourlyRate']; ?>/hr)</option>
                            <?php } ?>
                        </select>

                        <label class="form-label mt-2">Hours</label>
                        <input type="number" name="hours[]" min="1" class="form-control" required>

                        <button type="button" class="btn btn-danger btn-sm mt-2 remove-service">Remove</button>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary btn-sm mb-3 add-service">+ Add Another Service</button>

                <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const serviceContainer = document.getElementById("services-container");
            const addServiceBtn = document.querySelector(".add-service");

            addServiceBtn.addEventListener("click", function() {
                const serviceHTML = `
                    <div class="service-container mb-3 p-3 border rounded">
                        <label class="form-label">Service</label>
                        <select name="service[]" class="form-select" required>
                            <option selected disabled value="">Select Service</option>
                            <?php foreach ($services as $service) { ?>
                                <option value="<?php echo $service['id']; ?>"><?php echo $service['serviceName']; ?> (₱<?php echo $service['hourlyRate']; ?>/hr)</option>
                            <?php } ?>
                        </select>

                        <label class="form-label mt-2">Hours</label>
                        <input type="number" name="hours[]" min="1" class="form-control" required>

                        <button type="button" class="btn btn-danger btn-sm mt-2 remove-service">Remove</button>
                    </div>
                `;
                serviceContainer.insertAdjacentHTML("beforeend", serviceHTML);
            });

            serviceContainer.addEventListener("click", function(event) {
                if (event.target.classList.contains("remove-service")) {
                    event.target.parentElement.remove();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>