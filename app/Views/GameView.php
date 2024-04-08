<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Spiel</title>
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
    <div id="game-container" class="container">
        <h1>Willkommen <?= isset($_SESSION['alias']) ? $_SESSION['alias'] : '' ?>!</h1>
        <p class="game-info">TIMER: <?= $elapsedTime ?> Sekunden</p>
        <p>Was ist dein erster Tipp?</p>
        <form action="index.php?url=game/tip" method="post">
            <input id="guess-input" type="number" name="tip" min="0" max="1000" required>
            <button id="submit-button" type="submit">Absenden</button>
        </form>
        <br>
        <button class="ios-button" onclick="location.href='index.php?url=game/abort'">Spiel abbrechen</button>
    </div>
    <script src="public/js/app.js"></script>
</body>
</html>
