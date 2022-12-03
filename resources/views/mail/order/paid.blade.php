@component('mail::message')
# Mensaje del correo

Gracias por la compra

Aquí está su recibo

<table>
    <thead>
        <th>Nombre del producto</th>
        <th>Quantity</th>
        <th>Price</th>
    </thead>
    <tbody>
        foreach($order->items as $item)
            <tr>
                <td scope="row">{{ $item->name }}</td>
                <td>{{ $item->pivot->quantity }}</td>
                <td>{{ $item->pivot->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

Total: {{$order->grand_total}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
