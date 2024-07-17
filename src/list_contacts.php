<?php

session_start();
$success = $_SESSION['success'] ?? '';

require 'config/database.php';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$dsn = DB_DRIVER .':host='. DB_HOST. ';dbname='.DB_NAME;

try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT id, name, email, phone, message, created_at FROM contacts ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalStmt = $pdo->query("SELECT COUNT(*) FROM contacts");
    $totalEntries = $totalStmt->fetchColumn();
    $totalPages = ceil($totalEntries / $limit);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<?php include 'includes/header.php'; ?>

<?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

    <h2>Contact Entries</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (count($contacts) > 0) {
            foreach ($contacts as $contact) {
                $createdAt = new DateTime($contact['created_at']);
                echo "<tr>
                        <td>{$contact['id']}</td>
                        <td>{$contact['name']}</td>
                        <td>{$contact['email']}</td>
                        <td>{$contact['phone']}</td>
                        <td>{$contact['message']}</td>
                        <td>{$createdAt->format('d M Y, H:i')}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No entries found</td></tr>";
        }
        ?>
        </tbody>
    </table>
     <!-- Pagination -->
     <?php include 'includes/pagination.php'; ?>
      <!-- Pagination -->

<?php include 'includes/footer.php'; ?>