<!DOCTYPE html> 
<html> 
      
<head> 
    <title> 
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
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        else if(array_key_exists('button2', $_POST)) { 
            button2(); 
        } 
        else if(array_key_exists('button3', $_POST)) {
            button3();
        }
        else if(array_key_exists('button4', $_POST)) {
            button4();
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
                                </form> 
                        </p>
                        <?php
                    }   
			$db->close();
        } 
        function button3(){
            echo '<span style="color:#12EB2B;text-align:center;">You have accepted the submission!</span>';
        }
        function button4(){
            echo '<span style="color:#F10719;text-align:center;">You have rejected the submission.</span>';
        }
        
    ?> 
  
    <form method="post"> 
        <input type="submit" name="button1"
                class="button" value="Researcher" /> 
          
        <input type="submit" name="button2"
                class="button" value="Reviewer" /> 
    </form> 
</head> 
  
</html> 
