<div class="bs-component">
    <table class="table table-striped table-hover ">

<?php

    $recherche = clean($_POST["recherche"]);
    $contents = file ("data/cars.csv");
    $trouve=FALSE;
    $opt='';
    
    if(isset($_POST['opt']) && !empty($_POST['opt'])){
	$Col1_Array = $_POST['opt'];
        if($Col1_Array[0]=='all'){
            $opt='12345';
        }
        else{
            foreach($Col1_Array as $selectValue){
            //affichage des valeurs sélectionnées
            //echo $selectValue."<br>";
            $opt .= (string)$selectValue;
            }
        }

    }
    
                    
    
    
    foreach ($contents as $key => $value)
    {
        $members = explode("|", $value);
        
        
        for($i=0, $ok=FALSE;$i<=4;$i++){
            
            $si = $i + 1;
            $si = (string)$si;
            $sopt = (string)$opt;
            
            
            if(stristr($sopt,$si)){
                
                $cell = clean($members[$i]);

                if(stristr($cell,$recherche))
                {
                    $trouve=$ok=TRUE;

                }                
            }
            

             
        }
        if($ok==TRUE)
        {
            echo "<tr><td>" . $members[0] . "</td><td>" . $members[1] . "</td><td>" . $members[2] . "</td><td>" . $members[3] . "</td><td>" . $members[4] ."</td></tr>";
        }
    }
    
    if($trouve==FALSE)
    {
        echo '<tr><td>"'.$recherche.'" non trouvé dans la liste</td></tr>';
    }
    // affiche : "terre" non trouvé dans la chaîne de caractères
    
    
?>

    </table>
</div>