<!DOCTYPE html>
<html>
<head>
    <title>Member Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
        h1, h2 {
            margin-top: 0;
        }
        p {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Member Details</h1>
    <h2>{{ $person->name }}</h2>
    <p>ID: {{ $person->member_id }}</p>
    <p>Email: {{ $person->email }}</p>  
    

    @if ($person->contacts->count() > 0)
    <hr>
    <h2>Contact Details</h2>
    @foreach ($person->contacts as $index => $contact)
        <p><strong>Contact {{ $index + 1 }}</strong></p>
        <p>Country Code: {{ $contact->country_code }}</p>
        <p>Number: {{ $contact->number }}</p>
        <a href="{{ route('contacts.edit', ['person' => $person->id, 'contact' => $contact->id]) }}">Edit Contact</a>
         // <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this contact?')) document.getElementById('delete-contact-form-{{ $contact->id }}').submit();">Delete Contact</a>
        <form id="delete-contact-form-{{ $contact->id }}" action="{{ route('contacts.destroy', ['person' => $person->id, 'contact' => $contact->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        <hr>
    @endforeach
    @endif

    <a href="{{ route('contacts.create', ['person' => $person->id]) }}">Add New Contact</a>
    <br><br>
    <a href="{{ route('list-people') }}">Back to List</a>
</div>

</body>
</html>
