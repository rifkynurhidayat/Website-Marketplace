<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        //save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proses chechkout
        $code = 'STORE-' . mt_rand(0000000, 99999);
        $carts = Cart::with(['product', 'user'])->where('users_id', Auth::user()->id)->get();
        //transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX' . mt_rand(0000000, 99999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => (int) $request->total_price,
                'shipping_status' =>  0,
                'resi' => 'PENDING',
                'code' => $trx,
                'qty_buy' => $cart->stok_buy,
            ]);

            // Mengurangi stok produk berdasarkan kuantitas yang dibeli
        $cart->product->stok -= $cart->stok_buy;
        $cart->product->save();
        }

        //Delete cart data
    Cart::where('users_id', Auth::user()->id)->delete();
       

        //konfigurasi midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');

        //buat array untuk kriim ke midtrans
        $midtrans = array(
            'transaction_details' => array(
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
                'product' => $cart->product->name
            ),

            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),

            'enabled_payments' => array('gopay', 'permata_va', 'bank_transfer'),
                'vtweb' => array()
        );

           


        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        // Set konfigurasi Midtrans
        $serverKey = config("services.midtrans.serverKey");
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaction = Transaction::where('code', $request->order_id)->firstOrFail();
                $transaction->update(['transaction_status' => 'SUCCESS']);
            } elseif (in_array($request->transaction_status, ['deny', 'expire', 'cancel'])) {
                $transaction = Transaction::where('code', $request->order_id)->firstOrFail();
                $transaction->update(['transaction_status' => 'CANCELLED']);
            }
        } else {
            return response()->json(['error' => 'Invalid signature key'], 400);
        }

        return response()->json(['status' => 'ok'], 200);
        return view('pages.success');
    }

    public function success()
    {
        return view('pages.success');
    }
}
