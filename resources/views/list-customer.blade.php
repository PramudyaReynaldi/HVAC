<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
</head>
<body>
    <h1>Customer List</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <a href="{{ route('customer.create') }}">Add Customer</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Purpose</th>
                <th>Teknisi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->purpose }}</td>
                <td>{{ $customer->techName }}</td>
                <td>
                    <form action="{{ route('customer.updateTech', $customer->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="techid" id="techid">
                            @foreach($technicians as $technician)
                            <option value="{{$technician->id}}">{{$technician->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit">Save</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
