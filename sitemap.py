import time
import datetime
import xml.etree.ElementTree as ET


def create_sitemap(urlset):
    # 创建Sitemap的根元素
    urlset = ET.Element("urlset", xmlns="http://laraveltest.com/schemas/sitemap/0.9")
    
    # 添加一些URL元素
    for url in ["http://laraveltest.com/parameter"]:
        url_element = ET.SubElement(urlset, "url")
        loc = ET.SubElement(url_element, "loc")
        loc.text = url
        
        # 这里可以添加其他元素，如<lastmod>, <changefreq>, <priority>等
        lastmod = ET.SubElement(url_element, "lastmod")
        lastmod.text = datetime.datetime.now().strftime('%Y-%m-%dT%H:%M:%S+00:00')

    return urlset

def save_sitemap(urlset, filename="sitemap.xml"):
    # 将XML树写入文件
    tree = ET.ElementTree(urlset)
    tree.write(filename, xml_declaration=True, encoding='UTF-8', method="xml")

def refresh_sitemap():
    # 刷新Sitemap
    urlset = create_sitemap()
    save_sitemap(urlset)

def main():
    while True:
        refresh_sitemap()
        print("Sitemap refreshed at:", datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S'))
        time.sleep(3600)  # 休眠一小时

if __name__ == "__main__":
    main()