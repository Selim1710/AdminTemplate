<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Models\News;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Showcase;
use App\Models\Team;
use App\Models\Training;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
       $loginLog = LoginLog::orderBy('last_login','desc')->get();
       return view('admin.dashboard', compact('loginLog'));
    }

    public function unauthorized()
    {
        return view('admin.unauthorized');
    }

    public function my_account_edit()
    {
        $data['user'] = User::find(Auth::id());
        // return  $user;
        return view('admin.users.my_account_edit', $data);
    }

    public function my_account_update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        return redirect()->back()->with('success', 'Data updated successfully');
    }
}
