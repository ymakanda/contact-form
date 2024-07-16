<?php
function isActive($page) {
    return basename($_SERVER['PHP_SELF']) == $page ? 'active' : '';
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php echo isActive('index.php'); ?>">
                <a class="nav-link" href="index.php">Contact Form</a>
            </li>
            <li class="nav-item <?php echo isActive('list_contacts.php'); ?>">
                <a class="nav-link" href="list_contacts.php">Contact List</a>
            </li>
        </ul>
    </div>
</nav>
