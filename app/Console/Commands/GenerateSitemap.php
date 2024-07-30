<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Page; // 假设你有一个Page模型代表网站页面

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the website';

    public function handle()
    {
        $urlSet = $this->createSitemap();
        $this->saveSitemap($urlSet);
        $this->info('Sitemap generated successfully.');
    }

    protected function createSitemap()
    {
        $urlSet = new \SimpleXMLElement('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

        foreach (Page::all() as $page) {
            $url = $urlSet->addChild('url');
            $url->addChild('loc', url($page->slug));
            $url->addChild('lastmod', Carbon::now()->toAtomString());
            // 你可以根据需要添加更多的元素，如 <changefreq> 和 <priority>
        }

        return $urlSet;
    }

    protected function saveSitemap($xml)
    {
        $xml->asXML(storage_path('app/public/sitemap.xml'));
    }

    protected $commands = [
        \App\Console\Commands\GenerateSitemap::class,
    ];
}
