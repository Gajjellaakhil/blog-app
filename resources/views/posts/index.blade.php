<a href="{{ route('posts.index') }}">All Posts</a>
<a href="{{ route('posts.show', $post) }}">View Post</a>
<form action="{{ route('posts.comments.store', $post) }}" method="POST">
    @csrf
    <textarea name="comment" required></textarea>
    <button type="submit">Add Comment</button>
</form>
