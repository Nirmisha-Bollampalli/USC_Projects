import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.HashMap; 
import java.util.ArrayList; 
import rita.wordnet.*;
 
public class createHashMap 
{
	static final HashMap<String,ArrayList<String>> words = new HashMap<String,ArrayList<String>>();
	
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
					if(!words.containsKey(splits[i]))
					{	
						//System.out.print(" new");
						ArrayList<String> addList = new ArrayList<String>();
						addList.add(emotion);
						words.put(splits[i],addList);
					}
					else
					{
						//System.out.print(" contains");
						ArrayList<String> addList=words.get(splits[i]);
						if(!addList.contains(emotion))
							addList.add(emotion);
						words.put(splits[i],addList);
					}					
				}	
			}
			//System.out.println("words size = "+words.size());
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
	
	public static void addHyponyms(String word, ArrayList<String> emotions)
	{
		RiWordnet wordnet = new RiWordnet();
		String pos=wordnet.getBestPos(word);
		int count=0;
		int modify=0;
		
		if(wordnet.exists(word))
		{
		String[] related = wordnet.getAllHyponyms(word, pos);
		//System.out.println("\nHyponyms for "+word+"------------------------------>"+related.length);
			for(String s: related)
			{
			//System.out.println(s);
					if(!words.containsKey(s))
					{	
						//System.out.print(" new");
						ArrayList<String> addList = new ArrayList<String>();
						addList.addAll(emotions);
						words.put(s,addList);
						count++;
					}
					else
					{
						//System.out.print(" contains");
						ArrayList<String> addList=words.get(s);
						for(String e: emotions)
						{
							if(!addList.contains(e))
							{
								addList.add(e);
								modify++;
							}	
						}
						words.put(s,addList);
					}					
			}	
		}
		//System.out.println(count+" words were added");
		//System.out.println(modify+" values were modified");
		//System.out.println("words size = "+words.size());
	}
	
	public static void callAddHyponymsEmotions(String emotion)
	{
		ArrayList<String> al = new ArrayList<String>();
		al.add(emotion);
		addHyponyms(emotion,al);		
	}
	
	public static void driver() 
	{
		//System.out.println("words size = "+words.size());

		//Add words from .txt files for six emotion categories
		create("anger.txt","anger");
		create("disgust.txt","disgust");
		create("fear.txt","fear");
		create("joy.txt","joy");
		create("sadness.txt","sadness");
		create("surprise.txt","surprise");
		
		//Add hyponyms for emotion categories
		callAddHyponymsEmotions("anger");
		callAddHyponymsEmotions("disgust");
		callAddHyponymsEmotions("fear");
		callAddHyponymsEmotions("joy");
		callAddHyponymsEmotions("sadness");
		callAddHyponymsEmotions("surprise");
		
		//Add hyponyms of unhealthiness
		ArrayList<String> al1 = new ArrayList<String>();
		al1.add("fear");
		al1.add("sadness");
		words.put("unhealthiness",al1);
		words.put("catastrophe",al1);
		addHyponyms("unhealthiness",al1);		
		addHyponyms("catastrophe",al1);		
		
		//Add hyponyms for hostility,weaponry,weapon
		ArrayList<String> al2 = new ArrayList<String>();
		al2.add("anger");
		al2.add("sadness");
		words.put("hostility",al2);
		words.put("weaponry",al2);
		words.put("weapon",al2);
		addHyponyms("hostility",al2);		
		addHyponyms("weaponry",al2);		
		addHyponyms("weapon",al2);		
		
		//Add hyponyms for aggression,wrongdoing
		ArrayList<String> al3 = new ArrayList<String>();
		al3.add("anger");
		al3.add("sadness");
		al3.add("disgust");
		words.put("aggression",al3);
		words.put("wrongdoing",al3);
		addHyponyms("aggression",al3);		
		addHyponyms("wrongdoing",al3);		
	
		//Add hyponyms for prosperity
		ArrayList<String> al4 = new ArrayList<String>();
		al4.add("joy");
		words.put("prosperity",al4);
		words.put("delight",al4);
		addHyponyms("prosperity",al4);		
		addHyponyms("delight",al4);		
		
		//Add hyponyms for misfortune
		ArrayList<String> al5 = new ArrayList<String>();
		al5.add("sadness");
		words.put("misfortune",al5);
		addHyponyms("misfortune",al5);		
		
		//print hashmap		
		/*for(String s: words.keySet())
			System.out.println(s+" "+words.get(s));*/
	}
}