<?php

session_start();

$alphabet = range('a', 'z');
$numbers = range(0, 9);
$result = [];

if (!empty($_POST)) {

    $_SESSION['count'] = $_POST['count'];
    $_SESSION['letters'] = $_POST['letters'];
    $range = explode('-', $_POST['count']);

    $start = $range[0];
    $finish = $range[1];

    if ($_POST['letters'] === 'letters') {
        for ($i = 1; $i <= rand($start, $finish); $i++) {
            $result[] = $alphabet[rand(0, 25)];
        }
    }
    if ($_POST['letters'] === 'letters-numbers') {
        for ($i = 1; $i <= rand($start, $finish); $i++) {
            if (rand(0, 1) === 0) {
                $result[] = $alphabet[rand(0, 25)];
            } else {
                $result[] = $numbers[rand(0, 9)];
            }
        }
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
                <option <?php if (!empty($_SESSION) and $_SESSION['count'] === '3-8') echo 'selected'; else {
                    echo '';
                } ?> value="3-8">3-8
                </option>
                <option <?php if (!empty($_SESSION) and $_SESSION['count'] === '9-14') echo 'selected'; else {
                    echo '';
                }; ?> value="9-14">9-14
                </option>
                <option <?php if (!empty($_SESSION) and $_SESSION['count'] === '15-20') echo 'selected'; else {
                    echo '';
                }; ?> value="15-20">15-20
                </option>
                <option <?php if (!empty($_SESSION) and $_SESSION['count'] === '21-26') echo 'selected'; else {
                    echo '';
                }; ?> value="21-26">21-26
                </option>
                <option <?php if (!empty($_SESSION) and $_SESSION['count'] === '27-35') echo 'selected'; else {
                    echo '';
                }; ?> value="27-35">27-35
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


