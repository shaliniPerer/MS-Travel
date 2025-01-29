<?php

// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$database = "your_database";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to get hospitals based on district
function getHospitalsByDistrict($district) {
    global $conn;

    $sql = "SELECT * FROM hospitals WHERE district = '$district'";
    $result = mysqli_query($conn, $sql);

    $hospitals = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $hospitals[] = $row;
    }
    return $hospitals;
}

// Function to get hotels based on district
function getHotelsByDistrict($district) {
    global $conn;

    $sql = "SELECT * FROM hotels WHERE district = '$district'";
    $result = mysqli_query($conn, $sql);

    $hotels = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $hotels[] = $row;
    }
    return $hotels;
}

// Function to get vehicles based on district
function getVehiclesByDistrict($district) {
    global $conn;

    $sql = "SELECT * FROM vehicles WHERE district = '$district'";
    $result = mysqli_query($conn, $sql);

    $vehicles = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $vehicles[] = $row;
    }
    return $vehicles;
}

// Example usage:

if (isset($_POST['district_submit'])) {
    $district = $_POST['district'];

    // Get hospitals based on district
    $hospitals = getHospitalsByDistrict($district);

    // Get hotels based on district
    $hotels = getHotelsByDistrict($district);

    // Get vehicles based on district
    $vehicles = getVehiclesByDistrict($district);
}

?>

<!-- HTML form to select district -->
<form method="post">
    Select District:
    <select name="district">
        <option value="district1">District 1</option>
        <option value="district2">District 2</option>
        <option value="district3">District 3</option>
        <!-- Add more options as needed -->
    </select>
    <input type="submit" name="district_submit" value="Submit">
</form>

<!-- Display hospitals -->
<h2>Hospitals:</h2>
<ul>
    <?php if (!empty($hospitals)): ?>
        <?php foreach ($hospitals as $hospital): ?>
            <li><?php echo $hospital['name']; ?> - <?php echo $hospital['address']; ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No hospitals found.</li>
    <?php endif; ?>
</ul>

<!-- Display hotels -->
<h2>Hotels:</h2>
<ul>
    <?php if (!empty($hotels)): ?>
        <?php foreach ($hotels as $hotel): ?>
            <li><?php echo $hotel['name']; ?> - <?php echo $hotel['address']; ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No hotels found.</li>
    <?php endif; ?>
</ul>

<!-- Display vehicles -->
<h2>Vehicles:</h2>
<ul>
    <?php if (!empty($vehicles)): ?>
        <?php foreach ($vehicles as $vehicle): ?>
            <li><?php echo $vehicle['name']; ?> - <?php echo $vehicle['type']; ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No vehicles found.</li>
    <?php endif; ?>
</ul>

