<?php

namespace App\Http\Controllers;

use Hyperpay\ConnectIn\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    protected $rules;
    protected $user_data;
    protected $next_step;
    protected $previous_step;



    public function next(Request $request)
    {
        $user_data = $request->session()->get('user_data');
        $user_data[] = ($request->all());
        $request->session()->put('user_data', $user_data);
        $step = $request->get('step') ?? 1;
        return view('home' , compact('user_data' , 'step'));

    }

    public function inquiry(Request $request , Transaction $transaction)
    {

        return $request->all();
        dd($request->all());
        return view('home' , compact('transaction'));
    }

    public function previous(Request $request, $step)
    {
        $next_step = "stepThree";
        $previous_step = "stepFour";

        return view('home' , compact('next_step' , 'previous_step' , 'step'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $step)
    {


        $user_data = $request->session()->get('user_data');

        return view('home' , compact('user_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
