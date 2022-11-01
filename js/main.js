
// Call List Function
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
    document.getElementById("userAccount").innerHTML = this.responseText;
}
xhttp.open("GET", "php/userAccount.php");
xhttp.send();

//Get Account Profile
function _showProfile(userid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("userProfile").innerHTML = this.responseText;
  }
  xhttp.open("GET", "php/profileData/userProfile.php?userid="+userid);
  xhttp.send();

  const pet = new XMLHttpRequest();
  pet.onload = function() {
    document.getElementById("petProfile").innerHTML = this.responseText;
  }
  pet.open("GET", "php/profileData/petProfile.php?userid="+userid);
  pet.send();
}

// Get List
function getUser() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("contentHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/userList.php");
    xhttp.send();
}
function getPet() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("contentHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/petList.php");
    xhttp.send();
}
function getVaccine() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("contentHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/vaccineList.php");
    xhttp.send();
}
function getCard() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("contentHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/cardList.php");
    xhttp.send();
}
function getCardList() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("contentHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/cardReport.php");
    xhttp.send();
}
function getPrescription() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("contentHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/prescriptionList.php");
    xhttp.send();
}
function getSchedule(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("contentHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/scheduleList.php");
    xhttp.send();
}

// Add Data Function
function userNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/newData/userNew.php");
    xhttp.send();
  }
function petNew(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/newData/petNew.php");
    xhttp.send();
  }s
function vaccineNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/newData/vaccineNew.php");
    xhttp.send();
  }
function cardNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/newData/cardNew.php");
    xhttp.send();
  }
function prescriptionNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/newData/prescriptionNew.php");
    xhttp.send();
  }
function scheduleNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/newData/scheduleNew.php");
    xhttp.send();
  }

// Edit Functions
function userEdit(userid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/editData/userEdit.php?id="+userid);
    xhttp.send();
}

function petEdit(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/editData/petEdit.php?id="+petid);
    xhttp.send();
}

function vaccineEdit(vaxid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/editData/vaccineEdit.php?id="+vaxid);
    xhttp.send();
}

function cardEdit(cid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/editData/cardEdit.php?id="+cid);
    xhttp.send();
}

function prescriptionEdit(nid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/editData/prescriptionEdit.php?id="+nid);
    xhttp.send();
}

function scheduleEdit(qid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "php/editData/scheduleEdit.php?id="+qid);
    xhttp.send();
}

// Search Functions
function _searchAccount() {
  var account = document.getElementById("searchAccount").value;
    if(account != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("accountHere").innerHTML = this.responseText;
      }
      xhttp.open("GET", "php/searchData/searchAccount.php?account="+account);
      xhttp.send();
    } else {
      document.getElementById("accountHere").innerHTML = "";
    }
}

function searchBy() { 
    var input = document.getElementById("search").value;
    var searchinput = document.getElementById("searchby").value
    if(searchinput == 1){
      if(input!==""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("contentHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "php/searchData/searchUser.php?search="+input);
        xhttp.send();
      } else {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("contentHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "php/userProfile.php");
        xhttp.send();
      }
    } else if(searchinput == 2){
        if(input!==""){
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            document.getElementById("contentHere").innerHTML = this.responseText;
          }
          xhttp.open("GET", "php/searchData/searchPet.php?search="+input);
          xhttp.send();
        } else {
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            document.getElementById("contentHere").innerHTML = this.responseText;
          }
          xhttp.open("GET", "php/petProfile.php");
          xhttp.send();
        }
    } else if(searchinput == 3){
        if(input!==""){
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            document.getElementById("contentHere").innerHTML = this.responseText;
          }
          xhttp.open("GET", "php/searchData/searchCard.php?search="+input);
          xhttp.send();
        } else {
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            document.getElementById("contentHere").innerHTML = this.responseText;
          }
          xhttp.open("GET", "php/vaccineCard.php");
          xhttp.send();
        }
    } else if(searchinput == 4){
      if(input!==""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("contentHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "php/searchData/searchVaccine.php?search="+input);
        xhttp.send();
      } else {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("contentHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "php/vaccineInfo.php");
        xhttp.send();
      }
    } else if(searchinput == 5){
      if(input!==""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("contentHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "php/searchData/searchNote.php?search="+input);
        xhttp.send();
      } else {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("contentHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "php/prescriptionNote.php");
        xhttp.send();
      }
    } else if(searchinput == 6){
      if(input!==""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("contentHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "php/searchData/searchSchedule.php?search="+input);
        xhttp.send();
      } else {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("contentHere").innerHTML = this.responseText;
        }
        xhttp.open("GET", "schedList.php");
        xhttp.send();
      }
    }
}

// Get Card Function
function getCard(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("cardmodalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "cardList.php?petid="+petid);
    xhttp.send();
}