<!DOCTYPE html> 
<html> 
      
<head> 
    <title> 
      Paper Submission System
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
        session_start();
	include("database.php");
        $globaldata = array();
        $editorGlobalData = array();
        $editorDeadline;
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        else if(array_key_exists('button2', $_POST)) { 
            button2(); 
        } 
        else if(array_key_exists('button3', $_POST)) {
            button3($_POST["subId"]);
        }
        else if(array_key_exists('button4', $_POST)) {
            button4($_POST["subId"]);
        }
        else if(array_key_exists('submitButton', $_POST)) {
            submitButton();
        }
        else if(array_key_exists('editorButton', $_POST)) {
            editorButton();
        }
        else if(array_key_exists('assignButton', $_POST)) {
            assignButton();
        }
        else if(array_key_exists('editorSubmitButton', $_POST)) {
            editorSubmitButton();
        }
        else if(array_key_exists('editorDeadlineButton', $_POST)) {
            editorDeadlineButton();
        }
        function button1() { 
            //echo "This is Button1 that is selected"; 
            header("Location: work.php");
        } 
        function button2() { 

                $submissions = getAllSubmissions();
                //print_r($files);
                for($a = 0; $a < count($submissions); $a++)
                    {
			
                        //displaying links to download
                        //making it downloadable
                        ?>
                        <p>
                        <a download="<?php echo $submissions[$a][1] ?>" href="uploads/<?php echo $submissions[$a][1] ?>"><?php echo $submissions[$a][1] ?></a>
			    <div><?php echo $submissions[$a][2]?></div>
                                <form method="post"> 
                                <input type="submit" name="button3" 
                                       class="button" value= "Accept"/>
                                <input type="submit" name="button4" 
                                       class="button" value= "Reject"/>
				<input type="hidden" name="subId" value="<?php echo $submissions[$a][0] ?>">
                                </form> 
                        </p>
                        <?php
                    } 
                    //checkbox code. 
                    //holy fuck this was a mind fuck..
                    for($a = 0; $a < count($submissions); $a++)
                    {
                    ?>
                    <form method="post">
                     <input type="checkbox" name="data[]" value="<?php echo $submissions[$a][1] ?>" > <?php echo $submissions[$a][1]?>
                     
                     <?php
                    }
                    ?>
                        
                        <input type="submit" name="submitButton"
                               class="button" value="Submit" /> 
                        </form> 
                    <?php
        } 
        function button3($subId){
	    updateSubmissionStatus($subId, "Accepted");
	    
            echo '<span style="color:#12EB2B;text-align:center;">You have accepted the submission!</span>';
        }
        function button4($subId){
	    updateSubmissionStatus($subId, "Rejected");
            echo '<span style="color:#F10719;text-align:center;">You have rejected the submission.</span>';
        }
        function submitButton()
        {
            if(!empty($_POST["data"]))
            {
                global $globaldata;
                echo '<h3>you have selected the following</h3>';
                foreach($_POST["data"] as $data)
                {
                    echo '<p>' .$data. '</p>';
                    array_push($globaldata, $data);
                }
                $_SESSION['chosen'] = $globaldata;
            }
            else
            {
                echo 'please select at least one';
            }
        }

        function editorButton()
        {
            foreach($_SESSION['chosen'] as $key=>$value) 
            {
                echo "The reviewer would like to review: " .$value. "<br />";
            }
            ?>
            <form method="post"> 
            <input type="submit" name="editorDeadlineButton"
                    class="button" value="Assign" /> 
            </form>
            <?php
        }
        function assignButton()
        {
            echo "Now select the files you want to assign: ";
            $files = scandir("uploads");
            for($a = 2; $a < count($files); $a++)
                    {
                    ?>
                    <form method="post">
                     <input type="checkbox" name="editorData[]" value="<?php echo $files[$a] ?>" > <?php echo $files[$a]?>
                     
                     <?php
                    }
                    ?>
                        <input type="submit" name="editorSubmitButton"
                               class="button" value="Assign" />                     
                        </form> 
                    <?php
        }
        function editorDeadlineButton()
        {
            echo 'Please chose the deadline of the submissions first: ';
            ?>
            <form method="post">
            <input type="date" name="deadline" value="yyyy/mm/dd" />
            <input type="submit" name="assignButton"
                   class="button" value="Set Deadline" /> 
            </form> 
            <?php
            $exp_date = strtotime($_POST['deadline']);
            $deadlineLocal = date("Y-m-d",strtotime($exp_date));
            $_SESSION['deadlineSession'] = $deadline;

        }
        function editorSubmitButton()
        {
            if(!empty($_POST["editorData"]))
            {
                global $editorGlobalData;
                echo '<h3>you have assigned the following</h3>';
                foreach($_POST["editorData"] as $data)
                {
                    echo '<p>' .$data. '</p>';
                    array_push($editorGlobalData, $data);
                }
                $_SESSION['chosen'] = $editorGlobalData;
                global $editorDeadline;
                print_r($editorDeadline);
                echo " With the following deadline: " .$_SESSION['deadlineSession']. "<br>";
            }
            else
            {
                echo 'please select at least one';
            }            
        }
        
    ?> 
  
    <form method="post"> 
        <input type="submit" name="button1"
                class="button" value="Researcher" /> 
          
        <input type="submit" name="button2"
                class="button" value="Reviewer" />

        <input type="submit" name="editorButton"
                class="button" value="Editor" />  
    </form> 
</body> 
  
</html> 
