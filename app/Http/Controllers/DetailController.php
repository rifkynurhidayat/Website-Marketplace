<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::with(['user', 'galleries'])->where('slug', $id)->firstOrFail();
        return view('pages.detail', [
            'product' => $product
        ]);
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);


        //validasi stok
        if ($request->stok_buy > $product->stok) {
            return redirect()->route('details', ['id' => $product->slug])->with('warning', 'stok tidak mencukupi');
        }

        //cek produk di keranjang
        $cekProduk = Cart::where('products_id', $id)->where('users_id', Auth::user()->id)->first();

        if ($cekProduk) {
            $cekProduk->stok_buy += $request->stok_buy;

            //validasi stok setelah penambahab
            if ($cekProduk->stok_buy > $product->stok) {
                return redirect()->route('details', ['id' => $product->slug])->with('warning', 'Stok tidak mencukupi setelah penambahan');
            }
            //simpan perubahan
            $cekProduk->save();
        } else {
            //jika produk belum ada
            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id,
                'stok_buy' => $request->stok_buy,
            ];
            Cart::create($data);
        }
        return redirect()->route('cart')->with('succes', 'produk berhasil ditambahkan');
    }
}
