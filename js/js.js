///////////////////////////////////TODO//////////////////////////
let changer = false;
let btag = document.querySelector('b');
var count1 = document.getElementById('count1');
var count2 = document.getElementById('count2');
var count3 = document.getElementById('count3');
var hiddenindex = document.getElementById('listindex');
let todoInput = document.getElementById('todoinput');
    todoInput.focus();




/////////           AJAX REQUESTS FUNCTION              /////////////

let todoComplete = ()=>{
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200){
           console.log(this.responseText);
       } 
    }
    
    xhttp.open("POST", "inc/updatecompletestatus.php", true);
    xhttp.send();
    console.log(xhttp);
    
    
}



let todoInComplete = ()=>{
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200){
           console.log(this.responseText);
       } 
    }
    
    xhttp.open("POST", "inc/updateincompletestatus.php", true);
    xhttp.send();
    console.log(xhttp);
    
    
}


let todoDelete = ()=>{
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200){
           console.log(this.responseText);
       } 
    }
    
    xhttp.open("POST", "inc/updatedeletestatus.php", true);
    xhttp.send();
    console.log(xhttp);
    
    
}



let completeColor = ()=>{
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200){
           let myResult = JSON.parse(this.responseText);
           
           let Li = document.getElementsByTagName('li');
           for( let i =0; i < myResult.length; i++ ){
               Li[myResult[i].itemindex].style.backgroundColor = "seagreen";
               Li[myResult[i].itemindex].style.color = "white";
               Li[myResult[i].itemindex].style.borderBottomColor = "wheat";
               let icon = Li[myResult[i].itemindex].children;
               icon[1].style.color = 'white';
               icon[2].style.color = 'white';
               icon[3].style.color = 'white';
           }
           
           
           
       } 
    }
    
    xhttp.open("POST", "inc/updatecompletecolor.php", true);
    xhttp.send();
    console.log(xhttp);
    
    
}




let incompleteColor = ()=>{
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200){
           let myResult = JSON.parse(this.responseText);
           
           let Li = document.getElementsByTagName('li');
           for( let i =0; i < myResult.length; i++ ){
               Li[myResult[i].itemindex].style.backgroundColor = "tomato";
               Li[myResult[i].itemindex].style.color = "white";
               Li[myResult[i].itemindex].style.borderBottomColor = "wheat";
               let icon = Li[myResult[i].itemindex].children;
               icon[1].style.color = 'white';
               icon[2].style.color = 'white';
               icon[3].style.color = 'white';
           }
           
           
           
       } 
    }
    
    xhttp.open("POST", "inc/updateincompletecolor.php", true);
    xhttp.send();
    console.log(xhttp);
    
    
}







/////////////////////////////////////////////////////////////////////////////////////////////////
let Lis = document.getElementsByTagName('li');
for(let i =0; i < Lis.length; i++){
	
	Lis[i].addEventListener('click', (e)=>{
		//GET THE INDEX OF CLICKED LI TAGS
        
        if(e.target.className == 'far fa-check-square todoicons'){
		  let myKey = Array.from(e.target.closest('ul').children);
		  let keyIndex = myKey.indexOf(e.target.closest('li'));
          window.location.href = "inc/updatecompletestatus.php?listcontent="+(e.target.closest('li').textContent.trim());
          window.location.href = "inc/updatecompletestatus.php?listindex="+keyIndex;
          todoComplete();
          //e.target.closest('li').style.backgroundColor = "seagreen";
            
 
        }else if(e.target.className == 'far fa-window-close todoicons'){
                 
 		  let myKey = Array.from(e.target.closest('ul').children);
		  let keyIndex = myKey.indexOf(e.target.closest('li'));
          window.location.href = "inc/updateincompletestatus.php?listindex="+keyIndex;
          todoInComplete();
          //e.target.closest('li').style.backgroundColor = "tomato";   
            
        }else if(e.target.className == 'far fa-trash-alt todoicons'){
 		  let myKey = Array.from(e.target.closest('ul').children);
		  let keyIndex = myKey.indexOf(e.target.closest('li'));
          let UL = e.target.closest('ul');
          let LI = e.target.closest('li');
          UL.removeChild(LI);
          window.location.href = "inc/updatedeletestatus.php?listindex="+keyIndex;
          todoDelete();
          //e.target.closest('li').style.backgroundColor = "red";
        }
        
        

    });
  completeColor();
  incompleteColor();
}
            
            
            
            
            
            
		//CREATE A TOGGLE THAT STORES INDEX AND ASSIGN A VALUE 
		//if(changer == false){
			//ADD AJAX REQUEST HERE/////////////////
          //  window.location.href = "inc/updatecompletestatus.php?listindex="+keyIndex;
            //todoComplete();
         //   Lis[i].style.backgroundColor = "seagreen";
		//	changer = true;
		//}else{
			//ADD AJAX REQUEST HERE/////////////////
            //window.location.href = "inc/updatecompletestatus.php?listindex="+keyIndex;
           // todoInComplete();
          //  Lis[i].style.backgroundColor = "tomato";
		//	changer = false;
		//}
       // }
	//})
    

///////////////////////////////////////////////////////////////////////////////////////////////








///////// COUNT STATUS UPDATE////////////////////////////////////////////////////////////////////
let countStatus = ( myColor , myTarget )=>{
    var num = [];
    for(let i =0; i < Lis.length; i++){
        if(Lis[i].style.backgroundColor == myColor){
           num.push(i);
           }
    }
    myTarget.textContent = num.length;
}


setInterval(()=>{
    countStatus('seagreen' , count1);
    countStatus('tomato' , count2);///////////UPDATES COMPLETED INPROGRESS & PENDING
    countStatus('',count3);
})

///////////////////////////////////////////////////////////////////////////////////////////////////





