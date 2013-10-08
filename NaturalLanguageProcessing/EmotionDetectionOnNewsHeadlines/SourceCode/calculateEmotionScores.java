import java.lang.Math;
import java.util.ArrayList;
import java.util.Collections;
import java.io.BufferedReader;
import java.io.File;
import java.io.BufferedWriter;
import java.io.FileReader;
import java.io.FileWriter;

import javax.xml.parsers.*;
import org.w3c.dom.*;

class calculateEmotionScores
{	

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

		public static void main(String args[])
		{
			createMap map= new createMap();
			map.driver();
			String a="",b="",c="";
			if(args.length <= 0){
				//affectivetext_trial.xml /home/nirmisha/Downloads/TempOutput.txt /home/nirmisha/Downloads/FinalScoresSupervised.txt
				a = "Resources\\affectivetext_test.xml";
				b = "Resources\\TempOutput.txt";
				c = "Resources\\FinalScoresSupervised.txt";
			}
		
			try
			{
				File file = new File(a);
				DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
				DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
				Document doc = dBuilder.parse(file);
				doc.getDocumentElement().normalize();
				NodeList nList = doc.getElementsByTagName("instance");    
				File output = new File(b);

				// if file doesnt exists, then create it
				if (!output.exists()) 
				{
					output.createNewFile();
				}
				FileWriter fw = new FileWriter(output.getAbsoluteFile());
				BufferedWriter bw = new BufferedWriter(fw);
				
				String cnt="";
				for (int temp = 0; temp < nList.getLength(); temp++) 
				{
					String sentence = doc.getElementsByTagName("instance").item(temp).getTextContent();
					Element e = (Element) doc.getElementsByTagName("instance").item(temp);
					cnt=e.getAttribute("id");
					sentence=sentence.replaceAll("[?!,;:'\"$-]","");
					String [] tokens=sentence.split("\\s+");
					int [] score = {0,0,0,0,0,0};
					int [] count = {1,1,1,1,1,1};

					for(int i=0;i<tokens.length;i++)
					{
						//System.out.println(tokens[i]);
						tokens[i]=tokens[i].toLowerCase();
						if(map.wordMap.containsKey(tokens[i]))
						{
							//System.out.println(tokens[i]+" is present in hashmap.");
							int array[] = map.wordMap.get(tokens[i]);
							for(int j=0;j<6;j++)
							{
								if(array[j]>0)
								{
									score[j]+=array[j];
									count[j]+=1;
								}	
							}

						}
					}
					String content="";
					//content=content+cnt+" ";
					for(int i=0;i<6;i++)
					{
						score[i]=Math.round(score[i]/count[i]);
						content=content+score[i]+" ";
					}	
					content=content+"\n";	
					bw.write(content);
				}
				bw.close();

/****************************************Root Word Boost ***************************************************************************/

				FileWriter fstream = new FileWriter(c);
				BufferedWriter out = new BufferedWriter(fstream);
				BufferedReader br = null;
				String line;

				ArrayList ScoresList1= new ArrayList();
				ArrayList ScoresList2 = new ArrayList();
				br = new BufferedReader(new FileReader(b)); 	

				while ((line = br.readLine()) != null) 
					ScoresList1.add(line);	

			
				System.out.println("Scoring Sentences...");  
				RootSense rs = new RootSense();
				ScoresList2 = rs.Root_Sense();

				//System.out.println("Length "+ScoresList1.size()+","+ScoresList2.size() );
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

			}//try
			catch(Exception e)	
			{
				e.printStackTrace();
			}
		}
	}