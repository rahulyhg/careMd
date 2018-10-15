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
     patients = new Chart(ctx, config);

}).fail(function(data){
  console.log(data);
})

$("#patienttrendselect").change(function(){
  
  var period = $('#patienttrendselect').val();

  $.getJSON("<?php echo $root_path.'modules/dashboard/patientTrends.php?period=' ?>"+period).done(function(data){

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
      patients.destroy();
      var ctx = document.getElementById('patienttrends').getContext('2d');
      patients = new Chart(ctx, config);

}).fail(function(data){
  console.log(data);
})

})


$.getJSON("<?php echo $root_path.'modules/dashboard/TopDiseases.php' ?>").done(function(response){
var diseaseConfig = {
      type: 'doughnut',
      data: {
        datasets: [{
          data: response.data,
          backgroundColor: response.background,
          label: 'Top Diseases'
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
          // text: 'Top Diseases'
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
    topDiseasesChart = new Chart(dcht, diseaseConfig);

    // document.getElementById('randomizeData').addEventListener('click', function() {
    //   config.data.datasets.forEach(function(dataset) {
    //     dataset.data = dataset.data.map(function() {
    //       return randomScalingFactor();
    //     });
    //   });
    //  frequentdrugs.update();
    // });


});


    $('#topdiseasesselect').change(function(){
      var count = $('#topdiseasesselect').val();

      $.getJSON("<?php echo $root_path.'modules/dashboard/TopDiseases.php/?count=' ?>"+count).done(function(responseselect){
        var diseaseConfig = {
              type: 'doughnut',
              data: {
                datasets: [{
                  data: responseselect.data,
                  backgroundColor: responseselect.background,
                  label: 'Top Diseases'
                }],
                labels: responseselect.labels
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
                  // text: 'Top Diseases'
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
              topDiseasesChart.destroy();
              var dcht = document.getElementById('topdiseases').getContext('2d');
              topDiseasesChart = new Chart(dcht, diseaseConfig);

          })  
    })



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
   frequentdrugs = new Chart(freqntdchart, drugconfig);
});


$('#frequentdrugsselect').change(function(){
   var count = $('#frequentdrugsselect').val();
  $.getJSON("<?php echo $root_path.'modules/dashboard/FrequentDrugs.php?count=' ?>"+count).done(function(response){
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
   frequentdrugs.destroy();
    var freqntdchart = document.getElementById('frequentdrugs').getContext('2d');
   frequentdrugs = new Chart(freqntdchart, drugconfig);
});

})


$.getJSON("<?php echo $root_path.'modules/dashboard/ServedPatients.php' ?>").done(function(response){
var barChartData = {
      labels: response.labels,
      datasets: response.datasets
    };
    
   var servedctx = document.getElementById('servedpatients').getContext('2d');
    servedPatientBar = new Chart(servedctx, {
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

$('#servedpatientselect').change(function(){
   var period = $('#servedpatientselect').val();

   $.getJSON("<?php echo $root_path.'modules/dashboard/ServedPatients.php?period=' ?>"+period).done(function(response){
    var barChartData = {
          labels: response.labels,
          datasets: response.datasets
        };
        
        servedPatientBar.destroy();
        var servedctx = document.getElementById('servedpatients').getContext('2d');
        servedPatientBar = new Chart(servedctx, {
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

});


const numberWithCommas = (x) => {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


</script>