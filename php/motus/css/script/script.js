var tab = new Array();
var couleur;
var bgcolor;
var proposition;
var colors;
var time;

var startTime = new Date();
var endTime = new Date();

function init(){

	for(i=0; i<6; i++){
	  	for(j=0; j<8; j++)
  		couleur[i][j] = "#0033CC";
   	}

	for(i=0; i<6; i++){
	  	for(j=0; j<8; j++)
  		bgcolor[i][j] = "#0033CC"; 
    }
	
	for(i=0; i<6; i++){
	   	proposition[i] = "********";
   }

}


function create(){

	couleur = new Array(6);
	for(i=0; i<6; i++){
    	couleur[i] = new Array(8);
	}

	bgcolor = new Array(6);
	for(i=0; i<6; i++)
		bgcolor[i] = new Array(8);

	proposition = new Array(6);
	init();
	
}


function setColors(colors){

	console.log("setColors:" + colors);

	for(i=0; i< colors.length; i++)
   		for(j=0; j< 8; j++)
    		bgcolor[i][j] = colors[i][j];
}


function setWords(){

	console.log("setWords:" + tab);

	for(i=0; i< tab.length; i++)
    	proposition[i] = tab[i];

	for(i=0; i<tab.length; i++){
	  	for(j=0; j<8; j++)
  		couleur[i][j] = "white"; 
	}
}

function wins(){

	for(j=0; j<8; j++){
		if (bgcolor[tab.length-1][j] != "red")
			return 0;
		}
	return 1;		
}



function td(i,j){
	var string;
	string = " <td align=\"center\" bgcolor=\""+bgcolor[i][j]+"\"> <b style=\" font-size:20px ;color:" + couleur[i][j] + "\">"+proposition[i][j]+"</b></td> \n"; 
	return string;

}

function drawMotus(){

var motus ='</br>\n<table border=\"2\" bordercolor=\"#FFFFFF\" style=\"background-color:#0033CC\" width=\"100%\" cellspacing=13 cellpadding=15 align=\"center\">\n';

	for(i=0; i<6; i++){
 		motus= motus + '<tr>\n';
  		for(j=0; j<8; j++){
   			motus = motus + td(i,j);
 		}
  	 motus = motus +'</tr>\n';
	}
  
  	motus = motus +'</table>\n </br>\n';

	var formulaire = "<input id=\"word\" type=\"text\" name=\"jouer\" class=\"controls\"> \n";
	formulaire 	   = formulaire + "<input id=\"send\" class=\"btn\" type=\"submit\" value=\"Jouer\"> </br>\n";

	if(wins()){
		  return motus = motus+"<div><div style=\"text-align:center\" class=\"alert alert-success\">Trouvé en " + time+"s</div></div>";
	}
	
	if(tab.length == 6){
		 return motus = motus+"<div><div style=\"text-align:center\" class=\"alert alert-error\">Perdu !!! </div></div>";
	}
	

	return motus+formulaire;
}

function writeScores(data){

var scores = "</br></br></br></br><div class=\"container\"><table class=\"table table-striped table-bordered\"> \n";
var tbody  = "<tbody><tr><th>Pseudo</th><th>Parties jouées</th><th>Parties gagnées</th><th>Temps moyens</th></tr>\n"
scores = scores + tbody;

for(i=0; i<data.length; i++){
var tr = "<tr><td>" + data[i]["pseudo"]+"</td><td>" + data[i]["played_games"]+"</td><td>"+data[i]["won_games"]+"</td><td>"+ data[i]["average_time"]+ " secondes</td></tr>\n";

scores = scores + tr;
}
scores = scores + "</table><div></br>";
console.log(scores);
return scores;
}

function runClientAction(data, actionName) {
	console.log(actionName);
	switch(actionName){
		case "Proposal": runProposalAction(data); break;
		case "GetScores":runGetScoresAction(data); break;
		
	}	
}

function runGetScoresAction(data){

	var scores = writeScores(data);
	$('#motus').html(''); 
	$('#scoreboard').html(scores); 
	

}

function runProposalAction(data){
var verif = "verif: "+ data;
	console.log(verif);
	colors = data;
	setColors(colors);
	setWords();
	$('#motus').html(drawMotus()); 

}



function runErrorAction(data) {

}

function runServerAction(actionName, data) {
console.log(actionName);


$.ajax({ 

  type: "POST",
  url: "index.php?action="+actionName,
  data: data,
  dataType: 'json',
  success: function(data){
           	runClientAction(data, actionName);
   }

});

}


function sendWord() {

tab.push($("#word").val());
var string = $("#word").val();

if(string.length!= 8){
$('#error').html("<div style=\"text-align:center\" class=\"alert alert-error\">Vous devez entrer un mot de huit lettres !!! </div>");
console.log("taille du mot: "+ string.length);
return 1;
}
runServerAction("Proposal", {
word: $("#word").val(),
tableau:tab,
chrono: time
 });

}

function getScores() {

runServerAction("GetScores", { });

}






$(document).ready(function() {
create();

start = startTime.getTime();


$(document ).on( "click", "#send", function() {
  end = new Date().getTime();
  time = end - start; 
  console.log(time = Math.round(time/1000));
  sendWord();
});

$(document).on( "click", "#currentGameSession", function() {
	$('#scoreboard').html(''); 
	$('#motus').html(drawMotus()); 
	console.log("Partie en cours");

});

$(document).on( "click", "#scores", function() {
	getScores();
	console.log("Récupération du scores");

});


});


