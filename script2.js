alert("Приветствую, тут вам предстоит пройти небольшой квест который поможет познакомиться с нашим лицеем")

 function nextFunc(){
     otvet = document.getElementById("otvet1").value;
     var true1 = "105";  //ПРАВИЛЬНЫЙ ОТВЕТ
   if (otvet == true1) {
     alert("Правильно");    //ЕСЛИ ПРАВ
   } else {
     alert("НЕВЕРНО");      //ЕСЛИ НЕВЕРНО
   }
 }
