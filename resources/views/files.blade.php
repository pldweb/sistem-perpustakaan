<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
</head>
<body>
<h1>File List</h1>
<table class="table align-items-center mb-0">
    <thead class="thead-light">
    <tr>
        <th scope="col" class="text-start">No</th>
        <th scope="col" class="text-start">Judul Buku</th>
    </tr>
    </thead>
    <tbody id="tbody">
    @foreach($fileUrl as $index => $file)
        <tr>
            <td class="text-start">{{ $index + 1}}</td>
            <td class="text-start">
                <a href="{{ $file }}" class="text-start" target="_blank">{{ $file }}</a>
            </td>
    @endforeach
    </tbody>
</table>
</body>
</html>
