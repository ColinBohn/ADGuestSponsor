<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Input;
use Redirect;
use Auth;
use App\Guest;
use App\Notifications\AccountCreated;


class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function home() {
        return view('create');
    }
    
    function list() {
        $guests = Auth::user()->guests()->orderBy('expiration', 'desc')->get();
        return view('list', compact('guests'));
    }
    
    function create(Request $request) {
        $rules = array(
            'firstName' => 'required|alpha',
            'lastName'  => 'required|alpha',
            'purpose'   => 'required|string',
            'location'  => 'required|string',
            'duration'  => 'required|integer|min:1|max:30',
        );
        $validator = Validator::make($request->all(), $rules);
        
        // process the inputs
        if ($validator->fails()) {
            return redirect('home')
                ->withErrors($validator)
                ->withInput();
        } else {
            $guest = new Guest;
            $guest->firstName = $request->input('firstName');
            $guest->lastName = $request->input('lastName');
            $guest->location = $request->input('location');
            $guest->purpose = $request->input('purpose');
            $guest->cn = $request->input('lastName') . ', ' . $request->input('firstName');
            $guest->dn = $guest->createDn();
            $guest->sponsorDn = Auth::user()->dn;
            $guest->expiration = time() + ($request->input('duration') * 86400);
            $guest->username = strtolower('guest-' . $request->input('firstName')[0] . $request->input('lastName'));
            $guest->password = str_random(8);
            if ($guest->exists()) {
                $request->session()->flash('message', 'User already exists. Please contact the help desk for support.');
                return redirect('home');
            }
            if (!$guest->createAccount())
            {
                $request->session()->flash('message', 'An error occurred while creating this user. Please contact the help desk for support.');
                return redirect('home');
            }
            $guest->save();
            $guest->notify(new AccountCreated($guest));
            return view('success', compact('guest'));            
        }
    }
}
