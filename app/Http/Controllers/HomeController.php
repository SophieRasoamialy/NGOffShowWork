<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CDO;
use App\Models\Developpeur;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Closure;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);

        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            if(Developpeur::where('user_id', Auth::user()->id)->exists())
        {
            return redirect()->to('/projets');
        }
        if(CDO::where('user_id', Auth::user()->id)->exists() )
            {
            return redirect()->to('/dashboard');
            }
        if(Admin::where('user_id', Auth::user()->id)->exists() )
            {
            return redirect()->to('/dashboard');
            }
        return view('home');
    }

    public function markasreadcdo(Request $request) {

        $id = $request->route('id');
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        echo $id;

    }
    

    public function markasread()
    {
        $user = Auth::user();
        /*foreach ($user->unreadNotifications as $notification) {
        $notification->markAsRead();*/
         $user->unreadNotifications()->update(['read_at' => now()]);
            echo"";
        //}
        
    }
}
