<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $datos = request()->except(['_token']);

        switch ($datos["id_destinatario"]) {
            case 'Todos':
                $users = User::all();
                foreach ($users as $key => $value) {
                        Notification::create([
                            'id_remitente' => $datos['id_remitente'],
                            'id_destinatario' =>$value['id'],
                            'nombre_destinatario' =>$value["name"],
                            'nombre_remitente' =>$datos['nombre_remitente'],
                            'asunto' =>$datos['asunto'],
                            'mensaje' =>$datos['mensaje'],
                            'visto' =>$datos['visto']
                        ]);
                }
                break;
            default:
                $users = User::all();
                    foreach ($users as $key => $value) {
                        if($value['id'] == $datos['id_destinatario']){
                            Notification::create([
                                'id_remitente' => $datos['id_remitente'],
                                'id_destinatario' =>$value['id'],
                                'nombre_destinatario' =>$value["name"],
                                'nombre_remitente' =>$datos['nombre_remitente'],
                                'asunto' =>$datos['asunto'],
                                'mensaje' =>$datos['mensaje'],
                                'visto' =>$datos['visto']
                            ]);
                        }
                    }
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Notification::where("id_destinatario","=",$id)->orderBy('created_at','DESC')->get());
    }
    public function getMembers($id)
    {
        $users = User::all();
        $datos=[];
        foreach ($users as $key => $value) {
                array_push($datos, $value);
        }
        return response()->json($datos);
    }
    public function howManyNotifications($id)
    {
        $notificaciones = count(Notification::where([["id_destinatario","=",$id],["visto","=","no"]])->get());
        return $notificaciones;
    }
    public function getMsgSend($id)
    {
        return response()->json(Notification::where("id_remitente","=",$id)->orderBy('created_at','DESC')->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        Notification::find($id)->update(['visto'=>'si']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notification::where('id','=',$id)->Delete();
    }
}
