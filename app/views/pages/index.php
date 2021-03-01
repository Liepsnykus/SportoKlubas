<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="coverImg d-flex align-items-center justify-content-center">
    <h1 class="display-4 text-white"><?php echo $data['title'] ?></h1>
</div>

<div class="container800 products d-flex justify-content-around mx-auto">
    <div class="product d-flex flex-column align-items-center">
        <img src="./img/Product1.jpg" alt="weight training">
        <h4 class="text-center">Treniruoklių salė</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus tenetur voluptates unde repellat necessitatibus delectus dicta, totam alias! Saepe, asperiores!</p>
    </div>
    <div class="product d-flex flex-column align-items-center">
        <img src="./img/Product2.jpg" alt="aerobics training">
        <h4 class="text-center">Aerobika</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi nobis neque, sit sapiente ipsum esse doloremque voluptatum cum!</p>
    </div>
    <div class="product d-flex flex-column align-items-center">
        <img src="./img/Product3.jpg" alt="swimmer underwater">
        <h4 class="text-center">Baseinas</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae atque iusto magnam harum fuga officiis aliquid unde blanditiis nisi!</p>
    </div>
</div>

<div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2304.2194261622208!2d25.335691251574143!3d54.72335507828094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd96e7d814e149%3A0xdd7887e198efd4c7!2sSaul%C4%97tekio%20al.%2015%2C%20Vilnius%2010224!5e0!3m2!1sen!2slt!4v1614602247866!5m2!1sen!2slt" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>