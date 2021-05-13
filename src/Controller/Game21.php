<?php

declare(strict_types=1);

namespace Mos\Controller;

use joka20\Dice\Game;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{redirectTo, renderView, getBaseUrl};

/**
 * Controller for the "Game 21" route.
 */
class Game21
{
    public function init(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Game();
        $callable->initGame();

        $body = renderView("layout/dice.php");

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function play(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Game();
        $callable->playGame();

        $body = renderView("layout/dice.php");

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function reset()
    {
        $_SESSION["scores['Human']"] = 0;
        $_SESSION["scores['Robot']"] = 0;

        redirectTo(getBaseUrl() . "/dice");
    }
}
