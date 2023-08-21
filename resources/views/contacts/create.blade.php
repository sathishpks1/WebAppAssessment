<!DOCTYPE html>
<html>
<head>
    <title>Add New Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightgrey;
        }
        .container {
            margin-top:100px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            background-color: #333;
            color: white;
            padding: 10px;
            margin: 0;
            border-radius: 5px 5px 0 0;
        }
        form {
            padding: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        select#country_code {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"] {
            background-color: #1966e3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #0f4b91;
        }

        select#country_code {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url("data:image/svg+xml,%3Csvg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E") no-repeat right center;
            background-size: 24px 24px;
            padding-right: 30px;
        }

        .alert-success {
            max-width: 95%;
            margin: 10px 0;
            padding: 10px;
            background-color: #4CAF50; 
            color: white;
            border-radius: 5px;
        }

        .alert-danger {
            max-width: 95%;
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

    <h1>{{ isset($contact) ? 'Edit Contact' : 'Add New Contact' }} for {{ $person->name }}</h1>
    <form method="post" action="{{ isset($contact) ? route('contacts.update', [$person, $contact]) : route('contacts.store', $person) }}">
        @csrf
        @if(isset($contact))
            @method('PUT')
        @endif
        <div style="display: flex;">
            <div style="flex: 1; margin-right: 5px;">
                <label for="country_code">Country Code:</label>
                <select name="country_code" id="country_code">
                    @if(count($countryCodes) > 0)
                        <option value="">Select...</option>
                    @endif            
                    @forelse($countryCodes as $arr)
                        <option value="{{ $arr['callingCode'] }}"
                            @if(isset($contact) && $contact->country_code === $arr['callingCode'])
                                selected
                            @endif
                        >
                            {{ $arr['countryName'] }} ({{ $arr['callingCode'] }})
                        </option>
                    @empty
                        <option value="">No data available</option>
                    @endforelse
                </select>

            </div>
            <div style="flex: 1; margin-left: 5px;">
                <label for="number">Number:</label>
                <input type="text" name="number" id="number" value="{{ old('number', isset($contact) ? $contact->number : '') }}">
            </div>
        </div>
        <button type="submit">{{ isset($contact) ? 'Update Contact' : 'Add Contact' }}</button>
    </form>
</div>
</body>
</html>
