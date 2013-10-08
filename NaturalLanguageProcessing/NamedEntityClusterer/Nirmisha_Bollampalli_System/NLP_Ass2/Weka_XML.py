import nltk,re,os,sys
from urllib import urlopen

Discard_Set = {}
Final_Discard_Set = {}

def pre_process():
	base = "C:/Nirmisha_Bollampalli/Nirmisha_Bollampalli_System/NLP_Ass2/"
	root = "C:/Nirmisha_Bollampalli/Nirmisha_Bollampalli_System/NLP_Ass2/OutputFiles/"
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
	print Discard_Set
	
	args = sys.argv[1:]
	root = "C:/Nirmisha_Bollampalli/Nirmisha_Bollampalli_System/NLP_Ass2/OutputFiles/"
	os.chdir(root)

	persons = [d for d in os.listdir('.') if os.path.isdir(d)]
	#persons = ["Abby_Watkins"]
	for person in persons:
		output_set = {}
		fname = person.split('_')[0]
		lname = person.split('_')[1]
		output_set={}
		root_level1 = root+person+"/"
		os.chdir(root_level1)  
		
		count = 0
		num_lines = sum(1 for line in open('Output.arff'))
		input_file = open("Output.arff",'rU')	
		#print num_lines
		
		while(True):
			flag = 0
			line = input_file.readline().strip() #takes away all spaces in a line.
			
			pattern = "@"
			if pattern in line :
				flag = 1
			if (line == ''):
				flag = 1
				
			if(flag == 0):
				line = line.split(',')
				length = len(line)
				Cluster = line[length - 1]
				doc_no = line[0]
				
				key_k = person
				val_v = doc_no
				if key_k not in Discard_Set :
					Discard_Set[key_k] = [-1]
				for key, val in Discard_Set.items():
					if key == key_k :
						if val_v not in val :	
							if(Cluster) not in output_set :
								output_set[Cluster] = [doc_no]
							else :
								output_set[Cluster].append(doc_no)
						else :
							if(Cluster) not in Final_Discard_Set :
								Final_Discard_Set[Cluster] = [doc_no]
							else :
								Final_Discard_Set[Cluster].append(doc_no)
			
			count = count + 1
			if(count == num_lines) :
				break
		print Final_Discard_Set

			
		xml_txt = '<?xml version="1.0" encoding="UTF-8"?>\n'
		xml_txt += '<clustering name ="'+fname+" "+lname+'">\n'  
		for key in sorted(output_set.keys()):
			xml_txt += '<entity id = "'+str(key)+'">\n'
			while (output_set[key]):
				xml_txt += '<doc rank = "'+ str(output_set[key].pop())+'"/>\n'
			xml_txt += '</entity>\n'
		xml_txt += '</clustering>\n'
			
			
		xml_file = open('C:/Nirmisha_Bollampalli/Nirmisha_Bollampalli_System/NLP_Ass2/test_files/'+person+ '.clust.xml','w')
		xml_file.write(xml_txt)
		xml_file.close()
		
if __name__ =='__main__':
  pre_process()	
  xml_creation()