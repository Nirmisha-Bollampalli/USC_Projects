Student Details:

Name : Nirmisha Bollampalli
ID : 5319-6080-98
Email : bollampa@usc.edu



Language Used : c++


Program Structure :

1)Main function :  It reads input from a file and then calls the max function.
2)max_val function : It takes the initial board configuration and calls min_val function to generate successors
3)min_val function :It takes the input from max_val,generates successors and inturn calls max_val.
4)This process goes on recursively until the program finds the best move by applying min-max and alpha beta pruning.
5)getblackactions function : It gets moves/jumps of player A.
6)getwhiteactions function: It gets moves/jumps of player B
7)cutoff function : It tells the functions to recurse back when maximum depth is reached.
8)printmove function and printmoveB funtion prints A's and B's moves.

Note :Input is read from a file named input.txt(I have attached the sample file).The first 8 rows of the file represent the board configuration and the final row represents the depth.




Compile and Execute :

Compile : g++ -o checkers checkers.cpp
Run : checkers

