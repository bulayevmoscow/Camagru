let playStatus = 0;
let video;
let canvas;
let indexPhoto = {
    blob: null,
    url: null
}


function webcam_make_snapshot(event) {
    let preview = document.querySelector("#preview");
    if (document.querySelector("#preview").childElementCount) {
        clearPreview();
        playStatus = 1;
    }
    video = document.querySelector('video');
    let buttonSubmit = document.querySelector('#wc-b-submit');
    canvasPlace = document.querySelector('div.canvas');
    document.querySelector("#wc-b-download").classList.toggle('d-none');
    let settings = document.querySelector('#wc-mask-list');
    clearPreview();
    if (playStatus) {
        video.play();
        video.classList.remove('d-none');
        settings.classList.add('d-none');
        clearPreview();
        buttonSubmit.classList.toggle('d-none');
        clearParamsImage();
        document.querySelector('#wc-mask-list').removeEventListener('change', sendImageToRender);

    } else {
        video.pause();

        video.classList.add('d-none');
        settings.classList.remove('d-none');
        submitPhoto();
        buttonSubmit.classList.toggle('d-none');
        document.querySelector('#wc-mask-list').addEventListener('change', sendImageToRender)
    }

    event.target.innerHTML = (playStatus) ? 'Сделать снимок' : 'Переснять';
    playStatus = (playStatus) ? 0 : 1;

}

function getPhotoFromLoad(event) {
    if (!event.target.files.length)
        return;
    if (event.target.files[0].size > 1800000) {
        alert("Ошибка изображения, ограничение в 1.8mb, текущий размер =" + ((event.target.files[0].size) / 1024 / 1024).toFixed(2) + 'mb');
        return;
    }
    let preview = document.querySelector('#preview')
    let file = event.target.files[0];
    let settings = document.querySelector('#wc-mask-list');
    let downloadButton = document.querySelector('#downloadImageLabel')
    let buttonSubmit = document.querySelector('#wc-b-submit');
    let buttonDownload = document.querySelector('#wc-b-download');
    video = document.querySelector('video');
    if (event.target.length === 0) {
        return;
    }
    // console.log(URL.createObjectURL(file));
    // console.log(event.target.files);
    let image = document.createElement('img');
    clearPreview();
    settings.classList.remove('d-none');
    downloadButton.classList.remove('d-none');
    buttonDownload.classList.remove('d-none');
    buttonSubmit.classList.remove('d-none');
    indexPhoto.blob = file;
    indexPhoto.url = image.src = URL.createObjectURL(file);
    preview.append(image);
    if (!document.querySelector("video").classList.contains('d-none'))
        document.querySelector("video").classList.toggle('d-none')
    if (downloadButton.innerHTML === 'Загрузить файл') {

        document.querySelector('#wc-mask-list').removeEventListener('change', sendImageToRender);
    } else {
        clearParamsImage();
        document.querySelector('#wc-mask-list').addEventListener('change', sendImageToRender);
    }
    downloadButton.innerHTML = (downloadButton.innerHTML === 'Загрузить файл') ? 'Загрузить новый файл' : 'Загрузить файл';
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
        preview.append(image);
    })
}

function addPhotoToThumbnails() {
    let image = document.querySelector('#preview > img');
    let target = document.querySelector('#thumbnails');
    let shell = document.createElement('div');
    shell.innerHTML = '<span aria-hidden="true">&times;</span>';
    shell.querySelector('span').addEventListener('click', (event) => {
        shell.remove();
    })
    shell.classList.add('col-12', 'position-relative', 'col-lg-6');
    shell.append(image.cloneNode(true));
    target.append(shell);
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
            })
            .then(value => {
                console.log(value)
            })
        )
}

function sendImagesToSave() {
    let images = document.querySelectorAll('#thumbnails img');
    if (images.length === 0)
        return;
    console.clear()
    let form = new FormData();
    let promises = Array();
    form.append('json', JSON.stringify(getParamsImage()));
    // form.append("indexPhoto", indexPhoto.blob, 'img.png');
    images.forEach((image, i) => {
        let canvas = document.createElement('canvas');
        canvas.width = image.naturalWidth;
        canvas.height = image.naturalHeight;
        let ctx = canvas.getContext('2d');
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        let canvasBlob = getCanvasBlob(canvas);
        promises.push(canvasBlob);
        canvasBlob.then(function (e) {
            form.append("photos[]", e, i + 'img.png');
        })
    })
    // console.log(blob);
    // console.log(Promise.)
    // console.log(promises);
    Promise.all(promises).then(() => {
        console.log(form.getAll('photos[]'))
        fetch('/controller/push_images.php', {
            'method': 'POST',
            'url': 'localhost:8080/controller/fisting.php',
            body: form
        })
            .then(response => response.status).then(statusCode => {
            if (statusCode === 200)
                window.location = 'http://localhost:8080/?page=gallery&pages=0&msg=%20%D0%A4%D0%BE%D1%82%D0%BE%D0%B3%D1%80%D0%B0%D1%84%D0%B8%D0%B8%20%D0%B4%D0%BE%D0%B1%D0%B0%D0%B2%D0%BB%D0%B5%D0%BD%D1%8B'
            else
                alert('Ошибка ' + statusCode)
        })
    })
}

function getCanvasBlob(canvas) {
    return new Promise(function (resolve, reject) {
        canvas.toBlob((blob => {
            resolve(blob);
        }))
    })
}


// async function fillBlob(blob, form, image, i) {
//     let canvas = document.createElement('canvas');
//     canvas.width = image.naturalWidth;
//     canvas.height = image.naturalHeight;
//     let ctx = canvas.getContext('2d');
//     ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
//     await canvas.toBlob((e) => {
//         blob.push(e);
//         form.append("indexPhoto", e, i + '1.png');
//         // console.log(form.getAll('indexPhoto'));
//     })
//     return blob


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
    return {
        mainNode: document.querySelector('#wc-mask-list'),
        wcSettingBrightness: wcSettingBrightness.value,
        wcSettingContrast: wcSettingContrast.value,
        wcSettingInvert: wcSettingInvert.checked,
        wcSettingGrayscale: wcSettingGrayscale.checked,
        wcSettingIcon: document.querySelector('input[type="radio"]:checked').value
    };
}

function clearParamsImage() {
    wcSettingBrightness.value = 0;
    wcSettingContrast.value = 0;
    wcSettingInvert.checked = false;
    wcSettingGrayscale.checked = false;
}