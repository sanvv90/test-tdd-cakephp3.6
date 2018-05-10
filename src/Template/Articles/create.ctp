<div class="container">
    <h1>Create new a Articles</h1>
    <form action="/articles/add" method="POST">
        <div class="form-group">
            <label class="control-label"><?= h(__('articles.title')); ?></label>
            <input type="text" class="form-control" name="title"/>
        </div>

        <div class="form-group">
            <label class="control-label"><?= h(__('articles.author')); ?></label>
            <input type="text" class="form-control" name="author"/>
        </div>

        <div class="form-group">
            <label class="control-label"><?= h(__('articles.content')); ?></label>
            <textarea name="content" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>