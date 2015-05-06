
 $(document).ready(function() {
                $("#dataTable").convertToFusionCharts({type: "msline",
                    width: "100%",
                    height: "405",
                    dataFormat: "htmltable",
                    renderAt: "chartContainer",
                    renderer: "javascript"
                }, {
                    "chartAttributes": {
                        caption: "Pengunjung Rumah Sakit",
                        xAxisName: "Month",
                        yAxisName: "Units",
                        bgColor: "FFFFFF",
                        chartLeftMargin: "5",
                        chartRightMargin: "15",
                        labelDisplay: "ROTATE"
                    },
                    //Do not hide the table once chart is rendered
                    "hideTable": false
                });
            });
	