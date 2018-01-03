<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  ChartHoratiu
 *
 * @file           full-width-page.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>area > datasets | Chart.js sample</title>
    <link rel="stylesheet" type="text/css" href="http://www.chartjs.org/samples/latest/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
    <script src="http://www.chartjs.org/samples/latest/utils.js"></script>
    <script src="http://www.chartjs.org/samples/latest/charts/area/analyser.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.2.1.js"
      integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.8.3/jquery.csv.js"></script>
</head>
<body>
        <div class="wrapper">
            <canvas id="chart-0"></canvas>
        </div>
        <!--div class="toolbar">
            <button onclick="togglePropagate(this)">Propagate</button>
            <button onclick="toggleSmooth(this)">Smooth</button>
            <button onclick="randomize(this)">Randomize</button>
        </div-->
        <!--div id="chart-analyser" class="analyser"></div-->

    <script>
        var presets = window.chartColors;
        var utils = Samples.utils;
        var inputs = {
            min: 20,
            max: 80,
            count: 8,
            decimals: 2,
            continuity: 1
        };

        function generateData() {
            return utils.numbers(inputs);
        }

        function generateLabels(config) {
            return utils.months({count: inputs.count});
        }

        $.ajax({
          type: "GET",
          url: 'http://www.diaconescuradu.com/wp-content/uploads/data/AerobicPowerHoratiu.csv',
          dataType: 'text',
          async: false,
        }).done(loadData);

        function loadData(allText) {
            data = $.csv.toArrays(allText)
            weeks = []
            power60 = []
            power30 = []
            power20 = []
            power10 = []
            power5 = []
            for(var i = 1; i < data.length; i++) {
                var line = data[i];
                weeks.push(line[0])
                power60.push(line[2])
                power30.push(line[3])
                power20.push(line[4])
                power10.push(line[5])
                power5.push(line[6])
                }
            console.log(weeks)
        }

        utils.srand(42);

        var data = {
            labels: weeks,
            datasets: [{
                backgroundColor: utils.transparentize(presets.red),
                borderColor: presets.red,
                data: power60,
                hidden: true,
                label: '60 min power'
            }, {
                backgroundColor: utils.transparentize(presets.orange),
                borderColor: presets.orange,
                data: power30,
                label: '30 min power',
            }, {
                backgroundColor: utils.transparentize(presets.yellow),
                borderColor: presets.yellow,
                data: power20,
                hidden: true,
                label: '20 min power',
            }, {
                backgroundColor: utils.transparentize(presets.green),
                borderColor: presets.green,
                data: power10,
                label: '10 min power',
            }, {
                backgroundColor: utils.transparentize(presets.blue),
                borderColor: presets.blue,
                data: power5,
                label: '5 min power',
            }]
        };

        var options = {
            maintainAspectRatio: false,
            spanGaps: false,
            elements: {
                line: {
                    tension: 0.000001
                }
            },
            scales: {
                yAxes: [{
                    stacked: true
                }]
            },
            plugins: {
                filler: {
                    propagate: false
                },
                samples_filler_analyser: {
                    target: 'chart-analyser'
                }
            }
        };

        var chart = new Chart('chart-0', {
            type: 'line',
            data: data,
            options: options
        });

        function togglePropagate(btn) {
            var value = btn.classList.toggle('btn-on');
            chart.options.plugins.filler.propagate = value;
            chart.update();
        }

        function toggleSmooth(btn) {
            var value = btn.classList.toggle('btn-on');
            chart.options.elements.line.tension = value? 0.4 : 0.000001;
            chart.update();
        }

        function randomize() {
            chart.data.datasets.forEach(function(dataset) {
                dataset.data = generateData();
            });
            chart.update();
        }
    </script>
</body>
</html>
