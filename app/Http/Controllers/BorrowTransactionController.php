<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowTransactionController extends Controller
{
    public function index()
{
    return BorrowTransaction::with(['user', 'book'])->get();
}

public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_id' => 'required|exists:books,id',
        'type' => 'required|in:borrow,return',
        'date' => 'required|date',
    ]);

    return BorrowTransaction::create($validated);
}

public function destroy($id)
{
    $transaction = BorrowTransaction::findOrFail($id);
    $transaction->delete();

    return response()->json(['message' => 'Transaction deleted']);
}
}