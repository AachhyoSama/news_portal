<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;use Exception;
use Log;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $fileName = 'sitemap.xml';
            $this->path = public_path('/sitemap/');

            //setting memory limit so command won't fail

            ini_set("memory_limit", "-1");
            set_time_limit(0);
            ini_set('max_execution_time', 0);
            ignore_user_abort(true);

            //if file exists change it's name and add new file
            if (file_exists($this->path . $fileName)) {
                chmod($this->path, 0777);
                chmod($this->path . $fileName, 0777);
                rename($this->path . $fileName, $this->path . 'sitemap-old-' . date('D-d-M-Y h-s') . '.xml');
            }

            //Generate sitemap
            SitemapGenerator::create('https://news.revonepal.com')
                ->hasCrawled(function (Url $url) {
                    //if url has these array values set priority more
                    $priorityUrl = [
                        'category',
                        'news',
                    ];


                    if (
                        $url->segment(1) == $priorityUrl[0] ||
                        $url->segment(1) == $priorityUrl[1]

                    ) {
                        $url->setPriority(1.0)
                            ->setLastModificationDate(Carbon::now());
                    } else {
                        $url->setPriority(0.8)
                            ->setLastModificationDate(Carbon::now());
                    }


                    return $url;
                })
                //generate sitemap.xml file
                ->writeToFile($this->path . $fileName);


            /*
            * Ping Script Sitemap
            * Submit your site maps automatically to Google, Bing.MSN and Ask
            */

            //Location To Sitemap File
            $sitemapUrl = 'https://news.revonepal.com/public/sitemap/' . $fileName;


            // cUrl handler to ping the Sitemap submission
            function myCurl($url)
            {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                return $httpCode;
            }

            //Sitemap For  Google
            $url = "http://www.google.com/webmasters/sitemaps/ping?sitemap=" . $sitemapUrl;
            $returnCode = myCurl($url);
            echo "<p>Google Sitemaps has been pinged (return code: $returnCode).</p>";

            //Sitemap For  Bing / MSN
            $url = "http://www.bing.com/ping?siteMap=" . $sitemapUrl;
            $returnCode = myCurl($url);
            echo "<p>Bing / MSN Sitemaps has been pinged (return code: $returnCode).</p>";

            //Sitemap For ASK
            $url = "http://submissions.ask.com/ping?sitemap=" . $sitemapUrl;
            $returnCode = myCurl($url);
            echo "<p>ASK.com Sitemaps has been pinged (return code: $returnCode).</p>";

            //Sitemap For Yahoo
            $url =  "http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=YahooDemo&url=". $sitemapUrl;
            $returnCode = myCurl($url);
            echo "<p>Yahoo.com Sitemaps has been pinged (return code: $returnCode).</p>";

        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
