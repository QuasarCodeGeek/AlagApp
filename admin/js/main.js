const { isEmptyObject } = require("jquery");

// Add Data Function
function userNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "api/newData/userNew.php");
    xhttp.send();
  }
function petNew(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "api/newData/addPet.php");
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

/*function cardAlterNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/cardNewalter.php?petid="+petid);
    xhttp.send();
  }*/

function noteNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/noteNew.php?petid="+petid);
    xhttp.send();
  }

  function symptomNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "../newData/newSymptom.php");
    xhttp.send();
  }

/*function scheduleNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/scheduleNew.php");
    xhttp.send();
  }*/

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

/*function cardAlterEdit(cid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "editData/cardEditalter.php?cid="+cid);
  xhttp.send();
}*/

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
  xhttp.open("GET", "api/editData/scheduleEdit.php?qid="+qid);
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

function symptomEdit(sid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../editData/editSymptom.php?sid="+sid);
  xhttp.send();
}

function adminEdit(id) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../adminData/adminEdit.php?id="+id);
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
      xhttp.open("GET", "../searchData/searchAccount.php?account="+account);
      xhttp.send();
    } else {
      document.getElementById("accountHere").innerHTML = "";
    }
}

function searchCard() {
  var search = document.getElementById("card").value;
    if(search != "") {
      document.getElementById("table").style.display = "none";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("alter").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../searchData/getCard.php?search="+search);
      xhttp.send();
    } else {
      document.getElementById("altertable").style.display = "none";
      document.getElementById("table").style.display = "block";
    }
}

function searchNote() {
  var search = document.getElementById("note").value;
    if(search != "") {
      document.getElementById("table").style.display = "none";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("alter").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../searchData/getNote.php?search="+search);
      xhttp.send();
    } else {
      document.getElementById("altertable").style.display = "none";
      document.getElementById("table").style.display = "block";
    }
}

function searchUser() {
  var search = document.getElementById("user").value;
    if(search != "") {
      document.getElementById("table").style.display = "none";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("alter").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../searchData/getUser.php?search="+search);
      xhttp.send();
    } else {
      document.getElementById("altertable").style.display = "none";
      document.getElementById("table").style.display = "block";
    }
}

function searchPet() {
  var search = document.getElementById("pet").value;
    if(search != "") {
      document.getElementById("table").style.display = "none";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("alter").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../searchData/getPet.php?search="+search);
      xhttp.send();
    } else {
      document.getElementById("altertable").style.display = "none";
      document.getElementById("table").style.display = "block";
    }
}

function searchSched() {
  var search = document.getElementById("sched").value;
    if(search != "") {
      document.getElementById("table").style.display = "none";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("alter").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../searchData/getSched.php?search="+search);
      xhttp.send();
    } else {
      document.getElementById("altertable").style.display = "none";
      document.getElementById("table").style.display = "block";
    }
}

function searchSympt() {
  var search = document.getElementById("symptom").value;
    if(search != "") {
      document.getElementById("table").style.display = "none";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("alter").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../searchData/getSympt.php?search="+search);
      xhttp.send();
    } else {
      document.getElementById("altertable").style.display = "none";
      document.getElementById("table").style.display = "block";
    }
}

function searchVaxx() {
  var search = document.getElementById("vaxx").value;
    if(search != "") {
      document.getElementById("table").style.display = "none";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("alter").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../searchData/getVaxx.php?search="+search);
      xhttp.send();
    } else {
      document.getElementById("altertable").style.display = "none";
      document.getElementById("table").style.display = "block";
    }
}

function searchConsult() {
  var search = document.getElementById("consult").value;
    if(search != "") {
      document.getElementById("table").style.display = "none";
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("alter").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../searchData/getConsult.php?search="+search);
      xhttp.send();
    } else {
      document.getElementById("altertable").style.display = "none";
      document.getElementById("table").style.display = "block";
    }
}
//Sort Functions
function descUser() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../sortData/userDES.php");
  xhttp.send();
   
}

// Additional Functions
function checkField() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  if(email == "" || password == ""){
      console.log(email+"" +password);
      const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

      const wrapper = document.createElement('div')
      wrapper.innerHTML = [
          `<div class="alert alert-success alert-dismissible" role="alert">`,
          `   <div>Complete fields required!</div>`,
          '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
      ].join('')

      alertPlaceholder.append(wrapper)
  }
}