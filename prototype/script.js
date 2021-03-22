//generate a table of images

function makeList(){
    //make list based on start
    let listData = [
        'beans.png',
        'apple-1.png'
        
    ],
    listContainer = document.getElementById('image-select-grid'),
    listElement = document.getElementById('image-list'),
    numberOfListItems = listData.length,
    listItem,
    i,
    startPath = "135541-gastronomy-set/png/";
    //make conditional based on startPath

    for(i = 0; i < numberOfListItems; ++i){
        listItem = document.createElement('li');

        listItem.innerHTML = "<img src='" + startPath + listData[i] + "'>"+ "</img>";

        listElement.appendChild(listItem);
    }
}

makeList();