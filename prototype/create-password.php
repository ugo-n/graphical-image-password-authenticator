<?php
include 'common.php';
$foodnames = file_get_contents("files.txt");
    $animalnames = file_get_contents("animals.txt");
    $transportnames = file_get_contents("transport.txt");
    $foodarray = explode("\n", $foodnames);
    $animalarray = explode("\n", $animalnames);
    $transportarray = explode("\n", $transportnames);



?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Password Prototype</title>
    <link rel="stylesheet" href="prototype.css">

    <!--script for generating images-->
    <!--needs to be cleaned,,,-->
    <script type="text/javascript">
        var type = 1;
        var animalArray =  
            <?php echo json_encode($animalarray); ?>; 
        var tranportArray =  
            <?php echo json_encode($transportarray); ?>; 
        
        var foodArray =  
            <?php echo json_encode($foodarray); ?>; 
        var animalgrid = document.getElementById("a-image-list");
        var foodgrid = document.getElementById("image-list");
        var transportgrid = document.getElementById("t-image-list");

        function makeList(num){
            //make list based on start
            var listData,
            listContainer = document.getElementById('image-select-grid'),
            listElement = document.getElementById('image-list'),
            listItem,
            i,
            startPath = "",
            type = num;
            //make conditional based on startPath
            switch(type){
                case 1: startPath = "135541-gastronomy-set/png/";
                listElement = document.getElementById('image-list'),
                listData = foodArray;
                break;
                case 2: startPath = "741397-transport/png/";
                listElement = document.getElementById('t-image-list'),
                listData = tranportArray;
                break;
                case 3: startPath = "3969721-animals/png/";
                listElement = document.getElementById('a-image-list'),
                listData = animalArray;
                break;
                default:
                break;
            }

            var numberOfListItems = listData.length;

            for(i = 0; i < numberOfListItems; ++i){
                listItem = document.createElement('li');

                listItem.innerHTML = "<img src='" + startPath + listData[i] + "'>"+ "</img>";

                listElement.appendChild(listItem);
            }
        }

        function makeLists(){
            makeList(2);
            makeList(1);
            makeList(3);
        }
        

        function showAnimal(){
            document.getElementById("a-image-list").style.display = "block";
            document.getElementById("t-image-list").style.display = "none";
            document.getElementById("image-list").style.display = "none";
        }
        function showFood(){
            document.getElementById("a-image-list").style.display = "none";
            document.getElementById("t-image-list").style.display = "none";
            document.getElementById("image-list").style.display = "block";
        }
        function showTransport(){
            document.getElementById("a-image-list").style.display = "none";
            document.getElementById("t-image-list").style.display = "block";
            document.getElementById("image-list").style.display = "none";
        }

        
</script>
</head>
<body>
<!--display of the page-->
<button onclick="makeLists()"> show list</button>
<button onclick="showFood()"> food list</button>
<button onclick="showTransport()"> transport list</button>
<button onclick="showAnimal()"> animal list</button>
<div id="image-select-grid">
    <ul id="image-list"> 
        <!--generate list in js of all icons for category-->
    </ul>
    <ul id="a-image-list">
    </ul>
    <ul id="t-image-list">
    </ul>
    <ul id="images-selected">
        <li id = "image-1"></li>
        <li id = "image-2"></li>
        <li id = "image-3"></li>
        <li id = "image-4"></li>
        <li id = "image-5"></li>
    </ul>
</div>

<?php
pFooter();
?>

