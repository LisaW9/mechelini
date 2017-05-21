<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
}

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});

try {
    //PROFILE
    $user = User::getProfile();

    //CARDS THEME
    $cardProgress = Cards::getCardsProgress();

} catch (Exception $e) {
    echo $e->getMessage();
}

foreach ($cardProgress as $c):

    try {
        if (!empty($_POST[$c["themeID"]])) {
            $selectedField = $_POST[$c["themeID"]];

            echo $selectedField;

            Cards::resetCards($selectedField);

        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

endforeach;

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/progress.css">
    <title>progress van <?php echo $user->firstName; ?></title>
</head>
<body>
<?php $page = 'Progress';
include_once('includes/header.inc.php'); ?>
<div id="container">
    <div class="progress">
        <?php foreach ($cardProgress as $c):?>
        <div class="progress_block <?php if($c["theme_ID"]% 2 == 0){echo "even";}else{echo "odd";}?>">
            <h1><?php echo $c["name"] ?></h1>
            <h2>je hebt <?php echo $c["amountOfCollectedCards"] ?> van de 20 kaarten voor deze categorie</h2>

            <?php if($c["amountOfCollectedCards"] < 20): ?>

                <form action="" method="post" id="reset_collection" class="reset_collection">
                    <input type="hidden" name="<?php echo $c["themeID"] ?>" value="<?php echo $c["themeID"] ?>">
                    <button>RESET</button>
                </form>

            <?php endif; ?>

        </div>
        <?php endforeach;?>
    </div>
</div>
</body>
</html>