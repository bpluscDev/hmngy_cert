<?php
session_start();
require_once 'includes/auth.php';
require_login();

require_once 'includes/db.php';
require_once 'templates/header.php';

// Fetch certificates from the database
$sql = "SELECT * FROM certificates";
$result = $conn->query($sql);
?>

<a href="create.php" class="btn btn-primary mb-3">Add Certificate</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Certificate ID</th>
            <th>Full Name</th>
            <th>Company</th>
            <th>Certification</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre_completo']; ?></td>
                    <td><?php echo $row['nombre_empresa']; ?></td>
                    <td><?php echo $row['nombre_certificacion']; ?></td>
                    <td><?php echo $row['fecha_inicio']; ?></td>
                    <td><?php echo $row['fecha_fin']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this certificate?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No certificates found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$conn->close();
require_once 'templates/footer.php';
?>
