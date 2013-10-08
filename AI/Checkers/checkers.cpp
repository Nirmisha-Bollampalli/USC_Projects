#include <string>
#include <fstream>
#include <iostream>
#include <math.h>
#include <vector>


using namespace std;
int max_val(vector<vector<char> >,int,int,int);
//Global Declarations
int cno=0,m_depth=0,posval=0;
char max_depth;


bool king = false;
bool is_mandatory= false,prune=false;
 int count=0;


struct states
{
  char s_piece[8][8];
}state_no[100][100],state_no1[100][100];

struct currentBconfig
{
  char c_piece[8][8];
}c_state[100];

struct position
{
  int alpha;
  int posi1[100],posj1[100],posi2[100],posj2[100];
  int mover[100];
    
}positions[100];



vector< vector<vector<char> > > getBlackActions(vector<vector<char> > piece)
{
 
  vector< vector<vector<char> > > statesArray;
  statesArray.resize(1);
  statesArray[0].resize(9);
	for(int j=1;j<9;++j)
		  statesArray[0][j].resize(9);
  
  int j=0,white_coins=0,h=0,stateCount=0;


  is_mandatory = false;
 // cout << "Black Moves :";

     for(int j=1; j<9 ;j++)
{
       for(int i=1; i<9; i++)
	   {
	     king = false;
		 //Determine Moves for a Black King-----------------------------	
		 
		 if(piece[j][i] == 'k')
		 {
   		 //King jumps up towards left
		 if(j>2 && i>2 && piece[j-1][i-1] == '*')
			 { 
			     if(j>2 && i>2 && piece[j-2][i-2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1]= piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j-2][i-2] = 'k';
                     statesArray[stateCount][j-1][i-1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					  statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			
		 
		 //Kings jumps forward towards right
		 if(j>2 && i<7 && piece[j-1][i+1] == '*')
			 { 
				 
				if(j>2 && i<7 && piece[j-2][i+2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j-2][i+2] = 'k';
                     statesArray[stateCount][j-1][i+1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					  statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
				 
			 }
             
 
			 //King jumps Backward towards left	    
			 if(j<7 && i>2 && piece[j+1][i-1] == '*')
			 { 
				 
				 if(j<7 && i>2 && piece[j+2][i-2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
						     statesArray[stateCount][j1][i1]= piece[j1][i1];
						 }
					 }
                     statesArray[stateCount][j+2][i-2] = 'k';
                     statesArray[stateCount][j+1][i-1] = '.';
					 statesArray[stateCount][j][i]='.';	
					 stateCount++;
					 statesArray.resize(stateCount+1);
				     statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			 
			 //King Jumps Backward towards right
            if(j<7 && i<7 && piece[j+1][i+1] == '*')
			 {
				 if(j<7 && j<7 && piece[j+2][i+2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j+2][i+2] = 'k';
                     statesArray[stateCount][j+1][i+1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
				     statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			 
			 if(j>2 && i>2 && piece[j-1][i-1] == 'K')
			 { 
			     if(j>2 && i>2 && piece[j-2][i-2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1]= piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j-2][i-2] = 'k';
                     statesArray[stateCount][j-1][i-1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					  statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			
		 
		 //Kings jumps forward towards right
		 if(j>2 && i<7 && piece[j-1][i+1] == 'K')
			 { 
				 
				if(j>2 && i<7 && piece[j-2][i+2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j-2][i+2] = 'k';
                     statesArray[stateCount][j-1][i+1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					  statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
				 
			 }
             
 
			 //King jumps Backward towards left	    
			 if(j<7 && i>2 && piece[j+1][i-1] == 'K')
			 { 
				 
				 if(j<7 && i>2 && piece[j+2][i-2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
						     statesArray[stateCount][j1][i1]= piece[j1][i1];
						 }
					 }
                     statesArray[stateCount][j+2][i-2] = 'k';
                     statesArray[stateCount][j+1][i-1] = '.';
					 statesArray[stateCount][j][i]='.';	
					 stateCount++;
					 statesArray.resize(stateCount+1);
				     statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			 
			 //King Jumps Backward towards right
            if(j<7 && i<7 && piece[j+1][i+1] == 'K')
			 {
				 if(j<7 && j<7 && piece[j+2][i+2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j+2][i+2] = 'k';
                     statesArray[stateCount][j+1][i+1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
				     statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
		
			 
		}	 
		 if(piece[j][i] == 'o')
		 {
//Determine available no of jumps for a given piece------------------------
             if(j>2 && i>2 && piece[j-1][i-1] == 'K')
			 {
				 if(j>2 && i>2 && piece[j-2][i-2] == '.')
				 {	 
                 	 is_mandatory = true;
					 //cout << "I Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
                     
					 if(j-2 == 1)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j-2][i-2] = 'k';
                       statesArray[stateCount][j-1][i-1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }
					 else
					 {
					   statesArray[stateCount][j-2][i-2] = 'o';
                       statesArray[stateCount][j-1][i-1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }

					stateCount++;
					 statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }//if31	 
			 }
             if(j>2 && i<7 && piece[j-1][i+1] == 'K')
		     {
		         if(j>2 && i<7 && piece[j-2][i+2] == '.')
				 {	 
                 	 is_mandatory = true;
					 //cout << "I Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1]= piece[j1][i1];
							 
						 }
					 }
					 if(j-2 == 1)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j-2][i+2] = 'k';
                       statesArray[stateCount][j-1][i+1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }
					 else
					 {
					  
					   statesArray[stateCount][j-2][i+2] = 'o';
                       statesArray[stateCount][j-1][i+1] = '.';
					   statesArray[stateCount][j][i]='.';
					   
					 }

                   stateCount++;
				    statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=0;j<8;++j)
						statesArray[stateCount][j].resize(9);
				 }//if33	
		 
		     }
    	     if(j>2 && i>2 && piece[j-1][i-1] == '*')
			 {
				 if(j>2 && i>2 && piece[j-2][i-2] == '.')
				 {	 
                 	 is_mandatory = true;
					 //cout << "I Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
                     
					 if(j-2 == 1)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j-2][i-2] = 'k';
                       statesArray[stateCount][j-1][i-1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }
					 else
					 {
					   statesArray[stateCount][j-2][i-2] = 'o';
                       statesArray[stateCount][j-1][i-1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }

					stateCount++;
					 statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }//if31	 
			 }//if21
			
			  if(j>2 && i<7 && piece[j-1][i+1] == '*')
		     {
		         if(j>2 && i<7 && piece[j-2][i+2] == '.')
				 {	 
                 	 is_mandatory = true;
					 //cout << "I Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1]= piece[j1][i1];
							 
						 }
					 }
					 if(j-2 == 1)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j-2][i+2] = 'k';
                       statesArray[stateCount][j-1][i+1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }
					 else
					 {
					  
					   statesArray[stateCount][j-2][i+2] = 'o';
                       statesArray[stateCount][j-1][i+1] = '.';
					   statesArray[stateCount][j][i]='.';
					   
					 }

                   stateCount++;
				    statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }//if33	
		 
		     }//if22
			 
//Determine Moves -Provided there are no jumps for a given piece------------------
		     
		 }//if1

	   }//end of for 2
	 }//end of for 1
 if(!is_mandatory)
 {
    for(int j=1; j<9 ;j++)
	 {
       for(int i=1; i<9; i++)
	   {
          if(piece[j][i] == 'k')
		 {
		 
		     if(j>1 && i>1 && piece[j-1][i-1] == '.')
			  {
			         //cout << "King Got a Move!! From" << j << "," << i << "to" << j-1 << "," << i-1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							  statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					  statesArray[stateCount][j-1][i-1] = 'k';
                      statesArray[stateCount][j][i] = '.';
					  stateCount++;
					   statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
			  }
			  
			  if(j>1 && i<8 && piece[j-1][i+1] == '.')
			  {
			         //cout << "King Got a Move!! From" << j << "," << i << "to" << j-1 << "," << i+1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							  statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					  statesArray[stateCount][j-1][i+1] = 'k';
                      statesArray[stateCount][j][i] = '.';
					  stateCount++;
					   statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
			  }
			  
		     if(j<8 && i>1 && piece[j+1][i-1] == '.')
			  {
				     //cout << "King Got a Move!! From" << j << "," << i << "to" << j+1 << "," << i-1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					 statesArray[stateCount][j+1][i-1] = 'k';
                     statesArray[stateCount][j][i] = '.';
					 stateCount++;
					  statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
			  }
			  if(j<8 && i<8 && piece[j+1][i+1] == '.')
			  {
			         //cout << "King Got a Move!! From" << j << "," << i << "to" << j+1 << "," << i+1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					  statesArray[stateCount][j+1][i+1] = 'k';
                      statesArray[stateCount][j][i] = '.';
					  stateCount++;
					   statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
			  }
			  
		 }
         if(piece[j][i] == 'o')
		 {
		   if(j>1 && i>1 && piece[j-1][i-1] == '.')
				 {
				     //cout << "I Got a Move!! From" << j << "," << i << "to" << j-1 << "," << i-1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							  statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					  if(j-1 == 1)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					    statesArray[stateCount][j-1][i-1] = 'k';
                        statesArray[stateCount][j][i] = '.';
					 
					 }
					 else
					 {
					   
					    statesArray[stateCount][j-1][i-1] = 'o';
                        statesArray[stateCount][j][i] = '.';
					   
					 }
                    stateCount++;
					 statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);

				 }

				 if(j>1 && i<8 && piece[j-1][i+1] == '.')
				 {
				     //cout << "I Got a Move!! From" << j << "," << i << "to" << j-1 << "," << i+1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							  statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					  if(j-1 == 1)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					    statesArray[stateCount][j-1][i+1] = 'k';
                        statesArray[stateCount][j][i] = '.';
					 
					 }
					 else
					 {
					   
					    statesArray[stateCount][j-1][i+1] = 'o';
                        statesArray[stateCount][j][i] = '.';
					   
					 }
                    stateCount++;
					 statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
		 
		 }
	   }
	}
 }

 //return statesArray[stateCount][8][8];
/* cout << "State Count :" << stateCount << "\n";
 int no = stateCount;
 while(no>=0)
  {
	  cout << "State : " << no << "\n";
	  for(int i=0;i<8;i++)
	  {
		 for(int a=0;a<8;a++)
		 {
		  cout <<statesArray[no][i][a] ; 
		 }
		 cout << "\n";
	  }
	 no--;
  }  */

  return statesArray;
 
}

vector< vector<vector<char> > > getWhiteActions(vector<vector<char> > piece)
{
 
  vector< vector<vector<char> > > statesArray;
  statesArray.resize(1);
  statesArray[0].resize(9);
	for(int j=1;j<9;++j)
		  statesArray[0][j].resize(9);
  int j=0,white_coins=0,h=0,stateCount=0;
  is_mandatory = false;
  //Find No Of White Pieces	
 
     for(int j=1; j<9 ;j++)
	 {
      
	   for(int i=1; i<9; i++)
	   {
	     king=false;
		 //Determine Moves for a White King-----------------------------	
		if(piece[j][i] == 'K')
		 {
			 
          //Forward Jumps		    
			 if(j<7 && i>2 && piece[j+1][i-1] == 'o')
			 {
                 
				 if(j<7 && i>2 && piece[j+2][i-2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						}
					 }
					 statesArray[stateCount][j+2][i-2] = 'K';
                     statesArray[stateCount][j+1][i-1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
				}
			  if(j<7 && i>2 && piece[j+1][i+1] == 'o')
			  {
				 if(j<7 && i<7 && piece[j+2][i+2] == '.')
				 {	
                     is_mandatory = true;
					// cout << "King Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j+2][i+2] = 'K';
                     statesArray[stateCount][j+1][i+1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			 if(i<7 && j>2 && piece[j-1][i+1] == 'o')
			 { 
				 //Backward Jumps
				 if(i<7 && j>2 && piece[j-2][i+2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j-2][i+2] = 'K';
                     statesArray[stateCount][j-1][i+1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
				 
			 }
             if(j>2 && i>2 && piece[j-1][i-1] == 'o')
			 { 
			     if(j>2 && i>2 && piece[j-2][i-2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j-2][i-2] = 'K';
                     statesArray[stateCount][j-1][i-1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			 //Forward Jumps		    
			 if(j<7 && i>2 && piece[j+1][i-1] == 'k')
			 {
                 
				 if(j<7 && i>2 && piece[j+2][i-2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						}
					 }
					 statesArray[stateCount][j+2][i-2] = 'K';
                     statesArray[stateCount][j+1][i-1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
				}
			  if(j<7 && i>2 && piece[j+1][i+1] == 'k')
			  {
				 if(j<7 && i<7 && piece[j+2][i+2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j+2][i+2] = 'K';
                     statesArray[stateCount][j+1][i+1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			 if(i<7 && j>2 && piece[j-1][i+1] == 'k')
			 { 
				 //Backward Jumps
				 if(i<7 && j>2 && piece[j-2][i+2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j-2][i+2] = 'K';
                     statesArray[stateCount][j-1][i+1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
				 
			 }
             if(j>2 && i>2 && piece[j-1][i-1] == 'k')
			 { 
			     if(j>2 && i>2 && piece[j-2][i-2] == '.')
				 {	
                     is_mandatory = true;
					 //cout << "King Got a Jump!! From" << j << "," << i << "to" << j-2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
					 statesArray[stateCount][j-2][i-2] = 'K';
                     statesArray[stateCount][j-1][i-1] = '.';
					 statesArray[stateCount][j][i]='.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
			 }
			 
		 }
	 
		 if(piece[j][i] == '*')
		 {
//Determine available no of jumps for a given piece------------------------
             if(j<7 && i>2 && piece[j+1][i-1] == 'k')
			 {
				 if(j<7 && i>2 && piece[j+2][i-2] == '.')
				 {	 
                 	 is_mandatory = true;
					 //cout << "I Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
                     
					 if(j+2 == 8)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j+2][i-2] = 'K';
                       statesArray[stateCount][j+1][i-1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }
					 else
					 {
					   statesArray[stateCount][j+2][i-2] = '*';
                       statesArray[stateCount][j+1][i-1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }

					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }//if31	 
			 }//if21
			
    	     if(j<7 && i>2 && piece[j+1][i-1] == 'o')
			 {
				 if(j<7 && i>2 && piece[j+2][i-2] == '.')
				 {	 
                 	 is_mandatory = true;
					 //cout << "I Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i-2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							
						 }
					 }
                     
					 if(j+2 == 8)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j+2][i-2] = 'K';
                       statesArray[stateCount][j+1][i-1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }
					 else
					 {
					   statesArray[stateCount][j+2][i-2] = '*';
                       statesArray[stateCount][j+1][i-1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }

					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }//if31	 
			 }//if21
			 if(j<7 && i<7 && piece[j+1][i+1] == 'k')
		     {
		         if(j<7 && i<7 && piece[j+2][i+2] == '.')
				 {	 
                 	 is_mandatory = true;
					 //cout << "I Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							 
						 }
					 }
					  if(j+2 == 8)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j+2][i+2] = 'K';
                       statesArray[stateCount][j+1][i+1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }
					 else
					 {
					   
					   statesArray[stateCount][j+2][i+2] = '*';
                       statesArray[stateCount][j+1][i+1] = '.';
					   statesArray[stateCount][j][i]='.';
					   
					 }

                   stateCount++;
				   statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }//if33	
		 
		     }
			  if(j<7 && i<7 && piece[j+1][i+1] == 'o')
		     {
		         if(j<7 && i<7 && piece[j+2][i+2] == '.')
				 {	 
                 	 is_mandatory = true;
					 //cout << "I Got a Jump!! From" << j << "," << i << "to" << j+2 << "," << i+2 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
							 
						 }
					 }
					  if(j+2 == 8)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j+2][i+2] = 'K';
                       statesArray[stateCount][j+1][i+1] = '.';
					   statesArray[stateCount][j][i]='.';
					 }
					 else
					 {
					   
					   statesArray[stateCount][j+2][i+2] = '*';
                       statesArray[stateCount][j+1][i+1] = '.';
					   statesArray[stateCount][j][i]='.';
					   
					 }

                   stateCount++;
				   statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }//if33	
		 
		     }//if22
//Determine Moves -Provided there are no jumps for a given piece------------------
		     
		 }//if1

	   }//end of for 2
	 }//end of for 1

 if(!is_mandatory)
 {
    for(int j=1; j<9 ;j++)
	 {
       for(int i=1; i<9; i++)
	   {
          if(piece[j][i] == 'K')
		 {
		   if(j<8 && i>1 && piece[j+1][i-1] == '.')
			  {
				     //cout << "King Got a Move!! From" << j << "," << i << "to" << j+1 << "," << i-1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					 statesArray[stateCount][j+1][i-1] = 'K';
                     statesArray[stateCount][j][i] = '.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
			  }
			  if(j<8 && i<8 && piece[j+1][i+1] == '.')
			  {
			        // cout << "King Got a Move!! From" << j << "," << i << "to" << j+1 << "," << i+1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					 statesArray[stateCount][j+1][i+1] = 'K';
                     statesArray[stateCount][j][i] = '.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
			  }
			  if(j>1 && i>1 && piece[j-1][i-1] == '.')
			  {
			         //cout << "King Got a Move!! From" << j << "," << i << "to" << j-1 << "," << i-1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					 statesArray[stateCount][j-1][i-1] = 'K';
                     statesArray[stateCount][j][i] = '.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
			  }
			  if(j>1 && i<8 && piece[j-1][i+1] == '.')
			  {
			         //cout << "King Got a Move!! From" << j << "," << i << "to" << j-1 << "," << i+1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					 statesArray[stateCount][j-1][i+1] = 'K';
                     statesArray[stateCount][j][i] = '.';
					 stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
			  }
		  
		 }
		 if(piece[j][i] == '*')
		 {
		   if(j<8 && i>1 && piece[j+1][i-1] == '.')
				 {
				     //cout << "I Got a Move!! From" << j << "," << i << "to" << j+1 << "," << i-1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					  if(j+1 == 8)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j+1][i-1] = 'K';
                       statesArray[stateCount][j][i] = '.';
					 
					 }
					 else
					 {
					   
					   statesArray[stateCount][j+1][i-1] = '*';
                       statesArray[stateCount][j][i] = '.';
					   
					 }
                     stateCount++;
					 statesArray.resize(stateCount+1);
					 statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);

				 }

				 if(j<8 && i<8 && piece[j+1][i+1] == '.')
				 {
				     //cout << "I Got a Move!! From" << j << "," << i << "to" << j+1 << "," << i+1 << "\n" ;
					 for(int j1=1; j1<9 ;j1++)
					 {
						 for(int i1=1; i1<9; i1++)
						 {                  
							 statesArray[stateCount][j1][i1] = piece[j1][i1];
						 }
					 }
					  if(j+1 == 8)
					 { 
						 king = true;
				 
					 }

					 if(king)
					 {
					   
					   statesArray[stateCount][j+1][i+1] = 'K';
                       statesArray[stateCount][j][i] = '.';
					 
					 }
					 else
					 {
					   
					   statesArray[stateCount][j+1][i+1] = '*';
                       statesArray[stateCount][j][i] = '.';
					   
					 }
                   stateCount++;
				   statesArray.resize(stateCount+1);
				   statesArray[stateCount].resize(9);
					 for(int j=1;j<9;++j)
						statesArray[stateCount][j].resize(9);
				 }
		 
		 }

	   }
	}
 }
 
 /*cout << "StateCount : "<<stateCount;
 int numStates=statesArray.size()-1;
 cout<< "numStates :" << numStates;
  for(int i=0;i<8;++i){
	  cout<<"\n";
	  for(int j=0;j<8;++j){
		  cout<<"\n";
		  for(int k=0;k<8;++k){
			  cout<<statesArray[i][j][k]<<" ";
		  }
	  }
  }
  cout << "Exit White Actions";*/
  return statesArray;
 
}
bool CutoffTest(int depth)
{

	return depth>=m_depth;
}

string calculatetabs(int depth)
{
    string tabs = "";
	for(int i=0;i<depth;i++)
	{
	  tabs = tabs + "  ";
	}
	return tabs;
	
}
void printMoveB(vector<vector<char> > c_state,vector<vector<char> > cState, int c_depth)
{	
	bool forward = false;
	string tabs;
	int moverate=0,countforward=0;
	int movei[200],movej[200];
	for(int i=1;i<9;i++) 
	   for(int j=1;j<9;j++)
		  if(c_state[i][j] != cState[i][j])
		  {
				if(c_state[i][j] == '.' && countforward==0)
				{
				   forward = true;
				   countforward++;
				}
				else
				{
				   forward = false;
				}
				
				movei[moverate] = i;
				movej[moverate] = j;
                moverate++;
				
		  }	  
 
    tabs = calculatetabs(c_depth); 
	if(prune == false && moverate > 2)
	{
		
		if(forward)
	   {
		cout << tabs << "Depth " << c_depth << " : B Jumps from " << "[" << movei[0] << "," << movej[0] << "] To" << "[" << movei[2] << "," << movej[2] << "]" << "\n";
	    if(c_depth == 0)
		{
		positions[posval].posi1[posval] = movei[0];
		positions[posval].posj1[posval] = movej[0];

		positions[posval].posi2[posval] = movei[2];
		positions[posval].posj2[posval] = movej[2];
		}
	   }
	   else{
	     cout << tabs << "Depth " << c_depth << " : B Jumps from " << "[" << movei[2] << "," << movej[2] << "] To" << "[" << movei[0] << "," << movej[0] << "]" << "\n";
	    if(c_depth == 0)
		{
		positions[posval].posi1[posval] = movei[2];
		positions[posval].posj1[posval] = movej[2];

		positions[posval].posi2[posval] = movei[0];
		positions[posval].posj2[posval] = movej[0];
		}
	   
	   }
		
	}
	else if(prune == false && moverate <= 2)
	{
		if(forward)
		{
		cout << tabs<<"Depth " << c_depth << ": B Moves from " << "[" << movei[0] << "," << movej[0] << "] To" << "[" << movei[1] << "," << movej[1] << "]"<<"\n";
			if(c_depth == 0)
			{
			positions[posval].posi1[posval] = movei[0];
			positions[posval].posj1[posval] = movej[0];

			positions[posval].posi2[posval] = movei[1];
			positions[posval].posj2[posval] = movej[1];
			}
		}
		else
		{
		    cout << tabs<<"Depth " << c_depth << ": B Moves from " << "[" << movei[1] << "," << movej[1] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n";
			if(c_depth == 0)
			{
			positions[posval].posi1[posval] = movei[1];
			positions[posval].posj1[posval] = movej[1];

			positions[posval].posi2[posval] = movei[0];
			positions[posval].posj2[posval] = movej[0];
			}
		
		}
	
	}
	
	else if(prune == true && moverate > 2){
	   if(forward)
	   cout << tabs<< "Depth " << c_depth << " : Pruning B's Jump From"  << "[" << movei[0] << "," << movej[0] << "] To" << "[" << movei[2] << "," << movej[2] << "]" << "\n";
	   else
	   cout << tabs << "Depth " << c_depth << " : Pruning B's Jump From " << "[" << movei[2] << "," << movej[2] << "] To" << "[" << movei[0] << "," << movej[0] << "]" << "\n";
	   
	}
    else if(prune == true && moverate <= 2){
	   if(forward)
	   cout << tabs<<"Depth " << c_depth << ": Pruning B's Move From " << "[" << movei[0] << "," << movej[0] << "] To" << "[" << movei[1] << "," << movej[1] << "]"<<"\n";
	   else
	   cout << tabs<<"Depth " << c_depth << ": Pruning B's Move From" << "[" << movei[1] << "," << movej[1] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n";
			
     } 	
	

}
void printMove(vector<vector<char> > c_state,vector<vector<char> > cState, int c_depth)
{	
	bool forward = false;
	string tabs;
	int moverate=0,countforward=0;
	int movei[200],movej[200];
	for(int i=1;i<9;i++)
	   for(int j=1;j<9;j++)
		  if(c_state[i][j] != cState[i][j])
		  {
				
				if(c_state[i][j] == '.' && countforward==0)
				{
				   forward = true;
				   countforward++;
				}
				else
				{
				   forward = false;
				}
				
				movei[moverate] = i;
				movej[moverate] = j;
				//cout << movei[moverate] << "," << movej[moverate] << "\t";
                moverate++;
				
		  }	   		   
	tabs = calculatetabs(c_depth);
	if(prune == false && moverate > 2)
	{
	  if(forward)
	  {
		cout <<tabs<< "Depth " << c_depth << " :A Jumps from " << "[" << movei[0] << "," << movej[0] << "] To" << "[" << movei[2] << "," << movej[2] << "]"<<"\n";
	    if(c_depth == 0)
		{
		positions[posval].posi1[posval] = movei[0];
		positions[posval].posj1[posval] = movej[0];

		positions[posval].posi2[posval] = movei[2];
		positions[posval].posj2[posval] = movej[2];
		positions[posval].mover[posval] = moverate;
		//cout << "Depth " << c_depth << " : A Jumps from " << "[" << movei[2] << "," << movej[2] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n\n";
	   
		}
	  }
	 else
	 {
	    cout <<tabs<< "Depth " << c_depth << " :A Jumps from " << "[" << movei[2] << "," << movej[2] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n";
	    if(c_depth == 0)
		{
		positions[posval].posi1[posval] = movei[2];
		positions[posval].posj1[posval] = movej[2];

		positions[posval].posi2[posval] = movei[0];
		positions[posval].posj2[posval] = movej[0];
		positions[posval].mover[posval] = moverate;
		//cout << "Depth " << c_depth << " : A Jumps from " << "[" << movei[2] << "," << movej[2] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n\n";
	   
		}
	 
	 }
		
	}
	else if(prune == false && moverate <= 2)
	{
	  
      if(forward)
	  {
   	  cout <<tabs<<"Depth " << c_depth << ": A Moves from " << "[" << movei[0] << "," << movej[0] << "] To" << "[" << movei[1] << "," << movej[1] << "]"<<"\n";
	    if(c_depth == 0)
		{
		positions[posval].posi1[posval] = movei[0];
	    positions[posval].posj1[posval] = movej[0];
		positions[posval].posi2[posval] = movei[1];
		positions[posval].posj2[posval] = movej[1];
		positions[posval].mover[posval] = moverate;
		//cout << "Depth " << c_depth << " : A Jumps from " << "[" << movei[2] << "," << movej[2] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n\n";
	   
		}
	  }
	  else
	  {
	    cout <<tabs<<"Depth " << c_depth << ": A Moves from " << "[" << movei[1] << "," << movej[1] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n";
	    if(c_depth == 0)
		{
		positions[posval].posi1[posval] = movei[1];
	    positions[posval].posj1[posval] = movej[1];

		positions[posval].posi2[posval] = movei[0];
		positions[posval].posj2[posval] = movej[0];
		positions[posval].mover[posval] = moverate;
		//cout << "Depth " << c_depth << " : A Jumps from " << "[" << movei[2] << "," << movej[2] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n\n";
	   
		}
	  
	  }
	}
	else if(prune == true && moverate > 2){
	   if(!forward)
	   cout <<tabs<<"Depth " << c_depth << " :Pruning A's Jump From " << "[" << movei[2] << "," << movej[2] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n";
	   else
	   cout <<tabs<< "Depth " << c_depth << " :Pruning A's Jump From " << "[" << movei[0] << "," << movej[0] << "] To" << "[" << movei[2] << "," << movej[2] << "]"<<"\n";
	   
	 }   
    else if(prune == true && moverate <= 2){
	
	   if(!forward)
	   cout <<tabs<< "Depth " << c_depth << ": Pruning A's move From " << "[" << movei[1] << "," << movej[1] << "] To" << "[" << movei[0] << "," << movej[0] << "]"<<"\n";
       else
	    cout <<tabs<<"Depth " << c_depth << ": Pruning A's move From " << "[" << movei[0] << "," << movej[0] << "] To" << "[" << movei[1] << "," << movej[1] << "]"<<"\n";
	    
	   
	 }
	
			 
}



int eval(vector<vector<char> > count,char c)
{
   int x=0;
   for(int i=1;i<9;i++)
     for(int j=1;j<9;j++)
		if(count[i][j] == c)
			x++;
   return x;

}
int evalKings(vector<vector<char> > count,char c)
{
   int x=0;
   for(int i=1;i<9;i++)
     for(int j=1;j<9;j++)
		if(count[i][j] == c)
			x=x+2;
   return x;

}
int min_val(vector<vector<char> > state,int c_depth,int alpha,int beta)
{
	    string tabs;
		prune = false;
		c_depth++;
	   tabs = calculatetabs(c_depth);
		//cout << "Min_Val Depth :" << c_depth << "\n";
	  if(CutoffTest(c_depth))
	  {
		 //cout << "Min Depth Limit Reached!!" << "\n";
		 int c=0;
		 int b = eval(state,'*');
		 int a = eval(state,'o');
		 int f = evalKings(state,'k');
		 int e = evalKings(state,'K');
         if((b+e) == 0)
		 {
		     //cout << "Depth "<<c_depth<< ": Heuristic Value Of the Current Board = "<< c << "\n";
		     prune = false;
			 return 10000;
		 }
		 else if((a+f) ==0) 
		 {
		     //cout << "Depth "<<c_depth<< ": Heuristic Value Of the Current Board = "<< c << "\n";
		     prune = false;
			 return -10000;
		 }
		 else
		 { 
		  //cout << "No Kings";

		  c = (a+f) - (b+e); 
		 }
		 //c_depth--;
		 cout <<tabs<< "Depth "<<c_depth<< ": Heuristic Value Of the Current Board = "<< c << "\n";
	    // cout << "alpha : " << alpha << "," << "beta :" << beta << "\n";
         prune = false;
		 return c;
	  }

	  
      vector< vector<vector<char> > > statesArray=getWhiteActions(state);
	  int numStates=statesArray.size()-1;

	  if(numStates == 0)
	   {
	        int b = eval(state,'*');
		    int a = eval(state,'o');
		    int f = evalKings(state,'k');
		    int e = evalKings(state,'K');
			//int c = (a+f) - (b+e);
			prune = false;
    		return 10000;
	   }
	 
	  for(int i=0;i<numStates;++i){
		  vector<vector<char> > cState=statesArray[i];
		  if(prune == false){
		  printMoveB(state,cState,c_depth);
		  int temp=max_val(cState,c_depth,alpha,beta);
		  beta=min(beta,temp);
		  }
		 
		  if(beta<=alpha){
			  
			 if(prune == true) {
			   printMoveB(state,cState,c_depth);
             }			   
			 prune = true;	 
			 if(i == (numStates-1)){
				  cout << "Beta :" << beta << ",";
			      cout << "Alpha :"<<alpha << "\n";
				  prune = false;
          		  return alpha;
			  }
		  }
	  }
	  statesArray.clear(); 
	  //cout << "Min Return Beta :"<<beta << "\n";
      prune = false;
	  return beta;
}


int max_val(vector<vector<char> > state,int c_depth,int alpha,int beta)
{
	 prune = false;
	 
   	 c_depth++;
	  string tabs;
	  tabs = calculatetabs(c_depth);
	   // cout << "C_depth" <<c_depth<<"\n"; 
	 // cout << "Max_Val Depth :" << c_depth << "\n";
	   
	  if(CutoffTest(c_depth))
	  {
		 //cout << "Max Depth Limit Reached!!" << "\n";
		 int c;
		 int b = eval(state,'*');
		 int a = eval(state,'o');
		 int f = evalKings(state,'k');
		 int e = evalKings(state,'K');
         
         if((b+e) == 0)
		 {
			// cout << "Depth "<<c_depth<< ": Heuristic Value Of the Current Board = "<< c << "\n";
			 prune = false;
			 return 10000;
		 }
		 else if((a+f) ==0) 
		 {
		    // cout << "Depth "<<c_depth<< ": Heuristic Value Of the Current Board = "<< c << "\n";
			 prune = false;
			 return -10000;
		 }
		 else
		 {
		  //cout << "No Kings";
		  c = (a+f) - (b+e); 
		 }
		 
		 //c_depth--;
		cout << tabs <<"Depth "<<c_depth<< "\t : Heuristic Value Of the Current Board = "<< c << "\n \n ";
		 //cout << "alpha : " << alpha << "," << "beta :" << beta << "\n";
         prune = false;
 		 return c;
	  }
	
	  vector< vector<vector<char> > > statesArray=getBlackActions(state);
	  int numStates=statesArray.size()-1;
	  
	   if(numStates == 0)
	   {
	        int b = eval(state,'*');
		    int a = eval(state,'o');
		    int f = evalKings(state,'k');
		    int e = evalKings(state,'K');
			//int c = (a+f) - (b+e);	
			prune = false;
    		return -10000;
	   }

	   for(int i=0;i<numStates;++i){
          vector<vector<char> > cState=statesArray[i];
		  if(prune == false){
		  printMove(state,cState,c_depth);
		  //depth ==0 ,save position
		  int temp=min_val(cState,c_depth,alpha,beta);
		  alpha=max(alpha,temp);
		  if(c_depth == 0){
         	     positions[posval].alpha = alpha;				 
				 cout << "Alpha :" << positions[posval].alpha << " @ Pos Val :" << posval << "Beta" << beta <<"\n";
				 posval++;
		  }
		  }

		  if(alpha>=beta){
			  
			 if(prune == true){
			   printMove(state,cState,c_depth);
			   
			  }
			  prune = true;		
			  if(i == (numStates-1)){
			  cout << "Alpha :" << alpha << ",";
			  cout << "Beta :"<<beta << "\n";
			  prune = false;
			  return beta;
			  }

		  }
		  cState.clear();
	  }
	  statesArray.clear();
	  //cout << "Max Return alpha :"<<alpha << "\n";
	  prune = false;
	  return alpha;
}

int main()
{
  bool max_call = false;
  vector<vector<char> > state;
  vector<vector<char> > piece;
  state.resize(9);
  for(int i=1;i<9;++i)
	state[i].resize(9);
  piece.resize(9);
  for(int i=1;i<9;++i)
	piece[i].resize(9);

  const int SIZE = 70;
  int rowcount=0,colcount=0,noofpieces=0,a=1,b=1,alpha=-10000,beta=10000,c_depth=-1;
  char pieces[SIZE];
  char str; 
	

  std::ifstream fin("input.txt");

  for (int i = 1; (fin >> str) && (i <= SIZE+1); ++i) 
  {                                                  
    pieces[i] = str;	
	noofpieces++;
  }

  fin.close();
  //cout << "\n No Of Pieces : " << noofpieces << "\n";
  max_depth = pieces[noofpieces-1]; 
  string last_row = "";
 //Board Configuration
  for (int i = 1; i <=64; i++) 
  {
	 for (int j =1; j<9; j++)
	 {
		piece[b][j] = pieces[a];
		a = a+1;
	  }
	  b = b+1;
	  i = i+8;
	  
  }
 
 for (int i = 65; i <=noofpieces; ++i) 
			  {                                                  
				//get the last row value
				last_row = last_row + pieces[i];
				
			  }
  //cout << "\n Last row " << last_row << "\n";
  //cout << "Maximum Depth " << max_depth << "\n \n";
  
  m_depth = atoi(last_row.c_str());
  //cout << "m_depth" << m_depth;
 
  //copy piece array into state array to pass it to max_val

  for(int i=1;i<9;i++)
  {
    for(int j=1;j<9;j++)
	{
	  state[i][j] = piece[i][j];
	
	}
  }
  
  
  int v;
 
 for(int i=1;i<9;i++)
  {
    for(int j=1;j<9;j++)
	{
	    if(state[i][j] == 'o' || state[i][j] == 'k')
		{
		  max_call = true;
		}
		
    }
 }
 
    if(max_call == true)
        v=max_val(state,c_depth,alpha,beta);
	else
	    v=-10000;
  
  //Print Max Players First Move
    int max;
	for(int i=0;i<posval;i++)
	{
	max = positions[0].alpha;
	if(positions[i].alpha>max)
	max = positions[i].alpha;
	}
	cout << "Expansions Completed!! " << "\n\n";
	for(int i=0;i<posval;i++) 
	{
	  if(positions[i].alpha == max)
	  {
	     if(positions[posval].mover[posval] <= 2)
		 {
		 cout << "A moves the piece at " << "[" << positions[i].posi1[i] << "," << positions[i].posj1[i] << "] To" << "[" << positions[i].posi2[i] << "," << positions[i].posj2[i] << "]"<<"\n\n";
	     break; 
		 }
		 else{
		  cout << "A Jumps the piece at " << "[" << positions[i].posi1[i] << "," << positions[i].posj1[i] << "] To" << "[" << positions[i].posi2[i] << "," << positions[i].posj2[i] << "]"<<"\n\n";
	      break; 
		 }
	  }
	}
    
	cout << "Returned Final Heuristic Board Value : " << v <<"\n";
}
