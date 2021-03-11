<?php

namespace App\Http\Controllers\Guest_book;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('confirmed', true)->orderByDesc('created_at')->paginate(3);
        return view('guest_book.messages.index', compact('messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'text' => 'required',
            'captcha' => 'required|captcha'
        ]);
        $message = new Message();
        $message->fill($request->all());
        $message->save();
        flash('Сообщение отправлено на проверку')->success();
        return redirect()->route('messages.index');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
