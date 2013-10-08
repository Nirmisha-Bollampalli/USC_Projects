import sys,re,os

args = sys.argv[1:]
#print args[0]
root = "C:/NLP_Ass2/OutputFiles/"
os.chdir(root)

persons = [d for d in os.listdir('.') if os.path.isdir(d)]
for person in persons:
	fname = person.split('_')[0]
	lname = person.split('_')[1]
	output_set={}
	root_level1 = root+person+"/"
	os.chdir(root_level1)  
	input_file = open("topic_compostion.txt",'rU')
	
	while(True):
		
		line = input_file.readline().strip() #takes away all spaces in a line.
		if (line == "#doc source topic proportions") or (line == "#doc name topic proportion ..."):
			line = input_file.readline().strip()
		if  not line:
			break;
		if(args[0] == 'mallet') :
			line = line.split('\t')
		else :
			line = line.split(' ')
		#print line
		
		if len(line) > 3:
			doc_no = line[1]
			
			if(args[0] == 'mallet') :
				doc_no = doc_no.split('/')
			else :
				doc_no = doc_no.split('\\')
			#print doc_no[5]
			
			if(args[0] == 'mallet') :
				#print doc_no[5]
				if(doc_no[5] != 'topic_compostion.txt') :
					if(int(doc_no[5]) >= 1) :
						doc_no = doc_no[5].lstrip('0')
					else :
						doc_no = '0'
			else :			
				if(int(doc_no[4]) >= 1) :
					doc_no = doc_no[4].lstrip('0')
				else :
					doc_no = '0'
	
			if(float(line[3]) > 0.1) :
				if(line[2]) not in output_set :
					output_set[line[2]] = [doc_no]
				else :
					output_set[line[2]].append(doc_no)
			
			if len(line) > 5 and float(line[5]) > 0.5 :
				if(line[4]) not in output_set :
					output_set[line[4]] = [doc_no]
				else :
					output_set[line[4]].append(doc_no)
	#print output_set
	
	xml_txt = '<?xml version="1.0" encoding="UTF-8"?>\n'
	xml_txt += '<clustering name ="'+fname+" "+lname+'">\n'  
	for key in sorted(output_set.keys()):
		xml_txt += '<entity id = "'+str(key)+'">\n'
		while (output_set[key]):
			xml_txt += '<doc rank = "'+ str(output_set[key].pop())+'"/>\n'
		xml_txt += '</entity>\n'
	xml_txt += '</clustering>\n'
	
	
	xml_file = open('C:/NLP_Ass2/test_files/'+person+ '.clust.xml','w')
	xml_file.write(xml_txt)
	xml_file.close()		
			
		
		
	