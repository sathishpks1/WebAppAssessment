<!DOCTYPE html>
<html>
<head>
    <title>Member Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10% auto;
            padding: 0;
            background-color: lightgrey;
        }
        .container {
            max-width: 30%;
            margin: 0 auto;
            padding: 40px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: silver;
        }
        h1 {
            margin-top: 0;
        }
        label {
            font-weight: bold;
            width: 60px;
            display: inline-block;
        }
        input[type="text"] {
            width: 60%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 5%;
            margin-left: 10%;
        }

        .alert-success {
            max-width: 90%;
            margin: 10px 0;
            padding: 10px;
            background-color: #4CAF50; 
            color: white;
            border-radius: 5px;
        }

        .alert-danger {
            max-width: 90%;
            margin: 10px 0;
            padding: 10px;
            background-color: red; 
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('list-people') }}";
            }, 3000); 
        </script>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>{{ isset($person) ? 'Edit' : 'Add New' }} Member</h1>
    <form method="post" action="{{ isset($person) ? route('people.update', $person->id) : route('add-person') }}">
        @csrf
        @if(isset($person))
            @method('PUT')
        @endif
        <label for="id">ID:</label>
        <input type="text" name="member_id" id="member_id" value="{{ old('member_id', isset($person) ? $person->member_id : '') }}">
        <br>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', isset($person) ? $person->name : '') }}">
        <br>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="{{ old('email', isset($person) ? $person->email : '') }}">
        <br>
        <button type="submit">{{ isset($person) ? 'Update Member' : 'Add Member' }}</button>
    </form>
    <br>
    <a href="{{ route('list-people') }}">Back to List</a>
</div>

</body>
</html>
