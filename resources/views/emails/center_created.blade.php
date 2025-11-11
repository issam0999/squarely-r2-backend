<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Center Created</title>
</head>
<body>
    <h2>New Center Created</h2>

    <p>Hello,</p>
    <p>A new center has been created by {{ $user->name }}.</p>

    <p><strong>Center Details:</strong></p>
    <ul>
        <li>Name: {{ $center->name }}</li>
        <li>Address: {{ $center->address ?? 'N/A' }}</li>
    </ul>

    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>
