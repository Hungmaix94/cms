document.querySelector('#postFetchAPI').addEventListener('click', onClick);
let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function onClick() {
    fetch(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify({
            name: 'Tushar',
            number: '78987'
        })
    })
        .then((data) => {
        window.location.href = redirect;
}).catch(function (error) {
        console.log(error);
    });
}