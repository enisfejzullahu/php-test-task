<?php
    include('includes/header.php');
?>
    <h1>My Contact</h1>
    <div class="contact-form">
        <form method="POST" action="index.php">
            <fieldset>
                <legend>Contact Information</legend>
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first_name" required>

                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last_name" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="zip-city">Zip/City:</label>
                <input type="text" id="zip-city" name="zip_city" required>

                <label for="country">Country:</label>
                <select id="country" name="country" required>
                    <option value="">Select Country</option>
                    <?php
                        include('includes/connect.php');

                        // Query to fetch countries from the database
                        $sql = "SELECT name FROM countries";
                        $result = $conn->query($sql);

                        // Check if there are any results
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                            }
                        }

                        // Close database connection
                        $conn->close();
                    ?>
                </select>
            </fieldset>

            <fieldset>
    <legend>Phone Numbers</legend>
    <div class="phone-email-container" id="phone-container">
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone[]" required>
        <div class="checkbox-group">
            <input type="checkbox" name="hide_phone[]" value="0"> Hide
        </div>
        <button type="button" onclick="addInput('phone-container', 'phone', 'hide_phone[]')">Add Phone</button>
        <button type="button" onclick="removeInput('phone-container')">Remove Phone</button>
    </div>
</fieldset>

<fieldset>
    <legend>Email Addresses</legend>
    <div class="phone-email-container" id="email-container">
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email[]" required>
        <div class="checkbox-group">
            <input type="checkbox" name="hide_email[]" value="0"> Hide
        </div>
        <button type="button" onclick="addInput('email-container', 'email', 'hide_email[]')">Add Email</button>
        <button type="button" onclick="removeInput('email-container')">Remove Email</button>
    </div>
</fieldset>



            <div class="checkbox-group">
                <input type="checkbox" id="publish" name="publish">
                <label for="publish">Publish Contact Information to Public Phonebook</label>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>

<script>
    function addInput(containerId, inputName, checkboxName) {
        var container = document.getElementById(containerId);
        var input = document.createElement('input');
        input.type = (inputName === 'phone') ? 'text' : 'email';
        input.name = inputName + '[]';
        input.required = true;
        container.appendChild(document.createElement('br'));
        container.appendChild(input);

        var checkboxGroup = document.createElement('div');
        checkboxGroup.classList.add('checkbox-group');

        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = checkboxName;
        checkbox.value = '1';

        var label = document.createElement('label');
        label.textContent = 'Hide';
        label.insertBefore(checkbox, label.firstChild);

        checkboxGroup.appendChild(label);
        container.appendChild(checkboxGroup);
    }

    function removeInput(containerId) {
    var container = document.getElementById(containerId);
    var inputs = container.querySelectorAll('input[type=text], input[type=email]');
    if (inputs.length > 1) {
        container.removeChild(inputs[inputs.length - 1]); // Remove last input
        container.removeChild(container.lastElementChild); // Remove associated checkbox
    } else {
        alert("At least one input field must be present.");
    }
}

</script>


<?php
    include('includes/footer.php');
?>
