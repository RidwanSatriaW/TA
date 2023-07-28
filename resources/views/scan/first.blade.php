@section('js')
<script>
    document.addEventListener('DOMContentLoaded', async () => {
      const snapshotBtn = document.getElementById('snapshotBtn');
      const outputDiv = document.getElementById('output');
      const resultDiv = document.getElementById('result');
      let videoStream;
      let videoElement;
      let model;
  
      try {
        videoStream = await navigator.mediaDevices.getUserMedia({ video: { width: 300, height: 300 } });
        videoElement = document.createElement('video');
        videoElement.srcObject = videoStream;
        videoElement.play();
        outputDiv.appendChild(videoElement);
  
        model = await tf.loadLayersModel('../my_model/model.json');
        console.log('Model Loaded');
        snapshotBtn.disabled = false;
      } catch (error) {
        console.error('Error accessing webcam or loading model:', error);
      }
  
      snapshotBtn.addEventListener('click', () => {
        takeSnapshot();
      });
  
      async function takeSnapshot() {
        const canvasOriginal = document.createElement('canvas');
        canvasOriginal.width = 300;
        canvasOriginal.height = 300;
        const ctxOriginal = canvasOriginal.getContext('2d');
        ctxOriginal.drawImage(videoElement, 0, 0, canvasOriginal.width, canvasOriginal.height);
  
        const canvasReshaped = document.createElement('canvas');
        canvasReshaped.width = 48;
        canvasReshaped.height = 48;
        const ctxReshaped = canvasReshaped.getContext('2d');
        ctxReshaped.drawImage(videoElement, 0, 0, canvasReshaped.width, canvasReshaped.height);
  
        // Tampilkan gambar asli sebelum direshape
        const originalImg = document.createElement('img');
        originalImg.src = canvasOriginal.toDataURL('image/png');
        originalImg.style.width = '300px';
        resultDiv.innerHTML = ''; // Hapus konten sebelum menambahkan gambar hasil snapshot
        resultDiv.appendChild(originalImg);
  
        const imageData = ctxReshaped.getImageData(0, 0, canvasReshaped.width, canvasReshaped.height);
        const tensor = tf.browser.fromPixels(imageData).mean(2).expandDims(2).toFloat().div(tf.scalar(255));
        const prediction = model.predict(tensor.reshape([-1, 48, 48, 1]));
        const result = prediction.arraySync()[0];
        const emotions = ['angry', 'happy', 'netral', 'sad'];
        const maxIndex = result.indexOf(Math.max(...result));
        const emotion = emotions[maxIndex];
  
        const emojiMap = {
        angry: '😠',
        happy: '😄',
        netral: '😐',
        sad: '😢'
        };
        const emoticon = emojiMap[emotion] || '😶'; // Gunakan emoticon default jika emosi tidak dikenali
        outputDiv.innerText = `Predicted Emotion: ${emotion} ${emoticon}`;
        const emotionResultElem = document.getElementById('emotionResult');
        emotionResultElem.value = emotion;
        tensor.dispose();
        // Matikan webcam
        videoStream.getVideoTracks().forEach(track => track.stop());
      }
  
      window.addEventListener('beforeunload', () => {
        if (videoStream) {
          videoStream.getVideoTracks().forEach(track => track.stop());
        }
      });
    });
</script>


<script>
    //action update post
    $('#submit').click(function(e) {
        e.preventDefault();

        // define variable
    
        let user = $('#user').val();
        // let necessity = $('#necessity').val();
        let person = $('#person').val();
        let emotion = $("#emotionResult").val();
        console.log(user);  

        
        //ajax
        $.ajax({

            url: '/visitor/add_validation',
            type: 'POST',
            cache: false,
            data: {
                "user":user,
                // "necessity" : necessity,
                "person" : person,
                "emotion" : emotion,
                "_token":"{{ csrf_token() }}"
            },
            
            success:function(response){
                Swal.close();
                if (response.success == true) {

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Success',
                    showConfirmButton: false,
                    timer: 3000
                });
                window.location.href = '/visitor';
            }

        //         //close modal
                // $('#modal-first').modal('hide');
            },
            

        });

    });
</script>
@stop


@extends('dashboard')
@section('content')

{{-- <form method="POST" action="{{ route('visitor.add_validation') }}">
@csrf --}}
<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Emotion Detection</h4>
                <div id="container">
                    <div id="main-container">
                        <button id="snapshotBtn">Capture Snapshot</button>
                        <div id="output"></div>
                        <div id="result"></div>
                        <input type="hidden" id="emotionResult">
                        <input type="text" hidden name="user" id="user" value="{{ $visitor['user'] }}">
                        {{-- <input type="text" hidden name="necessity" id="necessity"  value="{{ $visitor['necessity'] }}"> --}}
                        <input type="text" hidden name="person" id="person"  value="{{ $visitor['person'] }}">

                        <button type="submit" class="btn btn-primary" id="submit">
                            Submit
                        </button>
                    </div>
                 </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.8.0/dist/tf.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection