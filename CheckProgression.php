<?php


/**********************************************************
 * This script checks if an entered sequence of integers,
 * separated by commas, is an arithmetic or geometric    
 * progression.                                       
 * The script is terminated via entering exit string.  
 *
 * @author     Igor Kolunov <igorkolunov@mail.ru>
 *
 **********************************************************/

// Check - if items in array are a geometric progression
function is_geometric_progression($arr)  
{  
    if (sizeof($arr) <= 1)  
        return True;  
    
    if ($arr[0] == 0)
        return false;
    // Calculate ratio  
    $ratio = $arr[1]/$arr[0];  
     
    // Check the ratio of the remaining  
    for($i=1; $i<sizeof($arr); $i++)  
    {  
        if ($arr[$i-1] == 0)
            return false; // Not a geometric sequence  

        if (($arr[$i]/($arr[$i-1])) != $ratio)  
            return false; // Not a geometric sequence  
    }          
  return true; // Geometric  sequence
}

// Check - if items in array are a arithmetic progression
function is_simple_arithmetic_progression($arr)  
  {  
   $delta = $arr[1] - $arr[0];  
   for($index=0; $index<sizeof($arr)-1; $index++)  
    {  
        if (($arr[$index + 1] - $arr[$index]) != $delta)  
        {  
             return false; // Not an arithmetic progression  
        }         
    }  
    return true; // An arithmetic progression  
} 

// Check - if items in array are a arithmetic progression of any order
function is_arithmetic_progression($arr)  
  {  
   if (is_simple_arithmetic_progression($arr) === true)
       return true;
   else {
       for($index=0; $index<sizeof($arr)-1; $index++)  
            $deltas[$index] = $arr[$index + 1] - $arr[$index];
       if (is_arithmetic_progression($deltas) === true)
           return true;
       else
           return false;
   }
    return true; // An arithmetic progression  
} 

 
echo "*******************************************************************\n";
echo "* This script checks if an entered sequence of integers,          *\n";
echo "* separated by commas, is an arithmetic (of 1-st, 2-nd and higher *\n";
echo "* order) or geometric progression.                                *\n";
echo "* The script is terminated via entering \"exit\" string.          *\n";
echo "*******************************************************************\n\n";

echo "Please enter a sequence of integers separated by commas.\n";
echo "To terminate the script please enter \"exit\".\n\n";

echo "Enter a Sequence to check >";

$nextSequence = true;

// To prevent troubles with identifying the PHP newlines when reading 
// stdin on a Macintosh-compatible computers
ini_set("auto_detect_line_endings", true);

stream_set_blocking(STDIN, 0);

do {
    // get entered line from a console (STDIN)
    $csv_ar = fgetcsv(STDIN);
    if (is_array($csv_ar)){
        if ($csv_ar[0] === null) {
            echo "No sequence was entered !\n\n";
            echo "Enter a Sequence to check >";
            continue;
        }
        
        if (strtolower($csv_ar[0]) === "exit") {
            exit ("Good by!");
        }

        $num = count($csv_ar);
        if ($num < 2) {
            echo "A sequence should contain more than a single element !\n\n";
            echo "Enter a Sequence to check >";
            continue;
            
            exit ("Good by!");
        }
        
        // validate entered elements
        $valid = true;
        foreach($csv_ar as $elt) {
            if (!is_numeric($elt)) {
                echo "\"".$elt."\" is not a numeric","\n";
                $valid = false;
            }
        }
        if ($valid === false) {
            echo "\n";
            echo "Enter a Sequence to check >";
            continue;
        }            
          
        $geom_progr   = is_geometric_progression($csv_ar);
        $arithm_progr = is_simple_arithmetic_progression($csv_ar);
        $progr = "";
        if ($geom_progr === true) {
            if ($arithm_progr === true)
                $progr = "an arithmetic and a geometric";
            else
                $progr = "a geometric";
        }
        else {
            if ($arithm_progr === true)
                $progr = "an arithmetic";
        }
        if ($progr === "") {
            $arithm_progr = is_arithmetic_progression($csv_ar);
            if ($arithm_progr === true)
               echo "It is arithmetic progression of 2-nd order of more higher order\n";
            else 
               echo "It is not an arithmetic or geometric progression\n";            
        }
        else
            echo "It is ".$progr." progression\n";

        echo "\n";
        echo "Enter a Sequence to check >";
            
    }
} while ($nextSequence == true);
?>