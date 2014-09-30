$(document).ready(function(){
    // CPU
    (function(){
        var data = [];
        var plot;
        var setLength = 300;
        var updateInterval = 500; //Fetch data ever x milliseconds
        var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching

        function update(){
            $.ajax({
                data:{data:"cpu_usage"},
                dataType: "json",
                success: function(result){
                    $.each(result, function(k,v){
                        if(data[k] == undefined){
                            var sample = [];
                            for(var i = 1; i <= setLength; i++){
                                sample.push([i, 0])
                            }
                            data[k] = {label:" CPU"+k, data:sample}
                        } else {
                            for(var i = 0; i < setLength - 1; i++){
                                data[k]["data"][i] = [i+1, data[k]["data"][i+1][1]]
                            }
                            data[k]["data"][setLength - 1] = ([setLength, v * 100])
                        }
                    })
                    if(!plot){
                        plot = $.plot("#cpu-usage .chart", data, {
                            grid: {
                                borderColor: "#f3f3f3",
                                borderWidth: 1,
                                tickColor: "#f3f3f3"
                            },
                            series: {
                                shadowSize: 0 // Drawing is faster without shadows
                                //color: "#3c8dbc"
                            },
                            lines: {
                                //color: "#3c8dbc"
                            },
                            yaxis: {
                                min: 0,
                                max: 100,
                                show: true
                            },
                            xaxis: {
                                show: false
                            }
                        });
                    } else {
                        plot.setData(data);
                        plot.draw();
                    }
                    if(realtime == "on"){
                        setTimeout(update, updateInterval)
                    }
                }
            })
        }
        if (realtime === "on") {
            update();
        }

        $("#cpu-usage .realtime .btn").click(function() {
            if ($(this).data("toggle") === "on") {
                realtime = "on";
                update();
            }
            else {
                realtime = "off";
            }
        });
    })();

    // Memory
    (function(){
        var data;
        var plot;
        var setLength = 300;
        var updateInterval = 500; //Fetch data ever x milliseconds
        var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching

        function update(){
            $.ajax({
                data:{data:"memory_usage"},
                success: function(result){
                    if(!data){
                        data = [];
                        for(var i = 1; i <= setLength; i++){
                            data.push([i, 0])
                        }
                    } else {
                        for(var i = 0; i < setLength - 1; i++){
                            data[i] = [i+1, data[i+1][1]];
                        }
                        data[setLength - 1] = [setLength, parseFloat(result) * 100];
                    }
                    if(!plot){
                        plot = $.plot("#memory-usage .chart", [data], {
                            grid: {
                                borderColor: "#f3f3f3",
                                borderWidth: 1,
                                tickColor: "#f3f3f3"
                            },
                            series: {
                                shadowSize: 0,
                                color: "#3c8dbc"
                            },
                            lines: {
                                color: "#3c8dbc"
                            },
                            yaxis: {
                                min: 0,
                                max: 100,
                                show: true
                            },
                            xaxis: {
                                show: false
                            }
                        });
                    } else {
                        plot.setData([data]);
                        plot.draw();
                    }
                    if(realtime == "on"){
                        setTimeout(update, updateInterval)
                    }
                }
            })
        }
        if (realtime === "on") {
            update();
        }

        $("#memory-usage .realtime .btn").click(function() {
            if ($(this).data("toggle") === "on") {
                realtime = "on";
                update();
            }
            else {
                realtime = "off";
            }
        });
    })()
})
