<div class="container">
     
    <?=$title; ?>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Contact from HTML page</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= getValidationClassName('name', $errors)  ?>" id="name" name="name" placeholder="Your Name" value= "<?= old('name'); ?>" >
                    <?= getErrors('name', $errors ?? []) ?> 
                </div>

                <div class="mb-3">
                    <label for="user_name" class="form-label">User Name</label>
                    <input type="text" class="form-control <?= getValidationClassName('user_name', $errors)  ?>" id="user_name" name="user_name" placeholder="Your User Name" value= "<?= old('user_name'); ?>"  >
                    <?= getErrors('user_name', $errors ?? []) ?> 
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= getValidationClassName('email', $errors)  ?>" id="email" name="email" placeholder="mail@example.com" value= "<?= old('email'); ?>"  >
                     <?= getErrors('email', $errors ?? []) ?> 
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Message</label>
                    <textarea class="form-control <?= getValidationClassName('content', $errors)  ?>" id="content" name="content" rows="4" ><?= old('content'); ?></textarea>
                     <?= getErrors('content', $errors ?? []) ?> 
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>
   
