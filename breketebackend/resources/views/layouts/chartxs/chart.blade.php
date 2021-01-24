<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */



    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    $reportvar = 11;
    $resolvedvar = 23;
    $pendingvar = 45;
    $testimonialvar = 27;

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    //For douhnut data
    var donutData        = {
      labels: [
          'Complaints',
          'Resolved',
          'Pending'
                ],
      datasets: [
        {
          data: [$reportvar,$resolvedvar,$pendingvar],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
      ]
    }

    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.

    //For pie data1
    var pieData1        = {
      labels: [
          'Resolved',
          'Pending'
                ],
      datasets: [
        {
          data: [$resolvedvar,$pendingvar],
          backgroundColor : ['#00a65a','#f56954'],
        }
      ]
    }
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = pieData1;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData1,
      options: pieOptions
    })

     //For pie data2
     var pieData2      = {
      labels: [
          'Complaints',
          'Testimonial'
                ],
      datasets: [
        {
          data: [$reportvar,$testimonialvar],
          backgroundColor : ['#f56954', '#00a65a'],
        }
      ]
    }
       //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
    var pieData        = pieData2;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData2,
      options: pieOptions
  })
</script>
