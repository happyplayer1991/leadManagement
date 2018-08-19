<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('currency')->delete();
        
        \DB::table('currency')->insert(array (
0 =>
            array (
                'id' => 1,
                'currency_code' => 'ALL',
                'symbol'=>'Lek'
            ),
            1 =>
            array (
              'id' => 2,
                'currency_code' => 'AFN',
                'symbol'=>'؋' 
            ),
            2 =>
            array (
                'id' => 3,
                'currency_code' => 'ARS',
                'symbol'=>'$' 
            ),
            3 =>
            array (
               'id' => 4,
                'currency_code' => 'AWG',
                'symbol'=>'ƒ'
            ),
            4 =>
            array (
                'id' => 5,
                'currency_code' => 'AUD',
                'symbol'=>'$' 
            ),
            5 =>
            array (
                'id' => 6,
                'currency_code' => 'AZN',
                'symbol'=>'₼' 
            ),
            6 =>
            array (
               'id' => 7,
                'currency_code' => 'BSD',
                'symbol'=>'$'
            ),
            7 =>
            array (
               'id' => 8,
                'currency_code' => 'BBD',
                'symbol'=>'$' 
            ),
            8 =>
            array (
               'id' => 9,
                'currency_code' => 'BYN',
                'symbol'=>'Br'
            ),
            9 =>
            array (
               'id' => 10,
                'currency_code' => 'BZD',
                'symbol'=>'BZ$' 
            ),
            10 =>
            array (
               'id' => 11,
                'currency_code' => 'BMD',
                'symbol'=>'$' 
            ),
             11 =>
            array (
               'id' => 12,
                'currency_code' => 'BOB',
                'symbol'=>'$b' 
            ),
             12 =>
            array (
               'id' => 13,
                'currency_code' => 'BAM',
                'symbol'=>'KM' 
            ),
             13 =>
            array (
               'id' => 14,
                'currency_code' => 'BWP',
                'symbol'=>'P' 
            ),
             14 =>
            array (
               'id' => 15,
                'currency_code' => 'BGN',
                'symbol'=>'лв' 
            ),
             15 =>
            array (
               'id' => 16,
                'currency_code' => 'BRL',
                'symbol'=>'R$' 
            ),
             16 =>
            array (
               'id' => 17,
                'currency_code' => 'BND',
                'symbol'=>'$' 
            ),
             17 =>
            array (
               'id' => 18,
                'currency_code' => 'KHR',
                'symbol'=>'៛' 
            ),
             18 =>
            array (
               'id' => 19,
                'currency_code' => 'CAD',
                'symbol'=>'$' 
            ),
             19 =>
            array (
               'id' => 20,
                'currency_code' => 'KYD',
                'symbol'=>'$' 
            ),
             20 =>
            array (
               'id' => 21,
                'currency_code' => 'CLP',
                'symbol'=>'$' 
            ),
             21 =>
            array (
               'id' => 22,
                'currency_code' => 'CNY',
                'symbol'=>'¥' 
            ),
             22 =>
            array (
               'id' => 23,
                'currency_code' => 'COP',
                'symbol'=>'$' 
            ),
             23 =>
            array (
               'id' => 24,
                'currency_code' => 'CRC',
                'symbol'=>'₡' 
            ),
             24 =>
            array (
               'id' => 25,
                'currency_code' => 'HRK',
                'symbol'=>'kn' 
            ),
             25 =>
            array (
               'id' => 26,
                'currency_code' => 'CUP',
                'symbol'=>'₱' 
            ),
             26 =>
            array (
               'id' => 27,
                'currency_code' => 'CZK',
                'symbol'=>'Kč' 
            ),
             27 =>
            array (
               'id' => 28,
                'currency_code' => 'DKK',
                'symbol'=>'kr' 
            ),
             28 =>
            array (
               'id' => 29,
                'currency_code' => 'DOP',
                'symbol'=>'RD$' 
            ),
             29 =>
            array (
               'id' => 30,
                'currency_code' => 'XCD',
                'symbol'=>'$' 
            ),
             30 =>
            array (
               'id' => 31,
                'currency_code' => 'EGP',
                'symbol'=>'£' 
            ),
             31 =>
            array (
               'id' => 32,
                'currency_code' => 'SVC',
                'symbol'=>'$' 
            ),
             32 =>
            array (
               'id' => 33,
                'currency_code' => 'EUR',
                'symbol'=>'€' 
            ),
             33 =>
            array (
               'id' => 34,
                'currency_code' => 'FKP',
                'symbol'=>'£' 
            ),
             35 =>
            array (
               'id' => 36,
                'currency_code' => 'FJD',
                'symbol'=>'$' 
            ),
             36 =>
            array (
               'id' => 37,
                'currency_code' => 'GHS',
                'symbol'=>'¢' 
            ),
             37 =>
            array (
               'id' => 38,
                'currency_code' => 'GIP',
                'symbol'=>'£' 
            ),
             38 =>
            array (
               'id' => 39,
                'currency_code' => 'GTQ',
                'symbol'=>'Q' 
            ),
             39 =>
            array (
               'id' => 40,
                'currency_code' => 'GGP',
                'symbol'=>'£' 
            ),
             40 =>
            array (
               'id' => 41,
                'currency_code' => 'GYD',
                'symbol'=>'$' 
            ),
             41 =>
            array (
               'id' => 42,
                'currency_code' => 'HNL',
                'symbol'=>'L' 
            ),
             42 =>
            array (
               'id' => 43,
                'currency_code' => 'HKD',
                'symbol'=>'$' 
            ),
             43 =>
            array (
               'id' => 44,
                'currency_code' => 'HUF',
                'symbol'=>'Ft' 
            ),
             44 =>
            array (
               'id' => 45,
                'currency_code' => 'ISK',
                'symbol'=>'kr' 
            ),
             45 =>
            array (
               'id' => 46,
                'currency_code' => 'INR',
                'symbol'=>'Rs' 
            ),
             46 =>
            array (
               'id' => 47,
                'currency_code' => 'IDR',
                'symbol'=>'Rp' 
            ),
             47 =>
            array (
               'id' => 48,
                'currency_code' => 'IRR',
                'symbol'=>'﷼' 
            ),
             48 =>
            array (
               'id' => 49,
                'currency_code' => 'IMP',
                'symbol'=>'£' 
            ),
             49 =>
            array (
               'id' => 50,
                'currency_code' => 'ILS',
                'symbol'=>'₪' 
            ),
             50 =>
            array (
               'id' => 51,
                'currency_code' => 'JMD',
                'symbol'=>'J$' 
            ),
             51 =>
            array (
               'id' => 52,
                'currency_code' => 'JPY',
                'symbol'=>'¥' 
            ),
             52 =>
            array (
               'id' => 53,
                'currency_code' => 'JEP',
                'symbol'=>'£' 
            ),
             53 =>
            array (
               'id' => 54,
                'currency_code' => 'KZT',
                'symbol'=>'лв' 
            ),
             54 =>
            array (
               'id' => 55,
                'currency_code' => 'KPW',
                'symbol'=>'₩' 
            ),
             55 =>
            array (
               'id' => 56,
                'currency_code' => 'KRW',
                'symbol'=>'₩' 
            ),
             56 =>
            array (
               'id' => 57,
                'currency_code' => 'KGS',
                'symbol'=>'лв' 
            ),
             57 =>
            array (
               'id' => 58,
                'currency_code' => 'LAK',
                'symbol'=>'₭' 
            ),
             58 =>
            array (
               'id' => 59,
                'currency_code' => 'LBP',
                'symbol'=>'£' 
            ),
             59 =>
            array (
               'id' => 60,
                'currency_code' => 'LRD',
                'symbol'=>'$' 
            ),
             60 =>
            array (
               'id' => 61,
                'currency_code' => 'MKD',
                'symbol'=>'ден' 
            ),
             61 =>
            array (
               'id' => 62,
                'currency_code' => 'MYR',
                'symbol'=>'RM' 
            ),
             62 =>
            array (
               'id' => 63,
                'currency_code' => 'MUR',
                'symbol'=>'₨' 
            ),
             63 =>
            array (
               'id' => 64,
                'currency_code' => 'MXN',
                'symbol'=>'$' 
            ),
             65 =>
            array (
               'id' => 66,
                'currency_code' => 'MNT',
                'symbol'=>'₮' 
            ),
             66 =>
            array (
               'id' => 67,
                'currency_code' => 'MZN',
                'symbol'=>'MT' 
            ),
             67 =>
            array (
               'id' => 68,
                'currency_code' => 'NAD',
                'symbol'=>'$' 
            ),
             68 =>
            array (
               'id' => 69,
                'currency_code' => 'NPR',
                'symbol'=>'₨' 
            ),
             69 =>
            array (
               'id' => 70,
                'currency_code' => 'ANG',
                'symbol'=>'ƒ' 
            ),
             70 =>
            array (
               'id' => 71,
                'currency_code' => 'NZD',
                'symbol'=>'$' 
            ),
             71 =>
            array (
               'id' => 72,
                'currency_code' => 'NIO',
                'symbol'=>'C$' 
            ),
             72 =>
            array (
               'id' => 73,
                'currency_code' => 'NGN',
                'symbol'=>'₦' 
            ),
             73 =>
            array (
               'id' => 74,
                'currency_code' => 'NOK',
                'symbol'=>'kr' 
            ),
             74 =>
            array (
               'id' => 75,
                'currency_code' => 'OMR',
                'symbol'=>'﷼' 
            ),
             75 =>
            array (
               'id' => 76,
                'currency_code' => 'PKR',
                'symbol'=>'₨' 
            ),
             76 =>
            array (
               'id' => 77,
                'currency_code' => 'PAB',
                'symbol'=>'B/.' 
            ),
             77 =>
            array (
               'id' => 78,
                'currency_code' => 'PYG',
                'symbol'=>'Gs' 
            ),
             78 =>
            array (
               'id' => 79,
                'currency_code' => 'PEN',
                'symbol'=>'S/.' 
            ),
             79 =>
            array (
               'id' => 80,
                'currency_code' => 'PHP',
                'symbol'=>'₱' 
            ),
             80 =>
            array (
               'id' => 81,
                'currency_code' => 'PLN',
                'symbol'=>'zł' 
            ),
             81 =>
            array (
               'id' => 82,
                'currency_code' => 'QAR',
                'symbol'=>'﷼' 
            ),
             82 =>
            array (
               'id' => 83,
                'currency_code' => 'RON',
                'symbol'=>'lei' 
            ),
             83 =>
            array (
               'id' => 84,
                'currency_code' => 'RUB',
                'symbol'=>'₽' 
            ),
             84 =>
            array (
               'id' => 85,
                'currency_code' => 'SHP',
                'symbol'=>'£' 
            ),
             85 =>
            array (
               'id' => 86,
                'currency_code' => 'SAR',
                'symbol'=>'﷼' 
            ),
             86 =>
            array (
               'id' => 87,
                'currency_code' => 'RSD',
                'symbol'=>'Дин.' 
            ),
             87 =>
            array (
               'id' => 88,
                'currency_code' => 'SCR',
                'symbol'=>'₨' 
            ),
             88 =>
            array (
               'id' => 89,
                'currency_code' => 'SGD',
                'symbol'=>'$' 
            ),
             89 =>
            array (
               'id' => 90,
                'currency_code' => 'SBD',
                'symbol'=>'$' 
            ),
             90 =>
            array (
               'id' => 91,
                'currency_code' => 'SOS',
                'symbol'=>'S' 
            ),
             91 =>
            array (
               'id' => 92,
                'currency_code' => 'ZAR',
                'symbol'=>'R' 
            ),
             92 =>
            array (
               'id' => 93,
                'currency_code' => 'LKR',
                'symbol'=>'₨' 
            ),
             93 =>
            array (
               'id' => 94,
                'currency_code' => 'SEK',
                'symbol'=>'kr' 
            ),
             94 =>
            array (
               'id' => 95,
                'currency_code' => 'CHF',
                'symbol'=>'CHF' 
            ),
             95 =>
            array (
               'id' => 96,
                'currency_code' => 'SRD',
                'symbol'=>'$' 
            ),
             96 =>
            array (
               'id' => 97,
                'currency_code' => 'SYP',
                'symbol'=>'£' 
            ),
             97 =>
            array (
               'id' => 98,
                'currency_code' => 'TWD',
                'symbol'=>'NT$' 
            ),
             98 =>
            array (
               'id' => 99,
                'currency_code' => 'THB',
                'symbol'=>'฿' 
            ),
             99 =>
            array (
               'id' => 100,
                'currency_code' => 'TTD',
                'symbol'=>'TT$' 
            ),
             100 =>
            array (
               'id' => 101,
                'currency_code' => 'TVD',
                'symbol'=>'$' 
            ),
             101 =>
            array (
               'id' => 102,
                'currency_code' => 'UAH',
                'symbol'=>'₴' 
            ),
             102 =>
            array (
               'id' => 103,
                'currency_code' => 'GBP',
                'symbol'=>'£' 
            ),
             103 =>
            array (
               'id' => 104,
                'currency_code' => 'USD',
                'symbol'=>'$' 
            ),
             104 =>
            array (
               'id' => 105,
                'currency_code' => 'UYU',
                'symbol'=>'$U' 
            ),
             105 =>
            array (
               'id' => 106,
                'currency_code' => 'UZS',
                'symbol'=>'лв' 
            ),
             106 =>
            array (
               'id' => 107,
                'currency_code' => 'VEF',
                'symbol'=>'Bs' 
            ),
             107 =>
            array (
               'id' => 108,
                'currency_code' => 'VND',
                'symbol'=>'	₫' 
            ),
             108 =>
            array (
               'id' => 109,
                'currency_code' => 'YER',
                'symbol'=>'﷼' 
            ),
             109 =>
            array (
               'id' => 110,
                'currency_code' => 'ZWD',
                'symbol'=>'Z$' 
            ),
           
        ));
    }
}
