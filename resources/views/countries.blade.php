<!DOCTYPE html>
<html>
<head>
    <title>Country Contacts</title>
</head>
<body>
    <h1>Country Contacts</h1>
    <table>
        <thead>
            <tr>
                <th>Country</th>
                <th>Calling Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countryContacts as $contact)
            <tr>
                <td>{{ $contact['countryName'] }}</td>
                <td>{{ $contact['callingCode'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>