function login(){
    const email = document.getElementById("email").value;
    const password = document.getElementById("password".value);
}
//Field Required Alert Trigger
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
    