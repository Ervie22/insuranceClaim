<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserCredit;

class CreditController extends Controller
{
    public function addCredit()
    {
        $uid = Auth::user()->id;
        $getEmail = User::where('id', $uid)->first();
        $getCredit = UserCredit::where('user_id', $uid)->first();
        return view('user.credit.add-credit', compact('getEmail', 'getCredit', 'uid'));
    }
    public function updateCredit(Request $request)
    {
        $input = $request->all();
        $uid = $input['uid'];
        $checkData = UserCredit::where('user_id', $uid)->first();
        if (isset($checkData)) {
            $checkData->no_of_credits = $input['user_credit'];
            $checkData->save();
        } else {
            $new = new UserCredit;
            $new->user_id = $uid;
            $new->no_of_credits = $input['user_credit'];
            $new->valid_date = date('Y-m-d');
            $new->save();
        }
        return 1;
    }
    public function updateEmail(Request $request)
    {
        $input = $request->all();
        $uid = $input['uid'];
        $checkData = User::where('id', $uid)->first();

        $checkData->email = $input['email'];
        $checkData->save();


        return 1;
    }
}
