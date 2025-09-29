const pswrdField = document.getElementById("password2"),
togggleBtn = document.getElementById("pwicon");

togggleBtn.onclick = ()=>{
    if(pswrdField.type == "password"){
        pswrdField.type = "text";
        togggleBtn.classList.add("ri-eye-off-fill");
        togggleBtn.classList.remove("ri-eye-fill");
        togggleBtn.classList.remove("wht");
        togggleBtn.classList.add("blc");
        
    }else{
        pswrdField.type = "password";
        togggleBtn.classList.remove("ri-eye-off-fill");
        togggleBtn.classList.add("ri-eye-fill");
        togggleBtn.classList.add("wht");
        togggleBtn.classList.remove("blc");
    }
}

const pswrdField2 = document.getElementById("password"),
togggleBtn2 = document.getElementById("pwicon2");

togggleBtn2.onclick = ()=>{
    if(pswrdField2.type == "password"){
        pswrdField2.type = "text";
        togggleBtn2.classList.add("ri-eye-off-fill");
        togggleBtn2.classList.remove("ri-eye-fill");
        togggleBtn2.classList.remove("wht");
        togggleBtn2.classList.add("blc");
        
    }else{
        pswrdField2.type = "password";
        togggleBtn2.classList.remove("ri-eye-off-fill");
        togggleBtn2.classList.add("ri-eye-fill");
        togggleBtn2.classList.add("wht");
        togggleBtn2.classList.remove("blc");
    }
}
const pswrdField3 = document.getElementById("pw1"),
togggleBtn3 = document.getElementById("pwicon3");

togggleBtn3.onclick = ()=>{
    if(pswrdField3.type == "password"){
        pswrdField3.type = "text";
        togggleBtn3.classList.add("ri-eye-off-fill");
        togggleBtn3.classList.remove("ri-eye-fill");
        togggleBtn3.classList.remove("wht");
        togggleBtn3.classList.add("blc");
        
    }else{
        pswrdField3.type = "password";
        togggleBtn3.classList.remove("ri-eye-off-fill");
        togggleBtn3.classList.add("ri-eye-fill");
        togggleBtn3.classList.add("wht");
        togggleBtn3.classList.remove("blc");
    }
}

const pswrdField4 = document.getElementById("pw2"),
togggleBtn4 = document.getElementById("pwicon4");

togggleBtn4.onclick = ()=>{
    if(pswrdField4.type == "password"){
        pswrdField4.type = "text";
        togggleBtn4.classList.add("ri-eye-off-fill");
        togggleBtn4.classList.remove("ri-eye-fill");
        togggleBtn4.classList.remove("wht");
        togggleBtn4.classList.add("blc");
        
    }else{
        pswrdField4.type = "password";
        togggleBtn4.classList.remove("ri-eye-off-fill");
        togggleBtn4.classList.add("ri-eye-fill");
        togggleBtn4.classList.add("wht");
        togggleBtn4.classList.remove("blc");
    }
}