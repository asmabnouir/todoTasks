<?php
/*
    ./app/vues/templates/defaut.php
    Template par défaut
 */
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php include '../app/vues/templates/partials/head.php'; ?>
	</head>
	<body>
		<section class="todoapp">
			<?php include '../app/vues/templates/partials/content_tasks.php'; ?>
		</section>

		<?php include '../app/vues/templates/partials/footer.php'; ?>
		<?php include '../app/vues/templates/partials/scripts.php'; ?>
	</body>
</html>
