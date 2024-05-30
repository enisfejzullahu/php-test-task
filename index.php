<?php
session_start();

include('includes/header.php');
?>

<?php
// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include('includes/connect.php');

// Function to handle form submission
function saveContact($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and store form data
        $first_name = sanitizeInput($_POST["first_name"]);
        $last_name = sanitizeInput($_POST["last_name"]);
        $address = sanitizeInput($_POST["address"]);
        $zip_city = sanitizeInput($_POST["zip_city"]);
        $country = sanitizeInput($_POST["country"]);
        $publish = isset($_POST["publish"]) ? 1 : 0;

        // Prepare and execute SQL statement for inserting contact details
        $stmt = $conn->prepare("INSERT INTO contacts (first_name, last_name, address, zip_city, country, publish) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $first_name, $last_name, $address, $zip_city, $country, $publish);

        try {
            if ($stmt->execute()) {
                // Get the inserted contact ID
                $contact_id = $conn->insert_id;

                // Insert phone numbers
                foreach ($_POST['phone'] as $key => $phone) {
                    $phone = sanitizeInput($phone);
                    $hide_phone = isset($_POST["hide_phone"][$key]) ? 1 : 0; // Check if corresponding hide_phone checkbox is checked
                    $stmt = $conn->prepare("INSERT INTO contact_phones (contact_id, phone, hide_phone) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $contact_id, $phone, $hide_phone);
                    $stmt->execute();
                }

                // Insert email addresses
                foreach ($_POST['email'] as $key => $email) {
                    $email = sanitizeInput($email);
                    $hide_email = isset($_POST["hide_email"][$key]) ? 1 : 0; // Check if corresponding hide_email checkbox is checked
                    $stmt = $conn->prepare("INSERT INTO contact_emails (contact_id, email, hide_email) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $contact_id, $email, $hide_email);
                    $stmt->execute();
                }
                
                // Make sure that it doesn't send the same from submission when refreshing the page
                header("Location: " . $_SERVER["PHP_SELF"]);
            } else {
                echo "Error: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }

        $stmt->close();
    }
}

saveContact($conn);
// Close connection
$conn->close();
?>



    <h1>Phonebook</h1>
    <ul>
        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="#" class="menu-link" id="logout-menu">Logout</a></li>
            <li><a href="#" class="menu-link" id="public-phonebook-menu">Public Phonebook</a></li>
            <li><a href="#" class="menu-link" id="my-contact-menu">My Contact</a></li>
        <?php else: ?>
            <li><a href="#" class="menu-link" id="login-menu">Login</a></li>
            <li><a href="#" class="menu-link" id="public-phonebook-menu">Public Phonebook</a></li>
        <?php endif; ?>
    </ul>
    <div id="content"></div>
    <script>
        $(document).ready(function() {
            $('#login-menu').click(function(event) {
                event.preventDefault();
                $('#content').load('login.php');
            });
            $('#public-phonebook-menu').click(function(event) {
                event.preventDefault();
                $('#content').load('public_phonebook.php');
            });
            $('#my-contact-menu').click(function(event) {
                event.preventDefault();
                $('#content').load('my_contact.php');
            });
            $('#logout-menu').click(function(event) {
                event.preventDefault();
                $.post('logout.php', function() {
                    location.reload();
                });
            });
        });
    </script>

