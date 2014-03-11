/*************************************************************************************
This is the Controller.  It will handle input from the User as well as local storage
on a User's Device.  It is also the middle man between server interaction and our Views.

Created by: Nathan Larson
*************************************************************************************/



/*************************************************************************************
This function is optional but it can display all of the available quizzes that are in 
the MySQL Database as well as what quizzes are stored locally. (Ran when body loads)
*************************************************************************************/

function getQuizzes()
{

var value = "nothing"; // IF we end up needing to pass something here we can.

$.post("model.php",
  {
    value:value
  },
  function(data,status){
  
  document.getElementById("availableQuizzes").innerHTML = data;
  
  });

}


/*************************************************************************************
If the user downloads a quiz from our MySQL Database, this function will store it in
Local Storage.
*************************************************************************************/

function downloadQuiz(quizID)
{

var quizID = document.getElementById("quizID").value;

$.post("model.php",
  {
    quizID:quizID
  },
  function(data,status){
  
  document.getElementById("availableQuizzes").innerHTML = data; //Put it in a hidden div.
  
  	var questionCount = document.getElementById("questionCount").value;
	var uploadToServer = document.getElemenyById("uploadToServer").value;

	for (var i = 1; i <= questionCount; i++)
	{

			var question1 = document.getElemenyById("question" + i).value;
			var choice1 = document.getElemenyById("question" + i + "choice1").value;
			var choice2 = document.getElemenyById("question" + i + "choice2").value;
			var choice3 = document.getElemenyById("question" + i + "choice3").value;
			var choice4 = document.getElemenyById("question" + i + "choice4").value;
			var question1Answer = document.getElemenyById("question" + i + "Answer").value;
			
			 localStorage.setItem("question" + i, question1);
			 localStorage.setItem("question" + i + "choice1", choice1);
			 localStorage.setItem("question" + i + "choice2", choice2);
			 localStorage.setItem("question" + i + "choice3", choice3);
			 localStorage.setItem("question" + i + "choice4", choice4);
			 localStorage.setItem("question" + i + "question1Answer", question1Answer);
			
			// Display something to the view to show that the saving of the quiz was completed.
  
  	}
  
  });

}


/*************************************************************************************
If the user creates their own quiz, this will store it in Local Storage and also provides
an option if they want to store it on the server.
*************************************************************************************/

function storeQuiz()
{

var questionCount = document.getElementById("questionCount").value;
var uploadToServer = document.getElemenyById("uploadToServer").value;

	for (var i = 1; i <= questionCount; i++)
	{
	
		if(uploadToServer == "No"){
	
			var question1 = document.getElemenyById("question" + i).value;
			var choice1 = document.getElemenyById("question" + i + "choice1").value;
			var choice2 = document.getElemenyById("question" + i + "choice2").value;
			var choice3 = document.getElemenyById("question" + i + "choice3").value;
			var choice4 = document.getElemenyById("question" + i + "choice4").value;
			var question1Answer = document.getElemenyById("question" + i + "Answer").value;
			
			 localStorage.setItem("question" + i, question1);
			 localStorage.setItem("question" + i + "choice1", choice1);
			 localStorage.setItem("question" + i + "choice2", choice2);
			 localStorage.setItem("question" + i + "choice3", choice3);
			 localStorage.setItem("question" + i + "choice4", choice4);
			 localStorage.setItem("question" + i + "question1Answer", question1Answer);
			
			// Display something to the view to show that the saving of the quiz was completed.
		
		}else{
		
			var question1 = document.getElemenyById("question" + i).value;
			var choice1 = document.getElemenyById("question" + i + "choice1").value;
			var choice2 = document.getElemenyById("question" + i + "choice2").value;
			var choice3 = document.getElemenyById("question" + i + "choice3").value;
			var choice4 = document.getElemenyById("question" + i + "choice4").value;
			var question1Answer = document.getElemenyById("question" + i + "Answer").value;
			
			 localStorage.setItem("question" + i, question1);
			 localStorage.setItem("question" + i + "choice1", choice1);
			 localStorage.setItem("question" + i + "choice2", choice2);
			 localStorage.setItem("question" + i + "choice3", choice3);
			 localStorage.setItem("question" + i + "choice4", choice4);
			 localStorage.setItem("question" + i + "question1Answer", question1Answer);
		
			$.post("model.php",
  			{
    			question1:question1,
    			choice1:choice1,
    			choice2:choice2,
    			choice3:choice3,
    			choice4:choice4,
    			question1Answer:question1Answer
  			},
  			function(data,status){
  
  				document.getElementById("").innerHTML = data; // A message saying it was finished.
  
  			});
		
		}
		

	}


}



/*************************************************************************************
This will handle any input from the user for their quiz questions. This is what handles 
it if the quiz is on local storage. (Which is the only option). I Use JQuery, because
I like it, and it simplifies the process.
*************************************************************************************/
$(document).ready(function() {

$(document).on("click",".classOfAnswers",function(){

var id = $(this).attr('id');
var choice = document.getElementById(id).value;

var questionID = document.getElementById("").value; // I would suggest using a hidden <input> to store the question Id.

var answer =  document.getElementById("result").innerHTML=localStorage.getItem(questionID);

// We compare the two.
if (choice.localeCompare(answer) == 0){

// Change some stuff on the view to show that it was the correct answer.

}else{

// Change some stuff on the view to show that it was the wrong answer.

}


});

});

