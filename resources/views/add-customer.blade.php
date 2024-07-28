<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
</head>
<body>
    <h1>Add Customer</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('customer.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>
        <br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="purpose">Purpose:</label>
        <input type="text" name="purpose" id="purpose" required>
        <br>
        <button type="submit">Add Customer</button>
    </form>
</body>
</html>
