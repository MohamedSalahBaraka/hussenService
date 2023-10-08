<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Objects\Day;
use App\Objects\Month;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::findOrFail(Auth::id());
        return view('user.profile', compact('user'));
    }
    public function books()
    {
        $books = Book::where('user_id', Auth::id())->get();
        return view('user.book', compact('books'));
    }
    public function notification()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->where('status', 0)
            ->get();
        foreach ($notifications as $notification) {
            $notification->update([
                'status' => 1
            ]);
        }
        return response()->json('ok');
    }
    public function invoice($id)
    {
        $book = Book::findOrFail($id);
        return view('user.invoice', compact('book'));
    }
    public function endpoint($id)
    {
        $book = Book::findOrFail($id);
        return view('user.endpoint', compact('book'));
    }
    public function accountDelete()
    {
        return view('user.accountDelete');
    }
    public function accountDeleteAction()
    {
        $user = User::findOrFail(Auth::id());
        Auth::guard()->logout();
        $user->delete();
        return redirect('/');
    }
    public function upfateInfo()
    {
        $user = User::findOrFail(Auth::id());
        return view('user.upfateInfo', compact('user'));
    }
    public function upfateInfoAction(Request $request)
    {
        $user = User::findOrFail(Auth::id());
         if($request->has('password') && $request->input('password') != ''){
            $user->update(['password' => Hash::make($request->input('password')),]);
        }
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'phone' => $request->input('phone'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function chat()
    {
        $messages = Message::where('user_id', Auth::id())->get();
        return view('user.chat', compact('messages'));
    }
    public function sendMessage(Request $request)
    {
        Message::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'direction' => 0
        ]);
        return redirect()->route('user.chat');
    }
    public function bookDelete($id)
    {
       $book = Book::findOrFail($id);
       $book->update([ 'is_deleted' => 1]);
       return back()->with('success', 'تم الغاء بنجاح');
    }




    public function updatebook($id)
    {
        $book = Book::findOrFail($id);
        $service = $book->service;
        $thisMonth = Carbon::now()->month;
        $thisyear = Carbon::now()->year;
        for ($i = $thisMonth; $i < $thisMonth + 7; $i++) {
            $bookColleaction = $service->books()->where('is_deleted','!=',1)->where('month', $i)->orderBy('day')->get();
            $books[] = new Month($bookColleaction, $i, $thisyear);
        }
        return view('user.editBook', compact(['books','book']));
    }
    public function updatebookAction(Request $request)
    {
            $book =  Book::findOrFail($request->book_id);
            $book->update([
                'day' => $request->input('day'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'is_deleted' => 2
            ]);
            return redirect()->route('user.books')->with('success', 'تم الحفظ بنجاح');
    }
}
