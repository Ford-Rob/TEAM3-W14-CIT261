<!DOCTYPE HTML>

<html>
    <head>
	<meta name="viewport" content="width=500" />

        <style>
		@media (max-width: 599px) and (min-width: 420px) {
			@-viewport {
			width: 500px;
			}
		}
            body {
            	background-image:url('BG.png');
		  }
		  .tab { 
			text-align:center;
			font-family: Arial,Calibri,sans-serif; 
			font-size: medium;
			
			}
		  #ccontainer{
		  width:450px;

		  margin: 0 auto;
		  margin-top:100px;
		  }

		  #myCanvas {
		//background:#FFFFFF;
            }

        </style>





        <script>
            window.onload = function(){
                var canvas = document.getElementById("myCanvas");
                var context = canvas.getContext("2d");
				var quizbg = new Image();
				var Question = new String;
				var Option1 = new String;
				var Option2 = new String;
				var Option3 = new String;
				var Option4 = new String;
				var mx=0;
				var my=0;
				var CorrectAnswer = 0;
				var qnumber = 0;
				var rightanswers=0;
				var wronganswers=0;
				var QuizFinished = false;
				var lock = false;
				var textpos1=45;
				var textpos2=145;
				var textpos3=235;
				var textpos4=325;
				var textpos5=410;
				var Questions = new Array;
				var Options = new Array;
				


        <?php


					 

					$datastr = "data".strval($_GET["q"]).".xml";
					$xml = simplexml_load_file($datastr);
					
					$counter= count($xml);
					 

					for($i=0;$i<$counter;$i++){
					echo "Questions[".$i."]='".$xml-> task[$i]->question ."';";
					echo "\n";
					echo "Options[".$i."]=['".$xml-> task[$i]->option[0] ."','";
					echo $xml-> task[$i]->option[1] ."','";
					echo $xml-> task[$i]->option[2]."','";
					echo $xml-> task[$i]->option[3]."'];";
					echo "\n";
					}

				
?>




				quizbg.onload = function(){
                                    startTimer();
                                    context.drawImage(quizbg, 0, 0);
                                    SetQuestions();
                                    };//quizbg
				quizbg.src = "quizbg4.png";



				SetQuestions = function(){

					Question=Questions[qnumber];
					CorrectAnswer=1+Math.floor(Math.random()*4);

					if(CorrectAnswer===1){Option1=Options[qnumber][0];Option2=Options[qnumber][1];Option3=Options[qnumber][2];Option4=Options[qnumber][3];}
					if(CorrectAnswer===2){Option1=Options[qnumber][2];Option2=Options[qnumber][0];Option3=Options[qnumber][3];Option4=Options[qnumber][1];}
					if(CorrectAnswer===3){Option1=Options[qnumber][1];Option2=Options[qnumber][3];Option3=Options[qnumber][0];Option4=Options[qnumber][2];}
					if(CorrectAnswer===4){Option1=Options[qnumber][3];Option2=Options[qnumber][2];Option3=Options[qnumber][1];Option4=Options[qnumber][0];}

					context.textBaseline = "middle";
					context.font = "24pt Calibri,Arial";
					context.fillText(Question,20,textpos1);
					context.font = "18pt Calibri,Arial";
					context.fillText(Option1,20,textpos2);
					context.fillText(Option2,20,textpos3);
					context.fillText(Option3,20,textpos4);
					context.fillText(Option4,20,textpos5);
                                        

				};//SetQuestions

				canvas.addEventListener('click',ProcessClick,false);

				function ProcessClick(ev) {

				mx=ev.x-canvas.offsetLeft;
				my=ev.y-canvas.offsetTop;
				
				if(ev.x === undefined){
					mx = ev.pageX - canvas.offsetLeft;
					my = ev.pageY - canvas.offsetTop;
				}

			if(lock){
				ResetQ();
			}//if lock

			else{

			if(my>110 && my<180){GetFeedback(1);}
			if(my>200 && my<270){GetFeedback(2);}
			if(my>290 && my<360){GetFeedback(3);}
			if(my>380 && my<450){GetFeedback(4);}

			}//!lock

				}//ProcessClick



		GetFeedback = function(a){

		  if(a===CorrectAnswer){
		  	context.drawImage(quizbg, 5,489,75,70,380,110+(90*(a-1)),75,70);
			rightanswers++;
			//drawImage(image, sx, sy, sWidth, sHeight, dx, dy, dWidth, dHeight)
		  }
		  else{
		    context.drawImage(quizbg, 80,489,75,70,380,110+(90*(a-1)),75,70);
			wronganswers++;
                        if(CorrectAnswer===1){
                            context.font = "18pt Calibri,Arial";
                            context.fillStyle = 'green';
                            context.fillText(Option1,20,textpos2);}
			if(CorrectAnswer===2){                            
                            context.font = "18pt Calibri,Arial";
                            context.fillStyle = 'green';
                            context.fillText(Option2,20,textpos3);}
			if(CorrectAnswer===3){
                            context.font = "18pt Calibri,Arial";
                            context.fillStyle = 'green';
                            context.fillText(Option3,20,textpos4);}                           
			if(CorrectAnswer===4){
                            context.font = "18pt Calibri,Arial";
                            context.fillStyle = 'green';
                            context.fillText(Option4,20,textpos5);}                                                   
		  }
		  lock=true;
		  context.font = "14pt Calibri,Arial";
                  context.fillStyle = 'black';
		  context.fillText("Click again to continue",20,465);
		};//get feedback


		ResetQ= function(){
		lock=false;
		context.clearRect(0,0,450,480);
		qnumber++;
		if(qnumber===Questions.length){EndQuiz();}
		else{
		context.drawImage(quizbg, 0, 0);
		SetQuestions();}
		};


		EndQuiz=function(){
                stopTimer();
		canvas.removeEventListener('click',ProcessClick,false);
		context.drawImage(quizbg, 0,0,450,90,0,0,550,480);
		context.font = "20pt Calibri,Arial";
		context.fillText("You have finished the quiz!",20,100);
		context.font = "16pt Calibri,Arial";
		context.fillText("Correct answers: "+String(rightanswers),20,200);
		context.fillText("Wrong answers: "+String(wronganswers),20,240);
		};
                startTimer=function(){
                    if(typeof(Worker)!=="undefined") {
                    if(typeof(w)==="undefined") {
                        w=new Worker("worker.js");
                        }
                    w.onmessage = function (event) {
                        document.getElementById("result").innerHTML=event.data;
                        };
                    } else {
                        document.getElementById("result").innerHTML="Sorry, your browser does not support Web Workers...";
                        }
                    };
                    stopTimer=function(){ 
                        w.terminate();
                        };
			};//windowonload

        </script>

        <title></title>
    </head>
    <body>

    <div id="ccontainer">
<canvas id="myCanvas" width="450" height="480"></canvas>
<p class="tab">Time: <output id="result"></output></p>
        </div>


</body>
</html>