<div class="container">
    <form method="post" class="action-form" action="/php/check_mask.php">
        <div class="form-group">
            <label for="exampleInput">Номер телефона</label>
            <input type="text" class="form-control" id="exampleInput" name="phoneNumber" placeholder="Введите номер">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    <div class="result-container"><?php if (isset($_GET['message'])) echo $_GET['message']; ?></div>
</div>