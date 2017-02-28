<?php

namespace App\Http\Controllers;

use App\Confession;
use App\Services\ChatworkService;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $confessions = Confession::orderBy('created_at', 'DESC')->paginate(50);

        return view('confesstion.list', ['confessions' => $confessions]);
    }

    public function send($id)
    {
        if ($confession = Confession::find($id)) {
            $content = view('_chatwork_message', ['confession' => $confession, 'admin' => false])->render();
            ChatworkService::sendConfession($content);
            $confession->status = 1;
            if ($confession->save()) {

                return redirect()->action('ListController@index')->with('message', 'Confession ID '. $id .' đã được gửi');
            }
        }

        return redirect()->action('ListController@index')->with('error', 'Something error!');
    }

    public function delete($id)
    {
        if ($confession = Confession::find($id)) {
            if ($confession->delete()) {
                return redirect()->action('ListController@index')->with('message', 'Confession ID '. $id .' đã được xóa');
            }
        }

        return redirect()->action('ListController@index')->with('error', 'Something error!');
    }
}
