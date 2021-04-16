<?php 

    $animals = "./ANIMALS-php.txt";
    $foods = "./FILES-php.txt";
    $transport = "./TRANSPORT-php.txt";
    
    //2D Associative Arrays of each icon list
    $aniArr = get_arr($animals);
    $foodArr = get_arr($foods);
    $transArr = get_arr($transport);

    // Function to create php associative array of each icon list
    //e.g $aniArr[1] will print the inner array at index 1(in this case [name] => 002-snake)
    //while $aniArr[1]['name'] will be the value of [name] from that inner array, in this case '002-snake'
    function get_arr($txt)
    {
        $count = 0;
        $result = array(array());
        array_pop($result);

        foreach(file($txt) as $line)
        {
            $result[$count]['name'] = $line;
            $count++;
        }
        return $result;
    }
    // echo("\n");
    // print_r($aniArr);
    // print_r($aniArr[1]['name']);


    //Will Need a function to randomly select one of  2D associative arrays each iteration,
    //and then randomly select from the chosen array a random index
    //For  populating the Enter Password grid

    function get_item()
    {
        
    }
    ?>