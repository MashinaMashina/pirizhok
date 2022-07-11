let groupIterator = 0;
let posIterator = 0;

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.js-add-group').forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            event.preventDefault();

            groupIterator--
            let tpl = document.querySelector('#menu-group').innerHTML
            tpl = tpl.replaceAll('%groupId%', groupIterator)

            let div = document.createElement('div')
            div.innerHTML = tpl

            document.querySelector('.js-menu-container').append(div)
        })
    })

    document.querySelector('body').addEventListener('click', function (event) {
        if (event.target.matches('.js-add-position')) {
            posIterator--

            let tpl = document.querySelector('#menu-position').innerHTML
            tpl = tpl.replaceAll("%groupId%", event.target.dataset.num)
            tpl = tpl.replaceAll("%posId%", posIterator)

            let div = document.createElement('div')
            div.innerHTML = tpl

            event.target.closest('.js-group-container').querySelector('.js-menu-positions').append(div)
        }
    })
})