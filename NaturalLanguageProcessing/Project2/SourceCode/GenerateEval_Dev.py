#! C:\Python27

from sets import Set
import re

file = "Output.txt"
ReadFiles =["eng.development.txt"]
DestFile = ["FinalOutputDev.txt"]
global tagset
global WordPlusTag
global GoldTag
GoldTag = []
tagset = []
WordTag = []

global engset
global evalset
engset = []
evalset =[]
ReadFile = open(file, 'r')
global i
i=0
for line in ReadFile:
	Input = line.strip().split()
	i=i+1
	if i>5:
		if len(Input) >= 4 :
			Output=re.sub(r'[0-9][:]', '',Input[2])
			tagset.append(Output)	
ReadFile.close()

WriteFile = open(DestFile[0],'a')
ReadFile = open(ReadFiles[0], 'r')
i=0
for line in ReadFile:
	Input = line.strip().split()
	
	if len(Input) > 0 :
		WriteFile.write(Input[0] + ' ' + Input[2] + ' '+tagset[i] +'\n')
		i =i +1
	else :
		#WordTag.append(" ")
		#print 'exception'
		WriteFile.write('\n')
#print WordTag	
ReadFile.close()
WriteFile.close()
