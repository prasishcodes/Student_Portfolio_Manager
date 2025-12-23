<?php 
require 'header.php'; 
require 'functions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = formatName($_POST['name']);
        if (empty($name)) throw new Exception("Name is required.");

        $email = validateEmail($_POST['email']);

        $skillsArray = cleanSkills($_POST['skills']);

        saveStudent($name, $email, $skillsArray);

        $message = '<p class="success">Student added successfully!</p>';
    } catch (Exception $e) {
        $message = '<p class="error">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
?>

<h2>Add Student Information</h2>
<?php echo $message; ?>

<form method="post">
    <label>Name: <input type="text" name="name" required></label><br><br>
    <label>Email: <input type="email" name="email" required></label><br><br>
    <label>Skills (comma-separated): <textarea name="skills" required></textarea></label><br><br>
    <button type="submit">Add Student</button>
</form>

<?php require 'footer.php'; ?>