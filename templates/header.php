<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
     <tr>
        <td colspan="2" style="text-align: right">
            <?= !empty($user) ? 'Привет, ' . $user->getNickname().' | <a href = "/users/logout">Выйти</a>'
             : '<a href="/users/login">Войдите на сайт</a> | <a href="/users/register">Зарегистрироваться</a>' ?>
        </td>
    </tr>
    <tr>
        <td>