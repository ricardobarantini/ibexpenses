<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Account;
use App\Tag;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Transactions';
        $transactions = Transaction::latest()->get();
        return view('transactions.index', compact('transactions', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Transaction';

        $accounts = Account::where('user_id', '=', auth()->id())->get();
        $tags = Tag::where('user_id', '=', auth()->id())->get();
        return view('transactions.create', compact(['accounts', 'tags', 'page_title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'description' => 'required',
            'type' => 'required'
        ]);

        $txn = Transaction::create([
            'amount' => request('amount'),
            'type' => request('type'),
            'description' => request('description'),
            'user_id' => auth()->id(),
            'from_account_id' => request('from_account') != "" ? request('from_account') : null,
            'to_account_id' => request('to_account') != "" ? request('to_account') : null,
        ]);

        $tags = request('tags');
        foreach($tags as $tag)
        {
            $txn->tags()->attach($tag);
        }

        return redirect('/transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $page_title = 'Transaction Details';
        return view('transactions.show', compact('transaction', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
