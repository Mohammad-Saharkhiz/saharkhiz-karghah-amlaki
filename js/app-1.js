const navLinks = document.querySelector(".nav-links")
const closeIcone = document.querySelector(".close-icone")
const login = document.querySelector(".login")
const cover = document.querySelector(".cover")

navLinks.addEventListener('click', function () {
    login.classList.add('login-show')
    cover.classList.add('cover-show')
})

closeIcone.addEventListener('click', function () {
    login.classList.remove('login-show')
    cover.classList.remove('cover-show')
})

const menuItems = document.querySelectorAll(".menu--items")

menuItems.forEach(item => {
    item.addEventListener('click', function (e) {
        e.preventDefault()
        
        let sectionClass = item.getAttribute("data-section")
        let sectionOFFsetTop = document.querySelector(`.${sectionClass}`).offsetTop
        window.scrollTo({
            top: sectionOFFsetTop,
            behavior: "smooth"
        })
    })
})