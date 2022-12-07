
// Call List Function
/*const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
    document.getElementById("userAccount").innerHTML = this.responseText;
}
xhttp.open("GET", "php/userAccount.php");
xhttp.send();*/

//Get Account Profile
function _showProfile(userid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("userProfile").innerHTML = this.responseText;
  }
  xhttp.open("GET", "php/accountList.php?userid="+userid);
  xhttp.send();

  const pet = new XMLHttpRequest();
  pet.onload = function() {
    document.getElementById("petProfile").innerHTML = this.responseText;
  }
  pet.open("GET", "php/petProfile.php?userid="+userid);
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
    xhttp.open("GET", "php/newData/addPet.php");
    xhttp.send()
  }

function PetNew(userid){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/petNew.php?userid="+userid);
    xhttp.send();
  }

function vaccineNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "../newData/vaccineNew.php");
    xhttp.send();
  }

function cardNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/cardNew.php?petid="+petid);
    xhttp.send();
  }
function noteNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/noteNew.php?petid="+petid);
    xhttp.send();
  }
function scheduleNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/scheduleNew.php");
    xhttp.send();
  }

// Edit Functions
function userEdit(userid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/userEdit.php?id="+userid);
    xhttp.send();
}

function petEdit(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/petEdit.php?id="+petid);
    xhttp.send();
}

function vaccineEdit(vaxid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "../editData/vaccineEdit.php?id="+vaxid);
    xhttp.send();
}

function cardEdit(cid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/cardEdit.php?cid="+cid);
    xhttp.send();
}

function prescriptionEdit(nid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/prescriptionEdit.php?nid="+nid);
    xhttp.send();
}

function scheduleEdit(qid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("schedHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "php/editData/scheduleEdit.php?qid="+qid);
  xhttp.send();
}
function schedEdit(qid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("schedHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/scheduleEdit.php?qid="+qid);
    xhttp.send();
}

function SchedEdit(qid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("schedHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../editData/scheduleEdit.php?qid="+qid);
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

// Get Card Function
function getCard(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("cardmodalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "cardList.php?petid="+petid);
    xhttp.send();
}