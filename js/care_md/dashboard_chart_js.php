<?php 
require_once('./roots.php');
 ?>
<script>

$.getJSON("<?php echo $root_path.'modules/dashboard/patientTrends.php' ?>").done(function(data){

    var config = {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: data.series
      },
      options: {
        responsive: true,
        title: {
          display: true,
        },
        legend: {
            position: 'left',
            labels: {
                boxWidth: 20,
                padding: 20
            }
        }
      }
    };
     var ctx = document.getElementById('patienttrends').getContext('2d');
      window.patients = new Chart(ctx, config);

}).fail(function(){
  console.log('error');
})


$.getJSON("<?php echo $root_path.'modules/dashboard/TopDiseases.php' ?>").done(function(response){
var diseaseConfig = {
      type: 'doughnut',
      data: {
        datasets: [{
          data: response.data,
          backgroundColor: response.background,
          label: 'Dataset 1'
        }],
        labels: response.labels
      },
      options: {
        responsive: true,
        legend: {
            position: 'right',
            labels: {
                boxWidth: 20,
                padding: 20
            }
        },
        title: {
          display: true,
          text: 'Top Diseases'
        },
        animation: {
          animateScale: true,
          animateRotate: true
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
              var dataset = data.datasets[tooltipItem.datasetIndex];
              var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                return previousValue + currentValue;
              });


              var currentValue = dataset.data[tooltipItem.index];
              var currentLabel = data.labels[tooltipItem.index];
              var percentage = Math.floor(((currentValue/total) * 100)+0.5);         
              return  currentLabel + " " + numberWithCommas(currentValue) + " equivalent to " + percentage + "%";
            }
          }
        }
      }
    };

    var dcht = document.getElementById('topdiseases').getContext('2d');
    window.topDiseasesChart = new Chart(dcht, diseaseConfig);

    // document.getElementById('randomizeData').addEventListener('click', function() {
    //   config.data.datasets.forEach(function(dataset) {
    //     dataset.data = dataset.data.map(function() {
    //       return randomScalingFactor();
    //     });
    //   });
    //   window.topDiseasesChart.update();
    // });


});



$.getJSON("<?php echo $root_path.'modules/dashboard/FrequentDrugs.php' ?>").done(function(response){
var drugconfig = {
      type: 'doughnut',
      data: {
        datasets: [{
          data: response.data,
          backgroundColor: response.background,
          label: 'Frequent Drugs'
        }],
        labels: response.labels
      },
      options: {
        responsive: true,
        legend: {
            position: 'left',
            labels: {
                boxWidth: 20,
                padding: 20
            }
        },
        title: {
          display: true,
          text: 'Frequent Drugs'
        },
        animation: {
          animateScale: true,
          animateRotate: true
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
              var dataset = data.datasets[tooltipItem.datasetIndex];
              var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                return previousValue + currentValue;
              });


              var currentValue = dataset.data[tooltipItem.index];
              var currentLabel = data.labels[tooltipItem.index];
              var percentage = Math.floor(((currentValue/total) * 100)+0.5);         
              return  currentLabel + " " + numberWithCommas(currentValue) + " equivalent to " + percentage + "%";
            }
          }
        }
      }
    };

    var freqntdchart = document.getElementById('frequentdrugs').getContext('2d');
    window.topDiseasesChart = new Chart(freqntdchart, drugconfig);
});



$.getJSON("<?php echo $root_path.'modules/dashboard/ServedPatients.php' ?>").done(function(response){
var barChartData = {
      labels: response.labels,
      datasets: response.datasets
    };
    
   var servedctx = document.getElementById('servedpatients').getContext('2d');
    window.servedPatientBar = new Chart(servedctx, {
      type: 'bar',
      data: barChartData,
      options: {
        title: {
          display: true,
          text: 'Served & Unserved Customers'
        },
        tooltips: {
          mode: 'index',
          intersect: false
        },
        responsive: true,
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        }
      }
    });


}).fail(function(){
  console.log('error');
})



const numberWithCommas = (x) => {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


</script>