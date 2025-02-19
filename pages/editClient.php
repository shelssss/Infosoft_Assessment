<?php
include_once('../objects/update_client.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | Client</title>
    <?php include '../nav.php'; ?>
</head>

<body>
    <h2>Update Client</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="name">Client Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" required>

        <button type="submit" name="submit">Update Client</button>
    </form>

</body>

</html>