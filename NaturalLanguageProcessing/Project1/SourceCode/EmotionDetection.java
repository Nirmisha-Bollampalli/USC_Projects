import java.io.*;
import java.util.*;

import javax.xml.parsers.*;

import org.w3c.dom.*;
import org.w3c.dom.Document;
import org.xml.sax.SAXException;

import rita.wordnet.RiWordnet;

import edu.stanford.nlp.ling.*;
import edu.stanford.nlp.pipeline.*;
import edu.stanford.nlp.trees.*;
import edu.stanford.nlp.util.*;

public class EmotionDetection {

	public static void print(ArrayList list){

		for(int i = 0; i < list.size(); i++) 
			System.out.println(list.get(i) + "\n"); 

	}
	public static int emoscore(String[] words,ArrayList emotions,int emonum){
		int x=0;
		if(emonum == 1) x = 100;
		else if(emonum == 2) x = 50;
		else if(emonum == 3) x = 33;
		else if(emonum == 4) x = 25;
		else if(emonum == 5) x = 20;
		else if(emonum == 6) x = 16;
		for(int i=0 ; i < words.length ; i++){
			if(i == 0 && emotions.contains("Anger")){
				int maxval = emotions(x,words[i]);
				words[i] =  maxval+"";
			}
			else if(i == 1 && emotions.contains("Disgust")){
				int maxval = emotions(x,words[i]);	 
				words[i] =  maxval+"";
			}
			else if(i == 2 && emotions.contains("Fear")){
				int maxval = emotions(x,words[i]);
				words[i] =  maxval+"";
			}
			else if(i == 3 && emotions.contains("Joy")){
				int maxval = emotions(x,words[i]);
				words[i] =  maxval+"";
			}
			else if(i == 4 && emotions.contains("Sadness")){
				int maxval = emotions(x,words[i]);
				words[i] =  maxval+"";
			}
			else if(i == 5 && emotions.contains("Surprise")){
				int maxval = emotions(x,words[i]);		 
				words[i] =  maxval+"";
			}
		}
		return x;
	}
	@SuppressWarnings("rawtypes")
	public static int emotions(int emoval,String words){
		int x = 0;
		x = Integer.parseInt(words);
		ArrayList rangeval = new ArrayList();
		ArrayList range100 = new ArrayList();

		for(int val = 0 ;val <= emoval ; val++)
			rangeval.add(x+val);

		for(int val = 0 ;val < rangeval.size() ; val++){
			if(val <= 100)
				range100.add(val);
		}
		Object o = Collections.max(range100);
		int maxval = (Integer)o;
		return maxval;
	}
	@SuppressWarnings("unchecked")
	public static String[] Sent_Root_Boost(Object WordScores,Object RootScore){


		String Word="",Root="";
		Word = WordScores.toString().replace(",", "") 
				.replace("[", "") 
				.replace("]", "");
		Root = RootScore.toString().replace(",", "") 
				.replace("[", "") 
				.replace("]", "");

		String[] words = Word.split("\\s+");
		String[] Roots = Root.split("\\s+");
		ArrayList emotions = new ArrayList();

		//System.out.println("Word Scores : " + Word ); 
		//System.out.println("Root Scores : " + Root );

		for(int i=0 ; i < Roots.length ; i++){
			if(Integer.parseInt(Roots[i]) > 0){
				if(i == 0)emotions.add("Anger");
				else if(i == 1)emotions.add("Disgust");
				else if(i == 2)emotions.add("Fear");
				else if(i == 3)emotions.add("Joy");
				else if(i == 4)emotions.add("Sadness");
				else if(i == 5)emotions.add("Surprise");
			}
		}

		if(emotions.size() > 0){

			if(emotions.size() == 1)
				emoscore(words,emotions,1);
			else if(emotions.size() == 2)
				emoscore(words,emotions,2);
			else if(emotions.size() == 3)
				emoscore(words,emotions,3);
			else if(emotions.size() == 4)
				emoscore(words,emotions,4);
			else if(emotions.size() == 5)
				emoscore(words,emotions,5);
			else if(emotions.size() == 6)
				emoscore(words,emotions,6);
		}
			return words;
		}
	public static ArrayList Read_XML(){

		ArrayList SentenceList =  new ArrayList();

		try{

			File input = new File("Resources\\affectivetext_test.xml");

			DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
			DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
			Document doc = dBuilder.parse(input);
			doc.getDocumentElement().normalize();

			NodeList nList = doc.getElementsByTagName("instance");

			for (int temp = 0; temp < nList.getLength(); temp++) 
				SentenceList.add(doc.getElementsByTagName("instance").item(temp).getTextContent());

		}catch(Exception e){	    	
			System.err.println("Error reading from file!"); }

		return SentenceList;

	}

	public static ArrayList POS_Tagger(ArrayList SentenceList){


		ArrayList SentWordList = new ArrayList();

		Properties props = new Properties();
		props.put("annotators", "tokenize, ssplit, pos,parse");
		StanfordCoreNLP pipeline = new StanfordCoreNLP(props);

		for(int j=0 ; j < SentenceList.size() ; j++){

			String sent = (String) SentenceList.get(j);
			sent.replaceAll(",","");

			String[] words = sent.split("\\s+");
			ArrayList list = new ArrayList();

			for(int i=0 ; i < words.length ; i++){

				words[i] = words[i].replaceAll("\\W", ""); 
				Annotation document = new Annotation(words[i]);
				pipeline.annotate(document);

				List<CoreMap> sentences = document.get(CoreAnnotations.SentencesAnnotation.class);

				for(CoreMap sentence: sentences) {	      
					Tree tree = sentence.get(TreeCoreAnnotations.TreeAnnotation.class);
					list.add(tree.taggedYield());
				}

			}
			SentWordList.add(list);
		}    
		return SentWordList;

	}

	public static void Stemmer(ArrayList list){

		RiWordnet wordnet = new RiWordnet();
		String word = "",FinalStem="";
		int index=0;

		for(int i1=0 ; i1 < list.size() ; i1++){
			for(int j1=0 ; j1 < ((ArrayList) list.get(i1)).size() ; j1++){	

				word = "";FinalStem="";
				word = ((ArrayList) list.get(i1)).get(j1).toString()
						.replace(",", "") 
						.replace("[", "") 
						.replace("]", "");

				index = word.lastIndexOf("/");
				word = word.substring(0,index);

				if(wordnet.exists(word)){
					String bestpos = wordnet.getBestPos(word);	
					String[] stems = wordnet.getStems(word, bestpos);

					if (stems != null) {
						Arrays.sort(stems);
						for (int i = 0; i < stems.length; i++) {
							FinalStem = stems[i];
						}
					} 

					if(FinalStem != ""){
						String pos = ((ArrayList) list.get(i1)).get(j1).toString()
								.replace(",", "") 
								.replace("[", "") 
								.replace("]", "");
						FinalStem = FinalStem.concat(pos.substring(index));

						((ArrayList) list.get(i1)).set(j1,FinalStem);

					}
					else{
						String pos = ((ArrayList) list.get(i1)).get(j1).toString()
								.replace(",", "") 
								.replace("[", "") 
								.replace("]", "");

						((ArrayList) list.get(i1)).set(j1,pos);


					}

				}
				else{
					String pos = ((ArrayList) list.get(i1)).get(j1).toString()
							.replace(",", "") 
							.replace("[", "") 
							.replace("]", "");

					((ArrayList) list.get(i1)).set(j1,pos);


				}
			}
		}

	}
	@SuppressWarnings("rawtypes")
	public static void main(String[] args) throws IOException {
		FileWriter fstream = new FileWriter("Resources\\FinalScores.txt");
		BufferedWriter out = new BufferedWriter(fstream);
		
		ArrayList SentenceList,WordList,ScoresList2,ScoresList1 =  new ArrayList();
		System.out.println("Reading Input file...");
		SentenceList = Read_XML();
		System.out.println("Read Complete.");
		System.out.println();

		System.out.println("Running the POS Tagger...");
		WordList = POS_Tagger(SentenceList);
		System.out.println("POS Tagging Complete.");
		System.out.println();

		System.out.println("Running the Stemmer...");   
		Stemmer(WordList);
		System.out.println("Stemming Complete.");
		System.out.println();
		//  print(WordList);


		System.out.println("Scoring Individual Words...");  
		for(int i=0 ; i < WordList.size() ; i++){  
			Scorer scorer = new Scorer();
			ScoresList1.add(scorer.WordScorer(WordList.get(i)));
		}

		System.out.println();

		System.out.println("Scoring Sentences...");  
		RootSense rs = new RootSense();
		ScoresList2 = rs.Root_Sense();

		String[] words={};
		for(int i=0 ; i < ScoresList1.size() ; i++){  
			words = Sent_Root_Boost(ScoresList1.get(i),ScoresList2.get(i));
			for(int i1=0 ; i1 < words.length ; i1++){  
				out.append(words[i1]+"  ");
			}
			out.append("\n");
		}
		out.close();
		System.out.println("Flushing Final Scores to Output File...");  
		System.out.println("Complete!");  

	}
}