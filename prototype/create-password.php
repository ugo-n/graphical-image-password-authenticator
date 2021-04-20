<?php
include 'common.php';
$foodnames = file_get_contents("food_names.txt");
    $animalnames = file_get_contents("animal_names.txt");
    $transportnames = file_get_contents("transport_names.txt");
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
        var count = 0;
        var password;
        var tracker = new Map();
        var animalArray =  
            <?php echo json_encode($animalarray); ?>; 
        var tranportArray =  
            <?php echo json_encode($transportarray); ?>; 
        
        var foodArray =  
            <?php echo json_encode($foodarray); ?>; 

        function makeList(num){
            //make list based on start
            var listData,
            listContainer = document.getElementById('image-select-grid'),
            listElement = document.getElementById('image-list'),
            listItem,imageItem,
            i,
            startPath = "icons/",
            type = num;
            //make conditional based on startPath
            switch(type){
                case 1:
                listElement = document.getElementById('image-list'),
                listData = foodArray;
                break;
                case 2:
                listElement = document.getElementById('t-image-list'),
                listData = tranportArray;
                break;
                case 3: 
                listElement = document.getElementById('a-image-list'),
                listData = animalArray;
                break;
                default:
                break;
            }

            var numberOfListItems = listData.length;

            for(i = 0; i < numberOfListItems; ++i){
                listItem = document.createElement('li');
                imageItem = document.createElement('img');
                imageItem.setAttribute('src', startPath + listData[i] + ".png");

                //listItem.innerHTML = "<img src='" + startPath + listData[i] + ".png'>"+ "</img>";

                //set ID attribute to each list container
                //may conflict, since we have multipe lists yet same IDs possibly
                imageItem.setAttribute("id", listData[i]);
                imageItem.setAttribute("class", "pass-choice")
                listItem.appendChild(imageItem);

                listElement.appendChild(listItem);
            }
        }

        function makeLists(){
            makeList(2);
            makeList(1);
            makeList(3);

            var imageSelect = document.getElementById("images-selected").childNodes;

            //create onclick events
            let imgs = document.querySelectorAll('.pass-choice');

            var selectImg;
            
            for (i of imgs) {
                i.addEventListener('click', function() {
                    //console.log(imageSelect[count])
                    //if all images for password have not been selected
                    if(count <= 4){
                        //check if this image has already been chosen
                        if(!tracker.has(this.id)){
                            //if not chosen yet, select image
                            tracker.set(this.id);
                            password += this.id + ",";
                            selectImg = '<img src = "icons/'+this.id+'.png" class = "'+ this.id + '"</img>';
                            //imageSelect[count].style.backgroundImage = "url('icons/" + this.id + ".png')";
                            imageSelect[count].innerHTML = selectImg
                            count++;
                        }   
                    }
                    console.log(password);
                });
            }
        }
        
        function clearIntro(){
            document.getElementById("instructions").style.display = "none";
        }
        function clearSelect(){
            var imageSelect = document.getElementById("images-selected").childNodes;
            for(var i = 0; i <= 4; i++){
                imageSelect[i].innerHTML = "";
                imageSelect[i].class = "";
            }
            tracker.clear();
            password = "";
            count = 0;
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
<body onload="makeLists()">
<!--display of the page-->

<div id = "pass-category">
    <h2>Create a Password:</h2>
    <button id = "btn" onclick="showFood()"> food list</button>
    <button id = "btn1" onclick="showTransport()"> transport list</button>
    <button id = "btn2" onclick="showAnimal()"> animal list</button>
</div>

<div id="grid-container">
    <div id="instructions">
        <p>Choose 5 images from the different categories to create your password!</p>
        <p>Choose different categories using the buttons above the grid</p>
        <p>Clear your selection at any time by pressing the 'clear selection' button</p>
        <p>Click submit once you're done!</p>
        <button id = "clear-intro" onclick="clearIntro()"> Clear intro</button>
    </div>
    <div id="image-select-grid">

        <ul id="image-list"> 
            <!--generate list in js of all icons for category-->
        </ul>
        <ul id="a-image-list">
        </ul>
        <ul id="t-image-list">
        </ul>

    </div>
</div>

<h2>Chosen Images:</h2>
<div id="password-display">
    <ul id="images-selected"><li id = "image-1"></li><li id = "image-2"></li><li id = "image-3"></li><li id = "image-4"></li><li id = "image-5"></li></ul>
    <br>
    <button id = "clear" onclick="clearSelect()"> clear selection </button>
</div>
<?php
pFooter();
?>

