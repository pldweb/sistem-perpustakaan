<?php

namespace App\Http\Controllers\Scrapping;

use App\Exports\ContactExport;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeController extends Controller
{

    public function scrape()
    {


        try {
            Log::info('Starting scraping process');

            $client = new Client();
            // $response = $client->request('GET', 'https://simpu.kemenag.go.id/home/travel');
            $response = $client->request('GET', 'https://dppamphuri.com/memlist');
            // $response = $client->request('GET', 'https://simpu.kemenag.go.id/home/travel/index/14');
            Log::info('HTTP request successful');

            $html = (string)$response->getBody();
            $crawler = new Crawler($html);
            Log::info('HTML content loaded into Crawler');

            $crawler->filter('table tbody tr')->each(function ($node) {
                try {
                    $namaElement = $node->filter('td')->eq(1)->filter('a');
                    $teleponElement = $node->filter('td')->eq(5);

                    $nama = $namaElement->count() > 0 ? $namaElement->text() : 'N/A';
                    $telepon = $teleponElement->count() > 0 ? $teleponElement->text() : 'N/A';


                    // if (strpos($telepon, '08') !== false || strpos($telepon, '82') !== false)

                    if (strpos($telepon, '08') === 0) {

                        Contact::create([
                            'nama' => $nama,
                            'nomor' => $telepon,
                        ]);

                        Log::info("Data saved: $nama, $telepon");

                    } else {

                        Log::info("Data saved: $nama, $telepon");

                    }

                } catch (\Exception $e) {

                    Log::error('Error processing a row: ' . $e->getMessage());

                }
            });

            return response()->json(['message' => 'Data berhasil di-scrape dan disimpan']);

        } catch (\Exception $e) {

            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['message' => 'Data gagal disimpan'], 500);
        }

    }

    public function index()
    {

        $data = Contact::paginate(10);
        $title = 'Scrape Data Travel';
        $slug = 'Ini untuk slug';

        return view('scrapping.scrape', compact('data', 'title', 'slug'));

    }

    public function delete()
    {

        Contact::truncate();
        return redirect()->route('scraping');

    }


    public function export()
    {

        return Excel::download(new ContactExport, 'Data Travel.xlsx');

    }


}
