<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Toll View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #eaeaea;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
        /* Style for toll items list */
        .toll-list {
            padding: 0;
            margin: 0;
            list-style-type: none; /* Remove bullets */
        }
        .toll-list li {
            padding: 5px 0; /* Add spacing between items */
            border-bottom: 1px solid #ddd; /* Add bottom border for separation */
        }
        .toll-list li:last-child {
            border-bottom: none; /* Remove bottom border for last item */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>All TOLL LIST</h1>

    @if ($newtoll->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Axel No</th>
                    <th>Total</th>
                    <th>Tolls</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp
                @foreach ($newtoll as $form)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $form->fromLocation->city }}</td>
                        <td>{{ $form->toLocation->city }}</td>
                        <td>{{ $form->axel_no }}</td>
                        <td>{{ $form->total }}</td>
                        <td>
                            <ul class="toll-list">
                                @foreach ($form->relatedtoll as $toll)
                                    <li>{{ $toll->tollname }}:{{ $toll->price }} Rs</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-danger text-center">No Record Found</p>
    @endif

    <div class="footer">
        <p>Thank you for using our service!</p>
    </div>
</div>

</body>
</html>
