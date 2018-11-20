//////////////////////////////////Search section////////////////////////////////////////////////
var select_operator=document.getElementById('select_operator');
var select_column=document.getElementById('select_column');
var input_date=document.getElementById('input_date');

select_column.addEventListener('mouseup',addSelectOperatorOptions);

function addSelectOperatorOptions(){
    select_operator.innerHTML="";
    input_date.type='text';
    input_date.value="";
    
   
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
    
    else if(select_column.value==='cause_of_death'){
        makeOption('equals to','=');
    }
    
    else if(select_column.value==='date_in'){
        input_date.type='date';
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



////////////////Update and delete buttons/////////////////////////////////////////
var button_update=document.getElementById('button_update');
var button_delete=document.getElementById('button_delete');
var button_checkout=document.getElementById('button_checkout');

if(button_update !== null){
button_update.onclick=function(){
    if (!(button_update.classList.contains('button-active'))){
        button_update.classList.add('button-active');
        button_delete.classList.remove('button-active');
        button_checkout.classList.remove('button-active');
    }
};

button_delete.onclick=function(){
    if (!(button_delete.classList.contains('button-active'))){
        button_delete.classList.add('button-active');
        button_update.classList.remove('button-active');
        button_checkout.classList.remove('button-active');
    }
};

button_checkout.onclick=function(){
    if (!(button_checkout.classList.contains('button-active'))){
        button_checkout.classList.add('button-active');
        button_update.classList.remove('button-active');
        button_delete.classList.remove('button-active');
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
            document.location.href="http://localhost/morgue/public/index.php/deceased_re/"+id+"/edit";
        }else if(button_delete.classList.contains('button-active')){
            document.location.href="http://localhost/morgue/public/index.php/deceased_re/"+id+"/showdelete";
        }else if(button_checkout.classList.contains('button-active')){
            document.location.href="http://localhost/morgue/public/index.php/released_deceased_re/create?id="+id;
        }
    }
};

