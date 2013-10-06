
import sys,re
from sets import Set
from nltk.corpus import wordnet as wn

def Repository():
  filenames = ['eng.train.txt','eng.development.txt']
  prevword = ''
  global per_TD
  global pla_TD 
  global org_TD 
  global misc_TD 
  per_TD = Set()
  pla_TD = Set()
  org_TD = Set()
  misc_TD = Set()
  other_TD = Set()
  
  for arg in filenames :
    filename = arg
    SourceFile = open(filename,'rU')
    for line in SourceFile:
      TD = line.strip().split(' ')
      if len(TD) >2:
        
        if TD[2] == 'B-LOC' or TD[2] == 'I-LOC' :
			pla_TD.add(TD[0].lower())
        if TD[2] == 'B-ORG' or TD[2] == 'I-ORG' :
			org_TD.add(TD[0].lower())
        if TD[2] == 'B-PER' or TD[2] == 'I-PER' :
			per_TD.add(TD[0].lower())
        if TD[2] == 'B-MISC' or TD[2] == 'I-MISC' :
			misc_TD.add(TD[0].lower())
		
    
    SourceFile.close()

  person_file = open('Yago2/Person_Yago.txt','rU')
  person_text = person_file.read()
  global person_YAGO
  person_YAGO =  Set(re.findall(r'[A-Z][a-z]+',person_text))
  person_file.close()
    
  location_file = open('Yago2/Places_Yago.txt','rU')
  location_text = location_file.read()
  global location_YAGO
  location_YAGO = Set(re.findall(r'[A-Z][a-z]+',location_text))
  location_file.close()
  
  Organisation_file = open('Yago2/Org_Yago.txt','rU')
  Organisation_text = Organisation_file.read()
  global Organisation_YAGO
  Organisation_YAGO = Set(re.findall(r'[A-Z][a-z]+',Organisation_text))
  Organisation_file.close()
  
  
def FeatureMatrix(Input_File):
  
  
  global wordnetclass
  Matrix = []
  
  word_feature = []
  Rows = []
  
  #Location_Triggers = ['land','chester','port','town','shire','bridge','wood']
  Organisation_Triggers=['organization','association','agency','university','institute','international','express','bank','centre','foundation','ltd.','inc.','group','party','system']
  #Per_Triggers=['mrs.','mr.','ms.','prof.','gen.','rep.','sen.','st.','dr.','sr.','jr.','ph.d.','m.d.','b.a.','m.a.','d.d.s.']
		  
  for line in Input_File:
    
    word_feature = (line.strip()).split(' ')
    word = word_feature[0]
    
    Rows = []
    #print word_feature
    if len(word_feature) > 1:
      
      if (re.search(r'^\w+',word)):
        isword = True;
      else:
        isword = False; 
      
      if re.search(r'\w+',word_feature[1]):
        Rows.append(word_feature[1])
        
      else:
        Rows.append('?')
       
  
      if isword :
        if word.title() in person_YAGO:
          person = 'yes'
        else: 
          person = 'no'
          
        if word.title() in location_YAGO:
          location = 'yes'
        else: 
          location = 'no'
		
      else:
        (person , location) = ('?' , '?')
      
      Rows.append(person)
      
      Rows.append(location) 
      
      
      
      if isword:
        if(word.upper()==word):
          allcaps = 'yes'
        else:
          allcaps = 'no'
      else :
        allcaps = '?'
      Rows.append(allcaps) # is all caps  
      
           
      if isword:
        if(word.istitle()):
          title = 'yes'
        else:
          title = 'no'
      else: 
        title = '?'
      Rows.append(title)
 
      if re.search(r'[A-Z]+\.',word):
        lonelyInitial = 'yes'
      else:
        lonelyInitial = 'no'
      Rows.append(lonelyInitial) 

      word1 = ''
      word2 = ''
      
      
      if Matrix and Matrix[-1]:  
        word1 = Matrix[-1][0]       
        if len(Matrix)> 1 and Matrix[-2]:        
          word2 = Matrix[-2][0]
        else :          
          word2= '?'
      else:        
        word1, word2 = '?' , '?'      
      Rows.append(word1)       
      Rows.append(word2)     
      
      
      if isword:
        if word.lower() in pla_TD:
          locwordlist = 'yes'
        else:
          locwordlist = 'no'
          
        if word.lower() in per_TD:
          perwordlist = 'yes'
        else:
          perwordlist = 'no'
          
        if word.lower() in org_TD:
          orgwordlist = 'yes'
        else:
          orgwordlist = 'no'
        
        if word.lower() in misc_TD:
          miscwordlist = 'yes'
        else:
          miscwordlist = 'no'
      else:
        perwordlist,locwordlist, orgwordlist, miscwordlist = '?','?','?','?' 
        
      Rows.append(perwordlist)
      Rows.append(locwordlist)
      Rows.append(orgwordlist)
      Rows.append(miscwordlist)
      
      if isword and word_feature[1]== 'NNP':
        if word.lower() in Organisation_Triggers:
          orgtrigger = 'yes'
        else:
          orgtrigger = 'no'
      else:
        orgtrigger = '?'
		
	 
      Rows.append(orgtrigger)
      
      wnclass = wn.synsets(word)
      if wnclass:
        wnc = wnclass[0].lexname
        Rows.append(wnc)
        #wordnetclass.add(wnc)
      else:
        Rows.append('?')
        
      if len(word_feature) > 2:
        Rows.append(word_feature[2])
      else:
        Rows.append('?')
        
      
    
    Matrix.append(Rows)

  return Matrix
 
 
 
  
def generate_arff_file(Matrix):
  
  pos_tags = "{ PRP$,VBG,VBD,VBN,VBP,WDT,JJ,WP,VBZ,DT,RP,NN,FW,POS,TO,-X-,PRP,RB,NNS,NNP,VB,WRB,CC,LS,PDT,RBS,RBR,CD,EX,IN,WP$,NN|SYM,MD,NNPS,JJS,JJR,SYM,UH }"
  arff_content = '@relation namedenitityrecognizer\n\n'
  
  arff_content += '@attribute pos_tag  '+ pos_tags+'\n'
  
  arff_content += '@attribute allcaps {yes , no}\n'
  
  arff_content += '@attribute title {yes , no}\n'
  
  arff_content += '@attribute mixedcaps {yes , no}\n'
   
  arff_content += '@attribute person {yes , no}\n'
  
  arff_content += '@attribute location {yes , no}\n'
  
  arff_content += '@attribute prevword1pos_tag '+ pos_tags+'\n'
  
  arff_content += '@attribute prevword2pos_tag  '+ pos_tags+'\n'
   
  arff_content += '@attribute personwordlist {yes , no}\n'
  
  arff_content += '@attribute locationwordlist {yes , no}\n'
  
  arff_content += '@attribute organizationwordlist {yes , no}\n'
  
  arff_content += '@attribute miscwordlist {yes , no}\n'

  arff_content += '@attribute orgtrigger {yes , no}\n'
  
  arff_content +='@attribute wordnet_class{ noun.process,noun.substance,verb.weather,noun.shape,verb.motion,noun.feeling,noun.state,verb.stative,verb.body,verb.emotion,noun.Tops,verb.perception,noun.animal,noun.event,noun.attribute,noun.food,noun.location,noun.time,verb.social,noun.body,noun.cognition,noun.group,noun.act,adv.all,noun.quantity,noun.artifact,verb.consumption,verb.possession,verb.change,adj.all,noun.plant,verb.cognition,noun.person,adj.pert,verb.competition,verb.communication,noun.communication,noun.motive,adj.ppl,noun.possession,noun.object,verb.contact,noun.relation,verb.creation,noun.phenomenon}\n'
  
  arff_content += '@attribute class { B-PER, I-PER, B-ORG, I-ORG, B-LOC, I-LOC, B-MISC, I-MISC, O }\n\n'
  
  arff_content += '@data\n'
  
  for row in Matrix:
    for col in row:
      arff_content +=col + ','
    arff_content +='\n'
  
  
  arff_file = open(filename + '.arff','w')
  arff_file.write(arff_content)
  arff_file.close()




def main():
  
  args = sys.argv[1:]
  
  global filename
  for arg in args :
    
    filename = arg
    SourceFile = open(filename,'rU')
        
    Repository()
    Matrix = FeatureMatrix(SourceFile)
    SourceFile.close()
    
    generate_arff_file(Matrix)

if __name__ =='__main__':
  main()
