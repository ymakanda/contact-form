<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$formData = $_SESSION['formData'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['errors'], $_SESSION['formData'], $_SESSION['success']);
?>
<?php include 'includes/header.php'; ?>

    <h2>Contact Us</h2>
    <form id="contactForm" action="save_contact.php" method="POST" class="needs-validation" novalidate>
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo htmlspecialchars($formData['name'] ?? '', ENT_QUOTES); ?>" required>
            <div class="invalid-feedback"><?php echo $errors['name'] ?? 'Please enter your name.'; ?></div>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo htmlspecialchars($formData['email'] ?? '', ENT_QUOTES); ?>" required>
            <div class="invalid-feedback"><?php echo $errors['email'] ?? 'Please enter a valid email address.'; ?></div>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>" id="phone" name="phone" pattern="^((\+27|0|27)[1-8][0-9]{8})$" value="<?php echo htmlspecialchars($formData['phone'] ?? '', ENT_QUOTES); ?>" required>
            <div class="invalid-feedback"><?php echo $errors['phone'] ?? 'Please enter a valid South African phone number.'; ?></div>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : ''; ?>" id="message" name="message" rows="5" required><?php echo htmlspecialchars($formData['message'] ?? '', ENT_QUOTES); ?></textarea>
            <div class="invalid-feedback"><?php echo $errors['message'] ?? 'Please enter your message.'; ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?php include 'includes/footer.php'; ?>
<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
