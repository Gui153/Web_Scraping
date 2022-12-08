#!/bin/bash

download(){
	local num="1"
	while IFS= read -r web
	do
		
		if egrep -q 'microcenter' <<< $web 
		then
			name="microcenter"
		else 
			name="newegg"
		fi
		wget -q -O "./data/${name}-${num}.html" "${web}"
		num=`expr $num + 1`
	done < $1	
}

convert(){

	local num="1"
	while [ $num -le 25 ]
	do
	
		if [ -f ./tagsoup-1.2.1.jar ]
		then 
			echo ""
		else 
			wget -q -O "./tagsoup-1.2.1.jar" "https://repo1.maven.org/maven2/org/ccil/cowan/tagsoup/tagsoup/1.2.1/tagsoup-1.2.1.jar"
			chmod 777 "./tagsoup-1.2.1.jar"
		fi

		java -jar tagsoup-1.2.1.jar --files "./data/${1}-${num}.html"
		
		python3 ./parser.py "./data/${1}-${num}.xhtml"
		num=`expr $num + 1`
	done 
}

delete(){
	local num="1"
	while [ $num -le 25 ]
	do 
		rm "./data/${1}-${num}.$3"
		rm "./data/${2}-${num}.$3"
		num=`expr $num + 1`
	done
}
mkdir ./picture
while [ 1 -eq 1 ]
do
	mkdir ./data
	download "${1}"
	download "${2}"
	convert "newegg"
	convert "microcenter"
	delete "newegg" "microcenter" "html"
	delete "newegg" "microcenter" "xhtml"
	rmdir ./data
	sleep 6h
	
done


