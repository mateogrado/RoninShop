<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItems;
use Illuminate\Http\Request;
use Mail;
use User;
use App\Product;
use App\Mail\OrderPaid;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at','DESC')->get();
        $orders_item = OrderItems::get();
        return view('orders.index', compact('orders'),compact('orders_item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_fullname' => 'required',
            'shipping_email' => 'required',
            'shipping_state' => 'required',
            'shipping_address' => 'required',
            'shipping_phone' => 'required',
            'shipping_zipcode' => 'required',
        ]);

        $order = new Order();

        $order->order_number = uniqid('OrderNumber-');

        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_email = $request->input('shipping_email');
        $order->shipping_state = $request->input('shipping_state');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_phone = $request->input('shipping_phone');
        $order->shipping_zipcode = $request->input('shipping_zipcode');



        $order->grand_total = \Cart::session(auth()->id())->getTotal();
        $order->item_count = \Cart::session(auth()->id())->getContent()->count();

        $order->user_id = auth()->id();

        $order->save();

        //save order items

        $cartItems = \Cart::session(auth()->id())->getContent();

        $totalUnidades = 0;
        foreach($cartItems as $item) {
            $producto = Product::find($item->id);
            if($item->quantity > $producto->unidades){
                $order->grand_total = $order->grand_total - (($item->price * $item->quantity) - ($producto->price * $producto->unidades));
                $item->quantity = $producto->unidades;
                $item->price = $producto->price * $item->quantity;
            }
                
            $order->items()->attach($item->id, ['price'=>$item->price, 'quantity'=> $item->quantity]);
            $producto->update([
                'unidades' => $producto->unidades - $item->quantity
            ]);

            $totalUnidades += $item->quantity;
        }


        $user_name = Auth::user()->name;
        $user_mail = Auth::user()->email;   
        $precio = $order->grand_total;
        $numProductos = $order->item_count;
        $subject = "Pedido RoninShop";
        $text = "Tu pedido de ".$numProductos." productos (".$totalUnidades." unidades), con importe: ".$precio."€ ha sido recibido";


        //Limpiamos el carrito de compras
        \Cart::session(auth()->id())->clear();
        
        //send email

        $mensaje=(object) ([
            'nombre'=> $user_name,
            'email'=>$user_mail,
            'subject'=>$subject,
            'contenido'=>$text
        ]);

        Mail::send('emails.order',["mensaje"=>$mensaje], function($m) use ($mensaje){
            $m->to($mensaje->email,$mensaje->nombre);
            $m->subject($mensaje->subject);
        });

        
        //take user to thank you page

        return redirect('/')->withMessage('Se ha realizado el pedido');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $orders_item = OrderItems::where("order_id","=",$id)->get();
        return view('orders.show',['orders'=>$orders_item]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $datos = request()->except(['_token','_method']);
        Order::where("id","=",$id)->update(["status" => $datos['status']]);

        // Mandar email

        $orden =  Order::where("id","=",$id)->get();

        $subject = "Pedido RoninShop Web";
        $text = "El status de su pedido es: ".$datos['status'];

        foreach ($orden as $key => $value) {
            $mensaje=(object) ([
                'nombre'=> $value['shipping_fullname'],
                'email'=>$value['shipping_email'],
                'subject'=>$subject,
                'contenido'=>$text
            ]);
        }
        

        Mail::send('emails.orderStatus',["mensaje"=>$mensaje], function($m) use ($mensaje){
            $m->to($mensaje->email,$mensaje->nombre);
            $m->subject($mensaje->subject);
        });
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('orders');
    }
}
