import nltk,re,os
from urllib import urlopen

base = "C:/Nirmisha_Bollampalli/Nirmisha_Bollampalli_System/NLP_Ass2/"
root = "C:/Nirmisha_Bollampalli/Nirmisha_Bollampalli_System/NLP_Ass2/webps/web_pages/"
os.chdir(root)
#print "Root" + os.getcwd()
persons = [d for d in os.listdir('.') if os.path.isdir(d)]

for person in persons:
	root_level1 = root+person+"/raw/"
	os.chdir(root_level1)
	#print "Root Level 1" + os.getcwd()

	all_subdirs = [d for d in os.listdir('.') if os.path.isdir(d)]
	
	for dir in all_subdirs:
		root_level2 = root_level1+dir
		os.chdir(root_level2)
		#print "Root Level 2" + os.getcwd()
		
		html = urlopen('index.html').read()
		clean_html = nltk.clean_html(html)
		output = re.sub(r'\W+',' ',clean_html)
		output = re.sub(r'\d+',' ',output)
		output = re.sub(r'amp',' ',output)
		output = re.sub(r'quot',' ',output)
		output = re.sub(r'[\t\n\s]+',' ',output)
		os.chdir(base)
		path = "OutputFiles/"+person+"/"+dir
		if not os.path.exists(path):
			os.makedirs(path)
		os.chdir(path)
		outputfile = open(dir+'.txt','w')
		outputfile.write(output)
		outputfile.close()
		
		os.chdir(root_level1)
		
		
os.chdir(root)
root_level1 = ""
	
	

