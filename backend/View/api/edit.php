<h1><?php echo $headAction ?> API</h1>

<?php if (isset($errors)) { ?>
    <div class="row">
        <div class="col">
            <div class="messages">
                <?php foreach ($errors as $error) { ?>
                    <div class="alert alert-warning" role="alert"><?php echo $error; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<form action="/ui/api/<?php echo $formAction ?>" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo isset($formData['name']) ? $formData['name'] : ''; ?>" />
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo isset($formData['title']) ? $formData['title'] : ''; ?>" />
    </div>
    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="<?php echo isset($formData['url']) ? $formData['url'] : ''; ?>" />
    </div>
    <div class="form-group">
        <label for="response_results_accessor">Response results accessor</label>
        <input type="text" class="form-control" id="response_results_accessor" name="response_results_accessor" placeholder="Response results accessor" value="<?php echo isset($formData['response_results_accessor']) ? $formData['response_results_accessor'] : ''; ?>" />
    </div>
    <div class="form-group">
        <label for="response_row_lat_accessor">Response row lat accessor</label>
        <input type="text" class="form-control" id="response_row_lat_accessor" name="response_row_lat_accessor" placeholder="Response row lat accessor" value="<?php echo isset($formData['response_row_lat_accessor']) ? $formData['response_row_lat_accessor'] : ''; ?>" />
    </div>
    <div class="form-group">
        <label for="response_row_lng_accessor">Response row lng accessor</label>
        <input type="text" class="form-control" id="response_row_lng_accessor" name="response_row_lng_accessor" placeholder="Response row lng accessor" value="<?php echo isset($formData['response_row_lng_accessor']) ? $formData['response_row_lng_accessor'] : ''; ?>" />
    </div>
    <button type="submit" class="btn btn-primary"><?php echo $headAction ?></button>
</form>
