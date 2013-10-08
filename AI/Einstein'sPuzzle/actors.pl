iright(L, R, [L | [R | _]]).
iright(L, R, [_ | Rest]) :- iright(L, R, Rest).
nextto(L, R, List) :- iright(L, R, List).
nextto(L, R, List) :- iright(R, L, List).
notmember(X,L) :-
(
member(X,L), !, fail
;
true
).


myprogram(Data) :-     =(Data, [ [_,_,_,_,_,_],[_,_,_,_,_,_],[_,_,_,_,_,_],[_,_,_,_,_,_],[_,_,_,_,_,_] ,[_,_,_,santamonicablvd,_,_]  ]).
myprogram(Data) :-     =(Data, [ [_,_,_,_,_,_],[_,_,_,_,_,_],[_,_,_,_,_,_],[_,_,_,_,_,_],[_,_,_,_,_,_] ,[_,_,_,melrose,_,_]  ]).


myop(Data) :- myprogram(Data),
member([_,mary,female,_,_,_],Data),

member([_,_,_,melrose,_,_],Data),
member([_,_,_,santamonicablvd,_,_],Data), 
member([_,_,_,sunsetblvd,_,_],Data),
member([_,_,_,hollywoodblvd,_,_],Data),
member([_,_,_,wilshireblvd,_,_],Data),
member([_,_,_,beverlyblvd,_,_],Data),

member([issac,kitty,female,santamonicablvd,_,_],Data), 
iright([aaron,philip,male,_,_,hotdog],[_,taylor,male,_,_,_],Data),
member([durant,_,_,hollywoodblvd,writer,_],Data),
member([_,ken,male,sunsetblvd,_,_],Data),
member([_,taylor,male,_,psychologist,_],Data),
member([arthur,_,male,_,salesman,_],Data),

notmember([_,rose,female,_,navy,hamburger],Data),
notmember([_,rose,female,_,historian,hamburger],Data),
member([_,rose,female,_,_,hamburger],Data), 
 
member([bradley,_,_,_,soccer,kebab],Data),
nextto([manuel,_,_,_,_,_],[aaron,_,_,_,_,_],Data),
nextto([manuel,_,_,_,_,_],[_,_,_,_,_,tacos],Data),

member([_,_,_,_,navy,tacos],Data),
iright([_,_,_,beverlyblvd,_,_],[_,_,_,_,psychologist,_],Data),

member([arthur,_,_,_,_,bento],Data),

member([_,_,male,wilshireblvd,_,pasta],Data),
iright([_,_,_,sunsetblvd,_,_],[_,_,_,_,_,hamburger],Data).