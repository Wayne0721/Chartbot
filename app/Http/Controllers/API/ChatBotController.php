<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use App\Models\Chat_logs;

class ChatBotController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ChatBotResponse(Request $request){
        $response_message = $request->all()['response_text'];
        Chat_logs::create(['chat_sentence' => $response_message]);
        $http = new Client(['verify' => false]);
        $url = 'https://bot.hithot.cc/wise/qa-ajax.jsp?id=php-test-0001&apikey=102d78d84e244ad80827&q=' . $response_message;
        $response = $http->get($url);
        $response_body = json_decode((string) $response->getBody(), true);

        $response_text = $response_body['output'];
        $chat_position = $request->all()['chat_position'];
        $view = view('chatbot_data', compact(['chat_position', 'response_text']))->render();
        // dd($response_body);
        return response()->json(['html' => $view]);
    }

    public function chatRecordSearch(Request $request){
        $search_keyword = $request->all()['keyword'];

        $chat_record = Chat_logs::where('chat_sentence','like','%' . $search_keyword . '%')->get()->map(function($record){
            $date_create = $record->created_at->format('Y-m-d H:i:s');
            $record->create_time = $date_create;

            return $record;
        })->toArray();
        $view = view('chatbot_record', compact(['chat_record']))->render();

        return response()->json(['html' => $view]);
    }
}
