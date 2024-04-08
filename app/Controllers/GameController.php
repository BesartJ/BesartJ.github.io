<?php

require_once 'app/Models/GameModel.php';

class GameController
{
    private $model;

    public function __construct()
    {
        $this->model = new GameModel();
    }

    public function welcome()
    {
        $highScores = $this->model->getHighScores();
        require 'app/Views/WelcomeView.php';
    }

    public function startGame()
    {
        if(isset($_POST['alias'])){
            $_SESSION['alias'] = $_POST['alias'];
            $_SESSION['start_time'] = time();
            $_SESSION['min_number'] = $_POST['min_number'] ?? 0;        
            $_SESSION['max_number'] = $_POST['max_number'] ?? 1000;
            $_SESSION['tips_count'] = 0;  // Reset Versuche
    
            // Erzeugen Sie eine zufällige Zahl im eingegebenen Bereich.
            $_SESSION['correctNumber'] = rand($_SESSION['min_number'], $_SESSION['max_number']);
    
            header('Location: index.php?url=game');
        } else {
            // Handle error here
        }
    }

    public function game()
    {
        $alias = $_SESSION['alias'] ?? '';
        $startTime = $_SESSION['start_time'] ?? null;
        $elapsedTime = $startTime ? time() - $startTime : 0;
        require 'app/Views/GameView.php';
    }

    public function playGame()
    {
        $alias = $_SESSION['alias'] ?? '';
        $startTime = $_SESSION['start_time'] ?? null;
        $elapsedTime = $startTime ? time() - $startTime : 0;
        require 'app/Views/GameView.php';
    }

    public function abort()
    {
        // Löschen Sie die spiel-spezifischen Session-Daten
        unset($_SESSION['start_time']);
        header('Location: index.php?url=/');
    }

    public function processTip()
    {
        if(isset($_POST['tip'])){
            $_SESSION['tip'] = $_POST['tip'];
            $_SESSION['tips_count'] = isset($_SESSION['tips_count']) ? $_SESSION['tips_count'] + 1 : 1;
            header('Location: index.php?url=game/answer');
        } else {
            // Handle error here
        }
    }

    public function showAnswer()
    {
        $alias = $_SESSION['alias'] ?? '';
        $startTime = $_SESSION['start_time'] ?? null;
        $elapsedTime = $startTime ? time() - $startTime : 0;
        $tips_count = $_SESSION['tips_count'] ?? 0;
        $tip = $_SESSION['tip'] ?? null;

        // Logik um den Tipp zu prüfen und eine Antwort zu generieren, dies könnte eine Funktion sein die Sie schreiben
        $result = $this->checkTip($tip);

        require 'app/Views/AnswerView.php';
    }

    public function calculateDeviation($tips_count) {
        $expectedOptimum = ceil(log($_SESSION['max_number'] - $_SESSION['min_number'] + 1, 2));
        return $tips_count - $expectedOptimum;
    }

    public function checkTip($tip)
    {
        $correctNumber = $_SESSION['correctNumber'] ?? null;
        $tipCount = $_SESSION['tips_count'] ?? 0;
        $maxTipCount = ceil(log($_SESSION['max_number'] - $_SESSION['min_number'] + 1, 2) * 1.5); 

        if ($correctNumber == $tip) {
            $alias = $_SESSION['alias'];
            $seconds = time() - $_SESSION['start_time'];
            $tips = $_SESSION['tips_count'];
            $abweichung_id = $this->model->createAbweichung($_SESSION['min_number'], $_SESSION['max_number'], $maxTipCount - $tips);
            $this->model->updateHighScore($alias, $seconds, $tips, $abweichung_id);
            return "Treffer!";
        } else if ($correctNumber > $tip) {
            if ($tipCount >= $maxTipCount) {
                // Spiel abbrechen, da die maximale Tippzahl erreicht wurde
                return "Du hättest die Zahl bereits finden müssen!";
            }
            return "Zu niedrig geraten!";
        } else {
            if ($tipCount >= $maxTipCount) {
                // Spiel abbrechen, da die maximale Tippzahl erreicht wurde
                return "Du hättest die Zahl bereits finden müssen!";
            }
            return "Zu hoch geraten!";
        }
    }

    public function saveGame($tip)
    {
        try {
            // Verbindung zur Datenbank herstellen
            $db = new PDO('mysql:host=localhost;dbname=game_db;charset=utf8', 'username', 'password');

            // SQL-Anweisung vorbereiten
            $stmt = $db->prepare('INSERT INTO games (alias, start_time, end_time, tips_count, correct_tip) VALUES (:alias, FROM_UNIXTIME(:start_time), NOW(), :tips_count, :correct_tip)');

            // Werte binden
            $stmt->bindParam(':alias', $_SESSION['alias']);
            $stmt->bindParam(':start_time', $_SESSION['start_time']);
            $stmt->bindParam(':tips_count', $_SESSION['tips_count']);
            $stmt->bindParam(':correct_tip', $tip);

            // Anweisung ausführen
            $stmt->execute();

        } catch (PDOException $e) {
            // Fehlerbehandlung
            error_log("PDO Error: ".$e->getMessage());
            die("Database error. Please contact admin.");
        }
    }
}

?>
