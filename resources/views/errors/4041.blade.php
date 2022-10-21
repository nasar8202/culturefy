<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Page Not Found</title>
</head>
<style>
    body{
  margin:0;
  padding:0;
  font-family: 'Tomorrow', sans-serif;
  height:100vh;
background-image: linear-gradient(to top, #2e1753, #1f1746, #131537, #0d1028, #050819);
  display:flex;
  justify-content:center;
  align-items:center;
  overflow:hidden;
}
.text{
  position:absolute;
  top:10%;
  color:#fff;
  text-align:center;
}
h1{
  font-size:50px;
}
.star{
  position:absolute;
  width:2px;
  height:2px;
  background:#fff;
  right:0;
  animation:starTwinkle 3s infinite linear;
}
.astronaut img{
  width:100px;
  position:absolute;
  top:55%;
  animation:astronautFly 6s infinite linear;
}
@keyframes astronautFly{
  0%{
    left:-100px;
  }
  25%{
    top:50%;
    transform:rotate(30deg);
  }
  50%{
    transform:rotate(45deg);
    top:55%;
  }
  75%{
    top:60%;
    transform:rotate(30deg);
  }
  100%{
    left:110%;
    transform:rotate(45deg);
  }
}
@keyframes starTwinkle{
  0%{
     background:rgba(255,255,255,0.4);
  }
  25%{
    background:rgba(255,255,255,0.8);
  }
  50%{
   background:rgba(255,255,255,1);
  }
  75%{
    background:rgba(255,255,255,0.8);
  }
  100%{
    background:rgba(255,255,255,0.4);
  }
}

a {
  margin: 20px;
}
.custom-btn {
  width: 130px;
  /* height: 40px; */
  color: #fff;
  border-radius: 5px;
  padding: 10px 25px;
  font-family: 'Lato', sans-serif;
  font-weight: 500;
  background: transparent;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
   box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
  outline: none;
}

/* 11 */
.btn-11 {
  border: none;
  background: rgb(251,33,117);
    background: linear-gradient(0deg, rgba(251,33,117,1) 0%, rgba(234,76,137,1) 100%);
    color: #fff;
    overflow: hidden;
}
.btn-11:hover {
    text-decoration: none;
    color: #fff;
}
.btn-11:before {
    position: absolute;
    content: '';
    display: inline-block;
    top: -180px;
    left: 0;
    width: 30px;
    height: 100%;
    background-color: #fff;
    animation: shiny-btn1 3s ease-in-out infinite;
}
.btn-11:hover{
  opacity: .7;
}
.btn-11:active{
  box-shadow:  4px 4px 6px 0 rgba(255,255,255,.3),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.2),
    inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
}


@-webkit-keyframes shiny-btn1 {
    0% { -webkit-transform: scale(0) rotate(45deg); opacity: 0; }
    80% { -webkit-transform: scale(0) rotate(45deg); opacity: 0.5; }
    81% { -webkit-transform: scale(4) rotate(45deg); opacity: 1; }
    100% { -webkit-transform: scale(50) rotate(45deg); opacity: 0; }
}

</style>
<body>
    <div class="text">
        <div>ERROR</div>
        <h1>404</h1>
        <hr>
        <div>Page Not Found</div>
        <a href="{{route("dashboard")}}" class="custom-btn btn-11">Go to Home<div class="dot"></div></a>
      </div>
      
      <div class="astronaut">
        <img src="https://images.vexels.com/media/users/3/152639/isolated/preview/506b575739e90613428cdb399175e2c8-space-astronaut-cartoon-by-vexels.png" alt="" class="src">
      </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded",function(){
  
  var body=document.body;
   setInterval(createStar,100);
   function createStar(){
     var right=Math.random()*500;
     var top=Math.random()*screen.height;
     var star=document.createElement("div");
  star.classList.add("star")
   body.appendChild(star);
   setInterval(runStar,10);
     star.style.top=top+"px";
   function runStar(){
     if(right>=screen.width){
       star.remove();
     }
     right+=3;
     star.style.right=right+"px";
   }
   } 
 })
</script>
</html>