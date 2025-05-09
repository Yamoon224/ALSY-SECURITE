<script>
    $(function() {
        "use strict";
        Highcharts.chart("chart6", {
            chart: {
                height: 350,
                type: "column",
                styledMode: !0
            },
            credits: {
                enabled: !1
            },
            title: {
                text: "@lang('lang.employees_salarial_mass')"
            },
            accessibility: {
                announceNewData: {
                    enabled: !0
                }
            },
            xAxis: {
                type: "category"
            },
            yAxis: {
                title: {
                    text: "@lang('lang.salarial_volume')"
                }
            },
            legend: {
                enabled: !1
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: !0,
                        format: "{point.y:.2f}%"
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },
            series: [{
                name: "@lang('lang.salarial_volume')",
                colorByPoint: !0,
                data: [{
                    name: "CDI",
                    y: {{ $employees->sum('net') == 0 ? 0 : round(($employees->where('contract', 'CDI')->sum('net')*100)/$employees->sum('net'), 2) }},
                    drilldown: "CDI"
                }, {
                    name: "CDD",
                    y: {{ $employees->sum('net') == 0 ? 0 : round(($employees->where('contract', 'CDD')->sum('net')*100)/$employees->sum('net'), 2) }},
                    drilldown: "CDD"
                }, {
                    name: "@lang('lang.women')",
                    y: {{ $employees->sum('net') == 0 ? 0 : round(($employees->where('gender', 'Femme')->sum('net')*100)/$employees->sum('net'), 2) }},
                    drilldown: "@lang('lang.women')"
                }, {
                    name: "@lang('lang.marries')",
                    y: {{ $employees->sum('net') == 0 ? 0 : round(($employees->where('familystatus', 'Marié(e)')->sum('net')*100)/$employees->sum('net'), 2) }},
                    drilldown: "@lang('lang.marries')"
                }]
            }],
            drilldown: {
                series: [{
                    name: "Chrome",
                    id: "Chrome",
                    data: [
                        ["v65.0", .1],
                        ["v64.0", 1.3],
                        ["v63.0", 53.02],
                        ["v62.0", 1.4],
                        ["v61.0", .88],
                        ["v60.0", .56],
                        ["v59.0", .45],
                        ["v58.0", .49],
                        ["v57.0", .32],
                        ["v56.0", .29],
                        ["v55.0", .79],
                        ["v54.0", .18],
                        ["v51.0", .13],
                        ["v49.0", 2.16],
                        ["v48.0", .13],
                        ["v47.0", .11],
                        ["v43.0", .17],
                        ["v29.0", .26]
                    ]
                }, {
                    name: "Firefox",
                    id: "Firefox",
                    data: [
                        ["v58.0", 1.02],
                        ["v57.0", 7.36],
                        ["v56.0", .35],
                        ["v55.0", .11],
                        ["v54.0", .1],
                        ["v52.0", .95],
                        ["v51.0", .15],
                        ["v50.0", .1],
                        ["v48.0", .31],
                        ["v47.0", .12]
                    ]
                }, {
                    name: "Internet Explorer",
                    id: "Internet Explorer",
                    data: [
                        ["v11.0", 6.2],
                        ["v10.0", .29],
                        ["v9.0", .27],
                        ["v8.0", .47]
                    ]
                }, {
                    name: "Safari",
                    id: "Safari",
                    data: [
                        ["v11.0", 3.39],
                        ["v10.1", .96],
                        ["v10.0", .36],
                        ["v9.1", .54],
                        ["v9.0", .13],
                        ["v5.1", .2]
                    ]
                }, {
                    name: "Edge",
                    id: "Edge",
                    data: [
                        ["v16", 2.6],
                        ["v15", .92],
                        ["v14", .4],
                        ["v13", .1]
                    ]
                }, {
                    name: "Opera",
                    id: "Opera",
                    data: [
                        ["v50.0", .96],
                        ["v49.0", .82],
                        ["v12.1", .14]
                    ]
                }]
            }
        });
    });
</script>