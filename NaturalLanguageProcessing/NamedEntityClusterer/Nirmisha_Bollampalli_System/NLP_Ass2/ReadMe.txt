-----------------------------------------------------------------------------------------------------------------------------------------------
													MALLET
-----------------------------------------------------------------------------------------------------------------------------------------------
Step 1 : First Run HtmlScraper to clean all html files
Command  : python HtmlScraper

Step 2 :
To test mallet(general model) 
	Step 1 :
	Run the following commands to create a model.(Ive already created and kept it in \Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\Mallet folder)
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Abby_Watkins --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\abby.mallet --keep-sequence --remove-stopwords 
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Cathie_Ely --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\cathie.mallet --keep-sequence --remove-stopwords 
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Dan_Rhone --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\dan.mallet --keep-sequence --remove-stopwords 
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Jane_Hunter --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\jane.mallet --keep-sequence --remove-stopwords 
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Michael_Howard --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\mic.mallet --keep-sequence --remove-stopwords 
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Thomas_Baker --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\thomas.mallet --keep-sequence --remove-stopwords 
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Tim_Whisler --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\tim.mallet --keep-sequence --remove-stopwords 

	Step 2:
	Run the following to perform topic modelling(This generates the topic_compostion.txt for each name inside the corresponding folder.)
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\abby.mallet  --num-topics 15 --num-iterations 1000   --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Abby_Watkins\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\cathie.mallet --num-topics 1 --num-iterations 1000   --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Cathie_Ely\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\dan.mallet --num-topics 2 --num-iterations 500   --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Dan_Rhone\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\jane.mallet --num-topics 15 --num-iterations 1000   --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Jane_Hunter\topic_compostion.txt
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\mic.mallet --num-topics 32 --num-iterations 1000    --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Michael_Howard\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\thomas.mallet  --num-topics 60 --num-iterations 1000   --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Thomas_Baker\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\tim.mallet --num-topics 11 --num-iterations 1000    --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Tim_Whisler\topic_compostion.txt 
	
   (Output for these commands can be found in "\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Mallet\Mallet_OutputFiles")
        
	Step 3:
	Copy the OutputFiles directory inside Mallet_OutputFiles to \Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\
	Run Command to generate xml files: python Create_XML_Mallet_No_Post-Process mallet
	Output for this can be found in : "\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\test_files\mallet"
	
		 
To test mallet bigram model
	Step 1 :
	Run the following commands to create a model.(Ive already created and kept it in \Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\mallet_bi folder)
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Abby_Watkins --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\abby.mallet --keep-sequence --remove-stopwords  --keep-sequence-bigrams --gram-sizes "2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Cathie_Ely --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\cathie.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Dan_Rhone --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\dan.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Jane_Hunter --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\jane.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Michael_Howard --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\mic.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Thomas_Baker --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\thomas.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Tim_Whisler --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\tim.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "2"

	Step 2:
	Run the following to perform topic modelling(This generates the topic_compostion.txt for each name inside the corresponding folder.)
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\abby.mallet  --num-topics 15 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Abby_Watkins\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\cathie.mallet --num-topics 1 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Cathie_Ely\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\dan.mallet --num-topics 2 --num-iterations 500 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Dan_Rhone\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\jane.mallet --num-topics 15 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Jane_Hunter\topic_compostion.txt
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\mic.mallet --num-topics 32 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Michael_Howard\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\thomas.mallet  --num-topics 60 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Thomas_Baker\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\tim.mallet --num-topics 11 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Tim_Whisler\topic_compostion.txt 

   (Output for these commands can be found in "\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Mallet\Mallet_bi_OutputFiles")
        
	Step 3:
	Copy the OutputFiles directory inside Mallet_bi_OutputFiles to \Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\
	Run Command to generate xml files: python Create_XML_Mallet_No_Post-Process a
	Output for this can be found in : "\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\test_files\mallet_bi_grams"
	
To test mallet unigram_bigram model
	Step 1 :
	Run the following commands to create a model.(Ive already created and kept it in \Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\Mallet_uni_bi folder)
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Abby_Watkins --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\abby.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "1,2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Cathie_Ely --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\cathie.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "1,2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Dan_Rhone --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\dan.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "1,2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Jane_Hunter --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\jane.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "1,2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Michael_Howard --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\mic.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "1,2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Thomas_Baker --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\thomas.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "1,2"
	bin\mallet import-dir --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Tim_Whisler --output  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\tim.mallet --keep-sequence --remove-stopwords --keep-sequence-bigrams --gram-sizes "1,2"

	Step 2:
	Run the following to perform topic modelling(This generates the topic_compostion.txt for each name inside the corresponding folder.)
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\abby.mallet  --num-topics 15 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Abby_Watkins\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\cathie.mallet --num-topics 1 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Cathie_Ely\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\dan.mallet --num-topics 2 --num-iterations 500 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Dan_Rhone\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\jane.mallet --num-topics 15 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Jane_Hunter\topic_compostion.txt
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\mic.mallet --num-topics 32 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Michael_Howard\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\thomas.mallet  --num-topics 60 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Thomas_Baker\topic_compostion.txt 
	bin\mallet train-topics  --input  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\tim.mallet --num-topics 11 --num-iterations 1000 --use-ngrams true  --output-state  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic-state.gz  --output-topic-keys  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Models\topic_keys.txt --output-doc-topics  C:\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\OutputFiles\Tim_Whisler\topic_compostion.txt 

   (Output for these commands can be found in "\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\Mallet\Mallet_uni_bi_OutputFiles")
        
	Step 3:
	Copy the OutputFiles directory inside Mallet_uni_bi_OutputFiles to \Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\
	Run Command to generate xml files: python Create_XML_Mallet_No_Post-Process b
	Output for this can be found in : "\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\test_files\mallet_uni+bi_grams"
		 
	
To test mallet unigram_bigram model (post-processed)
	Repeat Step 1 and 2
	Step 3 :
    Run Command : python Create_XML_Mallet_Post-Process b
	Output for this can be found in : "\Nirmisha_Bollampalli\Nirmisha_Bollampalli_System\NLP_Ass2\test_files\mallet_pre_processed"
	
	
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                                     WEKA
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------													 
		 
Step 1 : First Run HtmlScraper to clean all html files
Command  : python HtmlScraper

Step 2: Create the arff files using TextDirectoryLoader 
	java -cp /"Program Files"/Weka-3-7/weka.jar weka.core.converters.TextDirectoryLoader -dir /NLP_Ass2/OutputFiles/Abby_Watkins >  C:\NLP_Ass2\Abby_Watkins.arff
	java -cp /"Program Files"/Weka-3-7/weka.jar weka.core.converters.TextDirectoryLoader -dir /NLP_Ass2/OutputFiles/Cathie_Ely >  C:\NLP_Ass2\Cathie_Ely.arff
	java -cp /"Program Files"/Weka-3-7/weka.jar weka.core.converters.TextDirectoryLoader -dir /NLP_Ass2/OutputFiles/Dan_Rhone >  C:\NLP_Ass2\Dan_Rhone.arff
	java -cp /"Program Files"/Weka-3-7/weka.jar weka.core.converters.TextDirectoryLoader -dir /NLP_Ass2/OutputFiles/Jane_Hunter >  C:\NLP_Ass2\Jane_Hunter.arff
	java -cp /"Program Files"/Weka-3-7/weka.jar weka.core.converters.TextDirectoryLoader -dir /NLP_Ass2/OutputFiles/Michael_Howard >  C:\NLP_Ass2\Michael_Howard.arff
	java -cp /"Program Files"/Weka-3-7/weka.jar weka.core.converters.TextDirectoryLoader -dir /NLP_Ass2/OutputFiles/Thomas_Baker >  C:\NLP_Ass2\Thomas_Baker.arff
	java -cp /"Program Files"/Weka-3-7/weka.jar weka.core.converters.TextDirectoryLoader -dir /NLP_Ass2/OutputFiles/Tim_Whisler >  C:\NLP_Ass2\Tim_Whisler.arff

Step 3 : Load the arff files one by one into weka 
		 Then apply StringToword algorithm to get unigrams or bigrams and set desired options.
		 Run clustering.
		 Right click on the generated model and select visualise cluster option and then click save button that appears in the windows and save the new arff.
		 Create XML from the new arff files using Command : python Weka_XML_No_PostProcess
		 
		 Kmeans Unigrams :
		 StringToword options :
		 IDFTrasform : True
		 TFTransform : True
		 donotOperateOnPerClassBasis : true
		 MinTermFreq : 3
		 PeriodicPruning : 2.0
		 Stemmer : Lovins Stemmer.
		 Tokeniser : Word Tokeniser.
		 UseStopList : True
		 WordsToKeep : 10000
		 
		 Kmeans Unigrams Filtered :
		 ->Apply StringToword using the following options
		 StringToword options :
		 IDFTrasform : True
		 TFTransform : True
		 donotOperateOnPerClassBasis : true
		 MinTermFreq : 3
		 PeriodicPruning : 2.0
		 Stemmer : Lovins Stemmer.
		 Tokeniser : Word Tokeniser.
		 UseStopList : True
		 WordsToKeep : 10000
		 ->Then apply Discretize and Normalise filters with default options.
		 
		 Kmeans Bigrams :
		 StringToword options :
		 IDFTrasform : True
		 TFTransform : True
		 donotOperateOnPerClassBasis : true
		 MinTermFreq : 3
		 PeriodicPruning : 2.0
		 Stemmer : Lovins Stemmer.
		 Tokeniser : Ngram Tokeniser(options : max 2 ,min 1).
		 UseStopList : True
		 WordsToKeep : 10000
		 
		 Kmeans Bigrams (postprocessed) : same as above but use python Weka_XML while creating xml files.
		 
		 EM :
		 StringToword options :
		 IDFTrasform : True
		 TFTransform : True
		 donotOperateOnPerClassBasis : true
		 MinTermFreq : 3
		 PeriodicPruning : 2.0
		 Stemmer : Lovins Stemmer.
		 Tokeniser : Word Tokeniser.
		 UseStopList : True
		 WordsToKeep : 10000
		 
		 
		 
		 