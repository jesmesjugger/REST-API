$(document).ready(function(){
    var width = 600, height = 500;
    var margin = {"top":50,"right":50,"bottom":50,"left":50};

    var svg = d3.select("#svg-card").append("svg")
        .attr("width", width)
        .attr("height", height),
    width = svg.attr("width")-200,
    height = svg.attr("height")-200;
        
        //scaleBand used with discrete data e.g. 2011, 2012
    var xScale = d3.scaleBand().range([0,width]).padding(0.4),
    yScale = d3.scaleLinear().range([height, 0]);

    var g = svg.append("g")
        .attr("transform", "translate(" + 100 + "," + 100 + ")");

    d3.json("test.json").then(data=>{
        xScale.domain(data.map(d=>d.year));
        yScale.domain([0, d3.max(data, d=>d.value)]);

        g.append("g")
         .attr("transform", "translate(0," + height + ")")
         .call(d3.axisBottom(xScale));

         g.append("g")
         .call(d3.axisLeft(yScale).tickFormat(function(d){
             return "$" + d;
         }))
         .append("text")
         .attr("y", 6)
         .attr("dy", "0.71em")
         .attr("text-anchor", "end")
         .text("value");

         g.selectAll(".bar")
         .data(data)
         .enter().append("rect")
         .attr("class", "bar")
         .on('mouseover',mouseOver)
         .on('mouseout',mouseOut)
         .attr("x", function(d) { return xScale(d.year); })
         .attr("y", function(d) { return yScale(d.value); })
         .attr("width", xScale.bandwidth())
         .attr("height", function(d) {return height - yScale(d.value); });

         svg.append("text")
        .attr("transform", "translate(100,0)")
        .attr("x", 50)
        .attr("y", 50)
        .attr("font-size", "24px")
        .text("XYZ Foods Stock Price");    
    });

});