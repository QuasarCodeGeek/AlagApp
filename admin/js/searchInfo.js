// Search Functions
function _searchAccount() {
    var account = document.getElementById("searchAccount").value;
      if(account != "") {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("accountHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/searchAccount.php?account="+account);
        xhttp.send();
      } else {
        document.getElementById("accountHere").innerHTML = "";
      }
  }
  
  function searchCard() {
    var val = document.getElementById("card").value;
    search = val;
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/getCard.php?search="+search);
        xhttp.send();
  }
  
  function searchNote() {
    var search = document.getElementById("note").value;
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/getNote.php?search="+search);
        xhttp.send();
      
  }
  
  function searchUser() {
    var search = document.getElementById("user").value;
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/getUser.php?search="+search);
        xhttp.send();
  }
  
  function searchPet() {
    var val = document.getElementById("pet").value;
    search = val;
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/getPet.php?search="+search);
        xhttp.send();
  }
  
  function searchSched() {
    var val = document.getElementById("sched").value;
    search = val;
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/getSched.php?search="+search);
        xhttp.send();
  }
  
  function searchSympt() {
    var val = document.getElementById("symptom").value;
    search = val;
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/getSympt.php?search="+search);
        xhttp.send();
  }
  
  function searchVaxx() {
    var val = document.getElementById("vaxx").value;
    search = val;
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/getVaxx.php?search="+search);
        xhttp.send();
  }
  
  function searchConsult() {
    var val = document.getElementById("consult").value;
    search = val;
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "api/searchData/getConsult.php?search="+search);
        xhttp.send();
  }