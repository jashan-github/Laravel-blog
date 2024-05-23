<?php

namespace App\Exports;

use App\Models\Variant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VariantsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $variantIds;

    public function __construct(array $variantIds)
    {
        $this->variantIds = $variantIds;
    }

    public function collection()
    {
        return Variant::with('product')->whereIn('id', $this->variantIds)
            ->get([
                'product_id',
                'name',
                'price'
            ]);
    }

    public function headings(): array
    {
        return [
            'Product Name',
            'Name',
            'Price',
        ];
    }

    public function map($variant): array
    {
        return [
            $variant->product->name,
            $variant->name,
            $variant->price,
        ];
    }
}
