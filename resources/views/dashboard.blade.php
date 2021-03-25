<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
    </head>
    <body>
        <h2>Alle bestelde kozijnen</h2>
        <table>
            <tr>
                <th>Order</th>
                <th>Kozijn</th>
                <th>Ordertijd van het kozijn</th>
            </tr>
            @foreach($all_orders as $order)
                <tr>
                    <td>{{ $order->order_nr }}</td>
                    <td>{{ $order->canvas_name }}</td>
                    <td>{{ $order->order_delay }} dagen</td>
                </tr>
            @endforeach
        </table>
        <h2>Overzicht aantal kozijnen per order</h2>
        <table>
            <tr>
                <th>Order</th>
                <th>Aantal kozijnen</th>
            </tr>
            @foreach($canvasses_per_order as $order)
                <tr>
                    <td>{{ $order->order_nr }}</td>
                    <td>{{ $order->canvas_count }}</td>
                </tr>
            @endforeach
            </table>
            <h2>Aantal orders met 10m2 of minder: {{ $orders_less_10sq }}</h2>
        </table>
    </body>
</html>
