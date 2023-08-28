<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use App\Notifications\DepositSuccessful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function __construct()
    {
        //Thêm phương thức _construct() để khai báo phần mềm trung gian xác thực,
        // chỉ cho phép người dùng được xác thực gửi tiền.
        $this->middleware('auth');
    }

    public function deposit(Request $request)
    {
        $deposit = Deposit::create([
            'user_id' => Auth::user()->id,
            'amount' => $request->amount
        ]);
        //tìm người dùng hiện tại thông qua User::find(Auth::user()->id),
        // sau đó chúng ta gửi thông báo mới thông qua notify(new DepositSuccessful($deposit->amount)).
        User::find(Auth::user()->id)->notify(new DepositSuccessful($deposit->amount));

        return redirect()->back()->with('status', 'Your deposit was successful!');
    }

    //markAsRead()  để đánh dấu tất cả các thông báo chưa đọc là đã đọc.
    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
