async function userUpdate(event){
    let form = event.currentTarget.parentNode;
    let user_id = form.user_id.value;
    let data = {
        "name" : form.name.value,
        "password" : form.password.value==""?null:form.password.value,
        "is_admin" : form.is_admin.checked,
    };
    data = JSON.stringify(data);
    let url = "http://127.0.0.1:5000/admin/users/"+user_id;
    axios({
        method: "PATCH",
        url : url,
        data : data,
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }

        })
        .then(function(response){
        if(response.data["status"]==="success"){
            alert("Пользователь успешно изменен")
        }
        form.reset();
        location.reload()
        })
        .catch(error => {
        if (!error.response) {
            // network error
            this.errorStatus = "Error: Network Error";
        } else {
            this.errorStatus = error.response.data.message;
        }
            console.log(this.errorStatus)
        });
}
async function userDelete(event){
    let form = event.currentTarget.parentNode;
    let user_id = form.user_id.value;
    let url = "http://127.0.0.1:5000/admin/users/"+user_id;
    axios.delete(url)
         .then(function(response){
            if(response.data["status"]==="success"){
                alert("Пользователь успешно удален")
            }
            form.reset();
            location.reload()

            })
            .catch(error => {
            if (!error.response) {
                // network error
                this.errorStatus = "Error: Network Error";
            } else {
                this.errorStatus = error.response.data.message;
            }
                console.log(this.errorStatus)
            });
}
async function userAdd(event){
    let form = event.currentTarget.parentNode;
    let data = {
        "name" : form.name.value,
        "password" : form.password.value==""?null:form.password.value,
        "is_admin" : form.is_admin.checked,
    };
    data = JSON.stringify(data);
    let url = "http://127.0.0.1:5000/admin/users";
    axios({
        method: "post",
        url : url,
        data : data,
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }

        })
        .then(function(response){
        if(response.data["status"]==="success"){
            alert("Пользователь успешно добавлен");
        }
        form.reset();
        location.reload();
        })
        .catch(error => {
        if (!error.response) {
            // network error
            this.errorStatus = "Error: Network Error";
        } else {
            this.errorStatus = error.response.data.message;
        }
            console.log(this.errorStatus);
        });
}
console.log(typeof(userAdd))
console.log(typeof(userDelete))
console.log(typeof(userUpdate))
