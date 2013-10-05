import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.*;

public class Evaluator {

	public static ArrayList Calc_variables(int intscore1,int intscore2){
		int a=0,b=0,c=0,d=0;
		ArrayList emotions = new ArrayList();
		if(intscore1 == intscore2){
			if(intscore1 == 1)
				a++;
			if(intscore1 == 0)
				d++;
		}
		if(intscore1 != intscore2){
			if(intscore1 == 1)
				b++;
			if(intscore2 == 1)
				c++;
		}

		emotions.add(a);
		emotions.add(b);
		emotions.add(c);
		emotions.add(d);

		return emotions;
	}
	public static void Calc_APR(ArrayList ScoresList1,ArrayList ScoresList2){
		int i1=0,val=0,val1=0,val2=0,val3=0;
		while( i1 < 6){
			float Acc=0,Pre=0,Recall=0,a1=0,b1=0,c1=0,d1=0;
			
			val=0;val1=0;val2=0;val3=0;
			
			boolean flag = true;
			LinkedHashMap  emsMap = new LinkedHashMap();
			emsMap.put("a",val);
			emsMap.put("b",val);
			emsMap.put("c",val);
			emsMap.put("d",val);
			for(int i=0 ; i < ScoresList1.size() ; i++){  

				//System.out.println("Truth : " + ScoresList1.get(i));
				//System.out.println("System : " + ScoresList2.get(i));
				
				String scores1 = (String) ScoresList1.get(i);
				String scores2 = (String) ScoresList2.get(i);

				String[] score1 = scores1.split("\\s+");
				String[] score2 = scores2.split("\\s+");
				ArrayList emotions = new ArrayList();
				int intscore1 = Integer.parseInt(score1[i1]);
				int intscore2 = Integer.parseInt(score2[i1]);


				emotions = Calc_variables(intscore1,intscore2);

				for(int y=0 ; y < emotions.size() ; y++){
					if(y == 0){
						String v =emsMap.get("a").toString();
						val = Integer.parseInt(v);
						val = (int) emotions.get(y)+val;
						emsMap.put("a",val);
					}
					if(y == 1){
						String v =emsMap.get("b").toString();
						val1 = Integer.parseInt(v);
						val1 = (int) emotions.get(y)+val1;

						emsMap.put("b",val1);
					}
					if(y == 2){
						String v =emsMap.get("c").toString();
						val2 = Integer.parseInt(v);
						val2 = (int) emotions.get(y)+val2;
						emsMap.put("c",val2);
					}
					if(y == 3){
						String v =emsMap.get("d").toString();
						val3 = Integer.parseInt(v);
						val3 = (int) emotions.get(y)+val3;

						emsMap.put("d",val3);
					}
				}
			}

			a1 = Integer.parseInt(emsMap.get("a").toString());
			b1 = Integer.parseInt(emsMap.get("b").toString());
			c1 = Integer.parseInt(emsMap.get("c").toString());
			d1 = Integer.parseInt(emsMap.get("d").toString());
			
			//System.out.println("Values : "+a1+","+b1+","+c1+","+d1);
			if(a1>0 || b1>0 || c1>0 || d1>0){
			Acc = (a1+d1)/(a1+b1+c1+d1);
			}
			
			if(a1>0 || c1>0)
			Pre = (a1)/(a1+c1);
			
			if(a1>0 || b1>0)
			Recall = (a1)/(a1+b1);
			
			if(i1 == 0)
				System.out.println("Anger : \n");
			else if(i1 == 1)
				System.out.println("\n Disgust : \n");
			else if(i1 == 2)
				System.out.println("\n Fear : \n");
			else if(i1 == 3)
				System.out.println("\n Joy : \n");
			else if(i1 == 4)
				System.out.println("\n Sadness : \n");
			else if(i1 == 5)
				System.out.println("\n Surprise : \n");
			
			System.out.println("Accuracy : " + (Acc)*100);
			System.out.println("Precision : " + (Pre)*100);
			System.out.println("Recall : " + (Recall)*100);
			
			if(flag == true){
				i1++;
				flag= false;
			}
		}

		System.out.println();

	}

	public static ArrayList coarseGrainMapping(ArrayList ScoresList1){
		for(int i=0 ; i < ScoresList1.size() ; i++){  
			String scores = (String) ScoresList1.get(i);
			String ScoreUpdate="";
			String[] score = scores.split("\\s+");

			for(int i1=1 ; i1 < score.length ; i1++){ 
				int intscore = Integer.parseInt(score[i1]);
				if(intscore <= 50 && intscore >= 0 )
					intscore = 0;
				else if(intscore > 50 && intscore <= 100)
					intscore = 1;

				score[i1] = intscore+"";
				ScoreUpdate+= score[i1]+" ";
			}

			ScoresList1.set(i,ScoreUpdate);
		}

		return ScoresList1;
	}


	public static void main(String[] args){
		BufferedReader br = null;
		String a = "Resources\\affectivetext_test.emotions.gold";
		String b = "Resources\\FinalScoresSupervised.txt";
		//String b = "affectivetext_trial.emotions.gold";
		try {
			ArrayList ScoresList1= new ArrayList();
			ArrayList ScoresList2 = new ArrayList();
			String line;

			br = new BufferedReader(new FileReader(a)); 	
			while ((line = br.readLine()) != null) {
				ScoresList1.add(line);	
			}
			ScoresList1 = coarseGrainMapping(ScoresList1);

			int lineno=0;
			br = new BufferedReader(new FileReader(b)); 	
			while ((line = br.readLine()) != null) {
				ScoresList2.add(lineno+" "+line);	
				//ScoresList2.add(line);	
				lineno++;
			}

			ScoresList2 = coarseGrainMapping(ScoresList2);
			//		System.out.println(ScoresList2);

			//Calculate No of 0's and 1's
			Calc_APR(ScoresList1,ScoresList2);


		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} 	

	}
}
