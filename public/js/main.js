
 
 const btn_update_project=document.querySelectorAll(".btn_update_project");
 const popup =document.getElementById("popup");

btn_update_project.forEach(button => {
    button.addEventListener("click",()=>{
        popup.classList.toggle("hidden");

    })
});

const burgermenu = document.querySelector(".burgermenu");

  const sidebar = document.getElementById("sidebar");
  burgermenu.addEventListener("click", () => {
  
   
    sidebar.classList.remove("hidden");
  });
  const fermernav = document.getElementById("fermernav");

  fermernav.addEventListener("click", () => {
    
    sidebar.classList.add("hidden");
  });





