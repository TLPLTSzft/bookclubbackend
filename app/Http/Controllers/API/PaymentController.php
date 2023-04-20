<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = new Payment();
        $payment->fill($request->all());
        $payment->save();
        return response()->json($payment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::find($id);
        if (is_null($payment)) {
            return response()->json(['message' => 'Ilyen azonosítóval nem található rekord'], 404);
        }
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, string $id)
    {
        $payment = Payment::find($id);
        if (is_null($payment)) {
            return response()->json(['message' => 'Ilyen azonosítóval nem található rekord'], 404);
        }
        $payment->fill($request->all());
        $payment->save();
        return response()->json($payment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);
        if (is_null($payment)) {
            return response()->json(['message' => 'Ilyen azonosítóval nem található rekord'], 404);
        }
        Payment::destroy($id);
        return response()->noContent();
    }
}
