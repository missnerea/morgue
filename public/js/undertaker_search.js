//////////////////////////////////Search section////////////////////////////////////////////////
var select_operator=document.getElementById('select_operator');
var select_column=document.getElementById('select_column');
var input_dob=document.getElementById('input_dob');

select_column.addEventListener('mouseup',addSelectOperatorOptions);

function addSelectOperatorOptions(){
    select_operator.innerHTML="";
    input_dob.type='text';
    input_dob.value="";
    
   
    if(select_column.value==='id'){
        makeOption('equals to','=');
        makeOption('greater than','>');
        makeOption('less than','<');
        makeOption('greater than or equals to','>=');
        makeOption('less than or equals to','<=');
        makeOption('not equals to','!=');
    }
    
    else if(select_column.value==='first_name'){
        makeOption('equals to','=');
    }
    
    else if(select_column.value==='last_name'){
        makeOption('equals to','=');
    }
    
    else if(select_column.value==='gender'){
        makeOption('equals to','=');
    }
    
    else if(select_column.value==='id_number'){
        makeOption('equals to','=');
        makeOption('greater than','>');
        makeOption('less than','<');
        makeOption('greater than or equals to','>=');
        makeOption('less than or equals to','<=');
        makeOption('not equals to','!=');
    }
    
    else if(select_column.value==='date_of_birth'){
        input_dob.type='date';
        makeOption('equals to','=');
        makeOption('greater than','>');
        makeOption('less than','<');
        makeOption('greater than or equals to','>=');
        makeOption('less than or equals to','<=');
        makeOption('not equals to','!=');
    }
    
    else if(select_column.value==='admin_id'){
        makeOption('equals to','=');
        makeOption('greater than','>');
        makeOption('less than','<');
        makeOption('greater than or equals to','>=');
        makeOption('less than or equals to','<=');
        makeOption('not equals to','!=');
    }
}
/*
select_column.onclick=function(){
    select_operator.innerHTML="";
    if(select_column.value==='id'){
        makeOption('equals to','=');
        makeOption('greater than','>');
        makeOption('less than','<');
        makeOption('greater than or equals to','>=');
        makeOption('less than or equals to','<=');
        makeOption('not equals to','!=');
    }
};
*/
function makeOption(text,value){
    var option=document.createElement('option');
    option.text=text;
    option.value=value;
    select_operator.add(option);
}



////////////////Update, delete and change password buttons/////////////////////////////////////////
var button_update=document.getElementById('button_update');
var button_delete=document.getElementById('button_delete');
var button_change_password=document.getElementById('button_change_password');

if(button_update !== null){
button_update.onclick=function(){
    if (!(button_update.classList.contains('button-active'))){
        button_update.classList.add('button-active');
        button_delete.classList.remove('button-active');
        button_change_password.classList.remove('button-active');
    }
};

button_delete.onclick=function(){
    if (!(button_delete.classList.contains('button-active'))){
        button_delete.classList.add('button-active');
        button_update.classList.remove('button-active');
        button_change_password.classList.remove('button-active');
    }
};

button_change_password.onclick=function(){
    if (!(button_change_password.classList.contains('button-active'))){
        button_change_password.classList.add('button-active');
        button_delete.classList.remove('button-active');
        button_update.classList.remove('button-active');
        
    }
};
}


////////////////Table click selection section/////////////////////////////////////////
var body=document.getElementsByTagName('body')[0];

body.onclick=function(e){
    var row=e.target.parentElement;
    if(row.tagName==='TR' && row.parentElement.tagName==='TBODY'){
        var id=row.firstElementChild.innerHTML;
        if(button_update.classList.contains('button-active')){
            document.location.href="http://localhost/morgue/public/index.php/undertaker_re/"+id+"/edit";
        }else if(button_delete.classList.contains('button-active')){
            document.location.href="http://localhost/morgue/public/index.php/undertaker_re/"+id+"/showdelete";
        }else if(button_change_password.classList.contains('button-active')){
            document.location.href="http://localhost/morgue/public/index.php/undertaker_re/"+id+"/show_password_change";
        }
    }
};

