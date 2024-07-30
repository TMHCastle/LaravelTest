<!-- <?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://laraveltest.com">
    <sitemap>
        <loc>https://laraveltest.com/sitemap/posts</loc>
        <lastmod>{{ $post->publishes_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://laraveltest.com/sitemap/categories</loc>
        <lastmod>{{ $post->publishes_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://laraveltest.com/sitemap/podcasts</loc>
        <lastmod>{{ $podcast->publishes_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex> -->