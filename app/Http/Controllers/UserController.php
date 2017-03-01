<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(50);

        return view('user.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->input());
        $user->password = bcrypt($user->password);
        $user->active = true;
        if ($user->save()) {
            return redirect()->action('UserController@index')->with('message', 'Tạo tài khoản thành công!');
        }

        return redirect()->action('UserController@index')->with('error', 'Lỗi ròi!');
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
        if ($user = User::find($id))
        {
            if ($user->delete()) {
                return redirect()->action('UserController@index')->with('message', 'Xóa tk thành công!');
            }
        }

        return redirect()->action('UserController@index')->with('error', 'Lỗi ròi!');
    }

    public function status($id)
    {
        if ($user = User::find($id))
        {
            $user->active = !$user->active;
            if ($user->save()) {
                return redirect()->action('UserController@index')->with('message', 'Đổi status thành công!');
            }
        }


        return redirect()->action('UserController@index')->with('error', 'Lỗi ròi!');
    }

    public function changePassword($id)
    {
        if ($user = User::find($id))
        {
            return view('user.password', ['user' => $user]);
        }

        return redirect()->action('UserController@index')->with('error', 'Lỗi ròi!');
    }

    public function savePassword($id, Request $request)
    {
        if ($user = User::find($id))
        {
            $user->password = bcrypt($request->input('password'));
            if ($user->save()) {
                return redirect()->action('UserController@index')->with('message', 'Đổi password thành công!');
            }
        }

        return redirect()->action('UserController@index')->with('error', 'Lỗi ròi!');
    }
}
