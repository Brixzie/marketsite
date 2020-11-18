

<?php
/*
Purpose:    sanitizes data going in (and out?) to/fram the DB.
How:        escape takes string argument and passes it to the htmlentities() 
            which sanitizes it from single and double quotes with ENT_QUOTES.
            UTF-8 defines character encoding 
#methods:   htmlenentities() 
#params: 
*/
function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}