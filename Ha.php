<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Hash.css">
    <style>
        .d-align {
            text-align: right;
            padding-left: 400px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: whitesmoke;
            min-width: 160px;
            z-index: 1;
            box-shadow: 0px 8px 16px 0px azure;
            border: 1px whitesmoke;
            border-radius: 20px;
        }

        .dropdown-content a {
            color: black;
            font-weight: bolder;
            padding: 12px 16px;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .cart-table ,tr ,td,th {
            border: 2px black groove;
            margin-top: 60px;
            margin-left: 400px;
            position: relative;
            border-collapse: collapse;
        }

        .cart-link {
            padding: 20px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
            max-width: 600px;
        }

        .cart-price,
        .cart-qty {
            padding: 20px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
        }

        .qty-box {
            padding: 10px;
            border: none;
            width: 50px;


        }

        .cart-head {
            margin-top: 100px;
            font-weight: bold;
            color: gray;
            text-align: center;
        }

        .finalprice {
            text-align: center;
            margin-top: 30px;
            font-weight: bold;
            color: gray;
        }

        .btn {
            border: 1px solid transparent;
            background-color: maroon;
            color: white;
            font-weight: bold;
            padding: 8px;
            border-radius: 10px;
            outline: none;
        }

        .cbtn {
            border: 1px solid transparent;
            background-color: maroon;
            color: white;
            font-weight: bold;
            padding: 8px;
            margin-top: 30px;
            margin-left: 300px;
            border-radius: 10px;
            outline: none;
        }
        
    </style>
</head>

<body onload="before()">

    <div class="nav-bar">
        <h2>Infinite Learn</h2>
        <div class="Links">
            <a><i class="fa fa-user-circle-o"> </i>&nbsp; <?php echo $_SESSION["Username"]; ?> </a>&nbsp;&nbsp;
            <a href="#">Home</a>
            <div class="dropdown">
                <a href="#">Cart</a>
                <div class="dropdown-content">
                    <a href="#" onclick="showcart()">View Cart</a>
                    <a href="#" onclick="delcart()">Clear Cart</a>
                </div>
            </div>
            <a href="#" onclick="checkcartpayment()">Payment</a>
            <a href="Logout.php">Sign Out</a>
        </div>
    </div>
    <img class="image" src="ProjectLogo.png" height="55" width="200">
    <input class="search" id="keyword" type="text" size="50" placeholder="Search..." onkeypress="suggest()">&nbsp;
    <button onclick="searchinglink()" id="find"><i class="fa fa-search" style="color:white"></i></button>&nbsp;
    <button class="btn" onclick="showhistory()">View Search History</button> &nbsp;
    <button class="btn" onclick="delhistory()">Delete Search History</button>&nbsp;
    <button class="btn" onclick="showRecommendations()">Recommended for You</button>&nbsp;
    <div id="suggest"></div>
</body>
<script>
    var table = {}; //hashtable
    var items = []; //history stack
    var temp = []; // to get or store only name of link of pdf
    var v = ["obq", "Data Structures and Algorithms", "Javascript", "CSS", "Computer Architecture and Organisation", "Computer Networks", "Theory Of Computation", "Software Engineering", "Problem Solving and Programming"];
    var ls = [ //obq and CSS have same hash function just added to show quadratic probing works
        ["https://www.google.com"],
        ["https://gateoverflow.in/", "https://www.youtube.com/watch?v=zWg7U0OEAoE&list=PLBF3763AF2E1C572F", "https://web.ist.utl.pt/~fabio.ferreira/material/asa/clrs.pdf", "https://ocw.mit.edu/courses/electrical-engineering-and-computer-science/6-006-introduction-to-algorithms-fall-2011/", "http://www.musaliarcollege.com/e-Books/CSE/Data%20structures%20algorithms%20and%20applications%20in%20C.pdf", "https://www.youtube.com/channel/UCZCFT11CWBi3MHNlGf019nw"],
        ["https://skillcrush.com/blog/javascript/", "https://www.w3schools.com/js/DEFAULT.asp", "https://www.tutorialspoint.com/javascript/index.htm", "https://javascript.info/", "https://eloquentjavascript.net/Eloquent_JavaScript.pdf"],
        ["https://www.tutorialspoint.com/css/index.htm", "https://www.w3schools.com/css/", "https://css-tricks.com/"],
        ["https://www.geeksforgeeks.org/computer-organization-and-architecture-tutorials/", "https://www.pdfdrive.com/computer-organisation-and-architecturecarl-hamacher-e60361037.html"],
        ["https://www.geeksforgeeks.org/computer-network-tutorials/", "https://doc.lagout.org/network/Computer Networks_ A Systems Approach%2C 3rd Edition-Petersen.pdf", "https://eclass.teicrete.gr/modules/document/file.php/TP326/Θεωρία (Lectures)/Computer_Networking_A_Top-Down_Approach.pdf", "https://vaibhav2501.files.wordpress.com/2012/02/tcp_ip-protocol-suite-4th-ed-b-forouzan-mcgraw-hill-2010-bbs.pdf"],
        ["https://www.geeksforgeeks.org/introduction-of-theory-of-computation/", "https://www.youtube.com/watch?v=al4AK6ruRek", "https://www.gbv.de/dms/ilmenau/toc/512318859.PDF"],
        ["https://www.tutorialspoint.com/software_engineering/index.htm", "https://www.geeksforgeeks.org/software-engineering/", "https://www.javatpoint.com/software-engineering-tutorial", "https://dinus.ac.id/repository/docs/ajar/Sommerville-Software-Engineering-10ed.pdf"],
        ["https://www.pdfdrive.com/understanding-pointers-in-c-e175306125.html", "https://www.sololearn.com/", "https://www.geeksforgeeks.org/", "http://cslibrary.stanford.edu/102/PointersAndMemory.pdf"]
    ];
    var rat = [
        [4.51],
        [4.03, 4.55, 4.6, 4.62, 4.1, 3.6],
        [3.4, 4.5, 4.2, 4.1, 4.36],
        [3.45, 4.2, 4.3],
        [4.46, 4.41],
        [4.3, 4.4, 3.7, 3.98],
        [4, 3.5, 4.1],
        [4.3, 3.5, 4.1, 3.7],
        [4.46, 3.8, 4.2, 4.4]
    ];
    var User = "<?php echo $_SESSION["Username"];?>"; //Important!!!!
    var recc = [0, 0, 0, 0, 0, 0, 0, 0, 0];
    var topic = [];
    var price = {
        "www.musaliarcollege.com/e-Books/CSE/Data%20structures%20algorithms%20and%20applications%20in%20C.pdf": 500,
        "web.ist.utl.pt/~fabio.ferreira/material/asa/clrs.pdf": 990,
        "eloquentjavascript.net/Eloquent_JavaScript.pdf": 350,
        "doc.lagout.org/network/Computer Networks_ A Systems Approach%2C 3rd Edition-Petersen.pdf": 960,
        "eclass.teicrete.gr/modules/document/file.php/TP326/Θεωρία (Lectures)/Computer_Networking_A_Top-Down_Approach.pdf": 600,
        "vaibhav2501.files.wordpress.com/2012/02/tcp_ip-protocol-suite-4th-ed-b-forouzan-mcgraw-hill-2010-bbs.pdf": 450,
        "www.gbv.de/dms/ilmenau/toc/512318859.PDF": 1200,
        "dinus.ac.id/repository/docs/ajar/Sommerville-Software-Engineering-10ed.pdf": 1300,
        "cslibrary.stanford.edu/102/PointersAndMemory.pdf": 860
    };
    const m_size = 1000000007;
    //Utility Functions
    //Start
    function delelement() {
        var del1 = document.getElementsByClassName("demo");
        while (del1.length)
            del1[0].parentNode.removeChild(del1[0]);
        var del2 = document.getElementsByClassName("buy");
        while (del2.length)
            del2[0].parentNode.removeChild(del2[0]);
        var del2 = document.getElementsByClassName("cart-table");
        while (del2.length)
            del2[0].parentNode.removeChild(del2[0]);
        var del2 = document.getElementsByClassName("cart-qty");
        while (del2.length)
            del2[0].parentNode.removeChild(del2[0]);
        var del2 = document.getElementsByClassName("cart-link");
        while (del2.length)
            del2[0].parentNode.removeChild(del2[0]);
        var del2 = document.getElementsByClassName("cbtn");
        while (del2.length)
            del2[0].parentNode.removeChild(del2[0]);
        var del2 = document.getElementsByClassName("cart-price");
        while (del2.length)
            del2[0].parentNode.removeChild(del2[0]);
        var del2 = document.getElementsByClassName("cart-head");
        while (del2.length)
            del2[0].parentNode.removeChild(del2[0]);
        var del2 = document.getElementsByClassName("finalprice");
        while (del2.length)
            del2[0].parentNode.removeChild(del2[0]);

    }

    function getStars(rating) {
        // Round to nearest half
        rating = Math.round(rating * 2) / 2;
        let output = [];
        if (rating <= 2) {
            // Append all the filled whole stars
            for (var i = rating; i >= 1; i--)
                output.push('<i class="fa fa-star" aria-hidden="true" style="color: red;"></i>&nbsp;');

            // If there is a half a star, append it
            if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: red;"></i>&nbsp;');

            // Fill the empty stars
            for (let i = (5 - rating); i >= 1; i--)
                output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: red;"></i>&nbsp;');
        } else if (rating < 4) {
            // Append all the filled whole stars
            for (var i = rating; i >= 1; i--)
                output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            // If there is a half a star, append it
            if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            // Fill the empty stars
            for (let i = (5 - rating); i >= 1; i--)
                output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');
        } else {
            // Append all the filled whole stars
            for (var i = rating; i >= 1; i--)
                output.push('<i class="fa fa-star" aria-hidden="true" style="color: lawngreen;"></i>&nbsp;');

            // If there is a half a star, append it
            if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: lawngreen;"></i>&nbsp;');

            // Fill the empty stars
            for (let i = (5 - rating); i >= 1; i--)
                output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: lawngreen;"></i>&nbsp;');
        }

        return output.join('');
    }


    function delcart() {
        var f;
        while (cartFromLocal.length) {
            f = cartFromLocal.pop();
            f = qtyLocalStorage.pop();
        }
        localStorage.removeItem(User);
        localStorage.removeItem(QtyKey);
        while (temp.length) {
            f = temp.pop();
        }
        delelement();
        if (cartFromLocal.length == 0)
            alert("The cart is now empty!!");
            tArray = [];
            qArray = [];
    }

    function findprice() {
        var tempQty = [];
        var tprice = 0;
        for (i = 0; i < cartFromLocal.length; i++)
        {
            e = cartFromLocal[i];
            var r = document.getElementById(i).value;
            tempQty.push(r);
            var c;
            var k = "price" + i;
            var p1 = price[e];
            c = r * p1;
            document.getElementById(k).innerHTML = c;
            var t = c;
            tprice += r * p1;
        }
        localStorage.setItem(QtyKey,JSON.stringify(tempQty));
        document.getElementById("fprice").innerHTML = "Total price " + "Rs " + tprice;
    }
    
    var cartFromLocal = JSON.parse(localStorage.getItem(User));
    //Code to update that qty in local Storage
    var QtyKey = User+"_Qty";
    var qtyLocalStorage = JSON.parse(localStorage.getItem(QtyKey));

     
    function showcart() {
        let ini_totPrice = 0;
        delelement();
        cartFromLocal = JSON.parse(localStorage.getItem(User));
        if(cartFromLocal === null) 
        {
            alert("Cart is Empty");
        }
        qtyLocalStorage = JSON.parse(localStorage.getItem(QtyKey));
        var tprice = 0;
        if (cartFromLocal.length != 0) {
            var h = document.createElement("H2");
            h.setAttribute("class", "cart-head");
            h.innerHTML = "Your Cart";
            document.body.appendChild(h);
            var tabs = document.createElement("table");
            tabs.setAttribute("class", "cart-table");
            var trs = document.createElement("tr");
            tabs.appendChild(trs);
            trs.setAttribute("class", "cart-row");
            var td0 = document.createElement("th");
            td0.setAttribute("class", "cart-link");
            td0.innerHTML = "Book No";
            trs.appendChild(td0);
            var td1 = document.createElement("th");
            td1.setAttribute("class", "cart-link");
            td1.innerHTML = "E-Book Name";
            trs.appendChild(td1);
            var td2 = document.createElement("th");
            td2.setAttribute("class", "cart-qty");
            td2.innerHTML = "Quantity";
            trs.appendChild(td2);
            var td3 = document.createElement("th");
            td3.setAttribute("class", "cart-price");
            td3.innerHTML = "E-Book Price";
            trs.appendChild(td3);

            for (var i = 0; i < cartFromLocal.length; i++)
                (function(i) {
                    e = cartFromLocal[i];
                    var trs = document.createElement("tr");
                    tabs.appendChild(trs);
                    trs.setAttribute("class", "cart-row");
                    var td0 = document.createElement("td");
                    td0.setAttribute("class", "cart-link");
                    td0.innerHTML = i + 1;
                    trs.appendChild(td0);
                    var td1 = document.createElement("td");
                    td1.setAttribute("class", "cart-link");
                    td1.innerHTML = e;
                    trs.appendChild(td1);
                    var td2 = document.createElement("td");
                    var qty = document.createElement("INPUT");
                    qty.setAttribute("class", "qty-box");
                    qty.setAttribute("id", i);
                    qty.setAttribute("type", "number");
                    qty.setAttribute("placeholder", 1);
                    qty.setAttribute("min", 1);
                    qty.setAttribute("value", qtyLocalStorage[i]);
                    trs.appendChild(td2);
                    td2.appendChild(qty);
                    var td3 = document.createElement("td");
                    td3.setAttribute("class", "cart-price");
                    var k = "price" + i;
                    td3.setAttribute("id", k);
                    trs.appendChild(td3);
                    td3.innerHTML = price[e] * qtyLocalStorage[i];
                    ini_totPrice+=price[e] * qtyLocalStorage[i];
                    qty.addEventListener("input", findprice)
                })(i);
            document.body.appendChild(tabs);
            var h11s = document.createElement("H2");
            h11s.setAttribute("class", "finalprice");
            h11s.setAttribute("id", "fprice");
            document.body.appendChild(h11s);
            document.getElementById("fprice").innerHTML = "Total price " + "Rs " + ini_totPrice;
        } else {
            alert("cart is empty");
        }
    }
    var tArray = [];
    var qArray = [];
    if(cartFromLocal.length>0)
    {
        tArray = cartFromLocal;
        qArray = qtyLocalStorage;
    }
    function just() {
        if (window.confirm("Are you sure?") == true) {
            var d = this.id;
            var t = temp[d];
        if(!tArray.includes(t))
        {
        tArray.push(t);
        localStorage.setItem(User,JSON.stringify(tArray));
        //qty
        qArray.push("1");
        localStorage.setItem(QtyKey,JSON.stringify(qArray));
        }
        else{
            var indexofRepeat = tArray.indexOf(t);
            qArray[indexofRepeat] = parseInt(qArray[indexofRepeat]) + 1;
            localStorage.setItem(QtyKey,JSON.stringify(qArray));
        }
        }
        
    }

    function checkcartpayment() {
        if (cartFromLocal === null)
            alert("Please add books to your cart to proceed payment !!!");
        else
            location.replace("payment.php");
    }

    function display(put, i, k) {
        var tag;
        var r = rat[k][i];

        for (var j = 0; j < put.length / 2; j++)
            if (put[j] == '/' && put[j + 1] == "/") {
                tag = put.substring(j + 2);
                break;
            }
        if (tag[tag.length - 1] == "/")
            tag = tag.substring(0, tag.length - 1);
        //Above for loop removes https in the tag displayed

        var div = document.createElement("DIV");
        div.setAttribute("class", "demo");
        var dtag;
        dtag = tag;
        tag = tag.link(put); //creating the link by coverting string to a link
        var stt = getStars(r);

        if (put[put.length - 1].toLowerCase() == 'f' && put[put.length - 2].toLowerCase() == 'd' && put[put.length - 3].toLowerCase() == 'p') {
            div.innerHTML = "<h2>Book</h2>" + stt + "<br><br>" + "<i class='fa fa-link' id='link'></i>&nbsp;" + tag;
            var k = i;
            temp[i] = dtag;
            div.setAttribute("id", k);
            document.body.appendChild(div);

            var buy = document.createElement("BUTTON");
            buy.setAttribute("id", k);
            buy.setAttribute("class", "buy");
            buy.innerHTML = "ADD TO CART <i class='fa fa-shopping-cart'></i>";
            buy.addEventListener("click", just);
            document.body.appendChild(buy);
        } else if (put.includes("youtube")) {
            div.innerHTML = "<h2>Youtube Video</h2>" + stt + "<br><br>" + "<i class='fa fa-link' id='link'></i>&nbsp;" + tag;
            document.body.appendChild(div);
        } else {
            div.innerHTML = "<h2>Website</h2> " + stt + "<br><br>" + "<i class='fa fa-link' id='link'></i>&nbsp;" + tag;
            document.body.appendChild(div);
        }
    }
    //End

    //Ratings- Merge Sort Module 
    //Start
    function swap(arr, i, j) {
        var temp = arr[i];
        arr[i] = arr[j];
        arr[j] = temp;
    }

    function swap1(ls, k, i, j) {
        var temp = ls[k][i];
        ls[k][i] = ls[k][j];
        ls[k][j] = temp;
    }

    function partition(arr, pivot, left, right, k) {
        var pivotValue = arr[pivot],
            partitionIndex = left;
        for (var i = left; i < right; i++) {
            if (arr[i] >= pivotValue) {
                swap(arr, i, partitionIndex);
                swap1(ls, k, i, partitionIndex);
                partitionIndex++;
            }

        }
        swap(arr, right, partitionIndex);
        swap1(ls, k, right, partitionIndex);
        return partitionIndex;
    }

    function quickSort(arr, left, right, k) //k - To know which topic should be taken in ls array
    {
        var len = arr.length,
            pivot, partitionIndex;
        if (left < right) {
            pivot = right;
            partitionIndex = partition(arr, pivot, left, right, k);
            quickSort(arr, left, partitionIndex - 1, k);
            quickSort(arr, partitionIndex + 1, right, k);
        }
        return arr;
    }

    function before() {
        for (var i = 0; i < v.length; i++) {
            var sorted = quickSort(rat[i], 0, rat[i].length - 1, i);
            for (var j = 0; j < rat[i].length; j++)
                rat[i][j] = sorted[j];
        }
        keyvalue();
    }

    function linear_s(d) {
        for (var q = 0; q < v.length; q++)
            if (v[q].toLowerCase() == d.toLowerCase())
                return q;
    }
    //End

    //View History- Stack Module
    //Start
    function gostack(d) {
        items.push(d);
    }

    function showhistory() {
        delelement();
        if (items.length == 0) {
            var div = document.createElement("DIV");
            div.setAttribute("class", "demo");
            div.innerHTML = "<h3>Your search history is empty</h3>";
            document.body.appendChild(div);
        } else
            for (var i = 0; i < items.length; i++)
                (function(i) {
                    var div = document.createElement("DIV");
                    div.setAttribute("class", "demo");
                    div.style.cursor = "pointer";
                    div.onclick = function() {
                        document.getElementById("keyword").value = items[i];
                    };
                    var now = new Date(); // to display date and time in search history
                    var cdate = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
                    var ctime = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
                    var datetime = cdate + ' ' + ctime;
                    div.innerHTML = "<i class='fa fa-history' id='hist'></i>&nbsp;&nbsp;<b>" + items[i] + "</b>" + "&nbsp;&emsp;<i class='d-align'>" + datetime + "</i><br>";
                    document.body.appendChild(div);
                })(i);
    }

    function delhistory() {
        var e = 0;
        delelement();
        while (1) {
            if (items.length == 0) {
                var div = document.createElement("DIV");
                div.setAttribute("class", "demo");
                div.innerHTML = "<h3>Your search history is empty</h3>";
                document.body.appendChild(div);
                break;
            } else
                e = items.pop();
        }
    }
    //End

    //Recommendations Module
    //Start
    function maxx(r, z) {
        let max_r = 0;
        if (z == 0) {
            for (var i = 0; i < r.length; i++)
                if (r[i] > max_r) max_r = r[i];
        } else {
            for (var i = 0; i < r.length; i++)
                if (r[i] > max_r && r[i] < z) max_r = r[i];
        }
        return max_r;
    }

    function showRecommendations() {
        delelement();
        var m = maxx(recc, 0);
        var m2 = maxx(recc, m);
        var m3 = maxx(recc, m2);
        if (m == 0) {
            var div = document.createElement("DIV");
            div.setAttribute("class", "demo");
            div.innerHTML = "<h3>You have no recommendations so far</h3>";
            document.body.appendChild(div);
        } else {
            for (var i = 0; i < recc.length; i++) {
                if (recc[i] == m) {
                    display(ls[i][0], 0, i);
                } else if (recc[i] == m2 && m2 != 0) {
                    display(ls[i][0], 0, i);
                } else if (recc[i] == m3 && m3 != 0) {
                    display(ls[i][0], 0, i);
                }
            }
        }
    }

    //Hash Table Module
    //Start
    function hash(tval) //actual hash  function
    {
        var index = 0;
        tval = tval.toLowerCase();
        for (var i = 0; i < tval.length && tval[i] != ' '; i++)
            index += (tval[i].charCodeAt(0) - 97) * (tval.length - i); //index=(letter-ascii('a'))*(pos of letter in string from end)
        return index % m_size;
    }

    function keyvalue() {
        var val;
        for (var i = 0; i < v.length; i++) {
            var key = hash(v[i]);
            var h = 1;
            while (typeof topic[key] != "undefined") {
                key = (key + (h * h)) % m_size;
                h++;
            }
            topic[key] = v[i];
            val = ls[i];
            table[key] = val;
        }
    }

    function hashsearch(userinp) {
        var key = hash(userinp);
        var h = 1;
        while (topic[key].toLowerCase() != userinp.toLowerCase()) {
            key = (key + h * h) % m_size;
            h++;
        }
        return key;
    }
    //End


    function searchinglink() //function to generate the results based on user input
    {
        document.getElementById("suggest").style.display = "none";
        var d = document.getElementById("keyword").value; //d contains input entrered by user
        var disp = hashsearch(d);

        var k = linear_s(d);
        recc[k]++;

        delelement();
        var del = document.getElementById("break");
        if (del)
            del.remove();

        gostack(d);
        for (var i = 0; i < table[disp].length; i++) {
            var put = table[disp][i]; //hashtable->key's value[i]
            display(put, i, k);
        }
        var br = document.createElement("BR");
        br.id = "break";
        document.body.appendChild(br);
    }

    function suggest() {
        var y = document.getElementById("suggest");
        var sugbox = document.getElementById("keyword").value.toLowerCase();
        if (sugbox.length) {
            y.innerHTML = "";
            var list = document.createElement("ul");
            for (i = 0; i < v.length; i++)
                (function(i) {
                    if (v[i].toLowerCase().search(sugbox) != -1) {
                        var l = document.createElement("li");
                        l.innerHTML = '<h3 style="line-height:1.6"><i class="fa fa-lightbulb-o" style="color:gold"></i>&emsp;' + v[i] + '</h3>';
                        l.setAttribute("style", "list-style:none;margin-left:-30px");
                        l.onclick = function() {
                            document.getElementById("keyword").value = v[i];
                            y.style.display = "none";
                        };
                        list.appendChild(l);
                    }
                })(i);
            y.style.display = "block";
            y.style.cursor = "pointer";
            y.appendChild(list);
        }
    }
</script>
</body>

</html>