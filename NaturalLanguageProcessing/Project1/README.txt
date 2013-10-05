*********************************************************************************************************************
README
*********************************************************************************************************************
PROJECT TITLE: AFFECTIVE TEXT FOR NEWS HEADLINES
AUTHORS: Vaishnavi Dalvi, Nirmisha Bollampalli
	     Department of Computer Science,
		 University of Southern California,
		 Los Angeles, CA - 90089

This was submitted as the final project for the course CSCI-544 Applied Natural Language Processing at the University 
of Southern California. This course was taught by Dr. Zornitsa Kozareva during Spring 2013 semester.		 
**********************************************************************************************************************
Contents of the folder:

.java files for:
1. Knowledge based Unsupervised Approach
-createHashMap.java
-EmotionDetection.java
-RootSense.java
-Scorer.java
The output for Unsupervised approach is stored in FinalScores.txt

2. Supervised Approach
-createMap.java
-calculateEmotionScores.java
-RootSense.java (same file used in Unsupervised approach)
The output for Supervised approach is stored in FinalScoresSupervised.txt

3. Evaluating the scores by comparing to gold standard scores
-Evaluator.java

.txt files:
1. Six text files for emotion lists extracted from WordNet Affect
Note: These files were provided in the SemEval-2007 Task 14
The files are:
anger.txt
disgust.txt
fear.txt
joy.txt
sadness.txt
surprise.txt

2. Intermediate ouput files produced during execution
TempOutput.txt, output.txt

3. Final output files produced after execution
Unsupervised approach: FinalScores.txt
Supervised approach: FinalScoresSupervised.txt

4. xml files:
Trial data: affectivetext_trial.xml
Test data: affectivetext_test.xml
These files have been taken from SemEval-2007 task 14. 
Their gold standard files are:
Trial data: affectivetext_trial.emotions.gold
Test data: affectivetext_trial.emotions.gold

*******************************************************************************************************************
Compilation and execution instructions:
*******************************************************************************************************************
Note: 
i. Compilation of Evaluator.java requires Java 1.7. Some errors are thrown for Java 1.6 and lower.
ii. All .txt files for emotion list, xml files for trial and test data and the gold standard files have to be 
     in the same folder as the .java files for execution of each approach.
    
1. Include the following in the classpath
a. RiTa.WordNet jar files
RiTaWN.jar
supportWN.jar
The above two jar files can be obtained at http://www.rednoise.org/rita/wordnet/documentation/
b. Processing PApplet for RiTa.WordNet
RiTaWordNet requires a processing PApplet. It can be downloaded at http://www.processing.org/download/
Include the core.jar file
c. Stanford Core NLP
It can be obtained at http://nlp.stanford.edu/software/corenlp.shtml#Download
Include the following jar files:
stanford-corenlp-1.3.5.jar
stanford-corenlp-1.3.5-javadoc.jar
stanford-corenlp-1.3.5-models.jar
stanford-corenlp-1.3.5-sources.jar
xom.jar

2. Compile all java files
Ex. javac createHashMap.java

3. Execute each approach
a. Knowledge-based unsupervised approach
Execute: java EmotionDetection
Output: FinalScores.txt

b. Unsupervised approach
Execute: java calculateEmotionScores
Output: FinalScoresSupervised.txt

4. Evaluate the Scores
Execute: java Evaluator
This will produce the evaluation results for the supervised approach
To obatain the evaluation results for the unsupervised approach:
Change line 162 in Evaluator.java from
String b = "FinalScoresSupervised.txt";
to
String b = "FinalScores.txt";
Run the evaluator again

***************************************************************************************************************************
