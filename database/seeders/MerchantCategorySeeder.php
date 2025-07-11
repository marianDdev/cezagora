<?php

namespace Database\Seeders;

use App\Models\MerchantCategoryCode;
use Illuminate\Database\Seeder;

class MerchantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MerchantCategoryCode::insert($this->getMccs());
    }

    private function getMccs(): array
    {
        return [
            [
                'code'        => '0742',
                'description' => 'Veterinary services',
            ],
            [
                'code'        => '0743',
                'description' => 'Wine producers',
            ],
            [
                'code'        => '0744',
                'description' => 'Champagne producers',
            ],
            [
                'code'        => '0763',
                'description' => 'Agricultural Cooperatives',
            ],
            [
                'code'        => '0780',
                'description' => 'Landscaping and horticultural services',
            ],
            [
                'code'        => '1353',
                'description' => 'Dia (Spain)-Hypermarkets of Food',
            ],
            [
                'code'        => '1406',
                'description' => 'H&M Moda (Spain)-Retail Merchants',
            ],
            [
                'code'        => '1520',
                'description' => 'General contractors — residential and commercial',
            ],
            [
                'code'        => '1711',
                'description' => 'Heating, plumbing and air-conditioning contractors',
            ],
            [
                'code'        => '1731',
                'description' => 'Electrical contractors',
            ],
            [
                'code'        => '1740',
                'description' => 'Masonry, stonework, tile setting, plastering and insulation contractors',
            ],
            [
                'code'        => '1750',
                'description' => 'Carpentry contractors',
            ],
            [
                'code'        => '1761',
                'description' => 'Roofing, siding and sheet metal work contractors',
            ],
            [
                'code'        => '1771',
                'description' => 'Concrete work contractors',
            ],
            [
                'code'        => '1799',
                'description' => 'Special trade contractors — not elsewhere classified',
            ],
            [
                'code'        => '2741',
                'description' => 'Miscellaneous publishing and printing services',
            ],
            [
                'code'        => '2791',
                'description' => 'Typesetting, platemaking and related services',
            ],
            [
                'code'        => '2842',
                'description' => 'Speciality cleaning, polishing and sanitation preparations',
            ],
            [
                'code'        => 'G300',
                'description' => 'Airlines (codes between 3000 and 3350)',
            ],
            [
                'code'        => 'G335',
                'description' => 'Car rentals (codes between 3351 and 3500)',
            ],
            [
                'code'        => 'G350',
                'description' => 'Hotels (codes between 3501 and 3999)',
            ],
            [
                'code'        => '4011',
                'description' => 'Railroads',
            ],
            [
                'code'        => '4111',
                'description' => 'Local and suburban commuter passenger transportation, including ferries',
            ],
            [
                'code'        => '4112',
                'description' => 'Passenger railways',
            ],
            [
                'code'        => '4119',
                'description' => 'Ambulance Services',
            ],
            [
                'code'        => '4121',
                'description' => 'Taxi-cabs and limousines',
            ],
            [
                'code'        => '4131',
                'description' => 'Bus Lines',
            ],
            [
                'code'        => '4214',
                'description' => 'Motor freight carriers and trucking — local and long distance, moving and storage companies and local delivery',
            ],
            [
                'code'        => '4215',
                'description' => 'Courier services — air and ground and freight forwarders',
            ],
            [
                'code'        => '4225',
                'description' => 'Public warehousing and storage — farm products, refrigerated goods and household goods',
            ],
            [
                'code'        => '4411',
                'description' => 'Steamships and cruise lines',
            ],
            [
                'code'        => '4457',
                'description' => 'Boat Rentals and Leasing',
            ],
            [
                'code'        => '4468',
                'description' => 'Marinas, marine service and supplies',
            ],
            [
                'code'        => '4511',
                'description' => 'Airlines and Air Carriers (Not Elsewhere Classified)',
            ],
            [
                'code'        => '4582',
                'description' => 'Airports, Flying Fields, and Airport Terminals',
            ],
            [
                'code'        => '4722',
                'description' => 'Travel agencies and tour operators',
            ],
            [
                'code'        => '4723',
                'description' => 'Package Tour Operators – Germany Only',
            ],
            [
                'code'        => '4784',
                'description' => 'Tolls and bridge fees',
            ],
            [
                'code'        => '4789',
                'description' => 'Transportation services — not elsewhere classified',
            ],
            [
                'code'        => '4812',
                'description' => 'Telecommunication equipment and telephone sales',
            ],
            [
                'code'        => '4813',
                'description' => 'Key-entry Telecom Merchant providing single local and long-distance phone calls using a central access number in a non–face-to-face environment using key entry',
            ],
            [
                'code'        => '4814',
                'description' => 'Telecommunication services, including local and long distance calls, credit card calls, calls through use of magnetic stripe reading telephones and faxes',
            ],
            [
                'code'        => '4815',
                'description' => 'Monthly summary telephone charges',
            ],
            [
                'code'        => '4816',
                'description' => 'Computer network/information services',
            ],
            [
                'code'        => '4821',
                'description' => 'Telegraph services',
            ],
            [
                'code'        => '4829',
                'description' => 'Wire transfers and money orders',
            ],
            [
                'code'        => '4899',
                'description' => 'Cable and other pay television services',
            ],
            [
                'code'        => '4900',
                'description' => 'Utilities — electric, gas, water and sanitary',
            ],
            [
                'code'        => '5013',
                'description' => 'Motor vehicle supplies and new parts',
            ],
            [
                'code'        => '5021',
                'description' => 'Office and commercial furniture',
            ],
            [
                'code'        => '5039',
                'description' => 'Construction materials — not elsewhere classified',
            ],
            [
                'code'        => '5044',
                'description' => 'Office, photographic, photocopy and microfilm equipment',
            ],
            [
                'code'        => '5045',
                'description' => 'Computers, computer peripheral equipment — not elsewhere classified',
            ],
            [
                'code'        => '5046',
                'description' => 'Commercial equipment — not elsewhere classified',
            ],
            [
                'code'        => '5047',
                'description' => 'Dental/laboratory/medical/ophthalmic hospital equipment and supplies',
            ],
            [
                'code'        => '5051',
                'description' => 'Metal service centres and offices',
            ],
            [
                'code'        => '5065',
                'description' => 'Electrical parts and equipment',
            ],
            [
                'code'        => '5072',
                'description' => 'Hardware equipment and supplies',
            ],
            [
                'code'        => '5074',
                'description' => 'Plumbing and heating equipment and supplies',
            ],
            [
                'code'        => '5085',
                'description' => 'Industrial supplies — not elsewhere classified',
            ],
            [
                'code'        => '5094',
                'description' => 'Precious stones and metals, watches and jewellery',
            ],
            [
                'code'        => '5099',
                'description' => 'Durable goods — not elsewhere classified',
            ],
            [
                'code'        => '5111',
                'description' => 'Stationery, office supplies and printing and writing paper',
            ],
            [
                'code'        => '5122',
                'description' => 'Drugs, drug proprietors',
            ],
            [
                'code'        => '5131',
                'description' => 'Piece goods, notions and other dry goods',
            ],
            [
                'code'        => '5137',
                'description' => 'Men’s, women’s and children’s uniforms and commercial clothing',
            ],
            [
                'code'        => '5139',
                'description' => 'Commercial footwear',
            ],
            [
                'code'        => '5169',
                'description' => 'Chemicals and allied products — not elsewhere classified',
            ],
            [
                'code'        => '5172',
                'description' => 'Petroleum and petroleum products',
            ],
            [
                'code'        => '5192',
                'description' => 'Books, Periodicals and Newspapers',
            ],
            [
                'code'        => '5193',
                'description' => 'Florists’ supplies, nursery stock and flowers',
            ],
            [
                'code'        => '5198',
                'description' => 'Paints, varnishes and supplies',
            ],
            [
                'code'        => '5199',
                'description' => 'Non-durable goods — not elsewhere classified',
            ],
            [
                'code'        => '5200',
                'description' => 'Home supply warehouse outlets',
            ],
            [
                'code'        => '5211',
                'description' => 'Lumber and building materials outlets',
            ],
            [
                'code'        => '5231',
                'description' => 'Glass, paint and wallpaper shops',
            ],
            [
                'code'        => '5251',
                'description' => 'Hardware shops',
            ],
            [
                'code'        => '5261',
                'description' => 'Lawn and garden supply outlets, including nurseries',
            ],
            [
                'code'        => '5262',
                'description' => 'Marketplaces (online Marketplaces)',
            ],
            [
                'code'        => '5271',
                'description' => 'Mobile home dealers',
            ],
            [
                'code'        => '5299',
                'description' => 'Warehouse Club Gas',
            ],
            [
                'code'        => '5300',
                'description' => 'Wholesale clubs',
            ],
            [
                'code'        => '5309',
                'description' => 'Duty-free shops',
            ],
            [
                'code'        => '5310',
                'description' => 'Discount shops',
            ],
            [
                'code'        => '5311',
                'description' => 'Department stores',
            ],
            [
                'code'        => '5331',
                'description' => 'Variety stores',
            ],
            [
                'code'        => '5333',
                'description' => 'HYPERMARKETS OF FOOD',
            ],
            [
                'code'        => '5399',
                'description' => 'Miscellaneous general merchandise',
            ],
            [
                'code'        => '5411',
                'description' => 'Groceries and supermarkets',
            ],
            [
                'code'        => '5422',
                'description' => 'Freezer and locker meat provisioners',
            ],
            [
                'code'        => '5441',
                'description' => 'Candy, nut and confectionery shops',
            ],
            [
                'code'        => '5451',
                'description' => 'Dairies',
            ],
            [
                'code'        => '5462',
                'description' => 'Bakeries',
            ],
            [
                'code'        => '5499',
                'description' => 'Miscellaneous food shops — convenience and speciality retail outlets',
            ],
            [
                'code'        => '5511',
                'description' => 'Car and truck dealers (new and used) sales, services, repairs, parts and leasing',
            ],
            [
                'code'        => '5521',
                'description' => 'Car and truck dealers (used only) sales, service, repairs, parts and leasing',
            ],
            [
                'code'        => '5531',
                'description' => 'Auto Store',
            ],
            [
                'code'        => '5532',
                'description' => 'Automotive Tire Stores',
            ],
            [
                'code'        => '5533',
                'description' => 'Automotive Parts and Accessories Stores',
            ],
            [
                'code'        => '5541',
                'description' => 'Service stations (with or without ancillary services)',
            ],
            [
                'code'        => '5542',
                'description' => 'Automated Fuel Dispensers',
            ],
            [
                'code'        => '5551',
                'description' => 'Boat Dealers',
            ],
            [
                'code'        => '5552',
                'description' => 'Electric Vehicle Charging',
            ],
            [
                'code'        => '5561',
                'description' => 'Camper, recreational and utility trailer dealers',
            ],
            [
                'code'        => '5571',
                'description' => 'Motorcycle shops and dealers',
            ],
            [
                'code'        => '5592',
                'description' => 'Motor home dealers',
            ],
            [
                'code'        => '5598',
                'description' => 'Snowmobile dealers',
            ],
            [
                'code'        => '5599',
                'description' => 'Miscellaneous automotive, aircraft and farm equipment dealers — not elsewhere classified',
            ],
            [
                'code'        => '5611',
                'description' => 'Men’s and boys’ clothing and accessory shops',
            ],
            [
                'code'        => '5621',
                'description' => 'Women’s ready-to-wear shops',
            ],
            [
                'code'        => '5631',
                'description' => 'Women’s accessory and speciality shops',
            ],
            [
                'code'        => '5641',
                'description' => 'Children’s and infants’ wear shops',
            ],
            [
                'code'        => '5651',
                'description' => 'Family clothing shops',
            ],
            [
                'code'        => '5655',
                'description' => 'Sports and riding apparel shops',
            ],
            [
                'code'        => '5661',
                'description' => 'Shoe shops',
            ],
            [
                'code'        => '5681',
                'description' => 'Furriers and fur shops',
            ],
            [
                'code'        => '5691',
                'description' => 'Men’s and women’s clothing shops',
            ],
            [
                'code'        => '5697',
                'description' => 'Tailors, seamstresses, mending and alterations',
            ],
            [
                'code'        => '5698',
                'description' => 'Wig and toupee shops',
            ],
            [
                'code'        => '5699',
                'description' => 'Miscellaneous apparel and accessory shops',
            ],
            [
                'code'        => '5712',
                'description' => 'Furniture, home furnishings and equipment shops and manufacturers, except appliances',
            ],
            [
                'code'        => '5713',
                'description' => 'Floor covering services',
            ],
            [
                'code'        => '5714',
                'description' => 'Drapery, window covering and upholstery shops',
            ],
            [
                'code'        => '5715',
                'description' => 'Alcoholic beverage wholesalers',
            ],
            [
                'code'        => '5718',
                'description' => 'Fireplaces, fireplace screens and accessories shops',
            ],
            [
                'code'        => '5719',
                'description' => 'Miscellaneous home furnishing speciality shops',
            ],
            [
                'code'        => '5722',
                'description' => 'Household appliance shops',
            ],
            [
                'code'        => '5732',
                'description' => 'Electronics shops',
            ],
            [
                'code'        => '5733',
                'description' => 'Music shops — musical instruments, pianos and sheet music',
            ],
            [
                'code'        => '5734',
                'description' => 'Computer software outlets',
            ],
            [
                'code'        => '5735',
                'description' => 'Record shops',
            ],
            [
                'code'        => '5811',
                'description' => 'Caterers',
            ],
            [
                'code'        => '5812',
                'description' => 'Eating places and restaurants',
            ],
            [
                'code'        => '5813',
                'description' => 'Drinking places (alcoholic beverages) — bars, taverns, night-clubs, cocktail lounges and discothèques',
            ],
            [
                'code'        => '5814',
                'description' => 'Fast food restaurants',
            ],
            [
                'code'        => '5815',
                'description' => 'Digital Goods Media – Books, Movies, Music',
            ],
            [
                'code'        => '5816',
                'description' => 'Digital Goods – Games',
            ],
            [
                'code'        => '5817',
                'description' => 'Digital Goods – Applications (Excludes Games)',
            ],
            [
                'code'        => '5818',
                'description' => 'Digital Goods – Large Digital Goods Merchant',
            ],
            [
                'code'        => '5912',
                'description' => 'Drug stores and pharmacies',
            ],
            [
                'code'        => '5921',
                'description' => 'Package shops — beer, wine and liquor',
            ],
            [
                'code'        => '5931',
                'description' => 'Used merchandise and second-hand shops',
            ],
            [
                'code'        => '5932',
                'description' => 'Antique Shops – Sales, Repairs, and Restoration Services',
            ],
            [
                'code'        => '5933',
                'description' => 'Pawn shops',
            ],
            [
                'code'        => '5935',
                'description' => 'Wrecking and salvage yards',
            ],
            [
                'code'        => '5937',
                'description' => 'Antique Reproductions',
            ],
            [
                'code'        => '5940',
                'description' => 'Bicycle Shops – Sales and Service',
            ],
            [
                'code'        => '5941',
                'description' => 'Sporting goods shops',
            ],
            [
                'code'        => '5942',
                'description' => 'Book Stores',
            ],
            [
                'code'        => '5943',
                'description' => 'Stationery, office and school supply shops',
            ],
            [
                'code'        => '5944',
                'description' => 'Jewellery, watch, clock and silverware shops',
            ],
            [
                'code'        => '5945',
                'description' => 'Hobby, toy and game shops',
            ],
            [
                'code'        => '5946',
                'description' => 'Camera and photographic supply shops',
            ],
            [
                'code'        => '5947',
                'description' => 'Gift, card, novelty and souvenir shops',
            ],
            [
                'code'        => '5948',
                'description' => 'Luggage and leather goods shops',
            ],
            [
                'code'        => '5949',
                'description' => 'Sewing, needlework, fabric and piece goods shops',
            ],
            [
                'code'        => '5950',
                'description' => 'Glassware and crystal shops',
            ],
            [
                'code'        => '5960',
                'description' => 'Direct marketing — insurance services',
            ],
            [
                'code'        => '5961',
                'description' => 'Mail Order Houses Including Catalog Order Stores',
            ],
            [
                'code'        => '5962',
                'description' => 'Telemarketing — travel-related arrangement services',
            ],
            [
                'code'        => '5963',
                'description' => 'Door-to-door sales',
            ],
            [
                'code'        => '5964',
                'description' => 'Direct marketing — catalogue merchants',
            ],
            [
                'code'        => '5965',
                'description' => 'Direct marketing — combination catalogue and retail merchants',
            ],
            [
                'code'        => '5966',
                'description' => 'Direct marketing — outbound telemarketing merchants',
            ],
            [
                'code'        => '5967',
                'description' => 'Direct marketing — inbound telemarketing merchants',
            ],
            [
                'code'        => '5968',
                'description' => 'Direct marketing — continuity/subscription merchants',
            ],
            [
                'code'        => '5969',
                'description' => 'Direct marketing/direct marketers — not elsewhere classified',
            ],
            [
                'code'        => '5970',
                'description' => 'Artist’s Supply and Craft Shops',
            ],
            [
                'code'        => '5971',
                'description' => 'Art Dealers and Galleries',
            ],
            [
                'code'        => '5972',
                'description' => 'Stamp and coin shops',
            ],
            [
                'code'        => '5973',
                'description' => 'Religious goods and shops',
            ],
            [
                'code'        => '5974',
                'description' => 'Rubber Stamp Store',
            ],
            [
                'code'        => '5975',
                'description' => 'Hearing aids — sales, service and supplies',
            ],
            [
                'code'        => '5976',
                'description' => 'Orthopaedic goods and prosthetic devices',
            ],
            [
                'code'        => '5977',
                'description' => 'Cosmetic Stores',
            ],
            [
                'code'        => '5978',
                'description' => 'Typewriter outlets — sales, service and rentals',
            ],
            [
                'code'        => '5983',
                'description' => 'Fuel dealers — fuel oil, wood, coal and liquefied petroleum',
            ],
            [
                'code'        => '5992',
                'description' => 'Florists',
            ],
            [
                'code'        => '5993',
                'description' => 'Cigar shops and stands',
            ],
            [
                'code'        => '5994',
                'description' => 'Newsagents and news-stands',
            ],
            [
                'code'        => '5995',
                'description' => 'Pet shops, pet food and supplies',
            ],
            [
                'code'        => '5996',
                'description' => 'Swimming pools — sales, supplies and services',
            ],
            [
                'code'        => '5997',
                'description' => 'Electric razor outlets — sales and service',
            ],
            [
                'code'        => '5998',
                'description' => 'Tent and awning shops',
            ],
            [
                'code'        => '5999',
                'description' => 'Miscellaneous and speciality retail outlets',
            ],
            [
                'code'        => '6010',
                'description' => 'Financial institutions — manual cash disbursements',
            ],
            [
                'code'        => '6011',
                'description' => 'Financial institutions — automated cash disbursements',
            ],
            [
                'code'        => '6012',
                'description' => 'Financial institutions — merchandise and services',
            ],
            [
                'code'        => '6050',
                'description' => 'Quasi Cash—Customer Financial Institution',
            ],
            [
                'code'        => '6051',
                'description' => 'Non-financial institutions — foreign currency, money orders (not wire transfer), scrip and travellers’ checks',
            ],
            [
                'code'        => '6211',
                'description' => 'Securities — brokers and dealers',
            ],
            [
                'code'        => '6300',
                'description' => 'Insurance sales, underwriting and premiums',
            ],
            [
                'code'        => '6381',
                'description' => 'Insurance–Premiums',
            ],
            [
                'code'        => '6513',
                'description' => 'Real Estate Agents and Managers',
            ],
            [
                'code'        => '6529',
                'description' => 'Remote Stored Value Load — Member Financial Institution',
            ],
            [
                'code'        => '6530',
                'description' => 'Remove Stored Value Load — Merchant',
            ],
            [
                'code'        => '6532',
                'description' => 'Payment Transaction—Customer Financial Institution',
            ],
            [
                'code'        => '6533',
                'description' => 'Payment Transaction—Merchant',
            ],
            [
                'code'        => '6535',
                'description' => 'Value Purchase–Member Financial Institution',
            ],
            [
                'code'        => '6536',
                'description' => 'MoneySend Intracountry',
            ],
            [
                'code'        => '6537',
                'description' => 'MoneySend Intercountry',
            ],
            [
                'code'        => '6538',
                'description' => 'MoneySend Funding',
            ],
            [
                'code'        => '6539',
                'description' => 'Funding Transaction (Excluding MoneySend)',
            ],
            [
                'code'        => '6540',
                'description' => 'Non-Financial Institutions – Stored Value Card Purchase/Load',
            ],
            [
                'code'        => '6611',
                'description' => 'Overpayments',
            ],
            [
                'code'        => '6760',
                'description' => 'Savings Bonds',
            ],
            [
                'code'        => '7011',
                'description' => 'Lodging — hotels, motels and resorts',
            ],
            [
                'code'        => '7012',
                'description' => 'Timeshares',
            ],
            [
                'code'        => '7032',
                'description' => 'Sporting and recreational camps',
            ],
            [
                'code'        => '7033',
                'description' => 'Trailer parks and camp-sites',
            ],
            [
                'code'        => '7210',
                'description' => 'Laundry, cleaning and garment services',
            ],
            [
                'code'        => '7211',
                'description' => 'Laundry services — family and commercial',
            ],
            [
                'code'        => '7216',
                'description' => 'Dry cleaners',
            ],
            [
                'code'        => '7217',
                'description' => 'Carpet and upholstery cleaning',
            ],
            [
                'code'        => '7221',
                'description' => 'Photographic studios',
            ],
            [
                'code'        => '7230',
                'description' => 'Barber and Beauty Shops',
            ],
            [
                'code'        => '7251',
                'description' => 'Shoe repair shops, shoe shine parlours and hat cleaning shops',
            ],
            [
                'code'        => '7261',
                'description' => 'Funeral services and crematoriums',
            ],
            [
                'code'        => '7273',
                'description' => 'Dating and escort services',
            ],
            [
                'code'        => '7276',
                'description' => 'Tax preparation services',
            ],
            [
                'code'        => '7277',
                'description' => 'Counselling services — debt, marriage and personal',
            ],
            [
                'code'        => '7278',
                'description' => 'Buying and shopping services and clubs',
            ],
            [
                'code'        => '7280',
                'description' => 'Hospital Patient-Personal Funds Withdrawal',
            ],
            [
                'code'        => '7295',
                'description' => 'Babysitting Services',
            ],
            [
                'code'        => '7296',
                'description' => 'Clothing rentals — costumes, uniforms and formal wear',
            ],
            [
                'code'        => '7297',
                'description' => 'Massage parlours',
            ],
            [
                'code'        => '7298',
                'description' => 'Health and beauty spas',
            ],
            [
                'code'        => '7299',
                'description' => 'Miscellaneous personal services — not elsewhere classified',
            ],
            [
                'code'        => '7311',
                'description' => 'Advertising Services',
            ],
            [
                'code'        => '7321',
                'description' => 'Consumer credit reporting agencies',
            ],
            [
                'code'        => '7322',
                'description' => 'Debt collection agencies',
            ],
            [
                'code'        => '7332',
                'description' => 'Blueprinting and Photocopying Services',
            ],
            [
                'code'        => '7333',
                'description' => 'Commercial photography, art and graphics',
            ],
            [
                'code'        => '7338',
                'description' => 'Quick copy, reproduction and blueprinting services',
            ],
            [
                'code'        => '7339',
                'description' => 'Stenographic and secretarial support services',
            ],
            [
                'code'        => '7342',
                'description' => 'Exterminating and disinfecting services',
            ],
            [
                'code'        => '7349',
                'description' => 'Cleaning, maintenance and janitorial services',
            ],
            [
                'code'        => '7361',
                'description' => 'Employment agencies and temporary help services',
            ],
            [
                'code'        => '7372',
                'description' => 'Computer programming, data processing and integrated systems design services',
            ],
            [
                'code'        => '7375',
                'description' => 'Information retrieval services',
            ],
            [
                'code'        => '7379',
                'description' => 'Computer maintenance and repair services — not elsewhere classified',
            ],
            [
                'code'        => '7392',
                'description' => 'Management, consulting and public relations services',
            ],
            [
                'code'        => '7393',
                'description' => 'Detective  agencies,  protective  agencies  and  security  services,  including  armoured  cars  and guard dogs',
            ],
            [
                'code'        => '7394',
                'description' => 'Equipment, tool, furniture and appliance rentals and leasing',
            ],
            [
                'code'        => '7395',
                'description' => 'Photofinishing laboratories and photo developing',
            ],
            [
                'code'        => '7399',
                'description' => 'Business services — not elsewhere classified',
            ],
            [
                'code'        => '7511',
                'description' => 'Truck Stop',
            ],
            [
                'code'        => '7512',
                'description' => 'Automobile Rental Agency—not elsewhere classified',
            ],
            [
                'code'        => '7513',
                'description' => 'Truck and utility trailer rentals',
            ],
            [
                'code'        => '7519',
                'description' => 'Motor home and recreational vehicle rentals',
            ],
            [
                'code'        => '7523',
                'description' => 'Parking lots and garages',
            ],
            [
                'code'        => '7524',
                'description' => 'Express Payment Service Merchants–Parking Lots and Garages',
            ],
            [
                'code'        => '7531',
                'description' => 'Automotive Body Repair Shops',
            ],
            [
                'code'        => '7534',
                'description' => 'Tyre retreading and repair shops',
            ],
            [
                'code'        => '7535',
                'description' => 'Automotive Paint Shops',
            ],
            [
                'code'        => '7538',
                'description' => 'Automotive Service Shops (Non-Dealer)',
            ],
            [
                'code'        => '7539',
                'description' => 'Automotive Service Shops (Spain) - Other Merchant Categories',
            ],
            [
                'code'        => '7542',
                'description' => 'Car washes',
            ],
            [
                'code'        => '7549',
                'description' => 'Towing services',
            ],
            [
                'code'        => '7622',
                'description' => 'Electronics repair shops',
            ],
            [
                'code'        => '7623',
                'description' => 'Air Conditioning and Refrigeration Repair Shops',
            ],
            [
                'code'        => '7629',
                'description' => 'Electrical and small appliance repair shops',
            ],
            [
                'code'        => '7631',
                'description' => 'Watch, clock and jewellery repair shops',
            ],
            [
                'code'        => '7641',
                'description' => 'Furniture reupholstery, repair and refinishing',
            ],
            [
                'code'        => '7692',
                'description' => 'Welding services',
            ],
            [
                'code'        => '7699',
                'description' => 'Miscellaneous repair shops and related services',
            ],
            [
                'code'        => '7800',
                'description' => 'Government-Owned Lotteries (US Region only)',
            ],
            [
                'code'        => '7801',
                'description' => 'Government Licensed On-Line Casinos (On-Line Gambling) (US Region only)',
            ],
            [
                'code'        => '7802',
                'description' => 'Government-Licensed Horse/Dog Racing (US Region only)',
            ],
            [
                'code'        => '7829',
                'description' => 'Motion picture and video tape production and distribution',
            ],
            [
                'code'        => '7832',
                'description' => 'Motion picture theatres',
            ],
            [
                'code'        => '7833',
                'description' => 'Express Payment Service — Motion Picture Theater',
            ],
            [
                'code'        => '7841',
                'description' => 'Video tape rentals',
            ],
            [
                'code'        => '7911',
                'description' => 'Dance halls, studios and schools',
            ],
            [
                'code'        => '7922',
                'description' => 'Theatrical producers (except motion pictures) and ticket agencies',
            ],
            [
                'code'        => '7929',
                'description' => 'Bands, Orchestras, and Miscellaneous Entertainers (Not Elsewhere Classified)',
            ],
            [
                'code'        => '7932',
                'description' => 'Billiard and Pool Establishments',
            ],
            [
                'code'        => '7933',
                'description' => 'Bowling Alleys',
            ],
            [
                'code'        => '7941',
                'description' => 'Commercial sports, professional sports clubs, athletic fields and sports promoters',
            ],
            [
                'code'        => '7991',
                'description' => 'Tourist attractions and exhibits',
            ],
            [
                'code'        => '7992',
                'description' => 'Public golf courses',
            ],
            [
                'code'        => '7993',
                'description' => 'Video amusement game supplies',
            ],
            [
                'code'        => '7994',
                'description' => 'Video game arcades and establishments',
            ],
            [
                'code'        => '7995',
                'description' => 'Betting, including Lottery Tickets, Casino Gaming Chips, Off-Track Betting, and Wagers at Race Tracks',
            ],
            [
                'code'        => '7996',
                'description' => 'Amusement Parks, Circuses, Carnivals, and Fortune Tellers',
            ],
            [
                'code'        => '7997',
                'description' => 'Membership clubs (sports, recreation, athletic), country clubs and private golf courses',
            ],
            [
                'code'        => '7998',
                'description' => 'Aquariums, Seaquariums, Dolphinariums, and Zoos',
            ],
            [
                'code'        => '7999',
                'description' => 'Recreation services — not elsewhere classified',
            ],
            [
                'code'        => '8011',
                'description' => 'Doctors and physicians — not elsewhere classified',
            ],
            [
                'code'        => '8021',
                'description' => 'Dentists and orthodontists',
            ],
            [
                'code'        => '8031',
                'description' => 'Osteopaths',
            ],
            [
                'code'        => '8041',
                'description' => 'Chiropractors',
            ],
            [
                'code'        => '8042',
                'description' => 'Optometrists and ophthalmologists',
            ],
            [
                'code'        => '8043',
                'description' => 'Opticians, optical goods and eyeglasses',
            ],
            [
                'code'        => '8044',
                'description' => 'Optical Goods and Eyeglasses',
            ],
            [
                'code'        => '8049',
                'description' => 'Podiatrists and chiropodists',
            ],
            [
                'code'        => '8050',
                'description' => 'Nursing and personal care facilities',
            ],
            [
                'code'        => '8062',
                'description' => 'Hospitals',
            ],
            [
                'code'        => '8071',
                'description' => 'Medical and dental laboratories',
            ],
            [
                'code'        => '8099',
                'description' => 'Medical services and health practitioners — not elsewhere classified',
            ],
            [
                'code'        => '8111',
                'description' => 'Legal services and attorneys',
            ],
            [
                'code'        => '8211',
                'description' => 'Elementary and secondary schools',
            ],
            [
                'code'        => '8220',
                'description' => 'Colleges, universities, professional schools and junior colleges',
            ],
            [
                'code'        => '8241',
                'description' => 'Correspondence schools',
            ],
            [
                'code'        => '8244',
                'description' => 'Business and secretarial schools',
            ],
            [
                'code'        => '8249',
                'description' => 'Trade and vocational schools',
            ],
            [
                'code'        => '8299',
                'description' => 'Schools and educational services — not elsewhere classified',
            ],
            [
                'code'        => '8351',
                'description' => 'Child care services',
            ],
            [
                'code'        => '8398',
                'description' => 'Charitable and social service organizations',
            ],
            [
                'code'        => '8641',
                'description' => 'Civic, social and fraternal associations',
            ],
            [
                'code'        => '8651',
                'description' => 'Political organizations',
            ],
            [
                'code'        => '8661',
                'description' => 'Religious organizations',
            ],
            [
                'code'        => '8675',
                'description' => 'Automobile Associations',
            ],
            [
                'code'        => '8699',
                'description' => 'Membership organization — not elsewhere classified',
            ],
            [
                'code'        => '8734',
                'description' => 'Testing laboratories (non-medical)',
            ],
            [
                'code'        => '8911',
                'description' => 'Architectural, Engineering, and Surveying Services',
            ],
            [
                'code'        => '8931',
                'description' => 'Accounting, Auditing, and Bookkeeping Services',
            ],
            [
                'code'        => '8999',
                'description' => 'Professional services — not elsewhere classified',
            ],
            [
                'code'        => '9034',
                'description' => 'I-Purchasing Pilot',
            ],
            [
                'code'        => '9211',
                'description' => 'Court costs, including alimony and child support',
            ],
            [
                'code'        => '9222',
                'description' => 'Fines',
            ],
            [
                'code'        => '9223',
                'description' => 'Bail and Bond Payments',
            ],
            [
                'code'        => '9311',
                'description' => 'Tax payments',
            ],
            [
                'code'        => '9399',
                'description' => 'Government services — not elsewhere classified',
            ],
            [
                'code'        => '9402',
                'description' => 'Postal services — government only',
            ],
            [
                'code'        => '9405',
                'description' => 'U.S. Federal Government Agencies or Departments',
            ],
            [
                'code'        => '9406',
                'description' => 'Government-Owned Lotteries (Non-U.S. region)',
            ],
            [
                'code'        => '9700',
                'description' => 'Automated Referral Service',
            ],
            [
                'code'        => '9701',
                'description' => 'Visa Credential Server',
            ],
            [
                'code'        => '9702',
                'description' => 'Emergency Services (GCAS) (Visa use only)',
            ],
            [
                'code'        => '9751',
                'description' => 'UK Supermarkets, Electronic Hot File',
            ],
            [
                'code'        => '9752',
                'description' => 'UK Petrol Stations, Electronic Hot File',
            ],
            [
                'code'        => '9754',
                'description' => 'Gambling-Horse, Dog Racing, State Lottery',
            ],
            [
                'code'        => '9950',
                'description' => 'Intra-Company Purchases',
            ],
        ];
    }
}
