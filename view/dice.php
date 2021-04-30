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
$diceHandSum = $diceHandSum ?? null;
$lastDice = $lastDice ?? null;
$roll = $_POST["roll"] ?? 0;


?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<div class="btn-choices">
    <form action="<?= $action ?>" class="button" method="POST">
        <input type="hidden" name="roll" value="1">
        <button type="submit">Roll one</button>
    </form>
    <form action="<?= $action ?>" class="button" method="POST">
        <input type="hidden" name="roll" value="2">
        <button type="submit">Roll two</button>
    </form>
    <form action="<?php $action ?>" class="button" method="POST">
        <input type="hidden" name="roll" value="stay">
        <button type="submit">Stay</button>
    </form>
    </form>
</div>
<div class="dice-area">
    <?php if ($roll !== 0) : ?>
        <p>Hand sum</p>
        <p><?= $diceHandSum ?></p>
        <p>Score</p>
        <p><?= $_SESSION["score"] = $diceHandSum + ($_SESSION["score"] ?? 0) ?></p>
        <p>Dice rolled</p>
        <p><?= $lastDice ?></p>
    <?php endif ?>
</div>
<!-- <p><?= $dieLastRoll ?></p> -->



<?php
var_dump($_SESSION);

var_dump($_POST);

echo <<<EOD
<?php><a href="$url">destroy the session</a></?php>
EOD;;
