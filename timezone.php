<!DOCTYPE html>
<html>
<head>
    <title>Time Zone Selection</title>
</head>
<body>

<form method="post">
    <label for="timezone">Select Time Zone:</label>
    <select name="timezone" id="timezone">
        <?php
        $timezones = timezone_identifiers_list();
        foreach ($timezones as $timezone) {
            echo "<option value=\"$timezone\">$timezone</option>";
        }
        ?>
    </select>
    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected time zone
    $selectedTimeZone = $_POST["timezone"];

    // Create a DateTimeZone object
    $dateTimeZone = new DateTimeZone($selectedTimeZone);

    // Create a DateTime object with the selected time zone
    $dateTime = new DateTime("now", $dateTimeZone);

    // Display the current time in the selected time zone
    echo "<p>Current time in $selectedTimeZone: " . $dateTime->format("Y-m-d H:i:s") . "</p>";
}
?>

</body>
</html>
