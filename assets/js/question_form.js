/* QUESTION BUILDER	
	-INCLUDES-
	show / hide choices
	creating / removing choices
*/
	
/* hide/show choices section of add question form */
function hideChoice(radio){
	// find which radio button is selected
	var selected = radio[0].value;
	// selecting choices article
	var choices = document.getElementById('question_choices');
	// determine wheter or not to display 
	if(selected == 4 || selected == 5){
		choices.style.display = 'none';
	}else{
		choices.style.display = '';
	}// end if/else
}// end hideChoice()


var i = 0;
var count = 0;

function increment(){
	i += 1; 
}

/* remove selected choice from additional choice section of add question form */
function removeChoice(childDiv){
	var child = document.getElementById(childDiv);
	var parent = document.getElementById("additional_choices");
	parent.removeChild(child);
	count--;
}

/* add choice to additional choice section of add question form */
function addChoice(){
	// limit amount of added choices
	if(count === 6) return false;
	// create span 
	var s = document.createElement('span');
	// create input 
	var n = document.createElement("INPUT");
	// input attributes
	n.setAttribute("type", "text");
	n.setAttribute("Name", "choices[]");
	// create link
	var a = document.createElement("a");
	var t = document.createTextNode("x");
	a.appendChild(t);
	// run increment function to get id
	increment();
	// add to count of added inputs
	count++;
	// appending input to span
	s.appendChild(n);
	// onclick of a run removeChoice function pass id
	a.setAttribute("onclick", "removeChoice('id_" + i + "')");
	// appending remove link to span
	s.appendChild(a);
	// setting span id to i
	s.setAttribute("id", "id_" + i);
	// appending br to spans
	var br = document.createElement('br');
	s.appendChild(br);
	// appending span to form
	document.getElementById("additional_choices").appendChild(s);
}// end addChoice()