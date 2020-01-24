<?php declare(strict_types=1);

require __DIR__ . '/../app/init.php';

$registerForm = new \app\forms\RegisterForm();
if(isset($_POST['email']) && !$registerForm->load($_POST)->validate()) {
    $errors = $registerForm->getErrorMessages();
} else {
    $errors = [];
}

$fields = [
    'email' => ['text', 'E-mail'],
    'phone' => ['text', 'Phone number'],
    'full_name' => ['text', 'Full name'],
    'password' => ['password', 'Password'],
    'repassword' => ['password', 'Repeat password'],
];
?>

<?php require __DIR__ . '/header.php' ?>

<h1>Register</h1>

<div style="margin-bottom: 20px; color: darkblue;">All fields required</div>

<form method="post">
    <?php foreach ($fields as $fieldName => $fieldProps):
        [$fieldType, $fieldLabel] = $fieldProps; ?>
        <div style="margin-bottom: 20px">
            <label for="<?= $fieldName ?>" style="display: block"><?= $fieldLabel ?>:</label>
            <input type="<?= $fieldType ?>" name="<?= $fieldName ?>" id="<?= $fieldName ?>"
                   value="<?= isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName]) : '' ?>">

            <?php if(isset($errors[$fieldName])): ?>
                <?php foreach ($errors[$fieldName] as $error): ?>
                    <div style="color: darkred"><?= $error ?></div>
                <?php endforeach; ?>
            <?php elseif(isset($_POST[$fieldName])): ?>
                <div style="color: darkgreen">Correct</div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <input type="submit" value="Register">
</form>

<?php require __DIR__ . '/footer.php' ?>
