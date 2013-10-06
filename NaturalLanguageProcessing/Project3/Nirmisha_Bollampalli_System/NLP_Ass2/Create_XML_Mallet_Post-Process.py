import nltk,re,os,sys
from urllib import urlopen

Discard_Set = {}
Final_Discard_Set = {}

def pre_process():
	base = "C:/NLP_Ass2/"
	root = "C:/NLP_Ass2/OutputFiles/"
	os.chdir(root)
	#print "Root" + os.getcwd()
	persons = [d for d in os.listdir('.') if os.path.isdir(d)]

	for person in persons:
		fname = person.split('_')[0]
		lname = person.split('_')[1]
		root_level1 = root+person+"/"
		os.chdir(root_level1)
		#print "Root Level 1" + os.getcwd()

		all_subdirs = [d for d in os.listdir('.') if os.path.isdir(d)]
		
		for dir in all_subdirs:
			root_level2 = root_level1+dir
			os.chdir(root_level2)
			
			#print "Root Level 2" + os.getcwd()
			html = urlopen(dir+'.txt').read()
			if fname not in html and lname not in html :
				if(int(dir) >= 1) :
					dir = dir.lstrip('0')
				else :
					dir = '0'
				if(person) not in Discard_Set:
					Discard_Set[person] = [dir]
				else :
					Discard_Set[person].append(dir)
				
			os.chdir(root_level1)	
	os.chdir(root)
	root_level1 = ""
	
	
def xml_creation() :
	#print Discard_Set
	args = sys.argv[1:]
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
				
				key_k = person
				val_v = doc_no
				if key_k not in Discard_Set :
					Discard_Set[key_k] = [-1]
				for key, val in Discard_Set.items():
					if key == key_k :
						if val_v not in val :
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
						else :
							
							if(line[2]) not in Final_Discard_Set :
								Final_Discard_Set[line[2]] = [doc_no]
							else :
								Final_Discard_Set[line[2]].append(doc_no)

		print output_set
		print Discard_Set
		print Final_Discard_Set
		
		xml_txt = '<?xml version="1.0" encoding="UTF-8"?>\n'
		xml_txt += '<clustering name ="'+fname+" "+lname+'">\n'  
		for key in sorted(output_set.keys()):
			xml_txt += '<entity id = "'+str(key)+'">\n'
			while (output_set[key]):
				xml_txt += '<doc rank = "'+ str(output_set[key].pop())+'"/>\n'
			xml_txt += '</entity>\n'
		
		xml_txt += '<discarded>\n'	
		for key in Final_Discard_Set.keys():
			while (Final_Discard_Set[key]):
				xml_txt += '<doc rank = "'+ str(Final_Discard_Set[key].pop())+'"/>\n'
		xml_txt += '</discarded>\n'
			
		xml_txt += '</clustering>\n'
		
		
		xml_file = open('C:/NLP_Ass2/test_files/'+person+ '.clust.xml','w')
		xml_file.write(xml_txt)
		xml_file.close()		


if __name__ =='__main__':
  pre_process()
  xml_creation()