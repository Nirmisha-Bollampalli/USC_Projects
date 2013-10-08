
import java.io.*;
import java.util.*;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;
import org.w3c.dom.NodeList;

import rita.wordnet.RiWordnet;

import edu.stanford.nlp.io.*;
import edu.stanford.nlp.ling.*;
import edu.stanford.nlp.pipeline.*;
import edu.stanford.nlp.trees.*;
import edu.stanford.nlp.util.*;

public class RootSense {

	public static String GetRootWord(String file){
		
			String Root="",POS="",word="",FinalStem="";
			RiWordnet wordnet = new RiWordnet();
			try{
		    	
			    File input = new File(file);
			   
			    DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
				DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
			    Document doc = dBuilder.parse(input);
			    doc.getDocumentElement().normalize();
			    
			    NodeList dList = doc.getElementsByTagName("dep");
			    
			    for (int temp = 0; temp < dList.getLength(); temp++) {
			    	
			    	if(doc.getElementsByTagName("governor").item(temp).getTextContent().equalsIgnoreCase("ROOT")){
			    		Root = doc.getElementsByTagName("dependent").item(temp).getTextContent();
			    		break;
			    	}
			    	
			    }
			    
			    NodeList nList = doc.getElementsByTagName("token");
			    
			    for (int temp = 0; temp < nList.getLength(); temp++) {
			    	if(doc.getElementsByTagName("word").item(temp).getTextContent().equalsIgnoreCase(Root)){
			    		POS = doc.getElementsByTagName("POS").item(temp).getTextContent();
			    		break;
			    	}
			    }
			    
			    //Find stem of root
			    word = Root;
			    if(wordnet.exists(word)){
				    String bestpos = wordnet.getBestPos(word);	
					String[] stems = wordnet.getStems(word, bestpos);
							
					if (stems != null) {
							Arrays.sort(stems);
							for (int i = 0; i < stems.length; i++) {
									FinalStem = stems[i];
							}
					} 
			    }
			    else{FinalStem = word;}
			  
		    }catch(Exception e){	    	
		    	System.err.println("Error reading from file!"); }

			return FinalStem;

		
	}
	
	public static ArrayList Root_Sense(){
		
		ArrayList SentenceList,ScoresList =  new ArrayList();
		String RootWord="";
		Properties props = new Properties();
		props.put("annotators", "tokenize, ssplit, pos,parse");
		
	  	PrintWriter out;
    	out = new PrintWriter(System.out);
    	
    	
    	StanfordCoreNLP pipeline = new StanfordCoreNLP(props);
    	Annotation annotation;
    	
    	
    	try {
    		   
    		    EmotionDetection em= new EmotionDetection();
    		    SentenceList = em.Read_XML();
    		    
    		    for(int j=0 ; j < SentenceList.size() ; j++){
    		    	
					PrintWriter xmlOut = null;
					annotation = new Annotation((String) SentenceList.get(j));
					xmlOut = new PrintWriter("Resources\\output.txt");
					pipeline.annotate(annotation);
					//pipeline.prettyPrint(annotation, out);
					
					if (xmlOut != null) 
						 pipeline.xmlPrint(annotation, xmlOut);
					
					RootWord = GetRootWord("output.txt");
					//System.out.println(RootWord);
					Scorer scorer = new Scorer();
					ScoresList.add(scorer.RootScorer(RootWord));
					
    		    }
    		    
    		    
			
		}catch (IOException e) {e.printStackTrace(); }
    	
    	return ScoresList;
    	    
  }

}