<!-- Datei: app/Views/WelcomeView.php -->

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
    <h1 class="welcome">Willkommen zum Spiel</h1>
    <!-- Klarer Erklärungstext -->
    <p>Dies ist ein Zahlenraten-Spiel. Ihr Ziel ist es, eine zufällig generierte Zahl zu erraten. Je weniger Versuche Sie benötigen, desto besser ist Ihr Score! Viel Spaß!</p>

    <h2 class="high-scores">Top 5 High-Scores</h2>
    <ul class="high-scores">
    <ul class="high-scores">
    <?php foreach ($highScores as $score): ?>
        <li>
            <?= $score['Alias'] ?>: <?= $score['Sekunden'] ?> Sekunden, <?= $score['Tippzahl'] ?> Tipps, 
            <span style="float: right;">
                Abweichung: 
                <span style="color: <?= $score['deviation'] >= 0 ? 'green' : 'red' ?>;">
                    <?= $score['deviation'] > 0 ? '+' : '' ?><?= $score['deviation'] ?>
                </span>
            </span>
        </li>
    <?php endforeach; ?>
</ul>





    <form action="index.php?url=game/start" method="post" onsubmit="return validateForm();">
        <label for="min_number">Minimale Zahl:</label>
        <input id="min_number" type="number" name="min_number" required>
        <label for="max_number">Maximale Zahl:</label>
        <input id="max_number" type="number" name="max_number" required>
        <label for="alias">Gib deinen Alias ein:</label>
        <input type="text" id="alias" name="alias" value="<?= isset($alias) ? htmlspecialchars($alias) : '' ?>">
        <span id="alias_error" style="color: red; display: none;">Feld ist leer!</span>
        <button type="submit">Spiel starten</button>
    </form>






        <script>
        function validateForm() {
            const alias = document.getElementById('alias');
            const aliasError = document.getElementById('alias_error');
            if (alias.value.trim() === '') {
                aliasError.style.display = 'inline';
                return false;
            } else {
                aliasError.style.display = 'none';
                return true;
            }
        }
        </script>





    </div>

    <script src="public/js/app.js"></script>
</body>
</html>