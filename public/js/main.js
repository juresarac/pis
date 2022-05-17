

var container = document.querySelector('.rating')
var items     = container.querySelectorAll('.rating-item')
var form      = document.getElementById('form')
var user_id   = document.getElementById('user').value
var course_id = window.location.pathname.split('/')[3]
var rating = ''

container.addEventListener('click', function (e) {
const elClass = e.target.classList
    if (!elClass.contains('active')) {
        items.forEach(
            item => item.classList.remove('active')
        )
        console.log(e.target.getAttribute('data-rate'))
        rating = e.target.getAttribute('data-rate')
        elClass.add('active')
        form.style.display = 'block'
    }
})

form.addEventListener('submit', (event) => {
    event.preventDefault()
    var comment = document.getElementById('comment').value
    const data = {
        rating: rating,
        comment: comment,
        course_id: course_id,
        user_id: user_id,
    }
    fetch('/api/user/rating', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(res => res.json())
    .then(res => {
        if (res.message === 'Success') {
            form.style.display = 'none'
            location.reload();
        }
        console.log(res)
    })
})

