$(document).ready(function(){
    var svg = d3.select("#svg-card")
    .append("svg")
    .attr("width","100%")
    .attr("height","500")
    .style("background-color","#efefef");

    svg.append("rect")
    .attr("x",100)
    .attr("y",100)
    .attr("width","5%")
    .attr("height",100)
    .attr("stroke", "black");
});