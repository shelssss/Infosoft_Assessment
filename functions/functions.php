<?php
include_once('Dbconnection.php');


class Crud extends DbConnection
{
    public function __construct()
    {

        parent::__construct();
    }

    public function insertClient($name, $age, $phoneNumber)
    {
        $insertSQL = mysqli_query($this->connection, "INSERT into clients(name,age,phoneNumber) VALUES ('$name','$age','$phoneNumber')");

        if (!$insertSQL) {
            $error_message = mysqli_error($this->connection);
            echo "Database Error: $error_message";
        }

        return $insertSQL;
    }

    public function viewClients()
    {
        $sql = mysqli_query($this->connection, "SELECT * from clients order by id");
        return $sql;
    }

    public function updateClient($name, $age, $phoneNumber, $id)
    {
        $sql = mysqli_query(
            $this->connection,
            "UPDATE clients 
        SET name = '$name', 
            age = '$age', 
            phoneNumber = '$phoneNumber' 
        WHERE id = '$id'"
        );

        return $sql;
    }

    public function viewServices()
    {
        $sql = mysqli_query($this->connection, "SELECT * from services order by id");
        return $sql;
    }

    public function updateServices($hourlyRate, $id)
    {
        $sql = mysqli_query(
            $this->connection,
            "UPDATE services 
        SET hourlyRate = '$hourlyRate'
        WHERE id = '$id'"
        );

        return $sql;
    }

    public function createBookings($bookingName, $clientName, $date, $services, $hours)
    {
        //Note Some of this from ChatGPT but not ALL

        $bookingName = mysqli_real_escape_string($this->connection, $bookingName);
        $clientName = mysqli_real_escape_string($this->connection, $clientName);
        $date = mysqli_real_escape_string($this->connection, $date);

        
        mysqli_begin_transaction($this->connection);

        $checkSQL = mysqli_query($this->connection, "SELECT * FROM bookings WHERE date = '$date' AND TRIM(LOWER(clientName)) = TRIM(LOWER('$clientName'))");

        if (mysqli_num_rows($checkSQL) > 0) {
            echo "<script>alert('Error: This date is already booked for the client.');</script>";
            mysqli_rollback($this->connection);
            return false;
        }


        
        $insertBooking = mysqli_query($this->connection, "INSERT INTO bookings (bookingName, clientName, date) VALUES ('$bookingName', '$clientName', '$date')");

        if (!$insertBooking) {
            echo "Error: " . mysqli_error($this->connection);
            mysqli_rollback($this->connection);
            return false;
        }

        $bookingId = mysqli_insert_id($this->connection); // Get last inserted booking ID

        // Loop through selected services
        for ($i = 0; $i < count($services); $i++) {
            $serviceId = mysqli_real_escape_string($this->connection, $services[$i]);
            $hoursRendered = mysqli_real_escape_string($this->connection, $hours[$i]);

            // Get hourly rate for the service
            $rateQuery = mysqli_query($this->connection, "SELECT hourlyRate FROM services WHERE id = '$serviceId'");
            $serviceData = mysqli_fetch_assoc($rateQuery);

            if (!$serviceData) {
                echo "Error: Service not found.";
                mysqli_rollback($this->connection);
                return false;
            }

            $hourlyRate = $serviceData['hourlyRate'];

            // Calculate total cost
            $totalAmount = $hoursRendered * $hourlyRate;

            $insertService = mysqli_query($this->connection, "INSERT INTO booking_services (booking_id, service_id, hours_rendered, total_amount) 
                                                          VALUES ('$bookingId', '$serviceId', '$hoursRendered', '$totalAmount')");

            if (!$insertService) {
                echo "Error: " . mysqli_error($this->connection);
                mysqli_rollback($this->connection);
                return false;
            }
        }

        $insertBilling = mysqli_query($this->connection, "INSERT INTO billing (booking_id, total_amount, billing_date, status, balance) 
                                                      VALUES ('$bookingId', (SELECT SUM(total_amount) FROM booking_services WHERE booking_id='$bookingId'), NOW(), 'Pending', (SELECT SUM(total_amount) FROM booking_services WHERE booking_id='$bookingId'))");

        if (!$insertBilling) {
            echo "Error: " . mysqli_error($this->connection);
            mysqli_rollback($this->connection);
            return false;
        }

        mysqli_commit($this->connection);
        return true;
    }

    public function fetchBookings()
    {
        $sql = "SELECT b.bookingName, s.serviceName, s.hourlyRate, bs.hours_rendered AS hours, 
                   b.date, (s.hourlyRate * bs.hours_rendered) AS totalCost, 
                   bl.status, bl.id, bl.balance  -- Fetch payment status from billing table
            FROM bookings b 
            JOIN booking_services bs ON b.id = bs.booking_id 
            JOIN services s ON bs.service_id = s.id 
            LEFT JOIN billing bl ON b.id = bl.booking_id  -- Link to billing table
            ORDER BY b.date DESC";

        $result = mysqli_query($this->connection, $sql);

        if (!$result) {
            die("Query Failed: " . mysqli_error($this->connection));
        }

        $bookings = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }

        return $bookings;
    }

    public function processPayment($amount, $paymentMethod, $id)
    {
        // Update balance and payment method
        $sql = "UPDATE billing 
            SET balance = GREATEST(0, balance - ?), payment_method = ? 
            WHERE id = ?";

        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "dsi", $amount, $paymentMethod, $id);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            error_log("Error updating billing: " . mysqli_error($this->connection));
            return false; // Return false if update fails
        }

        // Check if the balance is now 0, then update status to "Paid"
        $checkBalanceSql = "SELECT balance FROM billing WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $checkBalanceSql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $balance);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($balance == 0) {
            $updateStatusSql = "UPDATE billing SET status = 'Paid' WHERE id = ?";
            $stmt = mysqli_prepare($this->connection, $updateStatusSql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        return true; // Return true on success
    }




    public function viewAvailableTools()
    {
        $sql = mysqli_query($this->connection, "SELECT * from tools where status = 'Available'");
        return $sql;
    }

    public function viewPayments()
    {
        $sql = mysqli_query($this->connection, "SELECT * from billing order by id");
        return $sql;
    }



}
