const profile = document.querySelector(".user-profile")
const exit = document.querySelector(".profile-details")
profile.addEventListener('click', function () {
    if(exit.style.opacity == '1'){
        exit.style.opacity = '0'
        exit.style.visibility = 'hidden'
    }else{
        exit.style.opacity = '1'
        exit.style.visibility = 'visible'
    }
})