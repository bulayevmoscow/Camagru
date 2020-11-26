let playStatus = 0;
let video;
let canvas;
let indexPhoto = {
    blob: null,
    url: null
}
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
        wcSettingBrightness.value = 0;
        wcSettingContrast.value = 0;
        wcSettingInvert.checked = false;
        wcSettingGrayscale.checked = false;
        document.querySelector('#wc-mask-list').removeEventListener('change', sendImageToRender)
    } else {
        video.pause();
        video.classList.toggle('d-none');
        submitPhoto();
        buttonAddMask.classList.toggle('d-none');
        buttonSubmit.classList.toggle('d-none');
        document.querySelector('#wc-mask-list').addEventListener('change', sendImageToRender)
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
    let dataURI;
    canvas.toBlob((blob) => {
        indexPhoto.blob = blob;
        indexPhoto.url = dataURI = URL.createObjectURL(blob);
        let image = document.createElement('img');
        clearPreview();
        image.src = dataURI;
        //
        let link = document.createElement('a');
        link.setAttribute('href', dataURI);
        link.innerText = 'Download';
        preview.append(link);
        //
        preview.append(image);
    })
    // dataURI = canvas.toDataURL('image/jpeg');
    // dataURI = canvas.toDataURL('image/jpeg')


}

function sendImageToRender() {
    let img = document.querySelector('#preview>img');
    let form = new FormData();
    form.append('json', JSON.stringify(getParamsImage()));
    form.append("indexPhoto", indexPhoto.blob, 'img.png');

    //blob
    fetch('/controller/fisting.php', {
        'method': 'POST',
        'url': 'localhost:8080/controller/fisting.php',
        body: form
    })
        .then(response => response.blob()
            .then((blob) => {
                img.src = URL.createObjectURL(blob)
            }))

    // fetch('/controller/test.php', {
    //     'method': 'POST',
    //     'url': 'localhost:8080',
    //     body: form
    // })
    //     .then(response => response.blob()
    //         .then(response => response.text())
    //         .then(json => console.log(json)))
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

function getParamsImage() {
//                    <div id="wc-mask-list">
//                     <label for="wcSettingBrightness">Яркость</label>
//                     <input type="range" class="form-control-range" id="wcSettingBrightness" value="255" min="0" max="255" step="1">
//                     <label for="wcSettingContrast">Контраст</label>
//                     <input type="range" class="form-control-range" id="wcSettingContrast" value="255" min="0" max="255" step="1"
//                            onchange="console.log(this.value)">
//                     <div class="form-check">
//                         <input class="form-check-input" type="checkbox" value="" id="wcSettingInvert">
//                         <label class="form-check-label" for="wcSettingInvert">Инвертировать цвета</label>
//                         <div class="w-100"></div>
//                         <input class="form-check-input" type="checkbox" value="" id="wcSettingGrayscale">
//                         <label class="form-check-label" for="wcSettingGrayscale">Чернобелое</label>
//                     </div>
//                 </div>
    let info = {
        mainNode: document.querySelector('#wc-mask-list'),
        wcSettingBrightness: wcSettingBrightness.value,
        wcSettingContrast: wcSettingContrast.value,
        wcSettingInvert: wcSettingInvert.checked,
        wcSettingGrayscale: wcSettingGrayscale.checked
    }
    // console.log(info);
    return info;
}
