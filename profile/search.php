<?php  
 $connect = mysqli_connect("localhost", "rosetelegram", "I*bGqOV#^X=7", "rosetelegramdb");  
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      //$query = "SELECT * FROM nominated_leader WHERE leader_name LIKE '%".$_POST["query"]."%'";  
	 $query = "SELECT DISTINCT leader_name, count(total_nominated) as tot,leader_name FROM nominated_leader WHERE category ='".$_POST["category"]."' AND country ='".$_POST["country"]."' AND leader_name LIKE '".$_POST["query"]."%' OR soundex(leader_name)= soundex('".$_POST["query"]."') GROUP BY leader_name";
	 
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           { 
		   		if($row["tot"] != 0){ 
                $output .= '<li>'.$row["leader_name"].' ('. $row["tot"]. ' Nominated )'.'</li>';
				}
				else
				{
					$output .= '<li>'.' Be the First One To Nominate '.'</li>';
				}
           }  
      }  
      else  
      {  
           $output .= '<li>Leader  Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>  