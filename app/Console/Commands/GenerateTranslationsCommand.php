<?php

namespace App\Console\Commands;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Nnjeim\World\Models\Country;

class GenerateTranslationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-translations-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $languagesCodes = Country::all()->pluck('iso2');
        $homepageText   = $this->getHomepageText();

        foreach ($languagesCodes as $code) {
            if ($code === "RO") {
                continue;
            }

            $response = json_decode($this->getTranslations($homepageText, $code)->body(), true);

            if (array_key_exists("message", $response) && $response['message'] === "Value for 'target_lang' not supported.") {
                continue;
            }

            $path = resource_path("lang/" . strtolower($code)); // This path might need to be adjusted based on the naming scheme Laravel uses for the language.
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            dump("path: " . $path);

            $extractedTranslations = [];
            $translations          = $response['translations'];

            dump($translations);

            foreach ($translations as $translation) {
                $extractedTranslations[] = $translation['text'];
            }

            dump($extractedTranslations);

            $forContent = array_combine($homepageText, $extractedTranslations);

            dump($forContent);

            $content    = "<?php\n\nreturn " . var_export($forContent, true) . ";\n";
            file_put_contents($path . "/messages.php", serialize($content));

        }
    }

    private function getHomepageText(): array
    {
        return [
            "Discover cosmetic raw materials, ingredients and services in one place.",
            "Signup now and join our cosmetics community of manufacturers,ingredients and packing suppliers, distributors and retailers.",
            "Get access to a wide variety of service providers, such as laboratories,compliance consultants, marketing agencies, couriers and many other relevant categories of CezAgora users.",
            "Contact us",
            "Ingredients",
            "Browse emulsifiers,preservatives, thickeners,moisturisers, colours and fragrances.",
            "Go to ingredients list",
            "Raw materials",
            "Discover acids, alkalis, amino acids, siliocones, antioxidants, colours, emollients and more .",
            "Go to raw materials list",
            "Laboratory analyses services",
            "Browse laboratories for microbiological, chemical and sensory cosmetic testing.",
            "Go to laboratories list",
            "Compliance",
            "Get access to regulatory solutions, compliance, registration and authoring services and more.",
            "Go to regulatory and compliance services list",
            "Packaging",
            "Discover cosmetic packaging, closures and sets.",
            "Go to packaging list",
            "Delivery",
            "Browse shipping, warehouse, transport and distribution services.",
            "Go to delivery providers list",
            "Marketing",
            "Discover marketing specialists and let them help you identify and satisfy customer needs, maintain customer loyalty and build customer relationships.",
            "Go to marketing specialists list",
            "Cosmetic products",
            "Buy cosmetic products directly from manufacturers",
            "Go to cosmetic products list",
        ];
    }

    private function getTranslations(array $homepageText, string $code): PromiseInterface|Response
    {
        return Http::withHeaders(
            [
                'Authorization' => 'DeepL-Auth-Key 8d1568ef-09d6-78ee-74ef-99618a3b8d4e:fx',
                'Content-Type'  => 'application/json',
            ]
        )->post(
            "https://api-free.deepl.com/v2/translate",
            [
                "text" => $homepageText,
                "target_lang" => $code,
            ]
        );
    }
}
