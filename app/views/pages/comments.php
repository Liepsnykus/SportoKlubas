<?php require APPROOT . '/views/inc/header.php'; ?>

<div class='container800'>
    <h1><?php echo $data['title'] ?></h1>

    <div class="commentsContainer" id="commentsContainer">

    </div>

    <?php if (isset($_SESSION['id'])) : ?>
        <form id="commentForm" method="post">
            <div class="form-group">
                <label for="text">Jūsų komentaras:</label>
                <textarea class="form-control" name="text" id="text" cols="20" rows="10"></textarea>
                <span class='text-danger'></span>
            </div>
            <button type="submit" class="btn btn-primary">Paskelbti</button>
        </form>
        <?php else: ?>

        <h2>Norite palikti komentarą?</h2>
        <a href="<?php echo URLROOT ?>users/login" class="btn btn-primary">Prisijunkite</a>

        <?php endif?>

</div>

<script>
    const commentText = document.getElementById('text')
    const commentsContainer = document.getElementById('commentsContainer')
    
    <?php if(isset($_SESSION['id'])): ?>
    const commentForm = document.getElementById('commentForm')
    commentForm.addEventListener('submit', postComment)
    <?php endif ?>

    function postComment(event) {
 
        event.preventDefault()

        const commentFormData = new FormData(commentForm)
        commentFormData.append('user', '<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>')
        commentFormData.append('user_id', '<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>')

        fetch("<?php echo URLROOT . '/API/postComment' ?>", {
                method: 'post',
                body: commentFormData
            }).then(resp => resp.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    commentText.value = '';

                    getComments();
                } else {
                    displayCommentError(data.errors)

                }
            })
            .catch(error => console.error(error));

    }

    function displayCommentError(errors) {
        commentText.nextElementSibling.innerHTML = errors.textError
    }

    function getComments() {

        commentsContainer.innerHTML = ''

        fetch("<?php echo URLROOT . '/API/getComments' ?>")
            .then(resp => resp.json())
            .then(data => {
                console.log(data);

                data.comments.map(item => {
                    console.log(item);
                    let comments = `
                <div class="commentContainer my-2">
                    <div class="d-flex justify-content-between">
                    <h4>${item.name}</h4>
                    <p class="text-muted">${item.created_at}</p>
                    </div>
                    <div>
                        <p>${item.text}</p>
                    </div>
                </div>
                `
                    commentsContainer.innerHTML += comments
                })
            })

    }

    getComments()
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>