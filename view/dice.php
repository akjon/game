<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$url = url("/session/destroy");
$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$diceAmount = $_POST["dice"] ?? 0;
?>

<!-- <h1><?= var_dump($_SESSION["diceAmount"] ?? null) ?></h1> -->
<!-- <h1><?= var_dump($diceAmount) ?></h1> -->


?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<div class="btn-choices">
    <form action="<?= $action ?>" class="button" method="POST">
        <input type="hidden" name="dice" value="1">
        <button type="submit">Roll one</button>
    </form>
    <form action="<?= $action ?>" class="button" method="POST">
        <input type="hidden" name="dice" value="2">
        <button type="submit">Roll two</button>
    </form>
    <form action="stay" class="button" method="POST">
        <input type="hidden" name="stay">
        <button type="submit">Stay</button>
    </form>
    </form>
</div>
<div class="dice-area">
    <?php if ($diceAmount !== 0) : ?>

        <p>
        <p><?= $diceHandRoll1 ?></p>
        </p>
    <?php endif ?>
</div>
<!-- <p><?= $dieLastRoll ?></p> -->

<p>Dicehand1</p>


<?php
var_dump($_SESSION);

var_dump($_POST);

echo <<<EOD
<?php><a href="$url">destroy the session</a></?php>
EOD;;
