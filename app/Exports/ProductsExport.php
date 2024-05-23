<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $productIds;

    public function __construct(array $productIds)
    {
        $this->productIds = $productIds;
    }

    public function collection()
    {
        return Product::whereIn('id', $this->productIds)
            ->get([
                'name',
                'description',
                'price'
            ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Price',
        ];
    }
}
