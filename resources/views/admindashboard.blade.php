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

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Text</th>
            <th>Attach</th>
            <th>Status</th>
            <th>Datetime</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->text }}</td>
                <td>
                    @if($item->file_addres)
                        <a href="{{ asset('storage/' . $item->file_addres) }}" target="_blank">
                            Download PDF
                        </a>
                    @else
                        No file
                    @endif
                </td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->datetime }}</td>
                <td>
                    <a href="/Report/Check/{{ $item->id }}">✓ Check</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>
