window.addEventListener('load', ()=>{
    const togglePassword = document.getElementById('toggle-password')
    const txtPassword = document.getElementById('txtPassword')

    togglePassword.addEventListener('click', ()=>{
        if(togglePassword.classList.contains('fa-eye-slash')){
            togglePassword.classList.remove('fa-eye-slash')
            togglePassword.classList.add('fa-eye')
            txtPassword.type = "password"
        } 
        else{
            togglePassword.classList.remove('fa-eye')
            togglePassword.classList.add('fa-eye-slash')
            txtPassword.type = "text"
        }
    })
})