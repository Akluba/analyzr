<div id="side_container">
	<h2><strong>Add a Question</strong></h2>
	
	<?php
		echo form_open('survey/add_question/'.$survey_id , array('id'=>'the_form'))."\n";
		
		$js = 'onClick="hideChoice([question_type])"';
		
		echo '<article>';
		echo '<h4>Question type:</h4>';
		echo form_label('radio: ') ."\n";
		echo form_radio('question_type',1,TRUE,$js);
		
		echo form_label('checkbox: ') ."\n";
		echo form_radio('question_type',2,FALSE,$js);
		
		echo form_label('dropdown: ') ."\n";
		echo form_radio('question_type',3,FALSE,$js);
		
		echo form_label('input: ') ."\n";
		echo form_radio('question_type',4,FALSE,$js);
		
		echo form_label('textarea: ') ."\n";
		echo form_radio('question_type',5,FALSE,$js);
		echo '</article>' ."\n";
		
		
		echo '<article>' ."\n";
		echo '<h4>Question:</h4>' ."\n";
		$data = array(
			'name' => 'question_text',
		);
		echo form_textarea($data) ."\n";
		echo '</article>' ."\n";
		
		
		echo '<article id="question_choices">' ."\n";
		echo '<h4>Choices:</h4>' ."\n";
		echo form_input('choices[]') ."<br />";
		echo form_input('choices[]') ."<br />";
		echo '<div id="additional_choices"></div>';
		echo '<p onclick="addChoice()" >add choice</p>' ."\n";
		echo '</article>' ."\n";	
			
			
		echo '<article>' ."\n";
		echo '<h4>Options:</h4>' ."\n";
		echo form_checkbox('question_require',1,FALSE) ."\n";
		echo form_label('Answer required ') ."\n";
		echo '</article>' ."\n";
		
		echo '<div id="errors"></div>';
		echo validation_errors();
		
		echo form_submit('submit', 'Add Question')."\n";
		
		echo form_close()."\n";
	?>
</div>



<script> 
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
	
	
	
	$("#the_form").submit(function(event) {
		
		event.preventDefault();
		
		// getting selected radio input
		var r = document.getElementsByName('question_type');
		for (var i = 0, length = r.length; i < length; i++) {
		    if (r[i].checked) {
		        // checked radio
				var selected = r[i].value;
		        // stop checking when selected is found
		        break;
		    }
		}
		
		// Rachel's code snippet
		var myForm = document.getElementById("the_form");
		//Extract Each Element Value
		data = {}
	    for (var i = 0; i < myForm.elements.length; i++) {
	        if(myForm.elements[i].name.indexOf('[]') > -1){
	            var name = myForm.elements[i].name.replace('[]','');
	            if(data[name] === undefined) data[name] = [];
	            data[name].push(myForm.elements[i].value);
	        }else if(myForm.elements[i].name == 'question_type'){
		        data[myForm.elements[i].name] = selected
	        }else{
	           data[myForm.elements[i].name] = myForm.elements[i].value
	        }
	
	    }
		
		
		$.ajax({
			type: "POST",
			url: "../add_question/<?php echo $survey_id; ?>",
			dataType: 'json',
			data: data,
			success: function(res) {
				
				console.log(res);
				// $('#errors').append(res['text'], res['choice']);
			}
		});
	});
	
	
	
	
	/*
document.getElementById('the_form').onsubmit = function(event){
		
		event.preventDefault();
		
		// getting selected radio input
		var r = document.getElementsByName('question_type');
		for (var i = 0, length = r.length; i < length; i++) {
		    if (r[i].checked) {
		        // checked radio
				var selected = r[i].value;
		        // stop checking when selected is found
		        break;
		    }
		}
		
		// Rachel's code snippet
		var myForm = document.getElementById("the_form");
		//Extract Each Element Value
		data = {}
	    for (var i = 0; i < myForm.elements.length; i++) {
	        if(myForm.elements[i].name.indexOf('[]') > -1){
	            var name = myForm.elements[i].name.replace('[]','');
	            if(data[name] === undefined) data[name] = [];
	            data[name].push(myForm.elements[i].value);
	        }else if(myForm.elements[i].name == 'question_type'){
		        data[myForm.elements[i].name] = selected
	        }else{
	           data[myForm.elements[i].name] = myForm.elements[i].value
	        }
	
	    }
	    console.log(data);
	    
	    
	    
	    var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				// not sure what to do here
			}
		}
		
		xmlhttp.open("POST","../add_question/<?php echo $survey_id; ?>",true);
		xmlhttp.send(data);
		
	    
		
	}
*/

	
	
	
	
	
</script>

