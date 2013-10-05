import java.util.HashMap;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.File;
import java.io.IOException;

import javax.xml.parsers.*;
import org.w3c.dom.*;

import rita.wordnet.*;

class createMap
{
static HashMap<String, int []> wordMap = new HashMap<String, int[]>();

	public static void create(String file,String emotion)
	{
	BufferedReader br = null;
		try
		{
			String line;
			br = new BufferedReader(new FileReader(file)); 	
			while ((line = br.readLine()) != null) 
			{
				//System.out.println(sCurrentLine);
				String[] splits = line.split(" ");
				for(int i=1;i<splits.length;i++)
				{
				//System.out.print("\n"+splits[i]);
				splits[i]=splits[i].toLowerCase();
					if(!wordMap.containsKey(splits[i]))
					{	
						//System.out.print(" new");
						int arr[] = {0,0,0,0,0,0,1};

						if(emotion.equals("anger"))
							arr[0]=100;
						if(emotion.equals("disgust"))
							arr[1]=100;
						if(emotion.equals("fear"))
							arr[2]=100;							
						if(emotion.equals("joy"))
							arr[3]=100;
						if(emotion.equals("sadness"))
							arr[4]=100;
						if(emotion.equals("sadness"))
							arr[5]=100;
								
						wordMap.put(splits[i],arr);
					}
					else
					{
						//System.out.print(" contains");
						int[] arr=wordMap.get(splits[i]);
						
						if(emotion.equals("anger"))
							arr[0]=100;
						if(emotion.equals("disgust"))
							arr[1]=100;
						if(emotion.equals("fear"))
							arr[2]=100;
						if(emotion.equals("joy"))
							arr[3]=100;
						if(emotion.equals("sadness"))
							arr[4]=100;
						if(emotion.equals("sadness"))
							arr[5]=100;
								
						arr[6]=1;
							
						wordMap.put(splits[i],arr);
					}
						
				}	
			}
			//System.out.println("wordMap size = "+wordMap.size());
			br.close();
		}
		catch (IOException e) 
		{
			e.printStackTrace();
		} 
		finally 
		{
			try 
			{
				if (br != null)
					br.close();
			} 
			catch (IOException ex) 
			{
				ex.printStackTrace();
			}
		} 
	}
	
	public static void populateWithEmotions()
	{
		//System.out.println("Anger file");
		//create("C:\\Users\\Vaishnavi\\Desktop\\a.txt","anger");
		create("Resources\\anger.txt","anger");
		//printSize();
		//System.out.println("Disgust file");
		//create("C:\\Users\\Vaishnavi\\Desktop\\b.txt","disgust");
		create("Resources\\disgust.txt","disgust");
		//printSize();
		//System.out.println("Fear file");
		//create("C:\\Users\\Vaishnavi\\Desktop\\c.txt","fear");
		create("Resources\\fear.txt","fear");
		//printSize();
		//System.out.println("Joy file");
		create("Resources\\joy.txt","joy");
		//printSize();
		//System.out.println("Sadness file");
		create("Resources\\sadness.txt","sadness");
		//printSize();
		//System.out.println("Surprise file");
		create("Resources\\surprise.txt","surprise");
		//printSize();
	}
	
	public static void printMap()
	{
		for(String s: wordMap.keySet())
		{
			System.out.print(s+" ");
			int[] arr=wordMap.get(s);
			for(int i=0;i<arr.length;i++)
				System.out.print(arr[i]+" ");
			System.out.println();	
		}		
	}
	
	public static void printSize()
	{
		System.out.println("Size of wordMap is "+wordMap.size());
	}
	
	public static void populateWithTrial()
	{
		try
		{
		File file = new File("Resources\\affectivetext_trial.xml");
		DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
		DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
		Document doc = dBuilder.parse(file);
		doc.getDocumentElement().normalize();
		BufferedReader br= new BufferedReader(new FileReader("Resources\\affectivetext_trial.emotions.gold"));
		
		NodeList nList = doc.getElementsByTagName("instance");    
		
			for (int temp = 0; temp < nList.getLength(); temp++) 
			{
				String line = doc.getElementsByTagName("instance").item(temp).getTextContent();
				line=line.replaceAll("[?!,;:'\"$-]","");
				String [] words = line.split("\\s+");
				String l=br.readLine();
				for(int j=0;j<words.length;j++)
				{
					if(!words[j].matches("-?\\d+(\\.\\d+)?"))
					{
					words[j]=words[j].toLowerCase();
					//System.out.print(words[j]+" ");
						
						if(l != null)
						{
							String [] score=l.split("\\s+");
							if(!wordMap.containsKey(words[j]))
							{
								int arr[] = new int[7];
								for(int k=0;k<6;k++)
									arr[k]=Math.round(Integer.parseInt(score[k+1]));
									//arr[k]=Math.round(Integer.parseInt(score[k+1])/words.length);
								arr[6]=1;	
								wordMap.put(words[j],arr);							
							}
							else
							{
								int arr[]=wordMap.get(words[j]);
								for(int k=0;k<6;k++)
									arr[k]+=Math.round(Integer.parseInt(score[k+1]));	
									//arr[k]+=Math.round(Integer.parseInt(score[k+1])/words.length);	
								arr[6]+=1;	
								wordMap.put(words[j],arr);							
							}
						}					
					}
				}	
				//System.out.println();		
			}		  
		}
		
		catch(Exception e)
		{            
				System.err.println("Error reading from file!"); 
		}
	}
	
	public static void normalizeAfterTrial()
	{
		for(String key: wordMap.keySet())
		{
			int [] arr = wordMap.get(key);
			for(int i=0;i<6;i++)
				arr[i]=arr[i]/arr[6];
			arr[6]=1;	
		}
	}
	
	public static void addWord(String s, int[] emotions)
	{
		s=s.toLowerCase();
		if(!wordMap.containsKey(s))
		{	
			//System.out.print(" new");
			int [] arr = {0,0,0,0,0,0,1};
			for(int i=0;i<emotions.length;i++)
				arr[emotions[i]]=100;
			wordMap.put(s,arr);
		}
		else
		{
			//System.out.print(" contains");
			int arr[] = wordMap.get(s);
			for(int i=0;i<emotions.length;i++)
				arr[emotions[i]]=100;
			wordMap.put(s,arr);
		}					
	}
	
	public static void addHyponyms(String word,int [] emotions)
	{
	RiWordnet wordnet = new RiWordnet();	
	
		if(wordnet.exists(word))
		{
		String pos=wordnet.getBestPos(word);
		String[] related = wordnet.getAllHyponyms(word, pos);
			for(String s: related)
			{
			//System.out.println(s);
			addWord(s,emotions);
			}	
		}
	}
	
	public static void populateWithHyponyms()
	{
		int arr[]=new int[]{0};
		addHyponyms("anger",arr);
		arr=new int[]{1};
		addHyponyms("disgust",arr);
		arr=new int[]{2};
		addHyponyms("fear",arr);
		
		arr=new int[]{3};
		addHyponyms("joy",arr);
		addWord("prosperity",arr);
		addHyponyms("prosperity",arr);
		
		arr=new int[]{4};
		addHyponyms("sadness",arr);
		addWord("misfortune",arr);
		addHyponyms("misfortune",arr);
		
		arr=new int[]{5};
		addHyponyms("surprise",arr);
		
		arr=new int[]{2,4};
		addWord("unhealthiness",arr);
		addWord("catastrophe",arr);
		addHyponyms("unhealthiness",arr);
		addHyponyms("catastrophe",arr);
		
		arr=new int[]{0,4};
		addWord("hostility",arr);
		addWord("weaponry",arr);
		addWord("weapon",arr);
		addHyponyms("hostility",arr);
		addHyponyms("weaponry",arr);
		addHyponyms("weapon",arr);
		
		arr=new int[]{0,1,4};
		addWord("aggression",arr);
		addWord("wrongdoing",arr);
		addHyponyms("aggression",arr);
		addHyponyms("wrongdoing",arr);
	
	}
	
	public static void driver()
	{
	System.out.println("Populating with trial data...");
	populateWithTrial();
	normalizeAfterTrial();
	//printSize();
	System.out.println("Populating with emotions...");
	populateWithEmotions();
	System.out.println("Populating with hyponyms of emotions...");
	populateWithHyponyms();
	//printSize();
	//printMap();
	}
}