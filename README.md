# Web-Scraping
**Objective:** Build a dropshipping online store where you take orders on your own website, but your vendor or distributor is responsible for shipping the product to the end customer.

**Task:** If, hypothetically, you’ve partnered up with exactly two online wholesalers, such as Walmart, Home Depot, Target, Best Buy, etc., find twenty five different items that are offered for sale by both partners. After finding the products to sell, offer the products on your own website. The information related to the fifty products:

**Product Name, Product Description, Product Price, Remote Image URL, Local Image URL, and Review Score**<br>
should be extracted from the partners’ websites.

<p>The names and images of all fifty products should be displayed on your homepage. When a customer clicks on any of the products, you should display a comparison page that shows the selected product along with the corresponding product from the other partner, side-by-side, highlighting the cheaper product. The comparison page should show the product names, descriptions, marked up prices, images, and review scores. The markup should be set to a constant percentage between 5% and 25% and it should be applied dynamically when the page is generated.</p>

<p>When a customer buys a product, the transaction details should be simply stored in a database table, with no further action required.</p>

**Deliverables:**<p> 
Two URL text files. Each file should be named after one of the partners and it must contain the corresponding partner’s URLs for 25 products. The order of the products in each file is synchronized to construct an affinity between each pair of matching products. For example, the first line of the first file and the first line of the second file should be the URLs of a matching pair of products, one from each partner, and so on.

A shell script named products.sh that takes the two URL file names as command-line arguments. The script should automatically repeat the following steps every six hours:

Download the Web page for each and every product using curl or wget UNIX commands.
Call TagSoup to generate a .xhtml file that corresponds to the downloaded .html file. TagSoup is written in Java. As such, you have to have a Java JRE installed on your system in order to run it. The command to run TagSoup is:
java -jar tagsoup-1.2.1.jar --files filename.html
Use curl or wget to download the tagsoup-1.2.1.jar file if it isn’t present in the current directory.
Call a Python script named parser.py that uses the xml.dom.minidom module to traverse the .xhtml documents one file at a time, extract the relevant product information, and insert the extracted data into a MySQL database. The prices stored in the database should be the original prices, not the marked-up prices.
Both, products.sh and parser.py should not leave any .html, .xhtml, or temporary files on the disk when finished.
PHP scripts that make the website, and static .html files, along with local images, if any.

A copy of the html pages for all 50 products as downloaded from the partners’ websites without any adulteration.
</p>
