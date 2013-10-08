phantom.cookiesEnabled = true;
var imageno = 0;
var click = false;
var Login = 0;

/****************************** Hard Coded Values **********************************************/
var EL = "/home/nirmisha/Desktop/Output/ExploredLink/";
var CL = "/home/nirmisha/Desktop/Output/clicks/";
var ME = "/home/nirmisha/Desktop/Output/MouseEventTesting/";
var FT = "/home/nirmisha/Desktop/Output/FormTesting/"
var DD = "/home/nirmisha/Desktop/Output/TestingDropDowns/"
var host = "http://127.0.0.0:8080/";
/****************************** Hard Coded Values **********************************************/


var casper = require('casper').create({
	verbose:true,
	holdOn: {
        navigationRequested: true,
        pendingWait: true,
        loadInProgress: false
        }
});
var a = casper.cli.get(0);
var links = [
    a];
var explored=[];
var upTo = ~~casper.cli.get(0) || 100000000;

var currentLink = 0;

function start(link) {
    
    this.start(link,function(){
	 
	    this.echo('Currently Explored Link :' + link,"INFO");

	    var flag1=true;
	    for(var j =0; j<explored.length;j++){
			if( link == explored[j]){
				flag1 = false;
			}
	    }

	    if(flag1==true){
	            explored.push(link);
		   
		    var count = this.evaluate(getCount);
			for (var i1=0;i1<count.length;i1++)
			{ 
			  if(count[i1] == "PageHeadCount"){
			    var countVal = this.evaluate(getCountVal);
			    
			    for(var h=0 ; h < countVal ; h++){
			    //  this.echo("Adding to array  "+link+"\n");
			      links.push(link);
			    }
			  }
			}
	 
            }
 	    
     	    this.echo('Capturing Screenshot...',"PARAMETER");
     	    click = false;
            this.capture(EL+'ExploredLink'+imageno+'.png', {
							top: 0,
							left: 0,
							width: 1000,
							height: 1000
	     });
	    imageno++;
 		
	    
            
           
    });
   
    
 }

function addLinks(link) {
			
			this.then(function() {
			
				   var found = this.evaluate(getLinks);
				   this.echo(found.length + " links found on " + link,"PARAMETER");

					for (var i=0;i<found.length;i++)
					{ 
						
						//this.echo("\n"+"Link " + i + found[i]+ "\n");
						var flag = true;
						var rep = found[i].substr(0,found[i].indexOf('?'));
						if(rep != "") 						
						found[i] = rep;
						else
						found[i] = found[i];

						for(var j =0; j<links.length;j++){
							if(host+found[i] == links[j]){
								flag = false;
							}
						}
						if(flag==true){
							
							if(found[i] != ""){
							//this.echo("Adding to array  "+found[i]+"\n");
							links.push(host+found[i]);
							}

						}	
					
					}     
			});

	
			
	   
/***********************************************Handling MouseClick On Elements**********************/

           this.then(function(){
           this.echo("Performing a Click On CheckBoxes : " , "COMMENT");
           
			t = this.thenEvaluate(function(){
		
	        a = document.getElementsByTagName('input'); 
			for(var t=0;t<a.length;t++){
			  if(a[t].type == "checkbox")
			    a[t].click();
			}
			});
			
			this.then(function(){
			    this.capture(CL+'click'+imageno+'.png', {
				top: 0,
				left: 0,
				width: 1000,
				height: 1000
				   });
				imageno++;
			
			});
			
            });
			/****************************************************/
			this.then(function(){
           this.echo("Performing a Click On RadioBoxes : " , "COMMENT");
         
			t = this.thenEvaluate(function(){
		
	        a = document.getElementsByTagName('input'); 
			for(var t=0;t<a.length;t++){
			  if(a[t].type == "radio")
			    a[t].click();
			}
			});
			
			this.then(function(){
			    this.capture(CL+'radioclick'+imageno+'.png', {
				top: 0,
				left: 0,
				width: 1000,
				height: 1000
				   });
				imageno++;
			
			});
			
            });
			/***************************************************************************/
			this.then(function(){
            this.echo("Performing a Click On Buttons : " , "COMMENT");
         
			t = this.thenEvaluate(function(){
		
	        a = document.getElementsByTagName('input'); 
			for(var t=0;t<a.length;t++){
			  if(a[t].type == "button")
			    a[t].click();
			}
			});
			
			this.then(function(){
			    this.capture(CL+'buttonClick'+imageno+'.png', {
				top: 0,
				left: 0,
				width: 1000,
				height: 1000
				   });
				imageno++;
			
			});
			
            });
	  /********************************************************************************************/
          this.then(function(){
          this.echo("Performing a Click On Anchor Elements : " , "COMMENT");
          var anchors = this.evaluate(getanchors);
          var t,val=0,val1=0;
          var t_array = [];
     
				for(var i=0;i<anchors.length;i++){
				var temp = JSON.stringify(i);
				var a;
				var rel=[];
				t = this.evaluate(function(temp,a,rel){
				temp = eval ("(" + temp + ")");
				a = document.getElementsByTagName('a')[temp].getAttribute('id');
				a = 'a#'+a;
				rel.push(a);
				temp = rel;
				return temp;
				},{temp : temp,a : a,rel : rel});
				//this.echo(t);
				t_array[val1] = t;
				val1++;
				}
				
				for(var i=0;i<anchors.length;i++){
				var temp1 = JSON.stringify(i);
				var a1;
				var rel1=[];
				t = this.evaluate(function(temp1,a1,rel1){
				temp1 = eval ("(" + temp1 + ")");
				a1 = document.getElementsByTagName('a')[temp1].getAttribute('class');
				a1 = 'a.'+a1;
				rel1.push(a1);
				temp1 = rel1;
				return temp1;
				},{temp1 : temp1,a1 : a1,rel1 : rel1});
				//this.echo(t);
				t_array[val1] = t;
				val1++;
				}
				
				var fin_anchor= [];
				for(var g=0;g<t_array.length;g++){
				 
				  if(t_array[g] != 'a#null' && t_array[g] != 'a#' && t_array[g] != 'a.null' && t_array[g] != 'a.'){
					 //this.echo('in if' + t_array[g]);
				 fin_anchor[val] = t_array[g];
				 val++;
				  }
				}
			   
			   var w=0;
			   for(var g=0;g<fin_anchor.length;g++){
			     var a = new String(fin_anchor[g]);
			     var fin1_arr=[];
			     if(a.indexOf(' ') < 0){		 
					var success = this.click(a);
					this.echo('Clicking on ' + fin_anchor[g] + ' is :'+ success,"PARAMETER");
					this.back();
			     }
			   }
}); 

/**************************************Handling Forms****************************************************************************/

            this.then(function(){
			this.echo("Testing Forms","COMMENT");
			var forms = this.evaluate(getForms);
			var suclogin;
			  
				   for(var i=0;i<forms.length;i++){
				     var x = JSON.stringify(i);
				     suclogin = this.thenEvaluate(function(x){
					 var arr = [],arrc=[],arrs=[],str,farr = [],farrc=[],farrs =[],arrr=[],farrr=[];
					 x = eval ("(" + x + ")");
				     var y = document.forms[x].elements;
						for(var u=0;u<y.length;u++){	  
						  if(y[u].type == "text" || y[u].type == "password" ){
							 arr.push(y[u].name);
						  }
						  if(y[u].type == "checkbox"){
						   
							 arrc.push(y[u].name);

						  }
						  if(y[u].type == "select-one" || y[u].type == "select-multiple" ){
							 arrs.push(y[u].name);
						  }
						  
						  if(y[u].type == "radio"){
							 arrr.push(y[u].name);
						  }
						   
						}	
						for(var t=0;t<arr.length;t++){
						   str = new String(arr[t]);
						   document.querySelector('input[name="'+str+'"]').setAttribute('value','admin');
						   farr.push(document.querySelector('input[name="'+str+'"]').value);
						}
						for(var t=0;t<arrc.length;t++){
						   str = new String(arrc[t]);
						   document.querySelector('input[name="'+str+'"]').checked = "checked";
						   //document.querySelector('input[id="'+str+'"]').checked = true;
						   farrc.push(document.querySelector('input[name="'+str+'"]').checked);
						  // farrc.push(arrc[t]);
						}
						for(var t=0;t<arrr.length;t++){
						   str = new String(arrr[t]);
						   document.querySelector('input[name="'+str+'"]').checked = true;
						   farrr.push(document.querySelector('input[name="'+str+'"]').value);
						}
						var a;
						for(var t=0;t<arrs.length;t++){
						   str = new String(arrs[t]);
						   document.getElementsByTagName('select[name="'+str+'"]').selectedIndex=2;
						   a = document.getElementsByTagName('select[name="'+str+'"]').selectedIndex;
						   //var b = document.getElementsByTagName('select[name="'+str+'"]').options[a].text;
						   farrs.push(a);
						} 
						//var action = document.forms[0].action;
						 document.forms[x].submit(); 
						 // return farrc;
						},{x : x});
						this.echo("This+"+suclogin);
						this.then(function(){
							   //this.echo(this.getCurrentUrl());
							   this.echo("Capturing Screenshot...","PARAMETER");	
									this.wait(10000,function(){
						   this.capture(FT+'Form'+imageno+'.png', {
						top: 0,
						left: 0,
						width: 1000,
						height: 1000
						   });
						imageno++;
						});	
					        if(Login == 0)
						{
						  // this.echo("Successful Login");
						}
						else{
						this.back();
						}
						});
						this.then(function(){
						 
						// this.echo(this.getCurrentUrl());
						});
				      }
			}); 
							 
 /******************************Simulating MouseOver****************************************************/
		this.then(function(){
					var lis = this.evaluate(getLItags);
					
					var t,vall=0,vall1=0;
					var l_array = [];
				        this.echo('Performing MouseOver..',"COMMENT");
					for(var i=0;i<lis.length;i++){
						var temp = JSON.stringify(i);
						var a;
						var rel=[];
						t = this.evaluate(function(temp,a,rel){
							temp = eval ("(" + temp + ")");
							a = document.getElementsByTagName('li')[temp].getAttribute('id');
							if(a!=null){
							a = 'li#'+a;
							rel.push(a);
							temp = rel;
							return temp;
							}
							else
							 return 0;
							
						},{temp : temp,a : a,rel : rel});

						if(t !=0)
						{
						l_array[vall1] = t;
						vall1++;
						}
						
					}
					for(var h=0;h<l_array.length;h++)
					{
					  str = new String(l_array[h]);		  
					  this.echo('Element Examined :' + str,"PARAMETER");
					  this.mouse.move(str);	
					  this.echo('Capturing Screenshot...',"PARAMETER")
					  this.capture(ME+'MouseEvent'+imageno+'.png', {
									top: 0,
									left: 0,
									width: 1000,
									height: 1000
					   });
					  imageno++;
					}
		    }); 
		/*****************************************Handling DropDowns***********************************/

                this.then(function(){
					var select = this.evaluate(getDropDowns);
					var d_array = [];
					var vald =0;
							this.echo('Testing Drop Downs...',"COMMENT");
					for(var i=0;i<select.length;i++){
					var temp4 = JSON.stringify(i);
					//this.then(function(){
					var rel=[],t;   
					   t = this.evaluate(function(temp4,rel){
					temp4 = eval ("(" + temp4 + ")");
					document.getElementsByTagName('select')[temp4].selectedIndex=2;
					var a = document.getElementsByTagName('select')[temp4].selectedIndex;
					var b = document.getElementsByTagName('select')[temp4].options[a].text;
							var c = document.getElementsByTagName('select')[temp4].getAttribute('id');
					//c = 'select#'+c;
							temp4 = c;
					rel.push(b);
					return temp4;
					},{temp4 : temp4,rel : rel});
							this.echo("Element Examined : "+t,"PARAMETER")
					this.echo("Capturing ScreenShot...","PARAMETER");
					this.capture(DD+'DropDown'+imageno+'.png', {
					top: 0,
					left: 0,
					width: 1000,
					height: 1000
					});
					imageno++;

		           }
                });
	
	
}
function getLItags()
{
  var lis = document.getElementsByTagName('li'); 
   return lis;
}
function getDropDowns()
{
  var select = document.getElementsByTagName('select'); 
   return select;

}
function getForms()
{
   var forms = document.getElementsByTagName('form'); 
   
   return forms;
}
function getanchors()  {
       var links = document.getElementsByTagName('a'); 
	   
	   return links;
}

function getLinks()  {
   
     var links = document.querySelectorAll('a');   
    return Array.prototype.map.call(links,function(a) {
        return a.getAttribute("href");
    });
   
}
function getCount()  {
   
     var count = document.querySelectorAll('input');   
    return Array.prototype.map.call(count,function(a) {
        return a.getAttribute("name");
    });
   
}

function getCountVal(){
   var value = document.getElementsByName('PageHeadCount')[0].value; 
   return value;
}

function main() {
    if (links[currentLink] && currentLink < upTo) {
       
        start.call(this, links[currentLink]);
        addLinks.call(this, links[currentLink]);
        currentLink++;
        this.run(main);
    } else {
        this.echo("All done.");
        this.exit();
    }
}

casper.start().then(function() {
    this.echo("Starting Casper...","INFO");
});

casper.run(main);
/***  casperjs --cookies-file=/tmp/cookies2.txt  --proxy=localhost:6789 casper.js http://localhost:8080/test.html  ***/
