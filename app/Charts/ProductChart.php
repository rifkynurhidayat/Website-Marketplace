<?php

namespace App\Charts;

use App\Models\Product;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProductChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $product = Product::with('category')->get();

        $data = [];
        $labels = [];

        foreach ($product->groupBy('category.name') as $categoryName => $products) {
            $data[] = $products->count();  
            $labels[] = $categoryName;
        }

        return $this->chart->pieChart()
            ->setTitle('Jumlah produk berdasarkan kategori')
            ->setSubtitle('Data berdasarkan produk berkategori')
            ->setWidth(400)
            ->setHeight(400)
            ->addData($data)
            ->setLabels($labels);
    }
}
