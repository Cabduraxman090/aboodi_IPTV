<h2>User Registration</h2>
<p>Create an account to access the student or parent portal.</p>

<?php
if (isset($_SESSION['error_message'])) {
    echo '<div style="color: red; background-color: #ffcccc; border: 1px solid red; padding: 10px; margin-bottom: 15px; border-radius: 4px;">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
    unset($_SESSION['error_message']); // Clear the message after displaying it
}
?>

<form action="register_process.php" method="POST">
    <div style="margin-bottom: 15px;">
        <label for="full_name" style="display: block; margin-bottom: 5px;">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="email" style="display: block; margin-bottom: 5px;">Email Address:</label>
        <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="password" style="display: block; margin-bottom: 5px;">Password:</label>
        <input type="password" id="password" name="password" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="role" style="display: block; margin-bottom: 5px;">I am a:</label>
        <select id="role" name="role" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">--Please choose an option--</option>
            <option value="student">Student</option>
            <option value="parent">Parent</option>
            <option value="teacher">Teacher</option>
        </select>
    </div>
    <div>
        <button type="submit" style="background-color: #333; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Register</button>
    </div>
</form>
