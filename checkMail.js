document.getElementById("back").addEventListener("click",
function back() {
    //window.location="ManagerFrontPage.php";
});

document.getElementById("mail").addEventListener("keyup", 
function showHint() {
    if (this.value == "") {
        document.getElementById("stateTxt").innerHTML = "";
        return;
    }
    else {
        var email_txt = this.value;
        var aId = document.getElementById("articleID").innerHTML;
        //var mail = document.getElementById("mail").innerHTML;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //var a = /^\w@[A-Za-z0-9].[A-Za-z]+$/;
            var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
            if (email_txt.match(emailRule)) {
                document.getElementById("stateTxt").innerHTML = xmlhttp.responseText;
            }
            else {
                document.getElementById("stateTxt").innerHTML = "請輸入完整的信箱";
            }
        }
        };
        xmlhttp.open("GET", "gethint.php?m=" + email_txt + "&id=" + aId, true);
        xmlhttp.send();
    }
});

document.getElementById("submit").addEventListener("click", 

function assign() {
    var mailTxt = document.getElementById("mail").value;
    var aId = document.getElementById("articleID").innerHTML;
    var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;

    var xmlhttpB = new XMLHttpRequest();
    xmlhttpB.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
            if (mailTxt.match(emailRule)) {

                if (xmlhttpB.responseText == 1) {
                    alert("已送出");
                    location.assign("ManagerFrontPage.php");
                }
                else {
                    document.getElementById("stateTxt").innerHTML = xmlhttpB.responseText;
                }
            }
            else {
                document.getElementById("stateTxt").innerHTML = "請輸入完整的信箱";
            }
        }
    };
    xmlhttpB.open("GET", "sendMail.php?m=" + mailTxt + "&id=" + aId, true);
    xmlhttpB.send();
});