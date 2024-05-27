<?php
session_start(); // Start the session

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the user is a teacher
$is_teacher = isset($_SESSION['role']) && $_SESSION['role'] === 'teacher';

// Include the database connection file
include 'db.php';

// Initialize $username variable
$username = '';

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Get the logged-in user's username
    $username = $_SESSION['username'];
}

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Example</title>
    <!-- Add Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<style>
    .content-container {
        margin-top: 100px; /* Adjust the value as needed */
    }
</style>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Students Data</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Logged in as: <span class="text-info"><?php echo htmlspecialchars($username); ?></span></a>
                    </li>
                </ul>
                <!-- Logout Button -->
                <a class="btn btn-danger" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>
<div class="container content-container">
    <h2 class="text-center">Users List</h2>
    <!-- Table to display users -->
    <table class="table">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>DoB</th>
                <th>Gender</th>
                <th>College</th>
                <th>Department</th>
                <th>Course</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['college']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                    <td>
                        <?php if ($row['status']): ?>
                            <span class="badge badge-success py-2">Active</span>
                        <?php else: ?>
                            <span class="badge badge-secondary py-2">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
                            <?php if ($is_teacher): ?>
                                <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <!-- Link to add a new user, only visible to teachers -->
    <?php if ($is_teacher): ?>
        <a href="create.php" class="btn btn-primary">Add New User</a>
    <?php endif; ?>
</div>

<!-- Bootstrap JS (optional, for certain Bootstrap features like dropdowns) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
