@section('js')
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script> 
<script type="text/javascript"> 
  document.addEventListener("DOMContentLoaded", function() { 
    init(); 
  }); 

  const URL = "../my_model/";

  let model, webcam, labelContainer, maxPredictions; 
  let snapshotContainer; 
  let isPredictionEnabled = false; 

  async function init() { 
    const modelURL = URL + "model.json"; 
    const metadataURL = URL + "metadata.json"; 

    model = await tmImage.load(modelURL, metadataURL); 
    maxPredictions = model.getTotalClasses(); 

    const flip = true; 
    webcam = new tmImage.Webcam(300, 300, flip); 
    await webcam.setup(); 
    await webcam.play(); 
    window.requestAnimationFrame(loop); 

    document.getElementById("webcam-container").appendChild(webcam.canvas); 
    labelContainer = document.getElementById("label-container"); 
    snapshotContainer = document.getElementById("snapshot-container"); 
  } 

  async function loop() { 
    webcam.update(); 
    if (isPredictionEnabled) { 
      await predict(); 
    } 
    window.requestAnimationFrame(loop); 
  } 

  async function predict() { 
    const prediction = await model.predict(webcam.canvas); 
    let highestProbability = 0; 
    let predictedClass = ""; 
    for (let i = 0; i < maxPredictions; i++) { 
      if (prediction[i].probability > highestProbability) { 
        highestProbability = prediction[i].probability; 
        predictedClass = prediction[i].className; 
      } 
    } 
    const predictionClassElement = document.getElementById("prediction-class"); 
    const predictionPercentageElement = document.getElementById("prediction-percentage"); 
    predictionClassElement.innerHTML = predictedClass; 
    // predictionPercentageElement.innerHTML =  : ${(highestProbability * 100).toFixed(2)}%; 
    labelContainer.style.display = "block"; 
  } 

  function takeSnapshot() { 
    const canvas = document.createElement("canvas"); 
    canvas.width = webcam.canvas.width; 
    canvas.height = webcam.canvas.height; 
    const context = canvas.getContext("2d"); 
    context.drawImage(webcam.canvas, 0, 0); 

    const imgDataUrl = canvas.toDataURL(); 
    const snapshotImg = document.createElement("img"); 
    snapshotImg.src = imgDataUrl; 
    snapshotImg.classList.add("snapshot-img"); 
    snapshotContainer.innerHTML = ""; 
    snapshotContainer.appendChild(snapshotImg); 

    webcam.stop(); 
    document.getElementById("webcam-container").style.display = "none"; 

    isPredictionEnabled = true; 
    predict(); 
  } 
</script> 
@stop

@section('css')
<style>  
    .webcam-title { 
      margin-bottom: 16px; 
      color: #3A5B22; 
      font-size: 20px; 
      font-family: Lato;
      font-style: normal; 
      font-weight: 800; 
      line-height: normal; 
    } 
 
    .webcam-container { 
      margin-bottom: 16px; 
    } 
 
    .prediction-container { 
      margin-bottom: 16px; 
    } 
 
    .snapshot-container { 
      margin-bottom: 16px; 
      position: relative; 
    } 
 
    .snapshot-img { 
      max-width: 100%; 
      height: auto; 
    } 
 
    .snapshot-button { 
      margin-top: 16px; 
      background-color: #3A5B22; 
      color: #FFFFFF; 
      border: none; 
      padding: 10px 20px; 
      font-size: 16px; 
      font-family: Lato; 
      font-weight: 600; 
      cursor: pointer; 
    } 
 
    .snapshot-button:hover { 
      background-color: #1E360F; 
    } 
 
    .snapshot-button:active { 
      background-color: #FCD34D; 
    } 
    .webcam-section { 
      flex: 1; 
      margin-left: 16px; 
    } 
</style> 
@stop

@extends('dashboard')

@section('content')
<div class="col-md-9"> 
    <div class="webcam-section"> 
      <h3 class="webcam-title">Deteksi Kematangan</h3> 
      <div class="webcam-container" id="webcam-container"></div> 
      <div class="prediction-container" id="label-container"> 
        <span id="prediction-class"></span> 
        <span id="prediction-percentage"></span> 
      </div> 
      <div class="snapshot-container" id="snapshot-container"></div> 
      <!-- <button type="button" onclick="takeSnapshot()" class="btn btn-primary snapshot-button">Take Snapshot</button> --> 
      <button type="button" onclick="takeSnapshot()" class="btn btn-primary snapshot-button">Take Snapshot</button> 
   
    </div> 
  </div> 
@endsection