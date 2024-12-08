<a href="{{ route('admin.posts.create') }}">Create Post</a>
<a href="{{ route('admin.posts.edit', $post) }}">Edit Post</a>
<form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete Post</button>
</form>
