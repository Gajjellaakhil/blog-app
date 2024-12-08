<form action="{{ route('posts.comments.store', $post) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="content" class="form-label">Your Comment</label>
        <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit Comment</button>
</form>
