<!-- Datei: app/Views/AnswerView.php -->

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Spiel</title>
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
    <div class="container">
        <h1>Hallo <?= $alias ?>!</h1>
        <p>Dein Tipp war: <?= $tip ?></p>
<p>Antwort: <?= $result ?></p>

        <p>Bisher benötigte Zeit: <?= $elapsedTime ?> Sekunden</p>
        <p>Bisherige Anzahl an Tipps: <?= $tips_count ?></p>

        <button class="ios-button" onclick="location.href='index.php?url=game'">Nächster Tipp</button>
        <button class="ios-button" onclick="location.href='index.php?url=game/abort'">Zurück zum Menü</button>


    </div>
</body>
</html>
