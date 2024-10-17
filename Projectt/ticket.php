<?php
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "register");
    if (!$conn) {
        echo mysqli_connect_error();
        exit;
    }

    // Query to fetch data from the contact_us table
    $query = "SELECT id, name, email, message, time_created FROM `contact_us`";
    $result = mysqli_query($conn, $query);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="card-container">';
        
        
        while ($row = mysqli_fetch_assoc($result)) {
            $ticket_id = str_pad($row['id'], 3, '0', STR_PAD_LEFT);
            $name = htmlspecialchars($row['name']);
            $email = htmlspecialchars($row['email']);
            $message = nl2br(htmlspecialchars($row['message']));
            $time_created = $row['time_created'];
        
        // Calculate the time difference in seconds
        $time_diff_seconds = time() - strtotime($time_created);
                
        $time_diff_hours = floor($time_diff_seconds / 3600);
        $time_diff_minutes = floor(($time_diff_seconds % 3600) / 60);
        $time_diff_days = floor($time_diff_seconds / 86400);
                
        if ($time_diff_seconds < 3600) { 
            $time_stripe = '<div class="time-stripe-green time-stripe">Submitted ' . $time_diff_minutes . ' minute(s) ago</div>';
        } elseif ($time_diff_hours < 24) { 
            $time_stripe = '<div class="time-stripe-green time-stripe">Submitted ' . $time_diff_hours . ' hour(s) and ' . $time_diff_minutes . ' minute(s) ago</div>';
        } elseif ($time_diff_days < 7) { 
            $time_stripe = '<div class="time-stripe-yellow time-stripe">Submitted ' . $time_diff_days . ' day(s) ago</div>';
        } else {
            $time_stripe = '<div class="time-stripe-red time-stripe">Submitted ' . $time_diff_days . ' day(s) ago</div>';
        }
            
            $card = '<div class="card">
                        <h2>Ticket #' . $ticket_id . '</h2>
                        <div class="underline-top"></div>
                        <div class="card-body">
                            <p>Name: ' . $name . '</p>
                            <p>Email: ' . $email . '</p>
                            <p>Message:<br>' . $message . '</p>
                        </div>
                        <div>' . $time_stripe . '</div>
                    </div>';
            
            echo $card;
        }
        
        echo '</div>'; 
    } else {
        echo "No tickets found.";
    }

    mysqli_close($conn);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="ticket.css">
</head>
<body></body>