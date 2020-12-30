<?php
    require_once 'core/init.php';
    include('templates/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
 
    <h2>Search for available listings</h2>                     
</body>
</html>

<?php
    #$test = new User();
    #$result = $test->testSearchSpace();
    #if(!$result)

    $result = DB::getInstance();
    $result->get("objects", array('available', '=', '0'));
    #$arrayResults = $result->results();
    #foreach($arrayResults as $value){
    #    echo $value;
    #}
    if(!$result->count()){
        echo "No objects";
    }else{
        foreach($result->results() as $result)
        echo $result->objName, '<br>';
    }
?>