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

    <form method="post">

        <input type="hidden" value="{{csrf_token()}}" name="_token">
        <input type="text" name="name" placeholder="Enter name">
        <input type="text" name="family" placeholder="Enter family">
        <input type="text" name="username" placeholder="Enter username">
        <input type="password" name="password"  placeholder="Enter password">

        <select name="type">
            <option value="USER">User</option>
            <option value="ADMIN">Admin</option>
        </select>

        <button type="submit">signup</button>


        <a href="/">Login</a>

    </form>

</body>
</html>
