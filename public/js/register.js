function show_register_box(){
    register_box = document.getElementById("register-box");
    login_box = document.getElementById("login-box");
    register_box.style.visibility = 'visible';
    login_box.style.visibility = 'collapse';
}
function show_login_box(){
    register_box = document.getElementById("register-box");
    login_box = document.getElementById("login-box");
    register_box.style.visibility = 'collapse';
    login_box.style.visibility = 'visible';
}
/* function check_comfirm_password(){
    if(document.getElementById("reg-password").value === document.getElementById("confirm-password").value){
        document.getElementById("password-confirm-error").style.visibility = "visible"
    }
    else{
        document.getElementById("password-confirm-error").style.visibility = "collapse"
    }
    return;
} */
async function register(){
    username = document.getElementById("reg-username").value;
    password = document.getElementById("reg-password").value;
    const url = "http://127.0.0.1:8000/register";
    const data = {
        "username" : username,
        "password" : password
    }
    console.log(JSON.stringify(data));


    const response = await fetch(url, {
        mode: 'no-cors',
        method: "post",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': document.getElementById("csrf-token").content
        }
    })
    const json = await response.json()
    console.log(json)
    /* if(json["server-response"]==="successfull"){
        window.location.replace("http://127.0.0.1/")
    } */
}
async function login(){
    username = document.getElementById("log-username").value;
    password = document.getElementById("log-password").value;
    console.log(username, password)
    const url = "http://127.0.0.1/login"
    const data = {
        "username" : username,
        "password" : password
    }
    const response = await fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json"
        }
    })
    //console.log(json["server-response"])
    //const json = await response.json()
     if(json["server-response"]==="successfull"){
        //window.location.replace("http://127.0.0.1/")
    }
    else{
        console.log(json["error"])
    }
}

