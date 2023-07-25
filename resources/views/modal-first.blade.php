<!-- Modal -->
<div class="modal fade" id="modal-first" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Emotion Detection</h5>
            </div>
            <div class="modal-body">
                <div id="container">
                    <div id="main-container">
                        <h1>Scan Emotion</h1>
                        <div class="hide" id="loader-container">
                            <div class="loader" id="progress-circle"></div>
                            <span id="progress-label">Loading prediction model</span>
                        </div>
                        <div id="my-camera"></div>
                        <input type=button value="Take Snapshot" onClick="take_snapshot()" id="takeSnapshot">
                        <input type="hidden" name="image" class="image-tag">
                        <div id="results">Your captured image will appear here...</div>
                        <div class="hide" id="result-container">
                            <h2>Result</h2>
                            <p id="result-name"></p>
                            <p id="result-perc"></p>
                            <canvas width="200" height="200" id="Input"></canvas>
                        </div>
                        <button type="button" class="hide" onclick="reset()" id="btn-reset" >Reset</button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submit">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> 
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    const URL = "../my_model/";

    let model, labelContainer, maxPredictions;

    let ctx = document.getElementById('Input');

    async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        $("#loader-container").removeClass("hide");
        $("#progress-label").text("Scanning...");
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();
        window.requestAnimationFrame(loop);
    }

    async function loop() {
        await predict();
    }

    async function predict() {
        $("#progress-label").text("Success");
        var ctx = document.getElementById('Input');
        const prediction = await model.predict(ctx);

        var th = 0.04;

        var entries = new Array;
        for (let i = 0; i < maxPredictions; i++) {
            entries.push(i);
        }
        
      
        for (let i = 0; i < maxPredictions - 1; i++) {
            for (let j = 1; j < maxPredictions - i; j++) {
                if (prediction[entries[j - 1]].probability < prediction[entries[j]].probability) {
                    let tmp = entries[j - 1];
                    entries[j - 1] = entries[j];
                    entries[j] = tmp;
                }
            }
        }

        setResult(prediction[entries[0]].className, prediction[entries[0]].probability.toFixed(2));
        for (let i = 1; i < maxPredictions; i++) {
            if (prediction[entries[i]].probability >= th)
                drawEntry(labelContainer.childNodes[i], 
                        prediction[entries[i]].className, 
                        prediction[entries[i]].probability.toFixed(2));
        }
        $("#loader-container").addClass("hide");
        $("#btn-reset").removeClass("hide");
    }

    // webcam
    async function open_camera(){
        Webcam.set({
            width: 200,
            height: 200,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
  
        Webcam.attach( '#my-camera' );
    }
    
    async function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'" id="coba" width="200" height="200" hidden/>';
            const image = new Image();
            image.src = data_uri;
        } );
        close_camera();
        const camera = document.getElementById("my-camera");
        const button = document.getElementById("takeSnapshot");
        removeElement(camera);
        removeElement(button);
        const img = document.getElementById("coba");



        if (ctx.getContext) {
            var canvas_width = ctx.width;
            var canvas_height = ctx.height;
            ctx = ctx.getContext('2d');
            img.onload = function() {
                img_width = img.width;
                img_height = img.height;

                var scale = 1;
                var offset_x = 0;
                var offset_y = 0;
                if (img_width > img_height) {
                    scale = canvas_height / img_height;
                    offset_x = -(img_width * scale - canvas_width) / 2;
                } else {
                    scale = canvas_width / img_width;
                    offset_y = -(img_height * scale - canvas_height) / 2;
                }
                ctx.clearRect(0, 0, canvas_width, canvas_height);
                ctx.drawImage(img, 
                            offset_x, 
                            offset_y, 
                            img_width * scale, 
                            img_height * scale);
            }
        }
  
        init();

    }
    async function close_camera() {
        await Webcam.reset();
    }

    async function removeElement(element) {
        if (element.parentNode) {
            element.parentNode.removeChild(element);
        }
    }

    // akhir webcam

    // $("#file_input").change(function(e){
    //     var URL = window.webkitURL || window.URL;
    //     var url = URL.createObjectURL(e.target.files[0]);
    //     var img = new Image();
    //     img.src = url;

    //     var ctx = document.getElementById('Input');
    //     if (ctx.getContext) {
    //         var canvas_width = ctx.width;
    //         var canvas_height = ctx.height;
    //         ctx = ctx.getContext('2d');
    //         img.onload = function() {
    //             img_width = img.width;
    //             img_height = img.height;

    //             var scale = 1;
    //             var offset_x = 0;
    //             var offset_y = 0;
    //             if (img_width > img_height) {
    //                 scale = canvas_height / img_height;
    //                 offset_x = -(img_width * scale - canvas_width) / 2;
    //             } else {
    //                 scale = canvas_width / img_width;
    //                 offset_y = -(img_height * scale - canvas_height) / 2;
    //             }
    //             ctx.clearRect(0, 0, canvas_width, canvas_height);
    //             ctx.drawImage(img, 
    //                         offset_x, 
    //                         offset_y, 
    //                         img_width * scale, 
    //                         img_height * scale);
                
    //             init();

    //             $("#file_input").addClass("hide");
    //         }
    //     }

    // });

    function drawEntry(elem_div, name, val) {
        var img, label, perc, progress;

        elem_div.className = "entry";

        elem_div.appendChild(document.createElement("img"));
        elem_div.appendChild(document.createElement("div"));
        
        var div_prog = elem_div.childNodes[1];
        div_prog.appendChild(document.createElement("div"));
        div_prog.appendChild(document.createElement("progress"));

        var div_label = div_prog.childNodes[0];
        div_label.className = "box_label";
        div_label.appendChild(document.createElement("div"));
        div_label.appendChild(document.createElement("div"));

        img = elem_div.childNodes[0];

        progress = div_prog.childNodes[1];

        label = div_label.childNodes[0];
        perc = div_label.childNodes[1];

        label.className = ("label");
        perc.className = ("perc");

        img.src = "./images/" + name + ".png";
        label.innerHTML = name;
        perc.innerHTML = (val * 100).toFixed(0) + "%";
        progress.value = Math.max(0.034, val);
    }

    function setResult(name, val) {
        $("#result-container").removeClass("hide");
        $("#Result").attr("src", "./images/" + name + ".png");
        $("#result-name").text(name);
        $("#result-perc").text((val * 100) + "%");
    }

    function reset() {
        $("#result-container").addClass("hide");
        // $("#file_input").removeClass("hide");
        $("#btn-reset").addClass("hide");
    }
</script>
<script>
    //button create post event
    $('body').on('click', '#btn-scan', function () {
        // open modal
        $('#modal-first').modal('show');
    });

    //action update post
    $('#submit').click(function(e) {
        e.preventDefault();

        // define variable
        let visitor_name = $('#visitor_name').val();
        let visitor_email   = $('#visitor_email').val();
        let visitor_mobile_no = $('#visitor_mobile_no').val();
        let visitor_address = $('#visitor_address').val();
        let necessity = $('#necessity').val();
        let person = $('#person').val();
        let emotion = $("#result-name").text();

        
        //ajax
        $.ajax({

            url: '/visitor/add_validation',
            type: 'POST',
            cache: false,
            data: {
                "visitor_name" : visitor_name,
                "visitor_email" : visitor_email,
                "visitor_address" : visitor_address,
                "visitor_mobile_no" : visitor_mobile_no,
                "necessity" : necessity,
                "person" : person,
                "emotion" : emotion,
                "_token":"{{ csrf_token() }}"
            },
            
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Success',
                    showConfirmButton: false,
                    timer: 3000
                });

        //         //close modal
                $('#modal-first').modal('hide');
                window.location.href = '/visitor';
            },
            // error:function(error){
                
            //     if(error.responseJSON.title[0]) {

            //         //show alert
            //         $('#alert-title-edit').removeClass('d-none');
            //         $('#alert-title-edit').addClass('d-block');

            //         //add message to alert
            //         $('#alert-title-edit').html(error.responseJSON.title[0]);
            //     } 

            //     if(error.responseJSON.content[0]) {

            //         //show alert
            //         $('#alert-content-edit').removeClass('d-none');
            //         $('#alert-content-edit').addClass('d-block');

            //         //add message to alert
            //         $('#alert-content-edit').html(error.responseJSON.content[0]);
            //     } 

            // }

        });

    });

</script>