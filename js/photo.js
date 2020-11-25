let playStatus = 0;
let video;
let canvas;
//                    <a id="wc-b-makephoto" class="btn btn-danger" onclick="webcam_stop_recording(event)">Сделать снимок</a>
//                     <a id="wc-b-addmask" class="btn btn-success" disabled>Добавить маску</a>
//                     <a id="wc-b-submit" class="btn btn-primary" onclick="sumbit_photo()">Отправить</a>
function webcam_make_snapshot(event) {
    video = document.querySelector('video');
    let buttonMakeSnapshot = document.querySelector('#wc-b-add-mask');
    let buttonAddMask = document.querySelector('#wc-b-addmask');
    let buttonSubmit = document.querySelector('#wc-b-submit');
    canvasPlace = document.querySelector('div.canvas');
    if (playStatus) {
        video.play();
        video.classList.toggle('d-none');
        clearPreview();
        buttonAddMask.classList.toggle('d-none');
        buttonSubmit.classList.toggle('d-none');
    } else {
        video.pause();
        video.classList.toggle('d-none');
        submitPhoto();
        buttonAddMask.classList.toggle('d-none');
        buttonSubmit.classList.toggle('d-none');
    }

    event.target.innerHTML = (playStatus) ? 'Сделать снимок' : 'Переснять';
    playStatus = (playStatus) ? 0 : 1;

}

function submitPhoto() {
    let canvas = document.createElement('canvas');
    let video = document.querySelector('video');
    let preview = document.querySelector('#preview')
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    let ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    dataURI = canvas.toDataURL('image/jpeg')
    clearPreview();
    let image = document.createElement('img');
    image.src = dataURI;
    preview.append(image);
}

function clearPreview() {
    let preview = document.querySelector('#preview');
    preview.innerHTML = '';
}


function addWebCam() {
    navigator.getUserMedia(
        {video: true},
        function (stream) {
            let video = document.querySelector('video');
            video.srcObject = stream;
            video.play();
            video.addEventListener('canplay', () => {
                video.classList.toggle('d-none')
                document.querySelector('#wc-b-makephoto').classList.toggle('d-none');
            })

        },
        function (err) {
            document.querySelector('#web-cam-err').innerHTML = 'Ошибка подключение к камере, проверте ее наличие или ' +
                'разрешите сайту доступ к камере. Или загрузите ваш снимок<br>Код ошибки ' + err;
        }
    );
}

document.addEventListener('DOMContentLoaded', () => {
    addWebCam();

})

let jsonexample = {
    name: 'alex',
    age: 25
}

function getImageWithParams(){
    let jsonexample = {
        name: 'alex',
        age: 25,
        // blob: document.querySelector('#preview>img').src
    }


    fetch('/controller/fisting.php', {
        'method': 'POST',
        'url': 'localhost:8080/controller/fisting.php',
        'headers': {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: "json="+JSON.stringify(jsonexample)+"&blob="+document.querySelector('#preview>img').src
        // 'form': 'yes',
        // 'blob': document.querySelector('#preview>img').src
    })
        .then(response => response.text())
        .then(json => console.log(json))
}
