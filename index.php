<?php

session_start();

$result = [];

if (!empty($_POST)) {

    $latinConsonants = [
        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
    ];
    $latinVowels = ['a', 'e', 'i', 'o', 'u'];

    $_SESSION['count'] = $_POST['count'];
    $_SESSION['letters'] = $_POST['letters'];
    $range = explode('-', $_POST['count']);

    $start = $range[0];
    $finish = $range[1];
    $limit = rand($start, $finish - 2);

    if ($_POST['letters'] === 'letters') {

        while (count($result) < rand($start, $finish)) {
            if (rand(1, 100) <= 95) {
                $result[] = $latinConsonants[rand(0, 20)];
            }
            $result[] = $latinVowels[rand(0, 4)];
        }
    }

    if ($_POST['letters'] === 'letters-numbers') {

        while (count($result) < $limit) {
            if (rand(1, 100) <= 95) {
                $result[] = $latinConsonants[rand(0, 20)];
            }
            $result[] = $latinVowels[rand(0, 4)];
        }

        $result[] = str_repeat(rand(1, 9), rand(1, 2));
    }

    $_SESSION['result'] = $result;


    header('Location:/');
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Генератор логинов онлайн</title>
    <link rel="stylesheet" href="styles/style.css"/>
</head>
<body>
<div class="container">
    <h2>Генератор логинов онлайн</h2>
    <form action="" method="post">
        <div class="filter-group">
            <label for="lengthRange">Длина</label>
            <select id="lengthRange" name="count">
                <option <?php if (!empty($_SESSION) and $_SESSION['count'] === '3-6') echo 'selected'; else {
                    echo '';
                } ?> value="3-6">3-6
                </option>
                <option <?php if (!empty($_SESSION) and $_SESSION['count'] === '7-10') echo 'selected'; else {
                    echo '';
                }; ?> value="7-10">7-10
                </option>
                <option <?php if (!empty($_SESSION) and $_SESSION['count'] === '11-15') echo 'selected'; else {
                    echo '';
                }; ?> value="11-15">11-15
                </option>
            </select>
        </div>
        <div class="filter-group">
            <label for="letters">Тип логина</label>
            <select id="letters" name="letters">
                <option <?php if (!empty($_SESSION) and $_SESSION['letters'] === 'letters') echo 'selected'; else {
                    echo '';
                } ?> value="letters">Буквы
                </option>
                <option <?php if (!empty($_SESSION) and $_SESSION['letters'] === 'letters-numbers') echo 'selected'; else {
                    echo '';
                } ?>
                        value="letters-numbers">Буквы и
                    Цифры
                </option>
            </select>
        </div>
        <button type="submit">Применить</button>
    </form>

    <div class="output-section" id="outputSection">
        <div id="output"><?php if (isset($_SESSION['result'])) echo implode('', $_SESSION['result']) ?></div>
    </div>
</div>
</body>
</html>
