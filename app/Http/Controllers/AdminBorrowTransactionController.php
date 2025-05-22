<?php

namespace App\Http\Controllers;

use App\Models\BorrowTransaction;
use Illuminate\Http\Request;

class AdminBorrowTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('admin');
    }

    // List transactions with related user (member) and book info
    public function index(Request $request)
    {
        $transactions = BorrowTransaction::with(['user:id,name,email', 'book:id,title,author'])
            ->orderBy('borrowed_at', 'desc')
            ->paginate(20);

        return response()->json($transactions);
    }

    // Show single transaction
    public function show($id)
    {
        $transaction = BorrowTransaction::with(['user:id,name,email', 'book:id,title,author'])->find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json($transaction);
    }

    // Update transaction (e.g. type or date)
    public function update(Request $request, $id)
    {
        $transaction = BorrowTransaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $validated = $request->validate([
            'type' => 'sometimes|in:borrow,return',
            'borrowed_at' => 'sometimes|date',
        ]);

        $transaction->update($validated);

        return response()->json($transaction);
    }

    // Delete transaction
    public function destroy($id)
    {
        $transaction = BorrowTransaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}

