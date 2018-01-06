<?php
//To show the issues
function showIssues($dbc,$sid){
    $query = "SELECT * FROM t_issues WHERE s_ID =".$sid." ORDER BY i_ID DESC";
    $getIssues = @mysqli_query($dbc,$query);
    if($getIssues){
        if (mysqli_num_rows($getIssues) > 0){
            while($row = mysqli_fetch_array($getIssues)){?>
                <div class="issue">
                    <div class="action"> 
                        <div class="opts2">
                            <div class="cat"><?php echo $row['i_Category']?></div>
                            <div class="cat"><?php echo $row['i_Severity']?></div>
                            <div onclick="edit(<?php echo $row['i_ID'] ?>)" class="edit"><img src="_images/icon_edit2.png" width="30px"></div>
                        </div>
                        <?php echo $row['i_Details'];?>
                    </div> 
                    <div class="punishment">
                        <?php echo $row['i_Recommendation'] ?>
                        <div class="from">
                            <span>by</span>
                            <?php echo admin($dbc,$row['a_ID']);?>
                        </div>
                    </div>
                </div>    
            <?php
            }
        }else{
            echo '<div class="clean"><img src="_images/icon_clean.png"> No Issues </div>';
        }
    }else{
        echo "Error".mysqli_error($dbc);
    }
}

function admin($dbc,$id){
   $query = "SELECT * FROM t_admins WHERE a_ID = ".$id;
   $getAdmin = mysqli_query($dbc,$query);
   $name = "";
   if ($getAdmin){
       while($row = mysqli_fetch_array($getAdmin)){
          return $row['a_Lastname']." ".$row['a_Firstname'];
       }
   }else{
       return "Cannot Retreive Admin";
   }
}
?>