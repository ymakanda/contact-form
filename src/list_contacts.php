<?php
session_start();
$success = $_SESSION['success'] ?? '';
require 'config/database.php';

$dsn = DB_DRIVER .':host='. DB_HOST. ';dbname='.DB_NAME;

try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, name, email, phone, message, created_at FROM contacts");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                echo "<tr>
                        <td>{$contact['id']}</td>
                        <td>{$contact['name']}</td>
                        <td>{$contact['email']}</td>
                        <td>{$contact['phone']}</td>
                        <td>{$contact['message']}</td>
                        <td>{$contact['created_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No entries found</td></tr>";
        }
        ?>
        </tbody>
    </table>
<?php include 'includes/footer.php'; ?>