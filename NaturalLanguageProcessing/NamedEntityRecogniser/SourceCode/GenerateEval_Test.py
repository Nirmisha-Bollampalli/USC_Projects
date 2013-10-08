#! C:\Python27

from sets import Set
import re

file = "Output.txt"
DestFile = ["InputEval.txt","eng.testing","FinalOutput.txt"]
global tagset
tagset = []

global engset
global evalset
engset = []
evalset =[]
ReadFile = open(file, 'r')

for line in ReadFile:
	Input = line.strip().split()
	if len(Input) == 4 :
		Output=re.sub(r'[0-9][:]', '',Input[2])
		tagset.append(Output)
		#print tagset
ReadFile.close()

WriteFile =open(DestFile[0],'a')
for tag in tagset:
	WriteFile.write(tag+"\n")
WriteFile.close()
	
ReadFile1 = open(DestFile[1], 'a+')
for line in ReadFile1:
	Input = line.strip().split()
	engset.append(Input)
#print engset
ReadFile1.close()

global i
i=0
ReadFile2 = open(DestFile[0],'a+')
#WriteFile2 = open(DestFile[0],'w')
for line in ReadFile2:
	Input = line.strip()
	evalset.append(Input)
#print evalset
ReadFile2.close()

global j
j=0
WriteFile2 = open(DestFile[2],'w')
while i<len(engset) :
	if len(engset[i]) == 0:
		a="\n"
		WriteFile2.write(a)
		
		i=i+1
	else:
		b = "\n"
		WriteFile2.write(evalset[j]+b)
		i=i+1
		j=j+1		
			
WriteFile2.close()	  




	



