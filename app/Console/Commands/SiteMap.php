<?php

namespace App\Console\Commands;

use App\Models\YmxCategory;
use App\Models\YmxProductDetail;
use Illuminate\Console\Command;

class SiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // lastmod
        $date = date('Y-m-d');
        // 获取pid == 0的总分类条目，用于创建文件
        $cate_0 = YmxCategory::where('pid', 0)->get();
        // 循环所有pid == 0条目
        foreach ($cate_0 as $value0){
            $times = 1; // 生成次数
            // 生成文档
            if($times == 1){
                echo 'creating file for ' .$value0->url_id ."_sitemap.xml" ."\n";
            }else{
                echo 'creating file for ' .$value0->url_id ."_" .$times ."_sitemap.xml" ."\n";
            }
            $Dom = new \DOMDocument('1.0', 'utf-8');
            $paper = $Dom->createElement('urlset');
            $paper->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');
            $Dom->appendChild($paper);
            $lines = 2; // 行数

            
            // 循环所有pid == $value0->id的条目(2,3,303,304,305)
            $cate_1 = YmxCategory::where('pid', $value0->id)->get();
            foreach ($cate_1 as $value){
                // 分类url组成方式：域名/$cate_2->url_id/$cate_1->url_id

                // $cate_2（父类）：pid == $cate_1->id的分类条目
                $cate_2 = YmxCategory::where('pid', $value->id)->get();
                // 循环所有pid == $value->id的条目(id==4-20,190-204)
                foreach ($cate_2 as $value1){
                    // 创建url元素
                    $url = $Dom->createElement('url');
                    $loc = $Dom->createElement('loc',"http://www.petslifehome.com/en/{$value1->url_id}/{$value->url_id}/");
                    $lastmod = $Dom->createElement('lastmod',$date);
                    // 追加loc和lastmod元素到url元素
                    $url->appendChild($loc);
                    $url->appendChild($lastmod);
                    $paper->appendChild($url);
                    
                    // 产品url组成方式：域名/$cate_3->product_sku_id

                    // $cate_3（产品）：kid == $cate_1->id的产品，放到对应目录下
                    $cate_3 = YmxProductDetail::where('kid',$value1->id)->get();
                    // 循环kid == $$value1->id的$cate_3
                    foreach ($cate_3 as $value2){
                        // 创建url元素
                        $url = $Dom->createElement('url');
                        // 规则
                        $value2->product_sku_id = mb_substr($value2->product_sku_id, 0, 225, 'UTF-8');
                        $value2->product_sku_id = htmlspecialchars($value2->product_sku_id, ENT_XML1, 'UTF-8');
                        $loc = $Dom->createElement('loc',"https://www.petslifehome.com/en/detail/{$value2->product_sku_id}/");
                        $lastmod = $Dom->createElement('lastmod',$date);
                        $url->appendChild($loc);
                        $url->appendChild($lastmod);
                        $paper->appendChild($url);
                        $lines += 4;
                        while($lines >= 39995){
                            // 39995行后，保存并生成新xml文档，防止超过40000行
                            $c = $Dom->saveXML();
                            $times ++;
                            file_put_contents(public_path("{$value0->url_id}" ."_" .$times ."_sitemap.xml"),$c);
                            echo 'creating file for ' .$value0->url_id ."_" .$times ."_sitemap.xml" ."\n";
                            $Dom = new \DOMDocument('1.0', 'utf-8');
                            $paper = $Dom->createElement('urlset');
                            $paper->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');
                            $Dom->appendChild($paper);
                            $lines = 2; // 行数
                        }
                    };
                }
            }
            // 保存xml文档
            
            $c = $Dom->saveXML();
            // 保存xml文档到url_id_sitemap.xml中
            if($times == 1){
                file_put_contents(public_path("{$value0->url_id}" ."_sitemap.xml"),$c);
            }else{
                file_put_contents(public_path("{$value0->url_id}" ."_" .$times ."_sitemap.xml"),$c);
            }
        }
    echo 'finish';
    }
}
