<?php 

try {
    $sothu1 = 6;
    $sothu2 = 0;
    echo "ket qua: ". $sothu1/$sothu2;    
}  catch(DivisionByZeroError $e){
    echo "got $e";
} catch(ErrorException $e) {
    echo "got $e";
}

echo "still working here";