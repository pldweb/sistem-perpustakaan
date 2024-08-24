<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
</head>
<body>
<h1>File List</h1>
<ul>
    @foreach($fileUrl as $file)
        <li>
            <a href="{{ $file }}" target="_blank">{{ $file }}</a>
        </li>
    @endforeach
</ul>
</body>
</html>
