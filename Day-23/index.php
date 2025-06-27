<?php
include 'db.php';

// Handle deletion
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Fetch all records
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students Table</title>
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 30px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #888;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            border: none;
            cursor: pointer;
        }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "index.php?id=" + id;
            }
        }
    </script>
</head>
<body>

<h2 style="text-align:center;">Student Records</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['course']) ?></td>
        <td>
            <button class="delete-btn" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
