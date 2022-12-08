import sys
import os
import mysql.connector
import xml.dom.minidom


#microcenter 1st



doc = xml.dom.minidom.parse(sys.argv[1])
x=0
price = 0.0
img = ""
#description 2 is the actual description, description is the product name
description2=""
description = ""
rev = 0.0 
path =sys.argv[1] 
rel = pid = int(path[path.find("-")+1:path.find(".",2)])
if "microcenter" in sys.argv[1]:

	sections = doc.getElementsByTagName('section')
	for sec in sections:
		if "tab-specs" in sec.getAttribute('id'):
			tabDivs =  sec.getElementsByTagName('div')
			for tabDiv in tabDivs:
				if "spec-head col-md-4" in tabDiv.getAttribute('class'):
					description2 += (tabDiv.childNodes[0].childNodes[0].nodeValue+":\n")
				if "spec-body" in tabDiv.getAttribute('class'):
					for minidiv in tabDiv.childNodes:
						if(minidiv.childNodes and x == 0 and minidiv.childNodes[0] is not None):
							description2 += ( "\t" + str(minidiv.childNodes[0].nodeValue))
							x = 1
						elif(minidiv.childNodes and x == 1 and minidiv.childNodes[0] is not None ) :
							description2 += ( " - " + str(minidiv.childNodes[0].nodeValue)+ "\n")
							x = 0

	divs = doc.getElementsByTagName('div')
	for div in divs:
		if(img == ""):
			if("image-slide" in div.getAttribute('class')):
				if("productImageZoom" in div.getElementsByTagName('img')[0].getAttribute('class')):
					img = div.getElementsByTagName('img')[0].getAttribute("src")
		
	
		if( "product-header" in div.getAttribute('class')):
			node = div.getElementsByTagName('span')
			price = node[0].getAttribute("data-price")
			description = node[0].childNodes[0].nodeValue

	scripts = doc.getElementsByTagName('script')
	for script in scripts:
		if("application/ld+json" in script.getAttribute('type')):
			txt = script.childNodes[0].nodeValue
			if "review" in txt:
				if txt.find("ratingValue") >= 0:
					txt = txt[txt.find('"ratingValue"') + len('"ratingValue": "'):len(txt)]
					rev = float(txt[0:txt.find("\"")])
	
if "newegg" in sys.argv[1]:
	pid += 25
	divs = doc.getElementsByTagName('div')
	for div in divs:
		if( "product-rating" in div.getAttribute('class')):
			node = div.getElementsByTagName('i')
			if(len(node) >=1):
				if("rating rating" in node[0].getAttribute('class')):
					if(node[0].getAttribute("title")):
						rev = float(node[0].getAttribute("title")[0:node[0].getAttribute("title").find(" ")])
			
		if( "tab-pane" in div.getAttribute('class')):
			header = div.getElementsByTagName('h2')
			if header and 'swiper-box-top-title margin-bottom' in header[0].getAttribute('class') and 'Learn more about' in header[0].childNodes[0].nodeValue:
				description2 = ""
				tables = div.getElementsByTagName('table')
				for table in tables:
					try:
						cap = table.getElementsByTagName('caption')[0].childNodes
					except:
						continue
					if cap:
						description2 += cap[0].nodeValue +":\n"
					
					for tbody in table.getElementsByTagName('tbody'):
						for tr in tbody.getElementsByTagName('tr'):
							description2 +="\t"+ tr.childNodes[0].childNodes[0].nodeValue + " - " + tr.childNodes[1].childNodes[0].nodeValue + "\n"
	
	scripts = doc.getElementsByTagName('script')
	for script in scripts:
		if('application/ld+json' in script.getAttribute('type')):
			txt = script.childNodes[0].nodeValue
			if "price" in txt:
				if txt.find("price") > 0:
					txt = txt[txt.find('"price"') + len('"price":"'):len(txt)]
					price = float(txt[0:txt.find("\"")])
			if "description" in txt:
				if txt.find("description") >= 0:
					txt = txt[txt.find('"description"') + len('"description":"'):len(txt)]
					description = txt[0:txt.find("\"")]
			if "thumbnailUrl" in txt:
				img = txt[txt.find('"thumbnailUrl"')+len('"thumbnailUrl":"'):txt.find('"',txt.find('"thumbnailUrl"')+len('"thumbnailUrl":"'))]

# if there are no pictures, use this code to get them:
'''
dwn = sys.argv[1]
dwn = dwn[dwn.index("/",2,7)+1:dwn.find(".", 3)]
dwn = os.getcwd()+"/picture/"+dwn+".jpg"
os.system("wget -q -O "+dwn+" " + img)
'''

cnx = mysql.connector.connect(host="localhost",user="root",password="WWP6happygoldcranes",database="HW7")
cursor = cnx.cursor()

product = ("delete from products where product_id = %s")
productval = [pid]
cursor.execute(product, productval)
cnx.commit()


product = ("insert into products ( product_id , relation , `Product Name` , `Product Description` ,`Product Price` , `Remote Image URL` , `Review Score`, `Local Image URL` ) values ( %s, %s, %s, %s, %s, %s, %s, NULL )")
productval = (pid, rel, description, description2,price, img, rev)
cursor.execute(product, productval)
cnx.commit()
cursor.close()
cnx.close()
