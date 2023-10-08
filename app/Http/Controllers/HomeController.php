<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bank;
use App\Models\Book;
use App\Models\Categories;
use App\Models\Payment;
use App\Models\Perpose;
use App\Models\Provider;
use App\Models\Service;
use App\Models\User;
use App\Objects\Day;
use App\Objects\Month;
use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use Upload;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function do ()
    {
        $clases = [
            Admin::class => 'all',
            Bank::class,
            Book::class,
        ];
        $class = new $clases[2];
        $method = 'all';
        return $class::$method();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home.home');
    }
    public function invoice($id)
    {
        $book = Book::findOrFail($id);
        return view('user.invoice', compact('book'));
    }
    public function services(Request $request)
    {
        $services = Service::orderBy('created_at', 'desc');
        if ($request->has('keyword')) {
            $services = $services->search($request->keyword);
        }
        if ($request->has('categories')) {
            $services = $services->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->input('categories'));
            });
        }
        if ($request->has('price')) {
            switch ($request->price) {
                case 1:
                    $services = $services->where('price', '<', 100);
                    break;
                case 2:
                    $services = $services->whereBetween('price', [100, 300]);
                    break;
                case 3:
                    $services = $services->whereBetween('price', [300, 1000]);
                    break;
                case 4:
                    $services = $services->where('price', '>', 1000);
                    break;
            }
        }
        $services = $services->paginate(20);
        $categorys = Categories::all();
        return view('home.services', compact(['services', 'categorys']));
    }

    public function service($id)
    {
        $service = Service::findOrFail($id);
        $thisMonth = Carbon::now()->month;
        $thisyear = Carbon::now()->year;
        for ($i = $thisMonth; $i < $thisMonth + 7; $i++) {
            $bookColleaction = $service->books()->where('is_deleted', '!=', 1)->where('month', $i)->orderBy('day')->get();
            $books[] = new Month($bookColleaction, $i, $thisyear);
        }
        // dd($books[0]);
        $perposes = Perpose::all();
        return view('home.service', compact(['service', 'books', 'perposes']));
    }

    public function book(Request $request)
    {
        $service = Service::findOrFail($request->input('service_id'));
        $user = User::findOrFail(Auth::id());
        $banks = Bank::all();
        $year = $request->input('year');
        $month = $request->input('month');
        $day = $request->input('day');

        $perpose_id = $request->input('perpose_id');

        return view('home.payment', compact(['service', 'user', 'banks', 'year', 'month', 'day', 'perpose_id']));
    }

    public function payment(Request $request)
    {
        if ($request->hasFile('photo')) {
            $path = $this->UploadFile($request->file('photo'));
            $id = Auth::user()->id;

            $book = Book::create([
                'day' => $request->input('day'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'service_id' => $request->input('service'),
                'user_id' => Auth::id(),
                'perpose_id' => $request->input('perpose_id'),
            ]);
            Payment::create([
                'amout' => $request->input('amout'),
                'user_id' => $id,
                'photo' => $path,
                'book_id' => $book->id
            ]);
            return redirect()->route('user.endpoint', $book->id);
        }
        return back()->with('error', 'شيء ما خطأ الرجاء المحاولة مجددا');
    }
    public function registerUserShow()
    {
        return view('auth.register', ['url' => 'user', 'title' => 'مستخدم']);
    }
    public function registerUser(Request $data)
    {
        $this->validatorUser($data->all())->validate();
        $user = User::create([
            'name' => $data->input('name'),
            'username' => $data->input('username'),
            'email' => $data->input('email'),
            'phone' => $data->input('phone'),
            'password' => Hash::make($data->input('password')),
            'type' => 'user'
        ]);
        Auth::guard()->login($user);
        return redirect()->route('home');
    }
    protected function validatorUser(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'unique:users'],
        ]);
    }
}