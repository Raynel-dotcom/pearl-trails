<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        return view('pages.home');
    }

    /**
     * Display the destinations page.
     */
    public function destinations()
    {
        return view('pages.destinations');
    }

    /**
     * Display the plan my trip page.
     */
    public function plan()
    {
        return view('pages.plan');
    }

    /**
     * Display explore by interest page.
     */
    public function interest(string $interest = 'wildlife')
    {
        return view('pages.interest', compact('interest'));
    }

    /**
     * Display saved trips page.
     */
    public function saved()
    {
        return view('pages.saved');
    }

    /**
     * Display about page.
     */
    public function about()
    {
        return view('pages.about');
    }
}
