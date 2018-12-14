<?php
include '../vendor/autoload.php';

$container   = new \DI\Container();
$farmService = $container->get('FarmGame\\Service\\FarmService');
$stateService = $container->get('FarmGame\\Service\\StateService');
$response = "Please select and option below";
$history = '';

if (isset($_POST['newGame'])) {
    $response = $farmService->newGame();
	$history = $stateService->getHistory();
}

if (isset($_POST['feed'])) {
    $response = $farmService->processTurn();
	$history = $stateService->getHistory();
}
?>
<form action="index.php" method="POST">
    <button type="submit" name="newGame">Start New Game</button>
    <button type="submit" name="feed">Feed an Animal</button>
</form>
<?php
echo "Current Response : ".$response;
echo $history;
?>