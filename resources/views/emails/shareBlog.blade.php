<!DOCTYPE html>
<html>
<head>
    <title>Check out this blog post!</title>
</head>
<body>
    <h1>{{ $blog->title }}</h1>
    <p>{{ $blog->content }}</p>
    <a href="{{ route('blogs.view', $blog) }}">Read more</a>
</body>
</html>