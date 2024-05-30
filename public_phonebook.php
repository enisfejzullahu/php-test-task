<?php
    include('includes/header.php')
?>
    <h1>Public Phonebook</h1>

    <?php
        include('includes/connect.php');

        $sql = "SELECT * FROM contacts WHERE publish = 1 ORDER BY `id` DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contact_id = $row['id'];

                // Retrieve phone numbers for this contact
                $phone_sql = "SELECT phone FROM contact_phones WHERE contact_id = $contact_id AND hide_phone = 0";
                $phone_result = $conn->query($phone_sql);

                // Retrieve email addresses for this contact
                $email_sql = "SELECT email FROM contact_emails WHERE contact_id = $contact_id AND hide_email = 0";
                $email_result = $conn->query($email_sql);

                // Display contact details
                echo "<div class='contact'>";
                echo "<h2>" . htmlspecialchars($row["first_name"] . ' ' . $row["last_name"]) . "</h2>";
                echo "<a class='view-details'>View Details</a>";
                echo "<div class='contact-details' style='display: none;'>";
                echo "<p>Address: " . htmlspecialchars($row["address"]) . "</p>";
                echo "<p>Zip/City: " . htmlspecialchars($row["zip_city"]) . "</p>";
                echo "<p>Country: " . htmlspecialchars($row["country"]) . "</p>";

                // Display phone numbers if available
                if ($phone_result->num_rows > 0) {
                    echo "<p>Phone Numbers:</p>";
                    echo "<ul>";
                    while ($phone_row = $phone_result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($phone_row["phone"]) . "</li>";
                    }
                    echo "</ul>";
                }

                // Display email addresses if available
                if ($email_result->num_rows > 0) {
                    echo "<p>Email Addresses:</p>";
                    echo "<ul>";
                    while ($email_row = $email_result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($email_row["email"]) . "</li>";
                    }
                    echo "</ul>";
                }

                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No results found.";
        }

        $conn->close();
    ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.view-details').click(function() {
            var $details = $(this).siblings('.contact-details');
            var $this = $(this);
            $details.slideToggle(400, function() {
                var isVisible = $details.is(':visible');
                $this.text(isVisible ? 'Hide Details' : 'View Details');
            });
        });
    });
</script>
<?php
    include('includes/footer.php')
?>
