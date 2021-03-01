<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container400">
    <h1><?php echo $data['title'] ?></h1>
    <form method="POST">
        <div class="form-group">
            <label for="email">Elektroninis paštas</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Slaptažodis</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Prisijungti</button>
          <a class="btn btn-secondary" href="<?php echo URLROOT?>users/register">Neturite paskyros? Užsiregistruokite</a>
        </div>
        
    </form>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>