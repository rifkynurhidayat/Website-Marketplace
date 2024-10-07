<?php

namespace App\Charts;

use App\Models\TransactionDetail;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProductTerbanyak
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $transactionDetails = TransactionDetail::with('product')->get();

        $groupDataProduk = $transactionDetails->groupBy('products_id');

        $data = [];
        $labels = [];

        foreach ($groupDataProduk as $details) {
                $product = $details->first()->product;
                $labels[] = $product->name;
                $data[] = $details->sum('qty_buy');
        }

        return $this->chart->barChart()
            ->setTitle('Jumlah Produk Terjual')
            ->setSubtitle('Berdasarkan data transaksi')
            ->setWidth(400)
            ->setHeight(400)
            ->addData('jumlah terjual', $data)
            ->setXAxis($labels);
    }
}
