<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ClinicDoctorExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\HelperServices;
use App\Services\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class SubAdminController extends Controller
{
    public ?HelperServices $helperServices = null;
    public ?Users $user = null;

    public function __construct()
    {
        $this->helperServices = new HelperServices();
        $this->user = new Users();
    }

    public function index()
    {
        $user = $this->user->getAllPaginated();
        $userCount = $this->user->getAllCount();
        return response()->json(['data' => $user, 'itemsCount' => $userCount]);
    }

    public function search()
    {
        $users = $this->user->getAllPaginated();
        return response()->json(['data' => $users]);
    }

    public function show($id)
    {
        $user = $this->user->findById($id);
        $clinics = $this->helperServices->clinics();
        return response()->json(['data' => $user,'clinics' => $clinics,]);
    }

    public function create()
    {
        $clinics = $this->helperServices->clinics();
        return response()->json(['clinics' => $clinics,]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'identity' => 'required',
            'role' => 'required',
            'email' => 'email|required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required',
        ]);

        $user = new User();
        $user->identity = $request->identity;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->role = in_array($request->role,['psychologist','family','religious']) ? 'clinic' : $request->role ?? 0;
        $user->clinic_type = in_array($request->role,['psychologist','family','religious']) ? $request->role : null;
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make($request->password);
        if ($request->file('image')) {
            $fileName = $request->image->store('users');
            $user->image = $fileName;
        }
        $user->save();
        $role = Role::where('name', $user->role)->first();
        $user->assignRole($role);
        return response()->json(['data' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = $this->user->findById($id);

        $request->validate([
            'name' => 'required',
            'identity' => 'required',
            'role' => 'required',
            'email' => 'email|required|unique:users,email,' . $user->id . ',id,deleted_at,NULL'
        ]);

        $user->identity = $request->identity;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->role = in_array($request->role,['psychologist','family','religious']) ? 'clinic' : $request->role ?? 0;
        $user->clinic_type = in_array($request->role,['psychologist','family','religious']) ? $request->role : null;
        $user->email_verified_at = Carbon::now();

        if ($request->filled('password'))
            $user->password = Hash::make($request->password);

        if ($request->file('image')) {
            $fileName = $request->image->store('users');
            $user->image = $fileName;
        }
        $user->save();
        $role = Role::where('name', $user->role)->first();
        $user->removeRole($user->roles->first());
        $user->assignRole($role);

        return response()->json(['data' => $user]);
    }
    public function status(Request $request, $id)
    {
        $user = $this->user->findById($id);
        $user->status = !$user->status;
        $user->save();

        return response()->json(['data' => $user]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['data' => 'success']);
    }
    public
    function export()
    {
        if (\request()->ext_type == 'excel') {
            return Excel::download(new ClinicDoctorExport(), 'users.xlsx');
        } else if (\request()->ext_type == 'csv') {
            return Excel::download(new ClinicDoctorExport(), 'users.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }
}
