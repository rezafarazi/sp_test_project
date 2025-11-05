<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
</head>
<body>

    <h3>Dashboard</h3>

    <form method="post" action="/NReport" enctype="multipart/form-data">

        @csrf
        <input type="text" name="title" placeholder="Title">
        <input type="text" name="text" placeholder="Text">
        <input type="file" name="attach" accept=".pdf">

        <button type="submit">Done</button>
    </form>

</body>
</html>
