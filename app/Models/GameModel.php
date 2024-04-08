<?php

class GameModel
{
    public function getHighScores()
    {
        $statement = db()->prepare('SELECT HISCORES.*, abweichung.deviation FROM HISCORES LEFT JOIN abweichung ON HISCORES.abweichung_id = abweichung.id ORDER BY HISCORES.Sekunden ASC, HISCORES.Tippzahl ASC LIMIT 10');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function checkAlias($alias): bool
    {
        $statement = db()->prepare('SELECT * FROM HISCORES WHERE Alias = :alias');
        $statement->bindParam(':alias', $alias);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? true : false;
    }

    public function createAlias($alias)
    {
        $statement = db()->prepare('INSERT INTO HISCORES (Alias, Sekunden, Tippzahl) VALUES (:alias, 0, 0)');
        $statement->bindParam(':alias', $alias);
        $statement->execute();
    }

    public function createAbweichung($min_number, $max_number, $deviation)
    {
        $statement = db()->prepare('INSERT INTO abweichung (min_number, max_number, deviation) VALUES (:min_number, :max_number, :deviation)');
        $statement->bindParam(':min_number', $min_number);
        $statement->bindParam(':max_number', $max_number);
        $statement->bindParam(':deviation', $deviation);
        $statement->execute();
        return db()->lastInsertId();
    }
    
    public function updateHighScore($alias, $seconds, $tips, $abweichung_id)
    {
        $currentHighScore = $this->getHighScoreByAlias($alias);
            
        if (!$currentHighScore || $seconds < $currentHighScore['Sekunden'] || ($seconds == $currentHighScore['Sekunden'] && $tips < $currentHighScore['Tippzahl'])) {
            $statement = db()->prepare('UPDATE HISCORES SET Sekunden = :seconds, Tippzahl = :tips, abweichung_id = :abweichung_id WHERE Alias = :alias');
            $statement->bindParam(':alias', $alias);
            $statement->bindParam(':seconds', $seconds);
            $statement->bindParam(':tips', $tips);
            $statement->bindParam(':abweichung_id', $abweichung_id);
            $statement->execute();
        }
    }
    
    
    

    public function getHighScoreByAlias($alias)
{
    $statement = db()->prepare('SELECT * FROM HISCORES WHERE Alias = :alias');
    $statement->bindParam(':alias', $alias);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

}
?>
