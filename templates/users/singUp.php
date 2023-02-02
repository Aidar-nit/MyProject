<?php include __DIR__ . '/../header.php'; ?>
    <div style="text-align: center;">
        <h1>Регистрация</h1>
        <form action="/users/register" method="post">
            <label>Nickname <input type="text" name="nickname"></label>
            <br><br>
            <label>Email <input type="text" name="email"></label>
            <br><br>
            <label>Пароль <input type="password" name="password"></label>
            <br><br>
            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>