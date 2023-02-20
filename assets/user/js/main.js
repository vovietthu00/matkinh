function search(str) {
    if (str.length == 0) {
        document.getElementById('search').innerHTML = '';
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("search").innerHTML = xmlhttp.responseText;
            }

        }
        xmlhttp.open("GET", "search.php?action=search&name=" + str, true);
        xmlhttp.send();
    }
}

