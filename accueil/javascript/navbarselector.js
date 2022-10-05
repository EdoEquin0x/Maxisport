// Javascript utilisé pour styliser la barre de navigation pc, il met en vert la page actuellement consultée
// Au vu du fait que j'y ajoutais progressivement les pages, la répétitivité de la méthode ne m'as pas dérangé.
// J'ai tenté de réaliser un switch mais il ne marchais pas comme convenu, j'ai donc continué avec cette méthode, bien que répétitive

const actualpage = window.location.href
const home = document.getElementById('home')
const infos = document.getElementById('infos')
const offers = document.getElementById('offers')
const login = document.getElementById('login')

const pannel = document.getElementById('pannel')
const logout = document.getElementById('logout')


    
      



if (actualpage.includes("index.php")) {
    home.classList.toggle('active')
}
if (actualpage.includes("infos.php")) {
    infos.classList.toggle('active')
}
if (actualpage.includes("offers.php")) {
    offers.classList.toggle('active')
}
if (actualpage.includes("login.php")) {
    login.classList.toggle('active')
}


if (actualpage.includes("Logout.php")) {
    logout.classList.toggle('active')
}



if (actualpage.includes("legal.php")) {
    home.classList.toggle('active')
  }



if (actualpage.includes("pannel.php")){
    pannel.classList.toggle('active')
}


if (actualpage.includes("establishlisting.php")){
    pannel.classList.toggle('active')
}


if (actualpage.includes("franchiselisting.php")){
    pannel.classList.toggle('active')
}

if (actualpage.includes("validforminfos.php")){
    pannel.classList.toggle('active')
}

if (actualpage.includes("editestablish.php")){
    pannel.classList.toggle('active')
}

if (actualpage.includes("establishreadonly.php")){
    pannel.classList.toggle('active')
}

if (actualpage.includes("franchisereadonly.php")) {
    pannel.classList.toggle('active')
}


if (actualpage.includes("createform.php")) {
    pannel.classList.toggle('active')
}




