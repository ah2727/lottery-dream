<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure mt-5">
    <div id="container" class="pt-5"></div>
</figure>

<?php 
$red=new readingData();
$transaction = $red->getTransactions()
?>
<script>
    const chart = Highcharts.chart('container', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'count and incomming'
        },


        legend: {
            align: 'right',
            verticalAlign: 'middle',
            layout: 'vertical'
        },

        xAxis: {
            categories: ['2019', '2020', '2021'],
            labels: {
                x: -10
            }
        },

        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Amount'
            }
        },

        series: [{
            name: 'count',
            data: [<?=$transaction['total_count']?>]
        }, {
            name: 'total',
            data: [<?=$transaction['total_amount']?>]
        }, {
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal'
                    },
                    yAxis: {
                        labels: {
                            align: 'left',
                            x: 0,
                            y: -5
                        },
                        title: {
                            text: null
                        }
                    },
                    subtitle: {
                        text: null
                    },
                    credits: {
                        enabled: false
                    }
                }
            }]
        }
    });


</script>

<style>
    .highcharts-credit{
        display: none;
    }
</style>