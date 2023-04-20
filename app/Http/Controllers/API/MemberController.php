<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\Models\Payment;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();
        return response()->json($members);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $member = new Member();
        $member->fill($request->all());
        $member->save();
        return response()->json($member, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Member::find($id);
        if (is_null($member)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($member);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, string $id)
    {
        $member = Member::find($id);
        if (is_null($member)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $member->fill($request->all());
        $member->save();
        return response()->json($member);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::find($id);
        if (is_null($member)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        Member::destroy($id);
        return response()->noContent();
    }

    /* public function pay(string $id)
    {
        $member = Member::find($id);
        if (is_null($member)) {
            return response()->json(['message' => 'Not Found'], 404);
        } else {
            $today = date('Y-m-d');
            $diff = date_diff(date_create($member->birth_date), date_create($today));
            $age = $diff->format('%y');
            $member->age = $age;
        }
        return response()->json($member);
    } */

    public function pay(StorePaymentRequest $request, string $member)
    {
        if (is_null(Member::find($member))) {
            return response()->json(['message' => 'Not Found'], 404);
        } else {
            $previousDate = date_modify(now(), '-30 days');
            $payments = Payment::all()->where('member_id', $member);
            $status = 0;
            foreach ($payments as $key => $payment) {
                if (date_create($payment->paid_at) >= $previousDate) {
                    $status = 409;
                }
            }
            if ($status == 409) {
                return response()->json(['message' => 'Conflict'], 409);
            } else {
                $payment = new Payment();
                $payment->member_id = $member;
                $payment->amount = 5000;
                $payment->paid_at = now();
                $payment->save();
                return response()->json($payment, 201);
            }
        }
    }
}
