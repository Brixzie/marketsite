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

        <br>
        <h2>List your space</h2>
        <p>Please enter information about the space that you're interested in renting out</p>

        <form action="" method="post">

            <div class="field">
                <label for="sqm">Size of storage</label>
                <input type="number" name="sqm" value="">
            </div>

            <div class="field">
                <label for="price">Price</label>
                <input type="number" name="price" value="">
            </div>
            <!-- Token is unique to this page 
            <input type = "hidden" name = "token" value ="<?php echo Token::generate(); ?>">
            -->
            <input type = "submit" value = "Search"> 

        </form>                  
</body>
</html>

<?php
    #$test = new User();
    #$result = $test->testSearchSpace();
    #if(!$result)
    #if(Input::exists() && Token::check(Input::get('token'))){
    if(Input::exists()){
        $result = DB::getInstance();
        if(Input::get('price')){#If price is set
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
        }
    }
?>

