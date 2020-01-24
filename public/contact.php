<?php declare(strict_types=1);

require __DIR__ . '/../app/init.php';

$contactForm = new \app\forms\ContactForm();
if(isset($_POST['email']) && !$contactForm->load($_POST)->validate()) {
    $errors = $contactForm->getErrorMessages();
}

$fields = [
    'email' => ['text', 'E-mail'],
    'phone' => ['text', 'Phone number'],
    'full_name' => ['text', 'Full name'],
    'message' => ['textarea', 'Message'],
];
?>

<?php require __DIR__ . '/header.php' ?>

<h1>Contact</h1>

<div style="margin-bottom: 20px; color: darkblue;">E-mail and Message fields required</div>

<form method="post">
    <?php foreach ($fields as $fieldName => $fieldProps):
        [$fieldType, $fieldLabel] = $fieldProps; ?>
        <div style="margin-bottom: 20px">
            <label for="<?= $fieldName ?>" style="display: block"><?= $fieldLabel ?>:</label>

            <?php if($fieldType == 'textarea'): ?>
                <textarea name="<?= $fieldName ?>" id="<?= $fieldName ?>" cols="50" rows="10"
                    ><?= isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName]) : '' ?></textarea>
            <?php else: ?>
                <input type="<?= $fieldType ?>" name="<?= $fieldName ?>" id="<?= $fieldName ?>"
                       value="<?= isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName]) : '' ?>">
           <?php endif; ?>

            <?php if(isset($errors[$fieldName])): ?>
                <?php foreach ($errors[$fieldName] as $error): ?>
                    <div style="color: darkred"><?= $error ?></div>
                <?php endforeach; ?>
            <?php elseif(isset($_POST[$fieldName])): ?>
                <div style="color: darkgreen">Correct</div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <input type="submit" value="Send message">
</form>

<?php require __DIR__ . '/footer.php' ?>
