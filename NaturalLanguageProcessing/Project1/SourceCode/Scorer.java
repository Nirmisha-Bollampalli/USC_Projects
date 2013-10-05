import java.lang.Math;
import java.util.ArrayList;

public class Scorer
{		
	    
		public static void CheckRepository(String WordToken,int[] score){
		
			createHashMap hm= new createHashMap();
			hm.driver();
		 
			if(hm.words.containsKey(WordToken))
			{
				//System.out.println(tokens[i]+" is present in hashmap with arraylist "+hm.words.get(tokens[i].substring(0,index).toLowerCase()));
				ArrayList<String> al = hm.words.get(WordToken);
				for(String s: al)
				{
					if(s.equals("anger"))
					{
						score[0]=score[0]+Math.round(100/al.size());
						//System.out.println(score[0]+" "+al.size());
					}
					if(s.equals("disgust"))
					{
						score[1]=score[1]+Math.round(100/al.size());
						//System.out.println(score[1]+" "+al.size());
					}	
					if(s.equals("fear"))
					{
						score[2]=score[2]+Math.round(100/al.size());
						//System.out.println(score[2]+" "+al.size());
					}
					if(s.equals("joy"))
					{
						score[3]=score[3]+Math.round(100/al.size());	
						//System.out.println(score[3]+" "+al.size());
					}	
					if(s.equals("sadness"))
					{
						score[4]=score[4]+Math.round(100/al.size());	
						//System.out.println(score[4]+" "+al.size());
					}	
					if(s.equals("surprise"))
					{
						score[5]=score[5]+Math.round(100/al.size());	
						//System.out.println(score[5]+" "+al.size());
					}	
				}
			}

		}
		public static ArrayList WordScorer(Object object)
		{
			
					ArrayList scores = new ArrayList();
					String Sentence;				
					Sentence = object.toString();
					//System.out.println("\r" + Sentence);
					Sentence = Sentence.replace(",", "") .replace("[", "") .replace("]", "");
					String [] tokens = Sentence.split("\\s+");
						
					
					int [] score = {0,0,0,0,0,0};
					for(int i=0;i<tokens.length;i++)
					{
						int index = tokens[i].lastIndexOf("/");
						String WordToken = tokens[i].substring(0,index).toLowerCase();
						CheckRepository(WordToken,score);
						
						
					}
					for(int j=0;j<6;j++){
						scores.add(Math.round(score[j]/tokens.length)+" ");	
					}
					
					return scores;
		}
		
		public static ArrayList RootScorer(String Root)
		{
			ArrayList scores = new ArrayList();
			int [] score = {0,0,0,0,0,0};
			
			CheckRepository(Root,score);
			
			for(int j=0;j<6;j++){
				scores.add(Math.round(score[j])+" ");	
			}
				
			return scores;
			
		}
}