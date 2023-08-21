<!DOCTYPE html>
<html>
<head>
    <title>List of Members</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #333;
            color: white;
            padding: 10px;
            margin: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: darkgray;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .container {
            padding: 20px;
        }
        .add-button {
            float: right;
            margin: 10px;
            border:1px  solid #1966e3;
            background-color:#1966e3;
            text-decoration:none;
            padding: 5px 10px;
            color: white;
            border-radius:2px;

        }

        .action-icons {
            text-align: center; 
        }

        .action-icons a {
            display: inline-block;
            margin-right: 10px; 
            color: #007bff;
            font-size: 18px;
        }

        .action-icons a:last-child {
            margin-right: 0;
        }

        .action-icons a:hover {
            color: #0056b3;
            text-decoration: none;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>List of Members</h1>

    <a href="{{ route('add-person') }}" class="add-button">Add New Member</a>
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Member Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $sno = 1; @endphp
            @foreach ($people as $person)
                <tr>
                    <td>{{ $sno++ }}</td>
                    <td>{{ $person->member_id }}</td>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->email }}</td>
                    <td class="action-icons">
                        <a href="{{ route('people.edit', $person->id) }}" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a style="color: #0b0f96" href="{{ route('people.view', $person->id) }}" title="View">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a style="color: #ff0000" href="#" title="Delete" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this person?')) document.getElementById('delete-form-{{ $person->id }}').submit();">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-{{ $person->id }}" action="{{ route('people.delete', $person->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
