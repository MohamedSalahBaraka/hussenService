<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bank;
use App\Models\Book;
use App\Models\Categories;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\perpose;
use App\Models\ProviderMessage;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function profile()
    {
        $admin = Admin::findOrFail(Auth::id());
        return view('admin.profile', compact('admin'));
    }
    public function books()
    {
        $books = Book::whereHas('payment', function ($q) {
            $q->where('status', 1);
        })->get();
        return view('admin.book', compact('books'));
    }

    public function services(Request $request)
    {
        $services = Service::orderBy('created_at', 'desc');
        if ($request->has('keyword')) {
            $services = $services->search($request->keyword);
        }
        $services = $services->paginate(20);
        return view('admin.services', compact(['services']));
    }


    public function admin(Request $request)
    {
        $admins = Admin::orderBy('created_at', 'desc');
        if ($request->has('keyword')) {
            $admins = $admins->search($request->keyword);
        }
        $admins = $admins->paginate(20);
        return view('admin.admin', compact('admins'));
    }
    protected function validatorAdmin(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'unique:admins'],
        ]);
    }
    public function adminCreate()
    {
        return view('admin.adminCreate');
    }
    public function adminCreateAction(Request $request)
    {
        $this->validatorAdmin($request->all())->validate();
        $user =  Admin::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function adminUpdate($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.adminUpdate', compact('admin'));
    }
    public function adminUpdateAction(Request $request)
    {
        $admin = Admin::findOrFail($request->input('id'));
        if($request->has('password') && $request->input('password') != ''){
            $admin->update(['password' => Hash::make($request->input('password')),]);
        }
        $admin->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function adminDelete($id)
    {
        $user = Admin::findOrFail($id);
        $user->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
        protected function passwordValidator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
public function adminUpdatepassword(Request $request)
{
     $this->passwordValidator($request->all())->validate();
        $user = Admin::find($request->input('id'));
        abort_if(is_null($user), 404);
        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
}

    public function user(Request $request)
    {
        $users = User::where('type',0)->orderBy('created_at', 'desc');
        if ($request->has('keyword')) {
            $users = $users->search($request->keyword);
        }
        $users = $users->paginate(20);
        return view('admin.user', compact('users'));
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
    public function userCreate()
    {

        return view('admin.userCreate');
    }
    public function userCreateAction(Request $request)
    {
        $this->validatorUser($request->all())->validate();
        $user =  User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'type'=>'user'
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function userUpdate($id)
    {
        $user = User::findOrFail($id);
        return view('admin.userUpdate', compact('user'));
    }
    public function userUpdateAction(Request $request)
    {
        $user = User::findOrFail($request->input('id'));
          if($request->has('password') && $request->input('password') != ''){
            $user->update(['password' => Hash::make($request->input('password')),]);
        }
        $user->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }


    public function provider(Request $request)
    {
        $providers = User::where('type',1)->orderBy('created_at', 'desc');
        if ($request->has('keyword')) {
            $providers = $providers->search($request->keyword);
        }
        $providers = $providers->paginate(20);
        return view('admin.provider', compact('providers'));
    }
    protected function validatorProvider(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'unique:users'],
        ]);
    }
    public function providerCreate()
    {
        return view('admin.providerCreate');
    }
    public function providerCreateAction(Request $request)
    {
        $this->validatorProvider($request->all())->validate();
        $user =  User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'type'=>'provider'
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function providerUpdate($id)
    {
        $provider = User::findOrFail($id);
        return view('admin.providerUpdate', compact('provider'));
    }
    public function providerUpdateAction(Request $request)
    {
        $user = User::findOrFail($request->input('id'));
          if($request->has('password') && $request->input('password') != ''){
            $user->update(['password' => Hash::make($request->input('password')),]);
        }
        $user->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function providerDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }




    public function category(Request $request)
    {
        $categorys = Categories::orderBy('created_at', 'desc');
        if ($request->has('keyword')) {
            $categorys = $categorys->search($request->keyword);
        }
        $categorys = $categorys->paginate(20);
        return view('admin.category', compact('categorys'));
    }
    public function categoryCreate()
    {
        return view('admin.categoryCreate');
    }
    public function categoryCreateAction(Request $request)
    {
        $user =  Categories::create([
            'name' => $request->input('name'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function categoryUpdate($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.categoryUpdate', compact('category'));
    }
    public function categoryUpdateAction(Request $request)
    {
        $user = Categories::findOrFail($request->input('id'));
        $user->update([
            'name' => $request->input('name'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function categoryDelete($id)
    {
        $user = Categories::findOrFail($id);
        $user->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }




    public function bank(Request $request)
    {
        $banks = Bank::orderBy('created_at', 'desc');
        if ($request->has('keyword')) {
            $banks = $banks->search($request->keyword);
        }
        $banks = $banks->paginate(20);
        return view('admin.bank', compact('banks'));
    }
    public function bankCreate()
    {
        return view('admin.bankCreate');
    }
    public function bankCreateAction(Request $request)
    {
        Bank::create([
            'number' => $request->input('number'),
            'owner' => $request->input('owner'),
            'bank' => $request->input('bank'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function bankUpdate($id)
    {
        $bank = Bank::findOrFail($id);
        return view('admin.bankUpdate', compact('bank'));
    }
    public function bankUpdateAction(Request $request)
    {
        $user = Bank::findOrFail($request->input('id'));
        $user->update([
            'number' => $request->input('number'),
            'owner' => $request->input('owner'),
            'bank' => $request->input('bank'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function bankDelete($id)
    {
        $user = Bank::findOrFail($id);
        $user->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }





    public function perpose(Request $request)
    {
        $perposes = perpose::orderBy('created_at', 'desc');
        if ($request->has('keyword')) {
            $perposes = $perposes->search($request->keyword);
        }
        $perposes = $perposes->paginate(20);
        return view('admin.perpose', compact('perposes'));
    }
    public function perposeCreate()
    {
        return view('admin.perposeCreate');
    }
    public function perposeCreateAction(Request $request)
    {
        $user =  perpose::create([
            'name' => $request->input('name'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function perposeUpdate($id)
    {
        $perpose = perpose::findOrFail($id);
        return view('admin.perposeUpdate', compact('perpose'));
    }
    public function perposeUpdateAction(Request $request)
    {
        $user = perpose::findOrFail($request->input('id'));
        $user->update([
            'name' => $request->input('name'),
        ]);
        return back()->with('success', 'تم الحفظ بنجاح');
    }
    public function perposeDelete($id)
    {
        $user = perpose::findOrFail($id);
        $user->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }



    public function chatProviderSingle($id)
    {
        $messages = Message::where('user_id', $id)->get();
        return view('admin.chatProvider', compact(['messages', 'id']));
    }
    public function chatProvider()
    {
        $providers = User::where('type',1)->get();
        return view('admin.chatProviders', compact('providers'));
    }
    public function sendProviderMessage(Request $request)
    {
        Message::create([
            'user_id' => $request->id,
            'content' => $request->content,
            'direction' => 1
        ]);
        return redirect()->route('admin.chat.provider.single', $request->id);
    }



    public function chatUserSingle($id)
    {
        $messages = Message::where('user_id', $id)->get();
        return view('admin.chat', compact(['messages', 'id']));
    }
    public function chatUser()
    {
        $users = User::where('type',0)->get();
        return view('admin.chatUsers', compact('users'));
    }
    public function sendUserMessage(Request $request)
    {
        Message::create([
            'user_id' => $request->id,
            'content' => $request->content,
            'direction' => 1
        ]);
        return redirect()->route('admin.chat.user.single', $request->id);
    }
}
