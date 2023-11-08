<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationRequest;
use App\Models\ApplicationRequestAnswer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::query();

        if (request()->has('q') and request()->get('q') != '') {
            $users = $users->where('name', 'like', '%' . request()->get('q') . '%');
            $users = $users->orWhere('email', 'like', '%' . request()->get('q') . '%');
            //$users = $users->orWhere('mobile', 'like', '%' . request()->get('q') . '%');
        }
        // if (request()->has('role') and request()->get('role') != '') {
        //     $users = $users->role(request()->get('role'));
        // }
        $users = $users->where('user_type',null)->orderBy('id', 'desc')->get();
        return response()->json(['users' => $users]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required',
            'selected_role' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = Carbon::now();
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->syncRoles([$request->selected_role]);

        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::with('roles')->find($id);
        return response()->json(['user' => $user]);
    }


    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        if(Hash::check($request->current_password,$user->password)){
            if ($request->current_password) {
                $user->password = Hash::make($request->new_password);
            }
            $user->save();
        }
        return response()->json(['message' => 'success']);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users,email,' . $id ,
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        //        $user->mobile = $request->mobile;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($request->generate_password) {
            $randomPassword = Str::random(8);
            $user->password = Hash::make($randomPassword);
        //            SendEmail::dispatch($request->email, 'email.send_generated_password'
        //                , 'تغيير كلمة سر حسابك', ['randomPassword'=>$randomPassword]);
        }
        $user->save();
        return response()->json(['message' => 'success','user' => $user]);
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $applications = ApplicationRequest::where('email',$user->email)->get();
        foreach($applications as $app){
            $app->answers()->delete();
            $app->delete();
        }
        $user->delete();
        return response()->json(['message' => 'success']);
    }

    public function showProfile()
    {
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email,' . auth()->user()->id,
        ]);
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        // User::where('id',auth()->user()->id)->update([
        //     'name'=>$user->name,
        //     'email' => $user->email,
        //     'password' => $user->password,
        // ]);

        return redirect()->back()->with('success', 'success')->with('id', $user->id);
    }

    public function auth()
    {
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }
}
