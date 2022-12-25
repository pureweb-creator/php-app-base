<?php include 'inc/header.php'; ?>

<h1><?= $data->lang->homepage_title; ?></h1>

<article>
	<form action="" method="POST">
		<input type="hidden" name="csrf" value="<?= $_SESSION['csrf_token'] ?>">
		<input type="text" name="name" placeholder="Name">
		<button type="submit">Send</button>
	</form>

    <ul>
        <?php foreach ($data->users as $user): ?>
        <li><?= $user['name']; ?></li>
        <?php endforeach; ?>
    </ul>
</article>

<?php include 'inc/footer.php'; ?>
