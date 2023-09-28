var myToastEl = document.getElementById('errorToast')
function show_error_label(){
    alert(' Незарегистрированные пользователи не могут сделать заказ')
}
async function make_order(event){
    event.preventDefault();
    let form = event.currentTarget.parentNode;
    let data = {
        "product_id" : form.product_id.value,
        "product_count" : form.product_count.value,
        "first_name" : form.first_name.value,
        "last_name" : form.last_name.value,
        "passport_id" : form.passport_id.value,
        "address" : form.address.value
    };
    data = JSON.stringify(data);
    let url = "http://127.0.0.1:5000/order";

    axios({
        method: "POST",
        url : url,
        data : data,
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }

     })
     .then(function(response){
        if(response.data["status"]==="success"){
            alert("Заказ успешно добавлен")
        }
        form.reset();
     })
     .catch(error => {
        if (!error.response) {
            // network error
            this.errorStatus = 'Error: Network Error';
        } else {
            this.errorStatus = error.response.data.message;
        }
            console.log(this.errorStatus)
        });
}
