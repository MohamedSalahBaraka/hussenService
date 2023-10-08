<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categories;
use App\Models\File;
use App\Models\User;
use App\Models\Message;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Notification;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Objects\Day;
use App\Objects\Month;
use App\Models\Perpose;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProviderController extends Controller
{
    use Upload;
    public function profile()
    {
        $id = Auth::id();
        $books = Book::whereHas('service',function ($q) use ($id)
        {
            $q->where('services.provider_id', $id);
        })->whereHas('payment', function ($q) {
            $q->where('status', 1);
        })->where('is_deleted','!=',1)->count();
        $provider = User::findOrFail(Auth::id());
        return view('provider.profile', compact(['provider','books']));
    }
    public function books()
    {
        $id = Auth::id();
        $books = Book::whereHas('service',function ($q) use ($id)
        {
            $q->where('services.provider_id', $id);
        })->whereHas('payment', function ($q) {
            $q->where('status', 1);
        })->get();
        return view('provider.book', compact('books'));
    }
    public function booksNew()
    {
         $id = Auth::id();
        $books = Book::whereHas('service',function ($q) use ($id)
        {
            $q->where('services.provider_id', $id);
        })->whereHas('payment', function ($q) {
            $q->where('status', 0);
        })->get();
        return view('provider.bookNew', compact('books'));
    }
    public function booksAccept($id)
    {
        $payment = Payment::findOrFail($id);
        if(is_null($payment->user)){
        return back()->with('success', 'شيء ما خاطئ');
        }
        Notification::create([
            'user_id' => $payment->user->id,
            'content' => 'تم قبول الحجز الخاص بك'
        ]);
        $payment->update([
            'status' => 1
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function booksRefues($id)
    {
        $payment = Payment::findOrFail($id);
         if(is_null($payment->user)){
            return back()->with('success', 'شيء ما خاطئ');
        }
        Notification::create([
            'user_id' => $payment->user->id,
            'content' => 'تم رفض الحجز الخاص بك'
        ]);
        $payment->book->delete();
        $payment->delete();
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function addbook($id)
    {
        $service = Service::findOrFail($id);
        $thisMonth = Carbon::now()->month;
        $thisyear = Carbon::now()->year;
        for ($i = $thisMonth; $i < $thisMonth + 7; $i++) {
            $bookColleaction = $service->books()->where('is_deleted','!=',1)->where('month', $i)->orderBy('day')->get();
            $books[] = new Month($bookColleaction, $i, $thisyear);
        }
        $perposes = Perpose::all();
        return view('provider.addBook', compact(['service', 'books','perposes']));
    }
    public function addbookAction(Request $request)
    {
            $id = Auth::user()->id;
            $book = Book::create([
                'day' => $request->input('day'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'service_id' => $request->input('service_id'),
                'user_id' => Auth::id(),
                'perpose_id' => $request->input('perpose_id'),
            ]);
               return redirect()->route('provider.services')->with('success', 'تم الحفظ بنجاح');
    }
    public function accountDelete()
    {
        return view('provider.accountDelete');
    }
    public function accountDeleteAction()
    {
        $provider = User::findOrFail(Auth::id());
        Auth::guard('provider')->logout();
        $provider->delete();
        return redirect('/');
    }
    public function upfateInfo()
    {
        $provider = User::findOrFail(Auth::id());
        return view('provider.upfateInfo', compact('provider'));
    }
    public function upfateInfoAction(Request $request)
    {
        $provider = User::findOrFail(Auth::id());
        if($request->has('password') && $request->input('password') != ''){
            $provider->update(['password' => Hash::make($request->input('password')),]);
        }
        $provider->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'username' => $request->input('username'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function services(Request $request)
    {
        $services = Service::where('provider_id', Auth()->id());
        if ($request->has('keyword')) {
            $services = $services->search($request->keyword);
        }
        $services = $services->paginate(20);
        return view('provider.services', compact(['services']));
    }
    public function servicesCreate()
    {
        $count = Service::where('provider_id', Auth()->id())->count();
        if($count > 0 ){
            return back()->with('error', 'لا يمكنك ادراج اكثر من قاعة');
        }
        $categories = Categories::all();
        return view('provider.servicesCreate', compact('categories'));
    }
    public function servicesCreateAction(Request $request)
    {
        $count = Service::where('provider_id', Auth()->id())->count();
        if($count > 0 ){
            return back()->with('error', 'لا يمكنك ادراج اكثر من قاعة');
        }
        if ($request->hasFile('photo')) {
            $path = $this->UploadFile($request->file('photo'));
            $service =  Service::create([
                'title' => $request->input('title'),
                'provider_id' => Auth::id(),
                'price' => $request->input('price'),
            'adress' => $request->input('adress'),
                'details' => $request->input('details'),
                'photo' => $path,
            ]);
            if ($request->hasfile('files')) {
                foreach ($request->file('files') as $file) {
                    $name = $file->getClientOriginalName();
                    $path = $this->UploadFile($file);
                    $fileuploadd = new File;
                    $fileuploadd->path = $path;
                    $fileuploadd->name = $name;
                    $service->Files()->save($fileuploadd);
                }
            }
            $categories = Categories::find($request->input('categories'));
            $service->categories()->attach($categories);
            return back()->with('success', 'تم الحفظ بنجاح');
        }
        return back()->with('error', 'شيء ما خطأ الرجاء المحاولة مجددا');
    }
    public function servicesUpdate($id)
    {
        $service = Service::findOrFail($id);
        $categories = Categories::all();
        return view('provider.servicesUpdate', compact(['service', 'categories']));
    }
    public function servicesUpdateAction(Request $request)
    {
        //get the file id and retrieve the file record from the database
        $service_id = $request->input('id');
        $service = Service::findOrFail($service_id);
        //check if the request has a file
        if ($request->hasFile('photo')) {
            //check if the existing file is present and delete it from the storage
            if (!is_null($service->photo)) {
                $this->deleteFile($service->photo);
            }
            //upload the new file
            $path = $this->UploadFile($request->file('photo'));
        } else {
            $path = $service->photo;
        }
        $service->update([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'details' => $request->input('details'),
            'adress' => $request->input('adress'),
            'photo' => $path,
        ]);
        $categories = Categories::find($request->input('categories'));

        $service->categories()->detach($service->categories);
        $service->categories()->attach($categories);
        //upadate the file path in the database
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function servicesDelete($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
    public function chat()
    {
        $messages = Message::where('user_id', Auth::id())->get();
        return view('provider.chat', compact('messages'));
    }
    public function sendMessage(Request $request)
    {
        Message::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'direction' => 0
        ]);
        return redirect()->route('provider.chat');
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
        return view('provider.editBook', compact(['books','book']));
    }
    public function updatebookAction(Request $request)
    {
            $book =  Book::findOrFail($request->book_id);
            $book->update([
                'day' => $request->input('day'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
            ]);
            return redirect()->route('provider.books')->with('success', 'تم الحفظ بنجاح');
    }
}
