<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CashOnDelivery;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CashOnDeliveryController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            $cash_on_deliveries = CashOnDelivery::all();
            return view('CashOnDelivery.index', compact('cash_on_deliveries'));
        }elseif (Auth::check() && Auth::user()->hasRole('rider')) {
            $cash_on_deliveries = Auth::user()->rider->cash_on_deliveries;
            return view('CashOnDelivery.index', compact('cash_on_deliveries'));
        }
        return redirect()->route('login');
    }

    public function online_verify(CashOnDelivery $cash_on_delivery)
    {
        return view('CashOnDelivery.online_verify', compact('cash_on_delivery'));
    }


    public function update(Request $request, CashOnDelivery $cash_on_delivery)
    {
        try {
            //dd($request->stripeToken);
            $charge = Stripe::charges()->create([
                'amount' => $cash_on_delivery->amount,
                'currency' => 'MYR',
                'source' => $request->stripeToken,
                'description' => 'Order'
            ]);
            $cash_on_delivery->type = 'online';
            $cash_on_delivery->online_status = 'received';
            $cash_on_delivery->save();
            return redirect()->route('cash_on_delivery.index')->with('success-message', 'Thank you! Your payment has been excepted');
        } catch (CardErrorException $e) {
            return redirect()->route('cash_on_delivery.index')->withErrors('Error!', $e->getMessage());
        }
    }

    public function rider_verify(CashOnDelivery $cash_on_delivery)
    {
        $cash_on_delivery->type = 'on-hand';
        $cash_on_delivery->save();
        return redirect()->route('cash_on_delivery.index');
    }

    public function staff_verify(CashOnDelivery $cash_on_delivery)
    {
        $cash_on_delivery->staff_id = Auth::user()->staff->id;
        $cash_on_delivery->verified = 'yes';
        $cash_on_delivery->save();
        return redirect()->route('cash_on_delivery.index');
    }
}
