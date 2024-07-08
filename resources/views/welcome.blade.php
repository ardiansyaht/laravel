<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Welcome to My Blog</h1>
    <p>This is the Welcome page of my Laravel Application.</p>

    <a href="{{route('posts.index')}}">
        <button>View all posts</button>
    </a>
</body>

</html>