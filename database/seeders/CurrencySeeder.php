<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            // Popular African Currencies
            ['code' => 'ZAR', 'name' => 'South African Rand', 'symbol' => 'R', 'country' => 'South Africa'],
            ['code' => 'NGN', 'name' => 'Nigerian Naira', 'symbol' => '₦', 'country' => 'Nigeria'],
            ['code' => 'KES', 'name' => 'Kenyan Shilling', 'symbol' => 'KSh', 'country' => 'Kenya'],
            ['code' => 'EGP', 'name' => 'Egyptian Pound', 'symbol' => 'E£', 'country' => 'Egypt'],
            ['code' => 'GHS', 'name' => 'Ghanaian Cedi', 'symbol' => 'GH₵', 'country' => 'Ghana'],
            ['code' => 'TZS', 'name' => 'Tanzanian Shilling', 'symbol' => 'TSh', 'country' => 'Tanzania'],
            ['code' => 'UGX', 'name' => 'Ugandan Shilling', 'symbol' => 'USh', 'country' => 'Uganda'],
            ['code' => 'MAD', 'name' => 'Moroccan Dirham', 'symbol' => 'DH', 'country' => 'Morocco'],
            ['code' => 'ETB', 'name' => 'Ethiopian Birr', 'symbol' => 'Br', 'country' => 'Ethiopia'],
            ['code' => 'XOF', 'name' => 'West African CFA Franc', 'symbol' => 'CFA', 'country' => 'West Africa (WAEMU)'],
            ['code' => 'XAF', 'name' => 'Central African CFA Franc', 'symbol' => 'FCFA', 'country' => 'Central Africa (CEMAC)'],
            ['code' => 'ZMW', 'name' => 'Zambian Kwacha', 'symbol' => 'ZK', 'country' => 'Zambia'],
            ['code' => 'BWP', 'name' => 'Botswana Pula', 'symbol' => 'P', 'country' => 'Botswana'],
            ['code' => 'MUR', 'name' => 'Mauritian Rupee', 'symbol' => 'Rs', 'country' => 'Mauritius'],
            ['code' => 'NAD', 'name' => 'Namibian Dollar', 'symbol' => 'N$', 'country' => 'Namibia'],
            ['code' => 'RWF', 'name' => 'Rwandan Franc', 'symbol' => 'FRw', 'country' => 'Rwanda'],
            ['code' => 'MWK', 'name' => 'Malawian Kwacha', 'symbol' => 'MK', 'country' => 'Malawi'],
            ['code' => 'SZL', 'name' => 'Swazi Lilangeni', 'symbol' => 'L', 'country' => 'Eswatini'],
            ['code' => 'LSL', 'name' => 'Lesotho Loti', 'symbol' => 'L', 'country' => 'Lesotho'],
            ['code' => 'MZN', 'name' => 'Mozambican Metical', 'symbol' => 'MT', 'country' => 'Mozambique'],
            ['code' => 'AOA', 'name' => 'Angolan Kwanza', 'symbol' => 'Kz', 'country' => 'Angola'],
            ['code' => 'DZD', 'name' => 'Algerian Dinar', 'symbol' => 'DA', 'country' => 'Algeria'],
            ['code' => 'TND', 'name' => 'Tunisian Dinar', 'symbol' => 'DT', 'country' => 'Tunisia'],
            ['code' => 'LYD', 'name' => 'Libyan Dinar', 'symbol' => 'LD', 'country' => 'Libya'],
            ['code' => 'SDG', 'name' => 'Sudanese Pound', 'symbol' => 'SDG', 'country' => 'Sudan'],
            
            // Common International Currencies for reference
            ['code' => 'USD', 'name' => 'US Dollar', 'symbol' => '$', 'country' => 'United States'],
            ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€', 'country' => 'European Union'],
            ['code' => 'GBP', 'name' => 'British Pound', 'symbol' => '£', 'country' => 'United Kingdom'],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
