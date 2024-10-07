<?php

namespace App\Http\Controllers;

use App\Charts\ProductChart;
use App\Charts\ProductTerbanyak;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Product;
use App\Models\galleries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(ProductChart $productChart, ProductTerbanyak $productTerbanyak)
    {
        // Mengambil transaksi detail dengan relasi yang diperlukan
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                            ->whereHas('product', function($query) {
                                // Memastikan kolom yang diakses benar-benar ada di tabel product
                                $query->where('users_id', Auth::user()->id);
                            })
                            ->get();
    
        // Menghitung total revenue
        $revenue = $transactions->reduce(function ($carry, $item) {
            return $carry + $item->price;
        });
    
        // Menghitung jumlah customer
        $customer = User::count();
    
        // Mengirim data ke view
        return view('pages.dashboard', [
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions,
            'revenue' => $revenue,
            'customer' => $customer,
            'productChart' => $productChart->build(),
            'productTerbanyak' => $productTerbanyak->build(),
        ]);
    }
    


}
