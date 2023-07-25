@extends('dashboard')

@section('content')
<div class="row">

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-calendar text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Today</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{ $count_today }}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-account mr-1" aria-hidden="true"></i> Number of Visitors Today
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-calendar text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Yesterday</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{ $count_yesterday }}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-account mr-1" aria-hidden="true"></i> Number of Visitors Yesterday
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-calendar text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">A Week</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{ $count_week }}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-account mr-1" aria-hidden="true"></i> Number of Visitors in a Week
                  </p>
                </div>
              </div>
            </div>
</div>
<div class="row">
  
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Emotion Visitor</h4>
      </div>
      <canvas id="stackedBarChart" style="height: 300px;" class="ml-4 mr-4" ></canvas>
    </div>
  </div>   
</div>
@endsection

@section('js')
<script>
  // document.addEventListener('DOMContentLoaded', function () {
  //     var ctx = document.getElementById('stackedBarChart').getContext('2d');
  //     var stackedBarChart = new Chart(ctx, {
  //         type: 'bar',
  //         data: {
  //             labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], // Ganti dengan label-label yang sesuai
  //             datasets: [
  //                 {
  //                     label: 'Angry \u{1F620}',
  //                     data: [10, 20, 30], // Ganti dengan data-data yang sesuai
  //                     backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang dataset 1
  //                     borderColor: 'rgba(75, 192, 192, 1)', // Warna garis dataset 1
  //                     borderWidth: 1
  //                 },
  //                 {
  //                     label: 'Happy \u{1F60A}',
  //                     data: [15, 25, 35], // Ganti dengan data-data yang sesuai
  //                     backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang dataset 2
  //                     borderColor: 'rgba(255, 99, 132, 1)', // Warna garis dataset 2
  //                     borderWidth: 1
  //                 },
  //                 {
  //                     label: 'Netral \u{1F610}',
  //                     data: [15, 25, 35], // Ganti dengan data-data yang sesuai
  //                     backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang dataset 2
  //                     borderColor: 'rgba(255, 99, 132, 1)', // Warna garis dataset 2
  //                     borderWidth: 1
  //                 },
  //                 {
  //                     label: 'Sad \u{1F622}',
  //                     data: [15, 25, 35], // Ganti dengan data-data yang sesuai
  //                     backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang dataset 2
  //                     borderColor: 'rgba(255, 99, 132, 1)', // Warna garis dataset 2
  //                     borderWidth: 1
  //                 }
  //             ]
  //         },
  //         options: {
  //             scales: {
  //                 x: {
  //                     stacked: true
  //                 },
  //                 y: {
  //                     stacked: true
  //                 }
  //             }
  //         }
  //     });
  // });
  document.addEventListener('DOMContentLoaded', function () {
  var ctx = document.getElementById('stackedBarChart').getContext('2d');

  function fetchFeedbackData() {
    // Kirim permintaan Ajax ke API di sisi server
    fetch('/dashboard/charts')
      .then(response => response.json())
      .then(data => {
        var labels = Object.keys(data);
        var datasets = [
          {
            label: 'Sad \u{1F622}',
            data: labels.map(date => data[date]['sad']),
            backgroundColor: 'rgba(75, 192, 192, 0.6)', // Warna untuk kategori "sad"
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          },
          {
            label: 'Angry \u{1F620}',
            data: labels.map(date => data[date]['angry']),
            backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna untuk kategori "angry"
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
          },
          {
            label: 'Happy \u{1F60A}',
            data: labels.map(date => data[date]['happy']),
            backgroundColor: 'rgba(255, 205, 86, 0.6)', // Warna untuk kategori "happy"
            borderColor: 'rgba(255, 205, 86, 1)',
            borderWidth: 1
          },
          {
            label: 'Netral \u{1F610}',
            data: labels.map(date => data[date]['netral']),
            backgroundColor: 'rgba(54, 162, 235, 0.6)', // Warna untuk kategori "netral"
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }
        ];
        
        var stackedBarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: datasets
          },
          options: {
            scales: {
              xAxes: {
                stacked: true,
              },
              yAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize: 1,
                    precision: 0
                }
            }]
              // y: {
              //   // stacked: true,
              //   beginAtZero: true, // Menetapkan label sumbu Y dimulai dari 0
              //   stepSize: 1,
              //   precision: 0 // Menetapkan jumlah angka desimal pada label sumbu Y menjadi 0
              // }
            }
          }
        });
      })
      .catch(error => {
        console.error('Error fetching feedback data:', error);
      });
  }

  fetchFeedbackData();
});

</script>
@stop