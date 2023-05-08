<!DOCTYPE html>
<html>

<head>
    <title>PAFID EMAIL</title>
    {{-- app css bootsrap 4 --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>

<body>

    <h1>{{ $mailData['title'] }}</h1>

    <p>Below are the phone numbers to send money</p>

    <table>
        <thead class="border-bottom">
            <tr>
                <th class="mr-2">Phone Number</th>
                <th class="ml-2">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailData['phone_number'] as $item)
                <tr>
                    <td class="mr-2">{{ $item }}</td>
                    <td class="ml-2">{{ $mailData['amount'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <p>{{ $mailData['body'] }}</p>
</body>

</html>
