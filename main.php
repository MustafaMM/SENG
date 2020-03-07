<!DOCTYPE html> 	<!--  Instruction to the web browser about what version of HTML the page is written in. --> 
<html> 			
      
<head> 		
	   <!-- a container for metadata (data about data) about the document. -->
    <title> 		
	    <!-- Defines the title. -->
        How to call PHP function 
        on the click of a Button ? 
    </title> 
</head> 
  
<body style="text-align:center;"> 
      
    <h1 style="color:green;"> 
       Paper Submission System
    </h1> 
      
    <h4> 
       Welcome to the webpage! Please select whether you are a researcher or reviewer.
    </h4> 
      
    <?php
	#Start PHP code interpretation.
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        else if(array_key_exists('button2', $_POST)) { 
            button2(); 
        } 
        else if(array_key_exists('button3', $_POST)) {
            button3($_POST["filename"]);
        }
        else if(array_key_exists('button4', $_POST)) {
            button4($_POST["filename"]);
        }
        function button1() { 
            //echo "This is Button1 that is selected"; 
            header("Location: work.php");
        } 
        function button2() { 

                $files = scandir("uploads");
		$db = new SQLite3("submitted_works.db");
                //print_r($files);
                for($a = 2; $a < count($files); $a++)
                    {
			
			$q = $db->prepare("SELECT * FROM submissions WHERE name=?");			
			$q->bindValue(1, $files[$a]);			
			$result = $q->execute();
			$row = $result->fetchArray();
                        //displaying links to download
                        //making it downloadable
                        ?>
                        <p>
                        <a download="<?php echo $files[$a] ?>" href="uploads/<?php echo $files[$a] ?>"><?php echo $files[$a] ?></a>
			<div><?php echo $row[1]?></div>
                                <form method="post"> 
                                <input type="submit" name="button3" 
                                       class="button" value= "Accept"/>
                                <input type="submit" name="button4" 
                                       class="button" value= "Reject"/>
				<input type="hidden" name="filename" value="<?php echo $files[$a] ?>">
                                </form> 
                        </p>
                        <?php
                    }   
			$db->close();
        } 
        function button3($filename){
	    $db = new SQLite3('submitted_works.db');
	    $q = $db->prepare("REPLACE INTO submissions (name, status) VALUES(?,'Accepted')");
	    $q->bindValue(1, $filename);
	    $q->execute();
	    $db->close();
	    
            echo '<span style="color:#12EB2B;text-align:center;">You have accepted the submission!</span>';
        }
        function button4($filename){
	    $db = new SQLite3('submitted_works.db');
	    $q = $db->prepare("REPLACE INTO submissions (name, status) VALUES(?,'Rejected')");
	    $q->bindValue(1, $filename);
	    $q->execute();
	    $db->close();
            echo '<span style="color:#F10719;text-align:center;">You have rejected the submission.</span>';
        }
    #End PHP code interpretation.    
    ?> 
  
    <form method="post"> 
        <input type="submit" name="button1"
                class="button" value="Researcher" /> 
          
        <input type="submit" name="button2"
                class="button" value="Reviewer" /> 
    </form> 
</head> 
  
</html> 
