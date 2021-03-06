(function($) {
  'use strict';
  $(function() {
    if ($("#earning-report").length) {
      var earningReportData = {
        datasets: [{
          data: [60, 30, 10],
          backgroundColor: [
            '#439aff',
            '#fdbab1',
            '#90f3c5'
          ],
          borderWidth: 0
        }],
    
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
          'Payment Terminal',
          'Mask',
          'PromptRUB App'
        ]
      };
      var earningReportOptions = {
        responsive: true,
        maintainAspectRatio: true,
        animation: {
          animateScale: true,
          animateRotate: true
        },
        legend: {
          display: false
        },
        legendCallback: function(chart) { 
          var text = [];
          text.push('<ul class="legend'+ chart.id +'">');
          for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
            text.push('<li><span class="legend-label" style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '"></span>');
            if (chart.data.labels[i]) {
              text.push(chart.data.labels[i]);
            }
            text.push('<span class="legend-percentage ml-auto">'+ chart.data.datasets[0].data[i] + '%</span>');
            text.push('</li>');
          }
          text.push('</ul>');
          return text.join("");
        },
        cutoutPercentage: 70     
      };
      var earningReportCanvas = $("#earning-report").get(0).getContext("2d");
      var earningReportChart = new Chart(earningReportCanvas, {
        type: 'doughnut',
        data: earningReportData,
        options: earningReportOptions
      });
      document.getElementById('earning-report-legend').innerHTML = earningReportChart.generateLegend();
    }
  });
  if ($("#chart-activity").length) {
    var areaData = {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
      datasets: [{
          data: [95, 136, 116, 139, 119, 150, 87],
          backgroundColor: [
            '#fdbab1'
          ],
          borderColor: [
            '#fdbab1'
          ],
          borderWidth: 0,
          fill: 'origin',
        },
        {
          data: [143, 250, 179, 220, 185, 240, 122],
          backgroundColor: [
            '#439aff'
          ],
          borderColor: [
            '#439aff'
          ],
          borderWidth: 0,
          fill: 'origin',
        }
      ]
    };
    var areaOptions = {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        filler: {
          propagate: false
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            lineWidth: 0,
            color: "rgba(0,0,0,0)"
          }
        }],
        yAxes: [{
          display: false,
          ticks: {
            display: false,
            autoSkip: false,
            maxRotation: 0,
            stepSize: 15,
            min: 0,
            max: 250
          }
        }]
      },
      legend: {
        display: false
      },
      tooltips: {
        enabled: true
      },
      elements: {
        line: {
          tension: 0
        },
        point: {
          radius: 0
        }
      }
    }
    var activityChartCanvas = $("#chart-activity").get(0).getContext("2d");
    var activityChart = new Chart(activityChartCanvas, {
      type: 'line',
      data: areaData,
      options: areaOptions
    });

  }
  if ($('#sales-chart').length) {
    var lineChartCanvas = $("#sales-chart").get(0).getContext("2d");
    var data = {
      labels: ["???.???.","???.???.","??????.???.","??????.???.","???.???.","??????.???.","???.???.","???.???.","???.???.","???.???.","???.???.","???.???."],
      datasets: [
        {
          label: '??????????????????????????????????????????',
          data: [30, 80, 120, 66, 20, 10, 78, 80, 199, 35, 40, 99],
          borderColor: [
            '#fdbab1'
          ],
          borderWidth: 3,
          fill: false
        }
      ]
    };
    var options = {
      scales: {
        yAxes: [{
          display: true,
          gridLines: {
            drawBorder: false,
            lineWidth: 0,
            color: "rgba(0,0,0,0)"
          },
          ticks: {
            stepSize: 20,
            fontColor: "#686868"
          }
        }],
        xAxes: [{
          gridLines: {
            drawBorder: false,
            lineWidth: 0,
            color: "rgba(0,0,0,0)"
          }
        }]
      },
      legend: {
        display: true
      },
      elements: {
        point: {
          radius: 0
        }
      },
      stepsize: 1
    };
    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: data,
      options: options
    });
  }
  if ($('#sales-chart2').length) {
    var lineChartCanvas2 = $("#sales-chart2").get(0).getContext("2d");
    var data2 = {
      labels: ["???.???.","???.???.","??????.???.","??????.???.","???.???.","??????.???.","???.???.","???.???.","???.???.","???.???.","???.???.","???.???."],
      datasets: [
        {
          label: '??????????????? Biller ID',
          data: [15, 30, 60, 14, 79, 80, 180, 40, 101, 80, 33, 80],
          borderColor: [
            '#439aff'
          ],
          borderWidth: 3,
          fill: false
        }
      ]
    };
    var options2 = {
      scales: {
        yAxes: [{
          display: true,
          gridLines: {
            drawBorder: false,
            lineWidth: 0,
            color: "rgba(0,0,0,0)"
          },
          ticks: {
            stepSize: 20,
            fontColor: "#686868"
          }
        }],
        xAxes: [{
          gridLines: {
            drawBorder: false,
            lineWidth: 0,
            color: "rgba(0,0,0,0)"
          }
        }]
      },
      legend: {
        display: true
      },
      elements: {
        point: {
          radius: 0
        }
      },
      stepsize: 1
    };
    var lineChart2 = new Chart(lineChartCanvas2, {
      type: 'line',
      data: data2,
      options: options2
    });
  }
  if ($("#inline-datepicker-example").length) {
    $('#inline-datepicker-example').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
    });
  }
})(jQuery);
