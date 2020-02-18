alert("Приветствую, тут вам предстоит пройти небольшой квест который поможет познакомиться с нашим лицеем")

 function nextFunc(){
     otvet = document.getElementById("otvet1").value;
     var true1 = "ooo";  //ПРАВИЛЬНЫЙ ОТВЕТ
   if (otvet == true1) {
     alert("Kkk");    //ЕСЛИ ПРАВ
   } else {
     alert("eee");      //ЕСЛИ НЕВЕРНО
   }
 }
