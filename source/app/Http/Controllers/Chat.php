<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class Chat extends Controller
{

    /**
     * @param Request $request
     *
     * This method is in charge of handling incoming messages
     */
    public function newMessage(Request $request)
    {
        if($request->hasFile('file'))
        {
            $this->fileMessage($request);
        } else {
            $this->textMessage($request);
        }

    }

    /**
     * @param Request $request
     *
     * handles messages that have file attachments
     */
    public function fileMessage(Request $request)
    {
        $request->file->move('/var/www/public/uploads', $request->file->getClientOriginalName());

        $message = 'has uploaded the file <a href="/uploads/'.$request->file->getClientOriginalName().'" target="_blank">'.$request->file->getClientOriginalName().'</a>';

        $this->broadCastMessage($message);
    }


    /**
     * @param Request $request
     *
     * handles normal text based messages
     */
    public function textMessage(Request $request)
    {
        $this->broadCastMessage($request->input('message'));
    }


    /**
     * @param $message
     *
     * prepares and pushes messages to Redis which is picked up by node and sent out to connected clients.
     */
    public function broadCastMessage($message)
    {
        $data = [
            'event' => 'message',
            'data' => [
                'message' => $message,
                'user'  => User::getUserName()
            ]
        ];

        Redis::publish('chat', json_encode($data));
    }
}
