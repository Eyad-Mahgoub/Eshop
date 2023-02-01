<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDetailsRequest;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{

    public function index()
    {
        $user = User::orderBy('created_at', 'desc')->first();
        // $userId = 1;
        return view('auth.userdetails.index', compact('user'));
    }

    public function store(UserDetailsRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        UserDetails::create($data);

        return redirect('/');
    }
}
