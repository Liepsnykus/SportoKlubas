<?php require APPROOT . '/views/inc/header.php';
?>

<div class="container400">
    <h1><?php echo $data['title'] ?></h1>
    <form method="POST">
        <div class="form-group">
            <label for="name">Vartotojo vardas</label>
            <input type="text" class="form-control" name="name" id="name">
            <span class='text-danger'><?php echo $data['errors']['nameErr'] ?></span>
        </div>
        <div class="form-group">
            <label for="email">Elektroninis paštas</label>
            <input type="email" class="form-control" name="email" id="email">
            <span class='text-danger'><?php echo $data['errors']['emailErr'] ?></span>
        </div>
        <div class="form-group">
            <label for="password">Slaptažodis</label>
            <input type="password" class="form-control" name="password" id="password">
            <span class='text-danger'><?php echo $data['errors']['passwordErr'] ?></span>
        </div>
        <div class="form-group">
            <label for="passwordRepeat">Pakartokite slaptažodį</label>
            <input type="password" class="form-control" name="passwordRepeat" id="passwordRepeat">
            <span class='text-danger'><?php echo $data['errors']['passwordRepeatErr'] ?></span>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Registruotis</button>
          <a class="btn btn-secondary" href="<?php echo URLROOT?>users/login">Turite paskyrą? prisijunkite</a>
        </div>
        
    </form>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>