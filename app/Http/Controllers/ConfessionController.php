<?php

namespace App\Http\Controllers;

use App\Confession;
use App\Services\BrowserService;
use App\Services\ChatworkService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConfessionController extends Controller
{
    public function index()
    {
        return view('new', [ 'title' => 'New confession']);
    }

    public function store(Request $request)
    {
        $input = $request->input();
        if (isset($input['content']) && trim($input['content']) != '') {
            $confession = new Confession($input);
            //Save to DB
            $browser = new BrowserService();

            $confession->status = 0;
            $confession->agent = $browser->getUserAgent();
            $confession->ip = $this->getUserIP();


            if ($confession->save()) {
                $content = view('_chatwork_message', ['confession' => $confession, 'admin' => true])->render();
                ChatworkService::sendNotifyToAdmin($content);

                return redirect()->action('ConfessionController@index')
                    ->with('message', 'Confession của bạn đã thêm thành công và đang chờ duyệt!');
            }

            return redirect()->action('ConfessionController@index')
                ->withInput($input)
                ->with('error', 'Có lỗi rồi!');
        } else {
            return redirect()->action('ConfessionController@index')
                ->withInput($input)
                ->with('error', 'Nhập nội dung đi đã chứ!');
        }
    }

    protected function getUserIP()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip ?: '0.0.0.0';
    }
}
