// regSwitcher = document.querySelector('body');

regSwitcher.querySelectorAll('.btn').forEach((x) => {
    x.addEventListener('click', (x) => {
        if (x.target.classList.contains('btn')) {
            regSwitcher.querySelectorAll('.btn').forEach(elements => {
                elements.classList.toggle('active');
            })
            document.querySelectorAll('.form-signin, .form-login').forEach(x=>{
                x.classList.toggle('d-none');
            })
        }

    })
})

//classList.toggle('d-none')