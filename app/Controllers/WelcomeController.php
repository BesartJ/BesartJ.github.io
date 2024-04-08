<?php


public function index()
{
    $alias = $_SESSION['alias'] ?? '';
    $highScores = $this->getHighScores();
    require 'app/Views/WelcomeView.php';
}

    
    public function getHighScores()
{
    $model = new GameModel();
    return $model->getHighScores();
}


?>