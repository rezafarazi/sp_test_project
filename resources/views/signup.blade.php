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

        @csrf
        <input type="text" name="name" placeholder="Enter name">
        <input type="text" name="family" placeholder="Enter family">
        <input type="text" name="username" placeholder="Enter username">
        <input type="password" name="password"  placeholder="Enter password">

        <select name="type">
            <option value="USER">User</option>
            <option value="ADMIN1">Admin 1 </option>
            <option value="ADMIN2">Admin 2 </option>
        </select>

        <button type="submit">signup</button>


        <a href="/">Login</a>

    </form>

</body>
</html>
