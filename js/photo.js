let playStatus = 0;

function webcam_stop_recording(event) {
    let video = document.querySelector('video');
    if (playStatus)
        video.play();
    else
        video.pause();
    event.target.innerHTML = (playStatus) ? 'Сделать снимок' : 'Переснять';
    playStatus = (playStatus) ? 0 : 1;

}

function sumbit_photo() {
    let canvas = document.createElement('canvas');
    let video = document.querySelector('video');
    canvas.width = parseInt(getComputedStyle(video).width);
    canvas.height = parseInt(getComputedStyle(video).height);
    let ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    let dataURI = canvas.toDataURL('image/jpeg');

    const url = '/controller/fisting.php';
    const data = {'test': 213};

    // fetch('https://jsonplaceholder.typicode.com/posts')
    //     .then(res=>console.log(res.json()))
    //     .catch(()=>console.log(err));
    let user = {
        name: 'John',
        surname: 'Smith',
    };
    console.log(JSON.stringify(user));
    fetch('/controller/fisting.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: JSON.stringify(user)
    })
        .then(response => response.text())
        .then(json => console.log(json))

}


function capture() {
    let canvas = document.createElement('canvas');
    let video = document.querySelector('video');
    canvas.width = parseInt(getComputedStyle(video).width);
    canvas.height = parseInt(getComputedStyle(video).height);
    let ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    dataURI = canvas.toDataURL('image/jpeg');
    let image = document.createElement('img');
    image.src = dataURI;
    image.classList.add('border', 'm-2');
    document.querySelector('#preview').append(image);

}